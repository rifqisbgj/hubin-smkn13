<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
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
        return view('admin.siswa', compact('datasiswa'));
    }

    public function tambah(Request $request)
    {
        $tahun = date('Y');
        $this->validate($request, [
            'nis' => 'required|integer|unique:App\Siswa,nis',
            'nama' => 'required',
            'jenis_kelamin' => [
                'required',
                Rule::in(['L', 'P']),
            ],
            'jurusan' => [
                'required',
                Rule::in(['AK', 'RPL', 'TKJ']),
            ],
            'kelas' => 'required|integer|gte:1|lte:6',
            'tahun' => "required|integer|gte:2020|lte:{$tahun}",
        ]);

        /* TODO: password random buat siswa baru */
        $affected = Siswa::insert([
            'nis' => $request->nis,
            'password' => Hash::make('password'),
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'tahun' => $request->tahun,
        ]);

        if ($affected) {
            return back()->with('status', ['success', 'Sukses menambahkan siswa']);
        }
    }

    public function hapus(Request $request)
    {
        $siswa = Siswa::find($request->nis);
        $siswa->delete();
        return back()->with('status', ['danger', 'Sukses menghapus siswa']);
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
        ])->with('status', ['warning', 'Mengedit data siswa']);
    }

    public function update(Request $request)
    {
        $affected = Siswa::where('nis', $request->old_nis)
            ->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'tahun' => $request->tahun,
            ]);

        return back()->with('status', ['success', 'Sukses mengedit siswa']);
    }
}
