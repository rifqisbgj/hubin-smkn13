@extends('layouts.app')

@section('title', 'Pemetaan')

@push('script')
    <script src="{{ asset('js/kit.fontawesome.91b3159b57.js') }}"></script>
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<div id="content" class="konten p-4 p-md-5 pt-5">

    <div class="container">
        <div class="container-content">
            <div class="row">
                <div class="col-12">
                    <h3>HOME</h3>
                    <h2 class="pki"><b>PRAKTEK KERJA INDUSTRI</b></h2>
                    <h2 class="smkn">SMKN 13 BANDUNG</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-6 ">
                    <hr class="hr">
                    <h3 class="ineu">Login Untuk Melanjutkan.</h3>
                    @if(old())
                        @error('nis')
                            <div class="alert alert-danger mt-1" class="text-white">NIS tidak sesuai</div>
                        @else
                            <div class="alert alert-danger mt-1" class="text-white">Password salah!</div>
                        @enderror
                    @endif
                    <a href="#" class="btn btn-login" data-toggle="modal" data-target="#exampleModalCenter">Login</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close d-flex align-items-center justify-content-center" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fas fa-times"></span>
                    </button>
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-6 d-flex">
                        <div class="modal-body p-5 img d-flex align-items-center color-2">
                            <div class="w-100 py-0 py-md-5">
                                <div class="text-white tulisan-login w-50">
                                    <h4 class="text-white">Login Siswa</h4>
                                    <hr class="garis-login col-lg-9 col-sm-12 m-0">
                                </div>
                                <h2 class="text-white"><b>Selamat Datang.</b></h2>
                                <form action="{{ route('siswa.login.submit') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>NIS</label>
                                        <input type="number" class="form-control" name="nis" maxlength="9" value="{{ old('nis') ?? ''}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary w-100">Login</button>
                                    </div>
                                    <p class="text-center mt-5"><a href="{{ route('admin.login') }}">Bukan siswa?</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 d-none d-lg-flex">
                        <div class="modal-body p-0 img d-flex color-1 text-center d-flex align-items-center ">
                            <div class="text w-100">
                                <div class="expand text-left p-5">
                                    <h1 class="text-white w-100">EXPAND YOUR</h1>
                                    <h1 class="exper">EXPERIENCE.</h1>
                                    <img src="{{ asset('img/illust_login.png') }}" alt="Ilustrasi halaman login" class="image-modal p-2">
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
