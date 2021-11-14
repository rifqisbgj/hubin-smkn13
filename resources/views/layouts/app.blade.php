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
    <script src="{{ asset('js/sidebar.js') }}"></script>
    @stack('script')

    <!-- Fonts -->
    <link href="//fonts.gstatic.com" rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightmode.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    @stack('style')
</head>
<body>
    <div id="app">
        <nav id="sidebar">
			<div class="custom-menu">
				<button type="button" id="sidebarCollapse" class="btn btn-primary">
					<i class="fa fa-bars"></i>
				</button>
			</div>
			<div class="p-4 pt-5">
                <h3>
                    <img src="{{ asset('img/smkn13bandung.png') }}" alt="Logo SMKN 13 Bandung" width="40" height="40">
                    <a class="text-white" href="{{ route('siswa.home') }}"><b>HUBIN-13</b></a>
                </h3>
                <ul class="list-unstyled mt-3">
					<li {{ Route::currentRouteName() === 'siswa.home' ? 'class=active' : '' }}>
						<a href="{{ route('siswa.home') }}"><i class="fa fa-home"></i>Home</a>
					</li>
					<li>
                        <a href="#"><i class="fa fa-eye"></i>Lihat Data Pemetaan</a>
					</li>
					<li {{ Route::currentRouteName() === 'pemetaan' ? 'class=active' : '' }}>
                        <a href="{{ route('pemetaan') }}"><i class="fa fa-check"></i>Hasil Data Pemetaan</a>
					</li>
                    @if(Auth::getDefaultDriver() === 'admin')
                        <li {{ Route::currentRouteName() === 'admin.siswa.data' ? 'class=active' : '' }}>
                            <a href="{{ route('admin.siswa.data') }}"><i class="fa fa-users"></i>Data Siswa</a>
                        </li>
                        <li {{ Route::currentRouteName() === 'admin.industri.data' ? 'class=active' : '' }}>
                            <a href="{{ route('admin.industri.data') }}"><i class="fa fa-industry"></i>Data Industri</a>
                        </li>
                    @elseif(Auth::getDefaultDriver() === 'siswa' && !Auth::user()->id_industri)
                        <li {{ Route::currentRouteName() === 'siswa.ajukan' ? 'class=active' : '' }}>
                            <a href="{{ route('siswa.ajukan') }}"><i class="fa fa-paper-plane"></i>Ajukan Industri</a>
                        </li>
                        <li {{ Route::currentRouteName() === 'siswa.pilih' ? 'class=active' : '' }}>
                            <a href="{{ route('siswa.pilih') }}"><i class="fa fa-list"></i>Pilih Industri</a>
                        </li>
                    @endif
					<li>
						<hr class="hr">
					</li>
                    @auth
                        <li {{ Route::currentRouteName() === Auth::getDefaultDriver() . '.pengaturan' ? 'class=active' : '' }}>
                            <a href="{{ route(Auth::getDefaultDriver() . '.pengaturan') }}"><i class="fa fa-cogs"></i>Pengaturan</a>
                        </li>
                    @endauth
					<li {{ Route::currentRouteName() === 'tentang' ? 'class=active' : '' }}>
						<a href="{{ route('tentang') }}"><i class="fa fa-comments"></i>Tentang</a>
					</li>
				</ul>
			</div>
			<div class="p-3 footer-gan">
                <img src="{{ asset('img/smkn13bandung.png') }}" alt="logo smkn 13 bandung" class="rounded-circle border" width="50" height="50">
				<div class="ml-3 my-auto flex-grow-1">
                    <div>{{ Auth::user()->nama ?? Auth::user()->username ?? 'Belum Masuk' }}</div>
                    <div>{{ Auth::user()->nis ?? '' }}</div>
				</div>
                @auth
                    <a class="m-auto ml-3" href="{{ route(Auth::getDefaultDriver() . ".logout") }}">
                        <i class="fa fa-sign-out fa-lg text-white"></i>
                    </a>
                @endauth
            </div>
        </nav>

        <main class="py-5" id="main">
            @yield('content')
        </main>
    </div>
</body>
</html>
