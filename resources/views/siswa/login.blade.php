@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login Siswa</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('siswa.login.submit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nis" class="col-md-4 col-form-label text-md-right">NIS</label>

                            <div class="col-md-6">
                                <input id="nis" type="number" min="0" class="form-control @if(old('nis')) is-invalid @endif" name="nis" value="{{ old('nis') }}" required autocomplete="off" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @if(old('nis')) is-invalid @endif" name="password" required autocomplete="current-password">

                                @if(old('nis'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Kredensial salah</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                                <a class="ml-3 card-link" href="{{ route('admin.login') }}">Bukan Siswa?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
