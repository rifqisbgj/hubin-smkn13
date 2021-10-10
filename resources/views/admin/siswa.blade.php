@extends('layouts.app')

@push('siswa-form')
    <script src="{{ asset('js/siswaform.js') }}"></script>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            <div class="card">
                <div class="card-header">Keterangan Siswa</div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label class="form-label">Nomor Induk Siswa</label>
                            <input class="form-control form-control-sm" type="number" name="nis" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Siswa</label>
                            <input class="form-control form-control-sm" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-control form-control-sm" name="jenis_kelamin" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jurusan</label>
                            <select class="form-control form-control-sm" id="jurusan" name="jurusan" required>
                                <option value="AK">Analis Kimia</option>
                                <option value="RPL">Rekayasa Perangkat Lunak</option>
                                <option value="TKJ">Teknik Komputer dan Jaringan</option>
                            </select>
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                            <label class="form-label">Kelas</label>
                            <select class="form-control form-control-sm" id="kelas" name="kelas" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                            </div>
                            <div class="col">
                                <label class="form-label">Tahun</label>
                                <input class="form-control form-control-sm" name="tahun" type="number" min="2020" max="{{ date("Y") }}" placeholder="{{ date("Y") }}" onKeyPress="if(this.value.length>=4) return false" required>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form class="container">
                        <div class="row justify-content-md-center">
                            <div class="col-5 p-0 pr-2">
                                <input class="form-control form-control-sm" name="nama" placeholder="Nama">
                            </div>
                            <div class="col-3 p-0 pr-2">
                                <select class="form-control form-control-sm" name="jurusan">
                                    <option value="">Semua Jurusan</option>
                                    <option value="AK">Analis Kimia</option>
                                    <option value="RPL">Rekayasa Perangkat Lunak</option>
                                    <option value="TKJ">Teknik Komputer Jaringan</option>
                                </select>
                            </div>
                            <div class="col p-0 pr-2">
                                <input class="form-control form-control-sm" type-"number" name="kelas" placeholder="Kelas">
                            </div>
                            <div class="col p-0 pr-2">
                                <input class="form-control form-control-sm" type="number" name="tahun" placeholder="Tahun">
                            </div>
                            <div class="col p-0">
                                <button class="btn btn-sm btn-outline-success" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body pt-0" style="overflow-y: auto; height: 75vh">
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
                                        <a class="btn btn-sm btn-outline-warning">Edit</a>
                                        <a class="btn btn-sm btn-outline-danger">Hapus</a>
                                    </td>
                                </tr>
                            @empty
                                <p>Data Siswa kosong!</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
