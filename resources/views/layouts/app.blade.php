<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <style>
        body {

            background-image: url('/img/background.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Asignaciones/Inventario</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <script src="https://kit.fontawesome.com/1bf0086160.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/generalStyle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/carrusel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/texto.css') }}" rel="stylesheet">
    <link href="{{ asset('css/inputsDani.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar-custom">
            <div class="container-menu">
                <div class="header-navigation-menu">
                    <div class="header-icon">
                        <a href="{{route('home')}}" style="text-decoration: none;">
                            <img src="/img/LogoBlanco.png" alt="" style="width: 100px; height:30px;">
                        </a>
                    </div>
                    <button class="navbar-nav-toggle">
                        <span></span>
                    </button>
                    <div class="navbar-navigation">
                        <ul>
                            @guest
                            <li>
                                <a href="{{ route('login') }}">{{ __('Iniciar sesión    ') }}<i class="fas fa-sign-in-alt"></i></a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">{{ __('Crear cuenta   ') }}<i class="fas fa-user-plus"></i></a>
                            </li>
                            @else
                            <li style="font-size: 12px;" class="dropdown">
                                <a href="#" class="sub-menu-toggle">
                                    {{ __('Inventario ') }} <span class="caret"><i class="fas fa-book"></i></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{url('/indexGeneral')}}" style="cursor: pointer">{{ __('Index General ') }}<i class="fas fa-list"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/home') }}" style="cursor: pointer">{{ __('Menú Principal ') }}<i class="fas fa-laptop"></i></a>
                                    </li>
                                </ul>
                            </li>
                            <li style="font-size: 12px;" class="dropdown">
                                <a href="#" class="sub-menu-toggle">
                                    {{ __('Asignaciones ') }} <span class="caret"><i class="fas fa-signature"></i></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="" style="cursor: pointer">{{ __('Index General ') }}<i class="fas fa-list"></i></a>
                                    </li>
                                    <li>
                                        <a href="" style="cursor: pointer">{{ __('Equipos ') }}<i class="far fa-window-restore"></i></a>
                                    </li>
                                </ul>
                            </li>
                            <li style="font-size: 12px;" class="dropdown">
                                <a href="#" class="sub-menu-toggle">
                                    <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"><i class="fas fa-caret-down"></i></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fas fa-power-off"></i>{{ __(' Cerrar sesión') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>

                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>