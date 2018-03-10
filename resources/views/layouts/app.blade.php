<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Puntos Negros</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('extra-css')
</head>
<body>
    <div id="app">
        @guest
            <div style="display: none;"></div>
        @else
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <ul id="dropdown1" class="dropdown-content">
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </li>
            </ul>
        @endguest
        <nav class="deep-purple darken-1">
            <div class="nav-wrapper">
                <a class="brand-logo" href="{{ url('/home') }}" style="padding-left:1rem;">
                    Puntos Negros
                </a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

                <ul class="right hide-on-med-and-down">
                    @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    @else
                        <li>
                            <a class="dropdown-button" href="#!" data-activates="dropdown1">
                                {{ Auth::user()->name }}
                                <i class="material-icons right">arrow_drop_down</i>
                            </a>
                        </li>
                    @endguest
                </ul>
                <ul class="side-nav" id="mobile-demo">
                    @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    @else
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

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
