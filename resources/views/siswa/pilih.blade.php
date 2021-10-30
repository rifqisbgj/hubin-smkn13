@extends('layouts.app')

@section('title', 'Pemilihan Industri')

@push('script')
    <script src="{{ asset('js/kit.fontawesome.91b3159b57.js') }}"></script>
    <script src="{{ asset('js/pilih.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('css/pilih.css') }}">
@endpush

@section('content')
    <div class="container">

        <header>
            <h1 class="font-weight-bolder py-2">Pilih Industri</h1>
        </header>

        <input class="form-control" id="cari" placeholder="Cari Industri">
        <small class="text-muted">
            *Hanya menampilkan industri <strong>{{ Auth::user()->jurusan }}</strong>
        </small>

        <div class="overflow-y" style="overflow-y: auto; height: 70vh">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nama</th>
                    <th scope="col">Bidang</th>
                    <th scope="col">Alamat</th>
                    <th scope="col" class="text-center">Kuota</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="data" id="cariTabel">
                @forelse ($dataindustri as $industri)
                    @if($industri->siswa_count >= $industri->kuota)
                        @continue
                    @endif
                <tr class="align-middle">
                    <td class="text-center">
                        <img class="avatar">
                    </td>
                    <td>{{ $industri->nama }}</td>
                    <td>{{ $industri->bidang }}</td>
                    <td>{{ $industri->alamat }}</td>
                    <td class="text-center text-success">
                        {{ "$industri->siswa_count/$industri->kuota" }}
                    </td>
                    <td class="text-center">
                        <a type="button" class="btn btn-sm btn-outline-primary" href="#">Detail</a>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center font-weight-bolder">
                            Data kosong!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
@endsection
