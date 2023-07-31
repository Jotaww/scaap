@extends('layouts.homePage')
@section('title', "SCAAP - Criar Formulário")
@section('content')
<link rel="stylesheet" href="{{asset('style/createForm.css')}}">
<link rel="stylesheet" href="{{asset('style/queries.css')}}">
<div class="container">
  <div class="pt-3 ms-1">
    <h1>Dados</h1>
  </div>
  <hr>
  <form class="ms-1" id="form" enctype="multipart/form-data" action="/create" method="post">
    @csrf
    <h4>Tipo de Cadastro</h4>
    <div class="tipoCadastro ms-3 mt-2">
      <div class="form-check me-4">
        <input class="form-check-input" type="checkbox" name="produtorCultural" value="1" id="produtorCultural">
        <label class="form-check-label" for="produtorCultural">Produtor Cultural</label>
      </div>
      <div class="form-check me-4">
        <input class="form-check-input" type="checkbox" name="produtorEsportivo" value="2" id="produtorEsportivo">
        <label class="form-check-label" for="produtorEsportivo">Produtor Esportivo</label>
      </div>
      <div class="form-check me-4">
        <input class="form-check-input" type="checkbox" name="artista" value="1" id="artista">
        <label class="form-check-label" for="artista">Artista</label>
      </div>
      <div class="form-check me-4">
        <input class="form-check-input" type="checkbox" name="atleta" value="2" id="atleta">
        <label class="form-check-label" for="atleta">Atleta</label>
      </div>
    </div>
    <div class="span-required-check ms-3">
      <span>Selecione uma das caixa a cima</span>
    </div>
    <div id="tabelaSegmentos">
      <div id="tabelaCultural">
        <table class="table table-striped table-hover mt-4">
          <thead>
            <tr>
              <th scope="col" class="bg-dark text-white ps-3">Segmento Cultural</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($segmentosCultural as $segmentoCultural)
            <tr>
              <td class="ps-3">
                <input class="form-check-input" type="checkbox" value="{{$segmentoCultural->id}}" name="cultural[]" id="{{$segmentoCultural->id}}">
                <label class="form-check-label" for="{{$segmentoCultural->id}}">{{$segmentoCultural->nome}}</label>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div id="tabelaEsportiva">
        <table class="table table-striped table-hover mt-4">
          <thead>
            <tr>
              <th scope="col" class="bg-dark text-white ps-3">Segmento Esportivo</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($segmentosEsportivo as $segmentoEsportivo)
            <tr>
              <td class="ps-3">
                <input class="form-check-input" type="checkbox" value="{{$segmentoEsportivo->id}}" name="esportivo[]" id="{{$segmentoEsportivo->id}}">
                <label class="form-check-label" for="{{$segmentoEsportivo->id}}">{{$segmentoEsportivo->nome}}</label>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="alert alert-warning d-flex justify-content-center mt-3" role="alert">
      Caso não houver o segmento desejado, entrar em contato com a SMCEL pelo telefone: 3433-8350/3033-2949
    </div>
    <hr>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-2 mb-3">
        <label for="pessoa" class="form-label">Pessoa</label>
        <select class="form-select" id="pessoa" name="pessoa">
          <option value="Física">Física</option>
          <option value="Jurídica">Jurídica</option>
        </select>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="nomeArtistico" id="nomeArtisticoLabel" class="form-label">Nome artístico</label>
        <input type="text" class="form-control required" id="nomeArtistico" name="nomeArtistico">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-4 mb-3">
        <label for="nomeCompleto" class="form-label">Nome Completo</label>
        <input type="text" class="form-control required" id="nomeCompleto" name="nomeCompleto">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="dataNascimento" id="dataNascimentoLabel" class="form-label">Data de nascimento</label>
        <input type="date" class="form-control required" id="dataNascimento" name="dataNascimento">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-3 mb-3">
        <label for="nomeMae" id="nomeMaeLabel" class="form-label">Nome da mãe</label>
        <input type="text" class="form-control required" id="nomeMae" name="nomeMae">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="pis" id="pisLabel" class="form-label">Pis / Pasep / Nit</label>
        <input type="text" class="form-control required" id="pis" name="pis">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="rg" class="form-label">RG</label>
        <input type="text" class="form-control required" id="rg" name="rg">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control required" onblur="validarcpf()" id="cpf" name="cpf">
        <div class="span-required"><span>Digite um cpf válido</span></div>
      </div>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-4 mb-3">
        <label for="orgaoExpedidor" class="form-label">Órgão expedidor</label>
        <input type="text" class="form-control required" id="orgaoExpedidor" name="orgaoExpedidor">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-4 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control required" onblur="emailValidate()" id="email" name="email">
        <div class="span-required"><span>Digite um email válido</span></div>
      </div>
      <div class="col-sm-4 mb-3">
        <label for="celular" class="form-label">Celular</label>
        <input type="text" class="form-control required" id="celular" name="celular" maxlength="15" onkeyup="handlePhone(event)">
        <div class="span-required"><span>Digite um nº celular válido</span></div>
      </div>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-5 mb-3">
        <label for="responsavel" class="form-label">Responsável</label>
        <input type="text" class="form-control required" id="responsavel" name="responsavel">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-5 mb-3">
        <label for="celResponsavel" class="form-label">Cel. do Responsável</label>
        <input type="text" class="form-control required" id="celResponsavel" name="celResponsavel" maxlength="15" onkeyup="handlePhone(event)">
        <div class="span-required"><span>Digite um nº celular válido</span></div>
      </div>
    </div>
    <hr class="mt-4 mb-4">
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-3 mb-3">
        <label for="cep" class="form-label">Cep</label>
        <input type="text" class="form-control required" onblur="cepValidate()" id="cep" name="cep">
        <div class="span-required"><span>Digite um Cep válido</span></div>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="cidade" class="form-label">Cidade</label>
        <input type="text" class="form-control required" id="cidade" name="cidade">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-6 mb-3">
        <label for="rua" class="form-label">Rua</label>
        <input type="text" class="form-control required" id="rua" name="rua">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
    </div>
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-6 mb-3">
        <label for="bairro" class="form-label">Bairro</label>
        <input type="text" class="form-control required" id="bairro" name="bairro">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="numCasa" class="form-label">Nº</label>
        <input type="text" class="form-control required" id="numCasa" name="numCasa">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-3 mb-3">
        <label for="complemento" class="form-label">Complemento</label>
        <input type="text" class="form-control" id="complemento" name="complemento">
      </div>
    </div>
    <hr class="mt-4 mb-4">
    <div class="row d-flex justify-content-evenly ms-1 me-1">
      <div class="col-sm-4 mb-3">
        <label for="banco" class="form-label">Banco</label>
        <input type="text" class="form-control required" id="banco" name="banco">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-4 mb-3">
        <label for="agencia" class="form-label">Agência</label>
        <input type="text" class="form-control required" id="agencia" name="agencia">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
      <div class="col-sm-4 mb-3">
        <label for="contaCorrente" class="form-label">Conta corrente</label>
        <input type="text" class="form-control required" id="contaCorrente" name="contaCorrente">
        <div class="span-required"><span>Campo obrigatório</span></div>
      </div>
    </div>
    <hr class="mt-4 mb-4">
    <div class="alert alert-warning" role="alert">
      Anexe aqui os arquivos...
    </div>
    <div class="mb-3">
      <label for="fileRgCpf" class="form-label">RG, CPF e Certidões negativas de débitos:</label>
      <input class="form-control required" type="file" id="fileRgCpf" name="fileRgCpf[]" multiple>
      <div class="span-required"><span>Campo obrigatório</span></div>
    </div>
    <div class="mb-3">
      <label for="comprovanteResidencia" class="form-label">Comprovante de Residência:</label>
      <input class="form-control required" type="file" id="comprovanteResidencia" name="comprovanteResidencia[]" multiple>
      <div class="span-required"><span>Campo obrigatório</span></div>
    </div>
    <div class="mb-3">
      <label for="comprovanteAtividade" class="form-label">Comprovante da Atividade:</label>
      <input class="form-control required" type="file" id="comprovanteAtividade" name="comprovanteAtividade[]" multiple>
      <div class="span-required"><span>Campo obrigatório</span></div>
    </div>
    <div class="form-check mt-3">
      <input class="form-check-input" type="checkbox" id="termo">
      <label class="form-check-label" id="termoLabel" for="termo">
        Eu li e concordo com a <a href="https://www.esteio.rs.gov.br/">Política de Privacidade do SCAAP.</a>
      </label>
      <div class="span-required-termo">
        <span>Campo obrigatório</span>
      </div>
    </div>
    <div class="mt-4 buttonSubmit">
      <button type="submit" class="btn btn-success">Enviar</button>
    </div>
  </form>
</div>
<script src="{{asset('js/createForm.js')}}"></script>
@endsection