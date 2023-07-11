<?php

namespace App\Http\Controllers;

use App\Jobs\DocumentsJob;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Validator;

class DocumentsController extends Controller
{
  public function index()
  {
    $hasPendingJobs = Queue::size('default') > 0;
    $documents = Documents::orderBy('id', 'DESC')->paginate(10);
    return view('app.documents.index', ['hasPendingJobs' => $hasPendingJobs, 'documents' => $documents]);
  }

  public function create()
  {
    return view('app.documents.create');
  }

  public function showQueue()
  {
    $totalItems = Queue::size('default');
    return view('app.documents.showQueue', ['totalItems' => $totalItems]);
  }

  public function processQueue()
  {
    try {
      $exitCode = Artisan::call('queue:work --stop-when-empty', []);
      return redirect()->route('documents.index')->with('status', 'Sucesso! Fila de documentos processada.');
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['Erro ao Processar fila', $e->getMessage()]);
    }
  }

  public function store(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'jsonfile' => 'required|file|mimetypes:application/json'
      ]
    );

    if ($validator->fails()) {
      return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
    }

    $file = $request->file('jsonfile');
    $content = file_get_contents($file);
    $json = json_decode($content, true);
    $reference = $json['exercicio'];
    collect($json['documentos'])->each(function ($doc) use ($reference) {
      DocumentsJob::dispatch([
        'category' => $doc['categoria'],
        'title' => $doc['titulo'],
        'contents' =>  $doc['conteúdo'],
        'reference' => $reference,
      ])->onQueue('default');
    });

    return redirect()->route('documents.index')->with('status', 'Arquivo adicionado à fila de importação!');
  }
}
