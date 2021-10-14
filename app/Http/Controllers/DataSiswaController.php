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
            'nis' => $request->nis,
            'password' => Hash::make('password'),
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'tahun' => $request->tahun,
        ]);

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
        return back()->withInput([
            'nis' => $siswa->nis,
            'nama' => $siswa->nama,
            'jenis_kelamin' => $siswa->jenis_kelamin,
            'jurusan' => $siswa->jurusan,
            'kelas' => $siswa->kelas,
            'tahun' => $siswa->tahun,
        ])->with('status', ['warning', "Mengedit data siswa {$siswa->nis}"]);
    }

    public function update(DataSiswa $request)
    {
        Siswa::where('nis', $request->old_nis)
            ->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'tahun' => $request->tahun,
            ]);

        return back()->with('status', ['success', "Sukses mengedit siswa {$request->nis}"]);
    }

    /* TODO: ganti percabangan if jadi lebih rapih */
    public function cari(Request $request)
    {
        $datasiswa = Siswa::query();

        if ($request->nis) { $datasiswa = $datasiswa->where('nis', $request->nis); }
        if ($request->nama) { $datasiswa = $datasiswa->where('nama', 'like', "%$request->nama%"); }
        if ($request->jurusan) { $datasiswa = $datasiswa->where('jurusan', $request->jurusan); }
        if ($request->kelas) { $datasiswa = $datasiswa->where('kelas', $request->kelas); }
        if ($request->tahun) { $datasiswa = $datasiswa->where('tahun', $request->tahun); }

        $datasiswa = $datasiswa->get();
        return view('admin.siswa')->with([
            'cari' => true,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'tahun' => $request->tahun,
            'datasiswa' => $datasiswa,
        ]);
    }
}
