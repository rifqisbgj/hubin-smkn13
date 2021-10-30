@extends('layouts.app')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pengaturan Akun</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('siswa.pengaturan.submit') }}">
                        @csrf

                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                <strong>Password sukses diganti</strong>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <strong>Password salah!</strong>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password Baru</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_old" class="col-md-4 col-form-label text-md-right">Password Lama</label>

                            <div class="col-md-6">
                                <input id="password_old" type="password" class="form-control" name="password_old" required>
                            </div>
                        </div>

                        <input type="hidden" name="remember" id="remember" value="{{ Auth::user()->remember_token ? 'true' : 'false' }}">
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Ganti</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
