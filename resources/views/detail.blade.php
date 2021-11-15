@extends('layouts.app')

@section('title', 'Pemetaan')

@push('script')
    <script src="{{ asset('js/kit.fontawesome.91b3159b57.js') }}"></script>
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
    <!--
        <!doctype html>
        <html lang="en">

        <head>
        <title>Detail Industri - HUBIN</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="frontsidebar/css/style.css">
        <link rel="stylesheet" href="frontsidebar/css/ionicons.min.css">
        <link rel="stylesheet" href="frontsidebar/css/flaticon.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        </head>

        <body>
        <div class="wrapper d-flex align-items-stretch">
    -->
    <!-- Page Content  -->
    <div id="content" class="konten p-4 p-md-5 d-flex">

        <div class="container">
            <div class="container-content">
                <div class="det-indust">
                    Detail Industri
                </div>
                <div class="detail-industri ">
                    <div class="row">
                        <div class="col col-sm-6 col-md-10 col-lg-12 justify-content-center">
                            <div class="card p-2">
                                <div class="card-body m-0 p-0">
                                    <div class="row perusahaan-kuota p-0 m-0">
                                        <div class="col col-sm-2 col-md-9 col-lg-9 nama-pt text-truncate">
                                            {{ $industri->nama }}
                                        </div>
                                        <div class="col col-sm-3 col-md-3 col-lg-3 kuota">
                                            <p class="text-right">
                                            Kuota {{ $industri->siswa_count }}/{{ $industri->kuota }}
                                            </p>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row m-0 p-0 alamat">
                                        <div class="col col-sm-6 col-md-12 col-lg-12">
                                            <h3>Alamat : </h3>
                                            <p>
                                            {{ $industri->alamat }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row m-0 p-0 bidang-usaha mt-2">
                                        <div class="col col-sm-6 col-md-12 col-lg-12">
                                            <h3>Bidang Usaha : </h3>
                                            <p>
                                            {{ $industri->bidang }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row m-0 p-0 persyaratan mt-2">
                                        <div class="col col-sm-6 col-md-12 col-lg-12">
                                            <h3>Persyaratan : </h3>
                                            <p>
                                            {{ $industri->catatan }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row m-0 p-0 siswa-terdaftar mt-2">
                                        <div class="col col-sm-6 col-md-12 col-lg-12">
                                            <h3>Siswa Terdaftar : </h3>
                                            <p>
                                            @foreach ($siswa as $sis)
                                                {{ $sis->nama }} {{ $sis->jurusan }} {{ $sis->kelas }}<br>
                                            @endforeach
                                            </p>
                                        </div>
                                    </div>
                                    <div class="button d-flex justify-content-end">
                                        <a class="btn btn-kembali m-2" href="{{ route('pemetaan') }}">
                                            Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
