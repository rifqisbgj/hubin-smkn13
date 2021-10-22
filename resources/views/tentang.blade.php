@extends('layouts.app')

@push('script')
    <script src="https://kit.fontawesome.com/91b3159b57.js" crossorigin="anonymous"></script>
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('css/lightmode.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tentang.css') }}">
@endpush

@section('content')

    <header>
        <h1>Tentang Developer</h1>
    </header>

    <main class="container">
        <div class="row row-cols-1 row-cols-sm-3">
            <div class="col mb-4">
                <div class="card border-0">
                    <img src="https://i.pinimg.com/564x/18/23/a6/1823a6eab786bc5112fff2b1a24edcc3.jpg" class="card-img-top" alt="Muhammad Irsyaad Fatahillah">
                    <div class="card-body">
                        <h4 class="card-text">Muhammad Irsyaad Fatahillah</h4>
                        <p class="card-text">Leader | Web Designer | <br> Front-End Developer</p>
                        <p class="card-text font-weight-light">RPL 1'22</p>
                        <a href="https://www.instagram.com/irsyaad_06/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://github.com/irsyaad06" target="_blank"><i class="fab fa-github"></i></a>
                        <a href="https://www.linkedin.com/in/irsyaad-fatahilah-906b64214/" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col mb-4">
                <div class="card border-0">
                    <img src="https://i.pinimg.com/564x/e9/bf/72/e9bf720d1b7065672deb8842095ff71d.jpg" class="card-img-top" alt="Fadhil Maulana">
                    <div class="card-body">
                        <h4 class="card-text">Fadhil Maulana</h4>
                        <p class="card-text">Quality Assurance</p>
                        <p class="card-text font-weight-light">RPL 1'22</p>
                        <a href="https://www.instagram.com/fadhilmuln_/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://github.com/fadhilmuln" target="_blank"><i class="fab fa-github"></i></a>
                        <a href="https://www.linkedin.com/in/fadhilmuln-1234" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col mb-4">
                <div class="card border-0">
                    <img src="https://i.pinimg.com/564x/04/1f/77/041f771a9d84af146f191d3ed61cd349.jpg" class="card-img-top" alt="Rifki Ahmad Maulana">
                    <div class="card-body">
                        <h4 class="card-text">Rifki Ahmad Maulana</h4>
                        <p class="card-text">Web Designer | Front-End Developer</p>
                        <p class="card-text font-weight-light">RPL 1'22</p>
                        <a href="https://www.instagram.com/rifkiahmd15/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="" target="_blank"><i class="fab fa-github"></i></a>
                        <a href="" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col mb-4">
                <div class="card border-0">
                    <img src="https://i.pinimg.com/564x/97/fb/89/97fb89e325460be9a8a38365cec92d51.jpg" class="card-img-top" alt="Sabrina Misyell Aaliyah">
                    <div class="card-body">
                        <h4 class="card-text">Sabrina Misyell Aaliyah</h4>
                        <p class="card-text">Web Designer | Front-End Developer</p>
                        <p class="card-text font-weight-light">RPL 1'22</p>
                        <a href="https://www.instagram.com/tkqmflsk/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://github.com/sabturday" target="_blank"><i class="fab fa-github"></i></a>
                        <a href="https://www.linkedin.com/in/sabrinamisyell/" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col mb-4">
                <div class="card border-0">
                    <img src="https://i.pinimg.com/564x/da/5f/14/da5f1439f1307906bcffef5017e2ac6e.jpg" class="card-img-top" alt="Cikal Gemintang Seya">
                    <div class="card-body">
                        <h4 class="card-text">Cikal Gemintang Seya</h4>
                        <p class="card-text">Back-End Developer</p>
                        <p class="card-text font-weight-light">RPL 1'22</p>
                        <a href="https://www.instagram.com/ckl_gs/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://github.com/sglkc" target="_blank"><i class="fab fa-github"></i></a>
                        <a href="https://www.linkedin.com/in/cikal-gs" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col mb-4">
                <div class="card border-0">
                    <img src="https://i.pinimg.com/564x/16/d3/94/16d3945fa89f2b98d60f744c8b34800a.jpg" class="card-img-top" alt="Rashad Razikin Zulkarnaen">
                    <div class="card-body">
                        <h4 class="card-text">Rashad Razikin Zulkarnaen</h4>
                        <p class="card-text">Back-End Developer</p>
                        <p class="card-text font-weight-light">RPL 1'22</p>
                        <a href="https://www.instagram.com/rashad.r.z/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://github.com/RashadRZ" target="_blank"><i class="fab fa-github"></i></a>
                        <a href="" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
