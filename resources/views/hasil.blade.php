@extends('layouts.app')

@section('title', 'Hasil Pemetaan')

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
            <h1 class="font-weight-bolder py-2">Hasil Pemetaan</h1>
        </header>

        <input class="form-control" id="cari" placeholder="Cari Industri">

        <div class="overflow-y" style="overflow-y: auto; height: 70vh">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nama</th>
                    <th scope="col">Bidang</th>
                    <th scope="col">Alamat</th>
                    <th scope="col" class="text-center">Jurusan</th>
                    <th scope="col" class="text-center">Kuota</th>
                    <th scope="col" class="text-center">Pembimbing</th>
                    <th scope="col" class="text-center">Siswa</th>
                </tr>
            </thead>
            <tbody class="data" id="cariTabel">
                @forelse ($dataindustri as $industri)
                <tr>
                    <td class="text-center">
                        <img class="avatar">
                    </td>
                    <td>{{ $industri->nama }}</td>
                    <td>{{ $industri->bidang }}</td>
                    <td>{{ $industri->alamat }}</td>
                    <td class="text-center">
                        @if(strstr($industri->jurusan, 'AK'))
                            <span class="badge p-2 mb-1 mb-lg-0 ak">
                                <i class="fas fa-flask pr-2"></i>AK
                            </span>
                        @endif
                        @if(strstr($industri->jurusan, 'RPL'))
                            <span class="badge p-2 mb-1 mb-lg-0 rpl">
                                <i class="fas fa-code pr-2"></i>RPL
                            </span>
                        @endif
                        @if(strstr($industri->jurusan, 'TKJ'))
                            <span class="badge p-2 mb-1 mb-lg-0 tkj">
                                <i class="fas fa-microchip pr-2"></i>TKJ
                            </span>
                        @endif
                    </td>
                    <td class="text-center text-{{ $industri->siswa_count >= $industri->kuota ? 'danger' : 'success' }}">
                        {{ "$industri->siswa_count/$industri->kuota" }}
                    </td>
                    <td class="text-center">
                        {{ $industri->nama_pembimbing }} {{ $industri->nip_pembimbing ? "($industri->nip_pembimbing)" : ''}}
                    </td>
                    <td>
                        <ol>
                            @foreach ($industri->siswa as $siswa)
                                <li>{{ "$siswa->nama ($siswa->nis)" }}</li>
                            @endforeach
                        </ol>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center font-weight-bolder">
                            Data kosong!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
@endsection
