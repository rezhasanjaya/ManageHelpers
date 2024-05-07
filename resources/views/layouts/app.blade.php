<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Manhell') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- DataTables -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>
    <style>
        .navbar-nav .nav-link.active {
            font-weight: bold; /* Membuat teks lebih tebal */
            color: #14A44D ; /* Warna teks hijau */
        }
        
        .nav-item .nav-item.active{
            color: #14A44D
        }
    </style>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="row">
                        <div class="col">
                            <center class="text-success">
                                <strong>
                                    {{ config('app.name', 'Laravel') }}
                                </strong>
                            </center>
                        </div>
                    </div>
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}"><strong>Home</strong></a>
                        </li>
                        <li class="nav-item dropdown {{ Request::is('paket*', 'provider*', 'customers*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <strong>Master</strong>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item {{ Request::is('provider*') ? 'bg-success text-white' : '' }}" href="{{ route('provider.index') }}"><strong>Provider</strong></a></li>
                                <li><a class="dropdown-item {{ Request::is('paket*') ? 'bg-success text-white' : '' }}" href="{{ route('paket.index') }}"><strong>Paket</strong></a></li>
                                <li><a class="dropdown-item {{ Request::is('customers*') ? 'bg-success text-white' : '' }}" href="{{ route('customers.index') }}"><strong>Customers</strong></a></li>
                            </ul>
                        </li>
                      
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('billing') ? 'active' : '' }}" aria-current="page" href="{{ route('billing.index') }}"><strong>Billing</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('pembayaran') ? 'active' : '' }}" aria-current="page" href="{{ route('pembayaran.index') }}"><strong>Payment</strong></a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ Request::is('customers') ? 'active' : '' }}" aria-current="page" href="{{ route('customers.index') }}"><strong>Customers</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('provider') ? 'active' : '' }}" aria-current="page" href="{{ route('provider.index') }}"><strong>Provider</strong></a>
                        </li> --}}
                    </ul>
                  </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <strong>{{ Auth::user()->name }}</strong>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
    @stack('scripts')
</body>
</html>
