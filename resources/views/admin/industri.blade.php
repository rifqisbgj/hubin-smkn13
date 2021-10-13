@extends('layouts.app')

@push('script')
    <script src="{{ asset('js/dataindustri.js') }}"></script>
@endpush
@section('content')
<div class="modal" id="industriModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="POST" action="{{ '' }}">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="industriId" type="hidden">
                <div class="form-group">
                    <label class="form-label">Nama Industri</label>
                    <input class="form-control form-control-sm" id="industriNama" name="nama" pattern="[a-zA-Z ]+" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Bidang</label>
                    <input class="form-control form-control-sm" id="industriBidang" name="bidang">
                </div>
                <div class="form-group">
                    <label class="form-label">Kontak</label>
                    <input class="form-control form-control-sm" id="industriKontak" name="kontak">
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control form-control-sm" id="industriAlamat" name="alamat" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Jurusan</label><br />
                    <div class="form-check form-check-inline">
                        <input class="form-check-input industriJurusan" type="checkbox" name="jurusan[]" value="AK">
                        <label class="form-check-label">AK</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input industriJurusan" type="checkbox" name="jurusan[]" value="RPL">
                        <label class="form-check-label">RPL</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input industriJurusan" type="checkbox" name="jurusan[]" value="TKJ">
                        <label class="form-check-label">TKJ</label>
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col">
                        <label class="form-label">Kuota</label>
                        <input class="form-control form-control-sm" id="industriKuota" type="number" name="kuota" min="0" max="10" value="4">
                    </div>
                    <div class="col">
                        <label class="form-label">Tahun</label>
                        <input class="form-control form-control-sm" id="industriTahun" name="tahun" type="number" min="2020" max="{{ date("Y") }}" value="{{ old() ? old('tahun') : date("Y") }}" onKeyPress="if(this.value.length>=4) return false" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Ubah Perubahan</button>
            </div>
        </form>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-3">
            <div class="card">
                <div class="card-header">Data Industri</div>
                <div class="card-body">
                    <form method="POST" action="submit">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">Nama Industri</label>
                            <input class="form-control form-control-sm" name="nama" pattern="[a-zA-Z ]+" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Bidang</label>
                            <input class="form-control form-control-sm" name="bidang">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kontak</label>
                            <input class="form-control form-control-sm" name="kontak">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control form-control-sm" name="alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jurusan</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="jurusan[]" value="AK">
                                <label class="form-check-label">AK</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="jurusan[]" value="RPL">
                                <label class="form-check-label">RPL</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="jurusan[]" value="TKJ">
                                <label class="form-check-label">TKJ</label>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                                <label class="form-label">Kuota</label>
                                <input class="form-control form-control-sm" type="number" name="kuota" min="0" max="10" value="4">
                            </div>
                            <div class="col">
                                <label class="form-label">Tahun</label>
                                <input class="form-control form-control-sm" name="tahun" type="number" min="2020" max="{{ date("Y") }}" value="{{ old() ? old('tahun') : date("Y") }}" onKeyPress="if(this.value.length>=4) return false" required>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ old() && !$errors->any() ? 'Edit' : 'Tambah' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form class="container" method="POST" action="{{ 'admin.cari.indsutri' }}">
                        @csrf
                        <div class="row justify-content-md-center">
                            <div class="col-3 p-0 pr-1">
                                <input class="form-control form-control-sm" name="nama" placeholder="Nama" autocomplete="off">
                            </div>
                            <div class="col-3 p-0 pr-1">
                                <input class="form-control form-control-sm" name="alamat" placeholder="Alamat" autocomplete="off">
                            </div>
                            <div class="col p-0 pr-1">
                                <input class="form-control form-control-sm" type="number" name="tahun" placeholder="Tahun" autocomplete="off">
                            </div>
                            <div class="col p-0 pr-1">
                                <button class="btn btn-sm btn-outline-success w-100" type="submit">Cari</button>
                            </div>
                            <div class="col p-0 pr-1">
                                <a class="btn btn-sm btn-outline-secondary w-100" href="{{ route('admin.data.industri') }}">Ulang</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0" style="overflow-y: auto; height: 75vh">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Bidang</th>
                                <th>Jurusan</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                <th>Kuota</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataindustri as $industri)
                                <tr class="{{ $industri->status ? '' : 'bg-warning' }}" role="button" data-toggle="modal" data-target="#exampleModal" data-id="{{ $industri->id }}">
                                    <td>{{ $industri->id }}</td>
                                    <td>{{ $industri->nama }}</td>
                                    <td>{{ $industri->bidang }}</td>
                                    <td>{{ $industri->jurusan }}</td>
                                    <td>{{ $industri->kontak }}</td>
                                    <td>{{ $industri->alamat }}</td>
                                    <td>{{ $industri->kuota }}</td>
                                    <td>{{ $industri->tahun }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="6">Data industri kosong!</th>
                                </tr>
                            @endempty
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
