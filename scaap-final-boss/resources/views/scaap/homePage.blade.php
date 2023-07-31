@extends('layouts.homePage')
@section('title', "SCAAP - Sistema de Cadastro de Artistas, Atletas e Produtores")

@section('content')

<div class="container">
  <div class="seach pt-3">
    <h1 class="mb-3">Pesquisar</h1>
    <form action="">
      <div class="row d-flex justify-content-evenly ms-1 me-1">
        <div class="col-sm-4 mb-3">
          <input type="text" class="form-control" id="search" name="search" value="{{request('search')}}"
          placeholder="Nome, cidade, bairro...">
        </div>
        <div class="col-sm-4 mb-3">
          <select class="form-select" id="tipoSegmento" name="tipoSegmento">
            <option value="">Selecione um tipo de segmento</option>
            <option value="1" {{ request('tipoSegmento') == 1 ? 'selected' : '' }}>Cultural</option>
            <option value="2" {{ request('tipoSegmento') == 2 ? 'selected' : '' }}>Esportivo</option>
          </select>
        </div>
        <div id="divSegCultural" class="col-sm-4 mb-3">
          <select class="form-select" id="segmentoCultural" name="segmentoCultural" disabled>
            <option value="" selected>Selecione um segmento</option>
            @foreach ($segmentosCultural as $segmentoCultural)
              <option value="{{$segmentoCultural->id}}" 
              {{ request('segmentoCultural') == $segmentoCultural->id ? 'selected' : '' }}>{{$segmentoCultural->nome}}</option>
            @endforeach
          </select>
        </div>
        <div id="divSegEsportivo" class="col-sm-4 mb-3">
          <select class="form-select" id="segmentoEsportivo" name="segmentoEsportivo" disabled>
            <option value="" selected>Selecione um segmento</option>
            @foreach ($segmentosEsportivo as $segmentoEsportivo)
              <option value="{{$segmentoEsportivo->id}}"
              {{ request('segmentoEsportivo') == $segmentoEsportivo->id ? 'selected' : '' }}>{{$segmentoEsportivo->nome}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-success">Pesquisar</button>
      </div>
    </form>
  </div>
  <hr>
  <div id="table" class="table-responsive">
    <table class="table table-striped table-hover">
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
            <td><a href="/scaap/visualizar/{{$user->id_user}}"><button type="button" class="btn btn-primary btn-sm">Visualizar</button></a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div id="pagination" class="d-flex justify-content-center mt-3">
    @if (isset($search) && isset($tiposegmento) && isset($segmentoEsportivo))
    {{$users->appends(['search' => isset($search) ? $search : '', 
    'tipoSegmento' => isset($tiposegmento) ? $tiposegmento : '', 
    'segmentoEsportivo' => isset($segmentoEsportivo) ? $segmentoEsportivo : ''])->onEachSide(1)->links()}}
    @elseif (isset($search) && isset($tiposegmento) && isset($segmentoCultural))
    {{$users->appends(['search' => isset($search) ? $search : '', 
    'tipoSegmento' => isset($tiposegmento) ? $tiposegmento : '', 
    'segmentoCultural' => isset($segmentoCultural) ? $segmentoCultural : ''])->onEachSide(1)->links()}}
    @elseif (isset($tiposegmento) && isset($segmentoCultural))
    {{$users->appends(['tipoSegmento' => isset($tiposegmento) ? $tiposegmento : '', 
    'segmentoCultural' => isset($segmentoCultural) ? $segmentoCultural : ''])->onEachSide(1)->links()}}
    @elseif (isset($tiposegmento) && isset($segmentoEsportivo))
    {{$users->appends(['tipoSegmento' => isset($tiposegmento) ? $tiposegmento : '', 
    'segmentoEsportivo' => isset($segmentoEsportivo) ? $segmentoEsportivo : ''])->onEachSide(1)->links()}}
    @elseif (isset($tiposegmento) && isset($search))
    {{$users->appends(['search' => isset($search) ? $search : '', 'tipoSegmento' => isset($tiposegmento) ? $tiposegmento : ''])->onEachSide(1)->links()}}
    @elseif (isset($tiposegmento))
    {{ $users->appends(['tipoSegmento' => isset($tiposegmento) ? $tiposegmento : ''])->onEachSide(1)->links() }}
    @elseif (isset($search))
    {{$users->appends(['search' => isset($search) ? $search : ''])->onEachSide(1)->links()}}
    @else 
    {{ $users->onEachSide(1)->links() }}
    @endif
</div>
</div>
<script src="{{asset('js/search.js')}}"></script>
@endsection
