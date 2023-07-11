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
        <li class="breadcrumb-item active" aria-current="page">Fila</li>
      </ol>
    </nav>
  </div>
</div>

<div class="card p-2 my-2">
  <div class="row">
    <div class="col-md-6 my-1">
      <h3>Fila de Documentos</h3>
    </div>
  </div>

  @foreach ($errors->all() as $error)
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ $error }}
  </div>
  @endforeach

  <div class="row">
    <div class="col-md-12 my-1">
      <strong>Itens na fila:</strong> {{$totalItems}}
    </div>

    @if(isset($totalItems))
    <div class="col-md-12 my-1">
      {!! Form::open(['url' => route('documents.processQueue'), 'method' => 'post']) !!}
      <button class="btn btn-primary" type="submit"><i class="bi bi-arrow-right-square"></i> Processar Fila</button>
      {!! Form::close() !!}
    </div>
    @endif

  </div>
</div>
@endsection