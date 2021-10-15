<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @stack('script')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tentang') }}">Tentang</a>
                        </li>
                        @auth
                            @auth('admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.industri.data') }}">Data Industri</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.siswa.data') }}">Data Siswa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.pengaturan') }}">Pengaturan Akun</a>
                                </li>
                            @endauth
                            @auth('siswa')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('siswa.home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="">Lihat Data Pemetaan</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="">Hasil Data Pemetaan</a>
                                </li>
                            @endauth

                            <span class="navbar-text">
                                @auth('admin') {{ Auth::user()->username }} @endauth
                                @auth('siswa') {{ Auth::user()->nama }} {{ Auth::user()->nis }} @endauth
                            </span>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route(Auth::getDefaultDriver() . ".logout") }}">Logout</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('siswa.login') }}">Login</a>
                            </li>
                        @endauth
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
