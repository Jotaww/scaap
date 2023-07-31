@extends('layouts.adminPage')
@section('title', "SCAAP - Admin")

@section('content')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container">
  <div class="ms-3 mb-3 pt-3">
    <h4>Tabela de usuarios esperando aprovação</h4>
  </div>
  <div id="table" class="table-responsive">
    <table id="example" class="table table-striped table-hover">
      <thead>
        <tr>
          <th class="ps-4">Nome</th>
          <th>Tipo</th>
          <th>Cidade/Bairro</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td class="ps-4">{{$user->nomeArtistico}}</td>
            <td>{{$user->tipo}}</td>
            <td>{{$user->cidade}}/{{$user->bairro}}</td>
            <td>
              <a href="/scaap/admin/editar/{{$user->id_user}}"><button type="button" class="btn btn-primary btn-sm me-2">Editar</button></a>
              <a href="/scaap/admin/aguardandoRetorno/motivo/{{$user->id_user}}"><button type="button" class="btn btn-secondary btn-sm me-2">Motivo</button></a>
              
              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#{{$user->id_user}}">
                Deletar
              </button>

              <div class="modal fade" id="{{$user->id_user}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Atenção</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Voce realmente deseja deletar esse usuario ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a href="/scaap/admin/deletar/{{$user->id_user}}"><button type="button" class="btn btn-danger">Deletar</button></a>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<!-- Ativando tabela-->
<script src="{{asset('js/tabela.js')}}"></script>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
  integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
@endsection
