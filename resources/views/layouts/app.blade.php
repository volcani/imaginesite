<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'COMP_hack') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark navbar-comp">
            <div class="container">
                <a class="navbar-brand navbar-brand-comp" href="{{ url('/') }}">
                    <div class="navbar-logo-box">
                        <img src="{{ asset('img/logo.png') }}" class="navbar-logo"/>
                        <!-- &nbsp;{{ config('app.name', 'COMP_hack') }} -->
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('News') }}</a></li>
                        @auth
                        <!-- <li><a class="nav-link" href="{{ route('login') }}">{{ __('Support') }}</a></li> -->
                        <li class="nav-item dropdown">
                            <a id="supportDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Support</a>

                            <div class="dropdown-menu" aria-labelledby="supportDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}">New Ticket</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">My Tickets</a>
                                @if(Auth::user()->admin) <!-- TODO: Make this a special role -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}">All Tickets</a>
                                @endif
                            </div>
                        </li>
                        @endif
                        <li><a class="nav-link" href="{{ route('register') }}">{{ __('Forum') }}</a></li>
                        @auth
                        <li><a class="nav-link disabled">{{ __('Shop') }}</a></li>
                        @if(Auth::user()->admin)
                        <li><a class="nav-link" href="{{ url('/accountmanager') }}">{{ __('Account Manager') }}</a></li>
                        @endif
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ Auth::user()->gravatar }}" class="profile-image rounded-circle">&nbsp;
                                    <!-- {{ Auth::user()->name }} --><span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <h6 class="dropdown-header">{{ Auth::user()->name }}<br/>{{ '@' . Auth::user()->username }}</h6>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
