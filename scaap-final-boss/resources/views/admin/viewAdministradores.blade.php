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
    <h4>Criar Administrador</h4>
  </div>
  <form action="" method="post">
    @csrf
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome">
    </div>
    <div class="mb-3">
      <label for="cpf" class="form-label">Cpf</label>
      <input type="text" class="form-control" id="cpf" name="cpf">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Senha</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-success">Criar Administrador</button>
    </div>
  </form>
  <hr>
  <div class="ms-3 mb-3">
    <h4>Tabela de Administradores</h4>
  </div>
  <div id="table" class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th class="ps-4">Nome</th>
          <th>Cpf</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($adms as $adm)
          <tr>
            <td class="ps-4">{{$adm->nome}}</td>
            <td>{{$adm->cpf}}</td>
            <td class="d-flex justify-content-end">
              @if ($adm->admin == 1)
              <a class="me-2" href="/scaap/admin/administradores/bloquear/{{$adm->id}}"><button type="button" class="btn btn-warning btn-sm">Bloquear</button></a>
              @else
              <a class="me-2" href="/scaap/admin/administradores/desbloquear/{{$adm->id}}"><button type="button" class="btn btn-primary btn-sm">Desbloquear</button></a>
              @endif
              <a href="/scaap/admin/administradores/deletar/{{$adm->id}}"><button type="button" class="btn btn-danger btn-sm">Deletar</button></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div id="pagination" class="d-flex justify-content-center mt-3">
    {{ $adms->onEachSide(1)->links() }}
  </div>
</div>
@endsection
