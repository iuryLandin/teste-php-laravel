<table class="table table-bordered mb-3 ">
  <thead>
    <tr class="table-success">
      <th scope="col">#</th>
      <th scope="col">Titulo</th>
      <th scope="col">Conteúdo</th>
      <th scope="col">Exercicio</th>
      <th scope="col">Categoria</th>
    </tr>
  </thead>
  <tbody>
    @foreach($documents as $data)
    <tr>
      <th scope="row">{{ $data->id }}</th>
      <td>{{ $data->title }}</td>
      <td class="text-truncate"> {{ $data->contents }}</td>
      <td>{{ $data->reference }}</td>
      <td>{{ $data->category->name }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="d-grid">
    {!! $documents->links('pagination::bootstrap-5') !!}
</div>

<style>
  .text-truncate {
    max-width: 200px;
    overflow: hidden !important;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
</style>