@extends('layouts.adminPage')
@section('title', "SCAAP - Admin")

@section('content')
@if(session('msg'))
  <p class="msg">{{ session('msg') }}</p>
@endif
@if(session('msgError'))
  <p class="msgError">{{ session('msgError') }}</p>
@endif
<div class="container">
  <div class="ms-3 pt-3 mb-3">
    <h4>Editar Segmento</h4>
  </div>
  <form action="" method="post">
    @csrf
    @method('put')
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" value="{{$seg->nome}}" class="form-control" id="nome" name="nome">
    </div>
    <div class="mb-3">
      <label for="tipo" class="form-label">Tipo</label>
      <select class="form-select" id="tipo" name="tipo">
        <option {{ $seg->tipo == 1 ? 'selected' : '' }} value="1">Cultural</option>
        <option {{ $seg->tipo == 2 ? 'selected' : '' }} value="2">Esportivo</option>
      </select>
    </div>
    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-success">Editar Segmento</button>
    </div>
  </form>
  <hr>
  <div class="ms-3 mb-3">
    <h4>Tabela de Segmentos</h4>
  </div>
  <div id="table" class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th class="ps-4">ID</th>
          <th>Nome</th>
          <th>Cpf</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($segmentos as $segmento)
          <tr>
            <td class="ps-4">{{$segmento->id}}</td>
            <td>{{$segmento->nome}}</td>
            <td>
              @if ($segmento->tipo == 1)
                Cultural
              @else
                Esportivo
              @endif
            </td>
            <td class="d-flex justify-content-end">
              <a class="me-2" href="/scaap/admin/segmentos/editar/{{$segmento->id}}"><button type="button" class="btn btn-primary btn-sm">Editar</button></a>
              <a href="/scaap/admin/segmentos/deletar/{{$segmento->id}}"><button type="button" class="btn btn-danger btn-sm">Deletar</button></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div id="pagination" class="d-flex justify-content-center mt-3">
    {{ $segmentos->onEachSide(1)->links() }}
  </div>
</div>
@endsection
