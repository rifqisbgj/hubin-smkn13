@extends('layouts.app')

@push('script')
    <script src="{{ asset('js/datasiswa.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-auto col-lg-3 pb-2">
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
                <div class="card-header">{{ session('edit') ? 'Edit Siswa' : 'Keterangan Siswa' }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ session('edit') ? route('admin.siswa.update') : route('admin.siswa.tambah') }}">
                        @csrf
                        @if (session('edit'))
                            <input type="hidden" name="old_nis" value="{{ old('old_nis') ?? old('nis') }}">
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
                                <input class="form-control form-control-sm" name="tahun" type="number" min="2020" max="{{ date("Y") }}" value="{{ old('tahun') ?? date("Y") }}" onKeyPress="if(this.value.length>=4) return false" required>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <button type="submit" class="btn btn-primary">{{ session('edit') ? 'Edit' : 'Tambah' }}</button>
                        </div>
                        @if(session('edit'))
                            <div class="text-right pt-1">
                                @if(old('id_industri') > 0)
                                    <button class="btn btn-warning mb-0 mb-lg-1" type="submit" formaction="{{ route('admin.siswa.kick') }}">Hapus Industri</button>
                                @endif
                                <a class="btn btn-secondary" href="">Kembali</a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Cari Siswa:</span>
                    </div>
                    <input class="form-control" id="cari" placeholder="NIS/Nama/Jenis Kelamin...">
                </div>
                <small class="form-text text-muted mx-auto mb-1">Gunakan garis | untuk mencari lebih dari 1 kata kunci</small>
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
                                <th>Industri</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="cariTabel">
                            @forelse ($datasiswa as $siswa)
                            <tr>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $siswa->jurusan }}</td>
                                <td>{{ $siswa->kelas }}</td>
                                <td>{{ $siswa->tahun }}</td>
                                <td class="text-truncate">{{ $siswa->industri ?? 'Kosong' }}</td>
                                <td class="text-center">
                                    <form class="d-inline" method="POST" action="{{ route('admin.siswa.edit') }}">
                                        @csrf
                                        <input type="hidden" name="nis" value="{{ $siswa->nis }}">
                                        <button type="submit" class="btn btn-sm btn-outline-info mb-1 mb-xl-0">Edit</button>
                                        <button type="submit" class="btn btn-sm btn-outline-danger" formaction="{{ route('admin.siswa.hapus') }}">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <th colspan="8">Data siswa kosong!</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <hr class="m-0" />
                <div class="card-body">
                    <form class="form-row" method="POST" action="{{ route('admin.siswa.upload') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg pb-2 pb-lg-0">
                            <input class="form-control-file" type="file" name="file" accept=".xlsx" required>
                        </div>
                        <div class="col-auto pb-2 pb-lg-0">
                            <button class="btn btn-success" type="submit">Upload (.xlsx)</button>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-success" href="{{ route('admin.siswa.download') }}">Download (.xlsx)</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
