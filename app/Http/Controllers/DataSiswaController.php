<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DataSiswa;
use App\Siswa;

class DataSiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $datasiswa = Siswa::toBase()->get();

        return view('admin.siswa')->with('datasiswa', $datasiswa);
    }

    public function tambah(DataSiswa $request)
    {
        /* NIS harus unik */
        $this->validate($request, ['nis' => 'unique:App\Siswa,nis']);

        /* TODO: password random buat siswa baru */
        Siswa::insert([
            'password' => Hash::make('password'),
        ] + $request->except('_token', 'password'));

        return back()->with('status', ['success', 'Sukses menambahkan siswa']);
    }

    public function hapus(Request $request)
    {
        $siswa = Siswa::find($request->nis);
        $siswa->delete();

        return back()->with('status', ['danger', "Sukses menghapus siswa {$request->nis}"]);
    }

    /* TODO: edit password? */
    public function edit(Request $request)
    {
        $siswa = Siswa::find($request->nis);

        return back()->withInput($siswa->attributesToArray())
                     ->with('status', ['warning', "Mengedit data siswa {$siswa->nama}"]);
    }

    public function update(DataSiswa $request)
    {
        // Jika NIS awal dan akhir tidak sama, maka cek jika ada duplikat
        if (! ($request->nis === $request->old_nis)) {
            $this->validate($request, ['nis' => 'unique:App\Siswa,nis']);
        }

        Siswa::where('nis', $request->old_nis)
            ->update($request->except('_token', 'old_nis'));

        return back()->with('status', ['success', "Sukses mengedit siswa {$request->nama}"]);
    }

    public function cari(Request $request)
    {
        $datasiswa = Siswa::query();

        if ($request->nis) {
            $datasiswa = $datasiswa->where('nis', 'like', "%{$request->nis}%");
        }
        if ($request->nama) {
            $datasiswa = $datasiswa->where('nama', 'like', "%{$request->nama}%");
        }
        if ($request->jurusan) {
            $datasiswa = $datasiswa->where('jurusan', $request->jurusan);
        }
        if ($request->kelas) {
            $datasiswa = $datasiswa->where('kelas', $request->kelas);
        }
        if ($request->tahun) {
            $datasiswa = $datasiswa->whereYear('tahun', $request->tahun);
        }

        $datasiswa = $datasiswa->get();

        return view('admin.siswa')->with([
            'cari' => true,
            'datasiswa' => $datasiswa,
        ] + $request->all());
    }
}
