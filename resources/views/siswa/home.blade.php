@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Selamat datang <strong>{{ Auth::user()->nama }}</strong>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-deck">
                        <div class="card btn btn-light">
                            <div class="card-body">
                                <h5 class="card-title">Ajukan Industri</h5>
                                Ajukan industri dari luar rekomendasi sekolah
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                        <div class="card btn btn-success text-reset">
                            <div class="card-body">
                                <h5 class="card-title">Pilih Industri</h5>
                                Pilih industri untuk prakerin
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                        <div class="card btn btn-warning">
                            <div class="card-body">
                                <h5 class="card-title">Hubungi Admin</h5>
                                Hubungi admin untuk mengajukan perubahan
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
