<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Hubin 13') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @stack('script')

    <!-- Fonts -->
    <link href="//fonts.gstatic.com" rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightmode.css') }}" rel="stylesheet">
    @stack('style')
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pemetaan') }}">Hasil Pemetaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tentang') }}">Tentang</a>
                        </li>
                        <!-- Authentication Links -->
                        @if(Auth::getDefaultDriver())
                            @if(Auth::guard('admin')->check())
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
                            @endif
                            @if(Auth::guard('siswa')->check())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('siswa.home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('siswa.pengaturan') }}">Pengaturan Akun</a>
                                </li>
                            @endif

                            <span class="navbar-text">
                                @if(Auth::guard('admin')->check())
                                    {{ Auth::guard('admin')->user()->username }}
                                @endif
                                @if(Auth::guard('siswa')->check())
                                    {{ Auth::guard('siswa')->user()->nama }}
                                    {{ Auth::guard('siswa')->user()->nis }}
                                @endif
                            </span>

                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route(Auth::getDefaultDriver() . ".logout") }}">Logout</a>
                                </li>
                            @endauth
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('siswa.login') }}">Login</a>
                            </li>
                        @endif
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
