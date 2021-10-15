@extends('layouts.app')

@push('script')
    <script src="{{ asset('js/siswaform.js') }}"></script>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            @if (session('status'))
                <div class="alert alert-{{ session('status')[0] }} mb-2" role="alert">
                    {{ session('status')[1] }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-warning mb-2" role="alert">
                    <div><strong>Gagal menambahkan data</strong></div>
                    @error('nis') <div>NIS sudah terdaftar!</div> @enderror
                    @error('nama') <div>Format nama tidak valid!</div> @enderror
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ old() && !$errors->any() ? 'Edit Siswa' : 'Keterangan Siswa' }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ old() && !$errors->any() ? route('admin.siswa.update') : route('admin.siswa.tambah') }}">
                        @csrf

                        @if (old())
                            <input type="hidden" name="old_nis" value="{{ old('nis') }}">
                        @endif

                        <div class="form-group">
                            <label class="form-label">Nomor Induk Siswa</label>
                            <input class="form-control form-control-sm @error('nis') is-invalid @enderror" type="number" name="nis" value="{{ old('nis') }}" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Siswa</label>
                            <input class="form-control form-control-sm @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" pattern="[a-zA-Z ]+" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-control form-control-sm" name="jenis_kelamin" required>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jurusan</label>
                            <select class="form-control form-control-sm" id="jurusan" name="jurusan" required>
                                <option value="AK" {{ old('jurusan') == 'AK' ? 'selected' : '' }}>Analis Kimia</option>
                                <option value="RPL" {{ old('jurusan') == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                                <option value="TKJ" {{ old('jurusan') == 'TKJ' ? 'selected' : '' }}>Teknik Komputer dan Jaringan</option>
                            </select>
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                            <label class="form-label">Kelas</label>
                            <select class="form-control form-control-sm" id="kelas" name="kelas" required>
                                <option value="1" {{ old('kelas') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('kelas') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('kelas') == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('kelas') == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ old('kelas') == '5' ? 'selected' : '' }}>5</option>
                                <option value="6" {{ old('kelas') == '6' ? 'selected' : '' }}>6</option>
                            </select>
                            </div>
                            <div class="col">
                                <label class="form-label">Tahun</label>
                                <input class="form-control form-control-sm" name="tahun" type="number" min="2020" max="{{ date("Y") }}" value="{{ old() ? old('tahun') : date("Y") }}" onKeyPress="if(this.value.length>=4) return false" required>
                                @if (!old())
                                    <small class="form-text text-muted">*Terisi otomatis</small>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <button type="submit" class="btn btn-primary">{{ old() && !$errors->any() ? 'Edit' : 'Tambah' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body px-2">
                    <form class="container" method="POST" action="{{ route('admin.siswa.cari') }}">
                        @csrf
                        <div class="row justify-content-md-center">
                            <div class="col-2 p-0 pr-1">
                                <input class="form-control form-control-sm" type="number" name="nis" placeholder="NIS" value="{{ $nis ?? '' }}" autocomplete="off">
                            </div>
                            <div class="col-3 p-0 pr-1">
                                <input class="form-control form-control-sm" name="nama" placeholder="Nama" value="{{ $nama ?? '' }}" autocomplete="off">
                            </div>
                            <div class="col-3 p-0 pr-1">
                                <select class="form-control form-control-sm" name="jurusan">
                                    <option value="">Semua Jurusan</option>
                                    <option value="AK" {{ $jurusan ?? '' == 'AK' ? 'selected' : '' }}>Analis Kimia</option>
                                    <option value="RPL" {{ $jurusan ?? '' == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                                    <option value="TKJ" {{ $jurusan ?? '' == 'TKJ' ? 'selected' : '' }}>Teknik Komputer dan Jaringan</option>
                                </select>
                            </div>
                            <div class="col p-0 pr-1">
                                <input class="form-control form-control-sm" type-"number" name="kelas" value="{{ $kelas ?? '' }}" autocomplete="off" placeholder="Kelas">
                            </div>
                            <div class="col p-0 pr-1">
                                <input class="form-control form-control-sm" name="tahun" maxlength="4" pattern="[\d+]{4}" value="{{ $tahun ?? '' }}" autocomplete="off" placeholder="Tahun">
                            </div>
                            <div class="col p-0 pr-1">
                                <button class="btn btn-sm btn-outline-success w-100" type="submit">Cari</button>
                            </div>
                            <div class="col p-0">
                                <a class="btn btn-sm btn-outline-secondary w-100" href="{{ route('admin.siswa.data') }}">Ulang</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0" style="overflow-y: auto; height: 75vh">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>Tahun</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datasiswa as $siswa)
                            <tr>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $siswa->jurusan }}</td>
                                <td>{{ $siswa->kelas }}</td>
                                <td>{{ $siswa->tahun }}</td>
                                <td class="text-center">
                                    <form class="d-inline" method="POST" action="{{ route('admin.siswa.edit') }}">
                                        @csrf
                                        <input type="hidden" name="nis" value="{{ $siswa->nis }}">
                                        <button type="submit" class="btn btn-sm btn-outline-info">Edit</button>
                                    </form>
                                    <form class="d-inline" method="POST" action="{{ route('admin.siswa.hapus') }}">
                                        @csrf
                                        <input type="hidden" name="nis" value="{{ $siswa->nis }}">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    @if ($cari ?? '')
                                        <th colspan="7">Data siswa tidak ditemukan!</th>
                                    @else
                                        <th colspan="7">Data siswa kosong!</th>
                                    @endif
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
