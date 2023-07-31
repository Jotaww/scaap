@extends('layouts.adminPage')
@section('title', "SCAAP - Admin")

@section('content')
<div class="container">
  <div class="painel pt-4">
    <a href="/scaap/admin/lista/produtorCultural" class="mb-3">
      <div class="btnPainel">
        <img src="{{asset('image/scaap/cone 1.png')}}" alt="">
        <p>Produtor Cultural</p>
      </div>
    </a>
    <a href="/scaap/admin/lista/produtorEsportivo" class="mb-3">
      <div>
        <img src="{{asset('image/scaap/cone 2.png')}}" alt="">
        <p>Produtor Esportivo</p>
      </div>
    </a>
    <a href="/scaap/admin/lista/artista" class="mb-3">
      <div>
        <img src="{{asset('image/scaap/cone 3.png')}}" alt="">
        <p>Artista</p>
      </div>
    </a>
    <a href="/scaap/admin/lista/atleta" class="mb-3">
      <div>
        <img src="{{asset('image/scaap/cone 4.png')}}" alt="">
        <p>Atleta</p>
      </div>
    </a>
    <a href="/register" class="mb-3">
      <div>
        <img src="{{asset('image/scaap/cone 5.png')}}" alt="">
        <p>Adicionar Produtor</p>
      </div>
    </a>
    <a href="/scaap/admin/segmentos" class="mb-3">
      <div>
        <img src="{{asset('image/scaap/cone 6.png')}}" alt="">
        <p>Adicionar Segmento</p>
      </div>
    </a>
    <a href="/scaap/admin/moderacao" class="mb-3">
      <div>
        <img src="{{asset('image/scaap/cone 7.png')}}" alt="">
        <p>Moderação</p>
      </div>
    </a>
    <a href="/scaap/admin/administradores" class="mb-3">
      <div>
        <img src="{{asset('image/scaap/cone 8.png')}}" alt="">
        <p>Administradores</p>
      </div>
    </a>
    <a href="/scaap/admin/aguardandoRetorno" class="mb-3">
      <div>
        <img src="{{asset('image/scaap/cone 9.png')}}" alt="">
        <p>Aguardando Retorno</p>
      </div>
    </a>
  </div>
</div>
@endsection
