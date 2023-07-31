@extends('layouts.homePage')
@section('title', "SCAAP - Visualizar")

@section('content')
<div class="container pt-4">
  <div class="tipoCadastro ms-3 mb-4">
    @if ($user->produtorCultural == 1)
      <div class="form-check me-4">
        <input class="form-check-input" type="checkbox" checked disabled>
        <label class="form-check-label">Produtor Cultural</label>
      </div>
    @endif
    @if ($user->produtorEsportivo == 2)
      <div class="form-check me-4">
        <input class="form-check-input" type="checkbox" checked disabled>
        <label class="form-check-label">Produtor Esportivo</label>
      </div>  
    @endif
    @if ($user->artista == 1)
      <div class="form-check me-4">
        <input class="form-check-input" type="checkbox" checked disabled>
        <label class="form-check-label">Artista</label>
      </div>
    @endif
    @if ($user->atleta == 2)
      <div class="form-check me-4">
        <input class="form-check-input" type="checkbox" checked disabled>
        <label class="form-check-label">Atleta</label>
      </div>
    @endif
  </div>
  <div id="tabelaSegmentos" class="mb-4">
    <div id="tabelaCultural">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col" class="bg-dark text-white ps-3">Segmento Cultural</th>
          </tr>
        </thead>
        <tbody id="tbodyCultural">
          @foreach ($arrayCultural as $arrayCul)
            <tr>
              <td class="ps-3">
                <label class="form-check-label">{{$arrayCul}}</label>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div id="tabelaEsportiva">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col" class="bg-dark text-white ps-3">Segmento Esportivo</th>
          </tr>
        </thead>
        <tbody id="tbodyEsportiva">
          @foreach ($arrayEsportivo as $arrayEsp)
            <tr>
              <td class="ps-3">
                <label class="form-check-label">{{$arrayEsp}}</label>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="row d-flex justify-content-evenly ms-1 me-1">
    <div class="col-sm-2 mb-3">
      <label for="pessoa" class="form-label">Pessoa</label>
      <select class="form-select" id="pessoa" name="pessoa" disabled>
        <option {{ $user->pessoa == 'Física' ? 'selected' : '' }} value="Física">Física</option>
        <option {{ $user->pessoa == 'Jurídica' ? 'selected' : '' }} value="Jurídica">Jurídica</option>
      </select>
    </div>
    <div class="col-sm-3 mb-3">
      <label for="nomeArtistico" id="nomeArtisticoLabel" class="form-label">Nome artístico</label>
      <input type="text" class="form-control" disabled value="{{$user->nomeArtistico}}">
    </div>
    <div class="col-sm-4 mb-3">
      <label for="nomeCompleto" class="form-label">Nome Completo</label>
      <input type="text" class="form-control" disabled value="{{$user->nomeCompleto}}">
    </div>
    <div class="col-sm-3 mb-3">
      <label for="dataNascimento" id="dataNascimentoLabel" class="form-label">Data de nascimento</label>
      <input type="date" class="form-control" disabled value="{{$user->dataNascimento}}">
    </div>
  </div>
  <div class="row d-flex justify-content-evenly ms-1 me-1">
    <div class="col-sm-4 mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" disabled value="{{$user->email}}">
    </div>
    <div class="col-sm-4 mb-3">
      <label for="celular" class="form-label">Celular</label>
      <input type="text" class="form-control" disabled value="{{$user->celular}}">
    </div>
    <div class="col-sm-4 mb-3">
      <label for="celular" class="form-label">Cidade</label>
      <input type="text" class="form-control" disabled value="{{$user->cidade}}">
    </div>
  </div>
  <div id="pessoaJuridica">
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-5 mb-3">
        <label for="email" class="form-label">Razão Social</label>
        <input type="email" class="form-control" disabled value="{{$user->razaoSocial}}">
      </div>
      <div class="col-sm-4 mb-3">
        <label for="celular" class="form-label">Responsável</label>
        <input type="text" class="form-control" disabled value="{{$user->responsavel}}">
      </div>
      <div class="col-sm-3 mb-3">
        <label for="celular" class="form-label">Cel. do Responsável</label>
        <input type="text" class="form-control" disabled value="{{$user->celResponsavel}}">
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/visualizar.js') }}"></script>
@endsection

