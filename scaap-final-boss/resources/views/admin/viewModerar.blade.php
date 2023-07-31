@extends('layouts.adminPage')
@section('title', "SCAAP - Admin")

@section('content')

<link rel="stylesheet" href="{{asset('style/editForm.css')}}">
<link rel="stylesheet" href="{{asset('style/queries.css')}}">
<div class="container">
  <div class="pt-3 ms-1">
    <h1>Dados</h1>
  </div>
  <hr>
  <form class="ms-1" id="form" enctype="multipart/form-data" action="/scaap/admin/aprovar/{{$user->id_user}}" method="post">
    @csrf
    @method('put')
    <h4>Tipo de Cadastro</h4>
    <div class="tipoCadastro ms-3 mt-2 mb-4">
      @if ($user->produtorCultural == 1) 
      <div class="form-check me-4">
        <input class="form-check-input" disabled checked type="checkbox">
        <label class="form-check-label">Produtor Cultural</label>
      </div>
      @endif
      @if ($user->produtorEsportivo == 2)
      <div class="form-check me-4">
        <input class="form-check-input" disabled checked type="checkbox">
        <label class="form-check-label">Produtor Esportivo</label>
      </div>
      @endif
      @if ($user->artista == 1)
      <div class="form-check me-4">
        <input class="form-check-input" disabled checked type="checkbox">
        <label class="form-check-label">Artista</label>
      </div>
      @endif
      @if ($user->artista == 2)
      <div class="form-check me-4">
        <input class="form-check-input" disabled checked>
        <label class="form-check-label">Atleta</label>
      </div>
      @endif
    </div>
    <div id="tabelaSegmentos" class="mb-4">
      <div id="tabelaCultural">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col" class="bg-dark text-white ps-3 pe-3 tdTable">
                <label class="form-check-label">Segmento Cultural</label>
              </th>
            </tr>
          </thead>
          <tbody id="tbodyCultural">
            @foreach ($segmentosCultural as $segmentoCultural)
              @foreach ($segmentos as $segmento)
                @if ($segmento->id_segmento == $segmentoCultural->id && $segmento->id_user == $id)
                <tr>
                  <td class="tdTable ps-3 pe-3">
                    <label class="form-check-label">{{$segmentoCultural->nome}}</label>
                  </td>
                </tr>
                @endif
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div>
      <div id="tabelaEsportiva">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col" class="bg-dark text-white ps-3 pe-3 tdTable">
                <label class="form-check-label">Segmento Esportivo</label>
              </th>
            </tr>
          </thead>
          <tbody id="tbodyEsportivo">
            @foreach ($segmentosEsportivo as $segmentoEsportivo)
              @foreach ($segmentos as $segmento)
                @if ($segmento->id_segmento == $segmentoEsportivo->id && $segmento->id_user == $id)
                <tr>
                  <td class="tdTable ps-3 pe-3">
                    <label class="form-check-label">{{$segmentoEsportivo->nome}}</label>
                  </td>
                </tr>
                @endif
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <hr>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-2 mb-3">
        <label for="pessoa" class="form-label">Pessoa</label>
        <select class="form-select" id="pessoa" disabled name="pessoa">
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
      <div class="col-sm-3 mb-3">
        <label for="nomeMae" id="nomeMaeLabel" class="form-label">Nome da mãe</label>
        <input type="text" class="form-control" disabled id="nomeMae" name="nomeMae"
        {{ $user->pessoa == 'Jurídica' ? 'value='."$user->razaoSocial".'' : 'value='."$user->nomeMae".'' }}>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="pis" id="pisLabel" class="form-label">Pis / Pasep / Nit</label>
        <input type="text" class="form-control" disabled id="pis" name="pis"
        {{ $user->pessoa == 'Jurídica' ? 'value='."$user->cnpj".'' : 'value='."$user->pis".'' }}>
      </div>
      <div class="col-sm-3 mb-3">
        <label class="form-label">RG</label>
        <input type="text" class="form-control" disabled value="{{$user->rg}}">
      </div>
      <div class="col-sm-3 mb-3">
        <label class="form-label">CPF</label>
        <input type="text" class="form-control required" disabled value="{{$user->cpf}}">
      </div>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-4 mb-3">
        <label class="form-label">Órgão expedidor</label>
        <input type="text" class="form-control" disabled value="{{$user->orgaoExpedidor}}">
      </div>
      <div class="col-sm-4 mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" disabled value="{{$user->email}}">
      </div>
      <div class="col-sm-4 mb-3">
        <label class="form-label">Celular</label>
        <input type="text" class="form-control" disabled value="{{$user->celular}}">
      </div>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-5 mb-3">
        <label class="form-label">Responsável</label>
        <input type="text" class="form-control" disabled value="{{$user->responsavel}}">
      </div>
      <div class="col-sm-5 mb-3">
        <label class="form-label">Cel. do Responsável</label>
        <input type="text" class="form-control" disabled value="{{$user->celResponsavel}}">
      </div>
    </div>
    <hr class="mt-4 mb-4">
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-3 mb-3">
        <label class="form-label">Cep</label>
        <input type="text" class="form-control" disabled value="{{$user->cep}}">
      </div>
      <div class="col-sm-3 mb-3">
        <label class="form-label">Cidade</label>
        <input type="text" class="form-control" disabled value="{{$user->cidade}}">
      </div>
      <div class="col-sm-6 mb-3">
        <label class="form-label">Rua</label>
        <input type="text" class="form-control" disabled value="{{$user->rua}}">
      </div>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-6 mb-3">
        <label class="form-label">Bairro</label>
        <input type="text" class="form-control" disabled value="{{$user->bairro}}">
      </div>
      <div class="col-sm-3 mb-3">
        <label class="form-label">Nº</label>
        <input type="text" class="form-control" disabled value="{{$user->numCasa}}">
      </div>
      <div class="col-sm-3 mb-3">
        <label class="form-label">Complemento</label>
        <input type="text" class="form-control" disabled value="{{$user->complemento}}">
      </div>
    </div>
    <hr class="mt-4 mb-4">
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-4 mb-3">
        <label class="form-label">Banco</label>
        <input type="text" class="form-control" disabled value="{{$user->banco}}">
      </div>
      <div class="col-sm-4 mb-3">
        <label class="form-label">Agência</label>
        <input type="text" class="form-control" disabled value="{{$user->agencia}}">
      </div>
      <div class="col-sm-4 mb-3">
        <label class="form-label">Conta corrente</label>
        <input type="text" class="form-control" disabled value="{{$user->contaCorrente}}">
      </div>
    </div>
    <hr class="mt-4 mb-4">
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <table class="table table-striped table-hover mt-4">
        <thead>
          <tr>
            <th scope="col" class="bg-dark text-white ps-3 pe-3 tdTable">
              <label class="form-check-label">RG, CPF e Certidões negativas de débitos</label>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($anexos as $anexo)
          @if ($user->id_user == $anexo->id_user && $anexo->tipo == 1)
            <tr>
              <td class="d-flex justify-content-between ps-3 pe-3">
                  <a target="_blank" href="/image/fileRgCpf/{{$anexo->path}}">{{$anexo->originalName}}</a>
              </td>
            </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <table class="table table-striped table-hover mt-4">
        <thead>
          <tr>
            <th scope="col" class="bg-dark text-white ps-3 pe-3 tdTable">
              <label class="form-check-label">Comprovante de Residência</label>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($anexos as $anexo)
          @if ($user->id_user == $anexo->id_user && $anexo->tipo == 2)
            <tr>
              <td class="d-flex justify-content-between ps-3 pe-3">
                  <a target="_blank" href="/image/comprovanteResidencia/{{$anexo->path}}">{{$anexo->originalName}}</a>
              </td>
            </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <table class="table table-striped table-hover mt-4">
        <thead>
          <tr>
            <th scope="col" class="bg-dark text-white ps-3 pe-3 tdTable">
              <label class="form-check-label">Comprovante da Atividade</label>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($anexos as $anexo)
          @if ($user->id_user == $anexo->id_user && $anexo->tipo == 3)
            <tr>
              <td class="d-flex justify-content-between ps-3 pe-3">
                  <a target="_blank" href="/image/comprovanteAtividade/{{$anexo->path}}">{{$anexo->originalName}}</a>
              </td>
            </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="mt-4">
      <button type="submit" class="btn btn-success d-flex m-auto">Aprovar</button>
    </div>
  </form>
  <hr class="mt-5 mb-5">
  <h3 class="mb-3">Reprovar</h3>
  <form action="/scaap/admin/reprovar/{{$user->id_user}}" method="post">
    @csrf
    @method('put')
    <div class="form-floating">
      <textarea class="form-control" name="motivo" placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px"></textarea>
      <label for="floatingTextarea">Motivo</label>
    </div>
    <div class="mt-4">
      <button type="submit" class="btn btn-danger d-flex m-auto">Reprovar</button>
    </div>
  </form>
</div>
<script src="{{asset('js/visualizar.js')}}"></script>

@endsection
