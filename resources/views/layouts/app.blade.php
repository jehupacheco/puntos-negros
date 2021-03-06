<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Puntos Negros</title>

    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('extra-css')
</head>
<body class="{{ isset($class) ? implode($class,',') : '' }}">
    <div id="app">
        @guest
            <div style="display: none;"></div>
        @else
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <ul id="dropdown1" class="dropdown-content">
                <li>
                    <a href="{{ url('/') }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </li>
            </ul>
        @endguest
        <div class="navbar-fixed">
            <nav class="deep-purple darken-1">
                <div class="nav-wrapper">
                    <a class="brand-logo" href="{{ url('/') }}" style="padding-left:1rem; width: 60%">
                        Puntos Negros
                    </a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down" style="width: 75%; display: flex; justify-content: flex-end">
                        @if (request()->path() == '/')
                        <div class="input-field" style="width: 100%">
                            <i class="material-icons prefix white-text">search</i>
                            <input class="white-text" type="text" placeholder="Busca un lugar" style="margin-bottom: 10px; margin-top: 10px;" id="nav-input-search">
                        </div>
                        @endif
                        <li style="min-width: 250px;"><a href="{{ route('blackpoint.list') }}" class="waves-effect waves-light btn">Ver como lista</a></li>
                        @guest
                            <li style="min-width: 100px; overflow: hidden"><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        @else
                            <li style="min-width: 180px;"><a href="{{ route('report') }}" class="waves-effect waves-light btn">Reportes</a></li>
                            <li style="min-width: 200px; overflow: hidden">
                                <a class="dropdown-button" href="#!" data-activates="dropdown1">
                                    Hola, {{ Auth::user()->name }}
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </div>
        <ul class="side-nav" id="mobile-demo">
                <li>
                    <a href="{{ url('/') }}">
                    Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('blackpoint.create') }}">
                    Agrega un punto
                    </a>
                </li>
            @guest
                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
            @else

                <li>
                    <a href="{{ route('report') }}">
                    Reportes
                    </a>
                </li>
                <li><div class="divider"></div></li>
                <li>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                    </a>
                </li>
            @endguest
        </ul>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/materialize.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".button-collapse").sideNav();
        });
    </script>

    @yield('extra-js')
</body>
</html>
