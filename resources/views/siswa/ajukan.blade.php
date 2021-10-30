@extends('layouts.app')

@section('title', 'Pengajuan Industri')

@push('script')
    <script src="{{ asset('js/ajukan.js') }}"></script>
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('css/ajukan.css') }}">
@endpush

@section('content')
    <main class="container">
        <div class="row row-cols-1 row-cols-sm-2 justify-content-center">
            <form class="col col-md-5" method="POST" action="{{ route('siswa.ajukan.submit') }}">
                <h1>Ajukan Industri</h1>

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                @if(session('status'))
                    <div class="alert alert-success">
                        <div><strong>Industri sukses diajukan!</strong></div>
                        <div>Harap tunggu informasi selanjutnya dari guru</div>
                    </div>
                @endif

                @csrf

                <div class="form-group">
                    <label class="form-label">Nama Industri</label>
                    <input class="form-control form-control-sm" name="nama" value="{{ old('nama') ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Bidang Industri</label>
                    <input class="form-control form-control-sm" name="bidang" value="{{ old('bidang') ?? '' }}" required>
                    <small class="form-text text-muted">Deskripsi pendek industri</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Kontak Industri</label>
                    <input class="form-control form-control-sm" name="kontak" value="{{ old('kontak') ?? '' }}" required>
                    <small class="form-text text-muted">Berupa email atau nomor telepon</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control form-control-sm" name="alamat" rows="3" required>{{ old('alamat') ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Catatan</label>
                    <textarea class="form-control form-control-sm" name="catatan" rows="3">{{ old('catatan') ?? '' }}</textarea>
                    <small class="form-text text-muted">Berupa syarat dan ketentuan untuk masuk.</small>
                    <small class="form-text text-muted m-0">Contoh: Laki-laki, Mempunyai SIM</small>
                </div>

                <div class="form-group p-0 m-0">
                    <div class="row">
                        <div class="col-3 col-lg-2 form-group">
                            <label class="form-label">Kuota</label>
                            <input class="form-control form-control-sm" id="kuota" type="number" min="1" max="5" name="kuota" value="1" required>
                        </div>

                        <div class="col form-group">
                            <label class="form-label">Menerima </label><br>
                            <input type="hidden" name="jurusan[]" value="{{ Auth::user()->jurusan }}">
                            <div class="custom-control custom-control-inline custom-checkbox">
                                <input class="custom-control-input" id="ak" type="checkbox" name="jurusan[]" value="AK" {{ Auth::user()->jurusan == 'AK' ? 'checked disabled' : '' }}>
                                <label class="custom-control-label" for="ak">AK</label>
                            </div>

                            <div class="custom-control custom-control-inline custom-checkbox">
                                <input class="custom-control-input" id="rpl" type="checkbox" name="jurusan[]" value="RPL" {{ Auth::user()->jurusan == 'RPL' ? 'checked disabled' : '' }}>
                                <label class="custom-control-label" for="rpl">RPL</label>
                            </div>

                            <div class="custom-control custom-control-inline custom-checkbox">
                                <input class="custom-control-input" id="tkj" type="checkbox" name="jurusan[]" value="TKJ" {{ Auth::user()->jurusan == 'TKJ' ? 'checked disabled' : '' }}>
                                <label class="custom-control-label" for="tkj">TKJ</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-0" id="nis">
                    <label class="form-label">NIS Siswa Pengaju</label>
                    <input class="form-control form-control-sm" type="number" name="nis_pengaju" value="{{ Auth::user()->nis }}" readonly required>
                    <small class="form-text text-muted">Kuota industri maksimal 5 bersama siswa lainnya</small>
                    <small class="form-text text-muted m-0">NIS siswa lain boleh kosong</small>
                </div>

                <div id="nisGroup">
                </div>

                <div class="form-group mb-0 mt-3">
                    <button type="submit" class="btn btn-primary">Ajukan</button>
                    <button type="reset" class="btn btn-outline-primary">Reset</button>
                </div>
            </form>
            <div class="col pt-3 pt-lg-0">
                <img class="w-100 h-100" src="{{ asset('img/illust_ajukan.svg') }}" alt="Ilustrasi">
            </div>
        </div>
    </main>
@endsection
