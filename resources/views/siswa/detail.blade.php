@extends('layouts.app')

@section('title', 'Pemetaan')

@push('script')
    <script src="{{ asset('js/kit.fontawesome.91b3159b57.js') }}"></script>
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
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
                                    <div class="button d-flex flex-column flex-lg-row justify-content-between">
                                        <form action="{{ route('siswa.pilih.submit') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_industri" value="{{ $industri->id }}">
                                            <button type="subit" class="btn btn-kembali m-2">
                                                Pilih Industri
                                            </button>
                                        </form>
                                        <a class="btn btn-kembali m-2" href="{{ route('siswa.pilih') }}">
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
