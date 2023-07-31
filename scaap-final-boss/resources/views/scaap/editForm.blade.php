@extends('layouts.homePage')
@section('title', "SCAAP - Editar Formulário")
@section('content')
<link rel="stylesheet" href="{{asset('style/editForm.css')}}">
<link rel="stylesheet" href="{{asset('style/queries.css')}}">
<div class="container">
  <div class="pt-3 ms-1">
    <h1>Dados</h1>
  </div>
  <hr>
  <form class="ms-1" id="form" enctype="multipart/form-data" action="/edit" method="post">
    @csrf
    @method('put')
    <h4>Tipo de Cadastro</h4>
    <div class="tipoCadastro ms-3 mt-2 mb-4">
      <div class="form-check me-4">
        <input class="form-check-input" {{ $user->produtorCultural == 1 ? 'checked' : '' }} type="checkbox" name="produtorCultural" value="1" id="produtorCultural">
        <label class="form-check-label" for="produtorCultural">Produtor Cultural</label>
      </div>
      <div class="form-check me-4">
        <input class="form-check-input" {{ $user->produtorEsportivo == 2 ? 'checked' : '' }} type="checkbox" name="produtorEsportivo" value="2" id="produtorEsportivo">
        <label class="form-check-label" for="produtorEsportivo">Produtor Esportivo</label>
      </div>
      <div class="form-check me-4">
        <input class="form-check-input" {{ $user->artista == 1 ? 'checked' : '' }} type="checkbox" name="artista" value="1" id="artista">
        <label class="form-check-label" for="artista">Artista</label>
      </div>
      <div class="form-check me-4">
        <input class="form-check-input" {{ $user->atleta == 2 ? 'checked' : '' }} type="checkbox" name="atleta" value="2" id="atleta">
        <label class="form-check-label" for="atleta">Atleta</label>
      </div>
    </div>
    <div class="span-required-check ms-3">
      <span>Selecione uma das caixa a cima</span>
    </div>
    <div id="tabelaSegmentos" class="mb-4">
      <div id="tabelaCultural">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col" class="bg-dark text-white ps-3 pe-3 tdTable">
                <label class="form-check-label">Segmento Cultural</label>
                <i id="addSegCul" class="bi bi-plus-circle addBtnTable"></i>
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
                    <a href="/scaap/edit/form/seg/delete/{{$segmento->id_segmento}}"><i id="trash" class="bi bi-trash trash"></i></a>
                  </td>
                </tr>
                @endif
              @endforeach
            @endforeach
          </tbody>
          <tfoot class="tfootBackground">
            <tr>
              <td id="footerCultural" >
                <select class="form-select" name="cultural">
                  <option value="">Adicione um novo segmento</option>
                  @foreach ($segmentosCultural as $segmentoCultural)
                    <option value="{{$segmentoCultural->id}}">{{$segmentoCultural->nome}}</option>
                  @endforeach
                </select>
                <button type="submit" class="btn btn-success btn-sm d-flex m-auto mt-2">Adicionar</button>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div id="tabelaEsportiva">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col" class="bg-dark text-white ps-3 pe-3 tdTable">
                <label class="form-check-label">Segmento Esportivo</label>
                <i id="addSegEsp" class="bi bi-plus-circle addBtnTable"></i>
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
                    <a href="/scaap/edit/form/seg/delete/{{$segmento->id_segmento}}"><i id="trash" class="bi bi-trash trash"></i></a>
                  </td>
                </tr>
                @endif
              @endforeach
            @endforeach
          </tbody>
          <tfoot class="tfootBackground">
            <tr>
              <td id="footerEsportivo">
                <select class="form-select" name="esportivo">
                  <option value="">Adicione um novo segmento</option>
                  @foreach ($segmentosEsportivo as $segmentoEsportivo)
                    <option value="{{$segmentoEsportivo->id}}">{{$segmentoEsportivo->nome}}</option>
                  @endforeach
                </select>
                <button type="submit" class="btn btn-success btn-sm d-flex m-auto mt-2">Adicionar</button>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <div class="alert alert-warning d-flex justify-content-center mt-3" role="alert">
      Caso não houver o segmento desejado, entrar em contato com a SMCEL pelo telefone: 3433-8350/3033-2949
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-2 mb-3">
        <label for="pessoa" class="form-label">Pessoa</label>
        <select class="form-select" id="pessoa" name="pessoa">
          <option {{ $user->pessoa == 'Física' ? 'selected' : '' }} value="Física">Física</option>
          <option {{ $user->pessoa == 'Jurídica' ? 'selected' : '' }} value="Jurídica">Jurídica</option>
        </select>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="nomeArtistico" id="nomeArtisticoLabel" class="form-label">Nome artístico</label>
        <input type="text" class="form-control required" id="nomeArtistico" name="nomeArtistico"
        value="{{$user->nomeArtistico}}">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-4 mb-3">
        <label for="nomeCompleto" class="form-label">Nome Completo</label>
        <input type="text" class="form-control required" id="nomeCompleto" name="nomeCompleto"
        value="{{$user->nomeCompleto}}">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="dataNascimento" id="dataNascimentoLabel" class="form-label">Data de nascimento</label>
        <input type="date" class="form-control required" id="dataNascimento" name="dataNascimento"
        value="{{$user->dataNascimento}}">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-3 mb-3">
        <label for="nomeMae" id="nomeMaeLabel" class="form-label">Nome da mãe</label>
        <input type="text" class="form-control required" id="nomeMae" name="nomeMae"
        {{ $user->pessoa == 'Jurídica' ? 'value='."$user->razaoSocial".'' : 'value='."$user->nomeMae".'' }}>
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="pis" id="pisLabel" class="form-label">Pis / Pasep / Nit</label>
        <input type="text" class="form-control required" id="pis" name="pis"
        {{ $user->pessoa == 'Jurídica' ? 'value='."$user->cnpj".'' : 'value='."$user->pis".'' }}>
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="rg" class="form-label">RG</label>
        <input type="text" class="form-control required" id="rg" name="rg"
        value="{{$user->rg}}">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control required" onblur="validarcpf()" id="cpf" name="cpf"
        value="{{$user->cpf}}">
        <div class="span-required"><span>Digite um cpf válido</span></div>
      </div>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-4 mb-3">
        <label for="orgaoExpedidor" class="form-label">Órgão expedidor</label>
        <input type="text" class="form-control required" id="orgaoExpedidor" name="orgaoExpedidor"
        value="{{$user->orgaoExpedidor}}">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-4 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control required" onblur="emailValidate()" id="email" name="email"
        value="{{$user->email}}">
        <div class="span-required"><span>Digite um email válido</span></div>
      </div>
      <div class="col-sm-4 mb-3">
        <label for="celular" class="form-label">Celular</label>
        <input type="text" class="form-control required" id="celular" name="celular" maxlength="15" onkeyup="handlePhone(event)" value="{{$user->celular}}">
        <div class="span-required"><span>Digite um nº celular válido</span></div>
      </div>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-5 mb-3">
        <label for="responsavel" class="form-label">Responsável</label>
        <input type="text" class="form-control required" id="responsavel" name="responsavel"
        value="{{$user->responsavel}}">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-5 mb-3">
        <label for="celResponsavel" class="form-label">Cel. do Responsável</label>
        <input type="text" class="form-control required" id="celResponsavel" name="celResponsavel" maxlength="15" onkeyup="handlePhone(event)" value="{{$user->celResponsavel}}">
        <div class="span-required"><span>Digite um nº celular válido</span></div>
      </div>
    </div>
    <hr class="mt-4 mb-4">
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-3 mb-3">
        <label for="cep" class="form-label">Cep</label>
        <input type="text" class="form-control required" onblur="cepValidate()" id="cep" name="cep"
        value="{{$user->cep}}">
        <div class="span-required"><span>Digite um Cep válido</span></div>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="cidade" class="form-label">Cidade</label>
        <input type="text" class="form-control required" id="cidade" name="cidade"
        value="{{$user->cidade}}">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-6 mb-3">
        <label for="rua" class="form-label">Rua</label>
        <input type="text" class="form-control required" id="rua" name="rua"
        value="{{$user->rua}}">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-6 mb-3">
        <label for="bairro" class="form-label">Bairro</label>
        <input type="text" class="form-control required" id="bairro" name="bairro"
        value="{{$user->bairro}}">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="numCasa" class="form-label">Nº</label>
        <input type="text" class="form-control required" id="numCasa" name="numCasa"
        value="{{$user->numCasa}}">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="complemento" class="form-label">Complemento</label>
        <input type="text" class="form-control" id="complemento" name="complemento"
        value="{{$user->complemento}}">
      </div>
    </div>
    <hr class="mt-4 mb-4">
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-4 mb-3">
        <label for="banco" class="form-label">Banco</label>
        <input type="text" class="form-control required" id="banco" name="banco"
        value="{{$user->banco}}">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-4 mb-3">
        <label for="agencia" class="form-label">Agência</label>
        <input type="text" class="form-control required" id="agencia" name="agencia"
        value="{{$user->agencia}}">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-4 mb-3">
        <label for="contaCorrente" class="form-label">Conta corrente</label>
        <input type="text" class="form-control required" id="contaCorrente" name="contaCorrente"
        value="{{$user->contaCorrente}}">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
    </div>
    <hr class="mt-4 mb-4">
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <table class="table table-striped table-hover mt-5">
        <thead>
          <tr>
            <th scope="col" class="bg-dark text-white ps-3 pe-3 tdTable">
              <label class="form-check-label">RG, CPF e Certidões negativas de débitos</label>
              <i id="addRg" class="bi bi-plus-circle addBtnTable"></i>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($anexos as $anexo)
          @if ($user->id_user == $anexo->id_user && $anexo->tipo == 1)
            <tr>
              <td class="d-flex justify-content-between ps-3 pe-3">
                  <a target="_blank" href="/image/fileRgCpf/{{$anexo->path}}">{{$anexo->originalName}}</a>
                  <a href="/scaap/edit/form/anexo/delete/{{$anexo->id}}"><i id="trash" class="bi bi-trash trash"></i></a>
              </td>
            </tr>
          @endif
          @endforeach
        </tbody>
        <tfoot class="tfootBackground">
          <tr>
            <td id="footerRgCpf">
              <input class="form-control required" type="file" id="fileRgCpf" name="fileRgCpf[]" multiple>
              <button type="submit" class="btn btn-success btn-sm d-flex ms-3 mt-2">Adicionar</button>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <table class="table table-striped table-hover mt-5">
        <thead>
          <tr>
            <th scope="col" class="bg-dark text-white ps-3 pe-3 tdTable">
              <label class="form-check-label">Comprovante de Residência</label>
              <i id="addCompResidencia" class="bi bi-plus-circle addBtnTable"></i>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($anexos as $anexo)
          @if ($user->id_user == $anexo->id_user && $anexo->tipo == 2)
            <tr>
              <td class="d-flex justify-content-between ps-3 pe-3">
                  <a target="_blank" href="/image/comprovanteResidencia/{{$anexo->path}}">{{$anexo->originalName}}</a>
                  <a href="/scaap/edit/form/anexo/delete/{{$anexo->id}}"><i id="trash" class="bi bi-trash trash"></i></a>
              </td>
            </tr>
          @endif
          @endforeach
        </tbody>
        <tfoot class="tfootBackground">
          <tr>
            <td id="footerCompResidencia">
              <input class="form-control required" type="file" id="comprovanteResidencia" name="comprovanteResidencia[]" multiple>
              <button type="submit" class="btn btn-success btn-sm d-flex ms-3 mt-2">Adicionar</button>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <table class="table table-striped table-hover mt-5">
        <thead>
          <tr>
            <th scope="col" class="bg-dark text-white ps-3 pe-3 tdTable">
              <label class="form-check-label">Comprovante da Atividade</label>
              <i id="addCompAtividade" class="bi bi-plus-circle addBtnTable"></i>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($anexos as $anexo)
          @if ($user->id_user == $anexo->id_user && $anexo->tipo == 3)
            <tr>
              <td class="d-flex justify-content-between ps-3 pe-3">
                  <a target="_blank" href="/image/comprovanteAtividade/{{$anexo->path}}">{{$anexo->originalName}}</a>
                  <a href="/scaap/edit/form/anexo/delete/{{$anexo->id}}"><i id="trash" class="bi bi-trash trash"></i></a>
              </td>
            </tr>
          @endif
          @endforeach
        </tbody>
        <tfoot class="tfootBackground">
          <tr>
            <td id="footerCompAtividade">
              <input class="form-control required" type="file" id="comprovanteAtividade" name="comprovanteAtividade[]" multiple>
              <button type="submit" class="btn btn-success btn-sm d-flex ms-3 mt-2">Adicionar</button>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="mt-4">
      <button type="submit" class="btn btn-success d-flex m-auto">Atualizar</button>
    </div>
  </form>
</div>
<script src="{{asset('js/editForm.js')}}"></script>
@endsection