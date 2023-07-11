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
        <li class="breadcrumb-item active" aria-current="page">Documentos</li>
      </ol>
    </nav>
  </div>
</div>

<div class="card p-2 my-2">
  <div class="row">
    <div class="col-md-6 my-1">
      <h3>Documentos</h3>
    </div>
    <div class="col-md-6 my-2">
      <a class="btn btn-sm btn-primary" href="{{ route('documents.create') }}"><i class="bi bi-upload"></i>
        Importar
      </a>

      @if ($hasPendingJobs)
      <a class="btn btn-sm btn-info" href="{{ route('documents.showQueue') }}"><i class="bi bi-card-list"></i>
       Ver Fila
      </a>
      @endif
    </div>
  </div>
  <div class="content">
    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
      <span class="alert-inner--icon"><i class="bi bi-check"></i></span>
      <span class="alert-inner--text">{{ session('status') }}</span>
    </div>
    @endif
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
      <span class="alert-inner--icon"><i class="bi bi-exclamation-triangle"></i></span>
      <span class="alert-inner--text">{{ $error }}</span>
    </div>
    @endforeach
    @if (isset($documents))
    <div id="table-container" class="table-responsive">
      @include('layouts.table_documents')
    </div>
    @endif
  </div>

</div>
{{-- Modal Alerta Para remoção de Documento --}}
<div class="modal fade" id="modalAlert" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alerta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['method' => 'delete', 'id' => 'delete-form']) !!}
      @csrf
      @method('delete')
      <div class="modal-body">
        <h3>Tem certeza que deseja remover?</h3>
      </div>
      <div class="modal-footer d-flex">
        <a><button data-dismiss="modal" aria-label="Close" type="button" class="btn btn-secondary">Cancelar</button></a>
        <button id="remover" type="submit" class="btn btn-warning">Confirmar</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@push('js')
<script>
  const remove_icon = document.querySelectorAll('.remove-icon');
  remove_icon.forEach(item => {
    item.addEventListener('click', event => {
      const removeElement = document.getElementById('delete-form');
      try {
        let id = item.getAttribute('data-id');
        removeElement.setAttribute('action', `/documents/${id}`)
      } catch (e) {
        console.warn(e);
      }
    })
  })
</script>
@endpush
@endsection