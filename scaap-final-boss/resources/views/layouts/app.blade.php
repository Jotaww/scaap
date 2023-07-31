<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('style/style.css')}}">
        <link rel="stylesheet" href="{{asset('style/queries.css')}}">

        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">

          <nav id="navBar" class="navbar navbar-expand-lg bg-dark bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
              <a id="scaapLogo" href="{{route('homePage')}}"><img src="{{asset('image/SCAAPbranco.png')}}" alt="SCAAP"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul id="white" class="navbar-nav mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('homePage')}}">Home</a>
                  </li>
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
                  @if ($existForm == true)
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

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
