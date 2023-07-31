<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{asset('style/style.css')}}">
  <link rel="stylesheet" href="{{asset('style/queries.css')}}">
  <title>@yield('title')</title>
</head>
<body>
  <nav id="navBar" class="navbar navbar-expand-lg bg-dark bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a id="scaapLogo" href="{{route('homePage')}}"><img src="{{asset('image/SCAAPbranco.png')}}" alt="SCAAP"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{route('homePage')}}">Home</a>
          </li>
          @if(auth('admin')->user() != null)
            <li class="nav-item">
              <a class="nav-link" href="/scaap/admin">Painel</a>
            </li>
          @endif
          @guest
          <li class="nav-item">
            <a class="nav-link" href="/login">Entrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/register">Registrar</a>
          </li>
          @endguest
          @auth
          <li class="nav-item">
            <a class="nav-link" href="/user/profile">Perfil</a>
          </li>
          @if ($exist == true)
            <li class="nav-item">
              <a class="nav-link" href="/scaap/edit/form">Formulário</a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link" href="/scaap/create/form">Formulário</a>
            </li>
          @endif
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" x-data>
              @csrf
              <a class="nav-link" href="{{ route('logout') }}"
                @click.prevent="$root.submit();">Sair</a>
            </form>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>
  @yield('content')
</body>
</html>