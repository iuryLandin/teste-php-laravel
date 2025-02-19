@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('index') }}"><i class="fas fa-home"></i>
            Início
          </a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('documents.index') }}"><i class="fas fa-home"></i>
            Documentos
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Importar</li>
      </ol>
    </nav>
  </div>
</div>

<div class="card p-2 my-2">
  <div class="row">
    <div class="col-md-6 my-1">
      <h3>Importar Documentos</h3>
    </div>
  </div>

  @foreach ($errors->all() as $error)
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ $error }}
  </div>
  @endforeach

  <div class="row">
    {!! Form::open(['method' => 'post', 'url' => route('documents.store'), 'files' => true, 'id' => 'upload-form']) !!}
    @csrf
    @method('post')
    <div class="col-md-6 my-1">
      <label class="text-warning">Arquivo suportado: JSON</label>
      <input type="file" class="form-control" name="jsonfile" id="jsonfile" accept="application/json" required />
    </div>
    <div class="col-md-3 my-1">
      <button class="btn btn-success btn-block" type="submit">Enviar</button>
    </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection