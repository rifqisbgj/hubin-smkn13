<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\DataSiswa;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use App\Siswa;

class DataSiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $datasiswa = Siswa::all();

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

        return back()->with('status', [
            'success',
            "Sukses menambahkan siswa {$request->nama}",
        ]);
    }

    public function hapus(Request $request)
    {
        $siswa = Siswa::find($request->nis);
        $siswa->delete();

        return back()->with('status', [
            'warning',
            "Sukses menghapus siswa {$request->nama}",
            ]);
    }

    /* TODO: edit password? */
    public function edit(Request $request)
    {
        $siswa = Siswa::find($request->nis);

        return back()->withInput($siswa->attributesToArray())
                     ->with([
                         'edit' => true,
                         'status' => [
                             'warning',
                             "Mengedit data siswa {$siswa->nama}",
                         ]
                     ]);
    }

    public function update(DataSiswa $request)
    {
        // Jika NIS awal dan akhir tidak sama, maka cek jika ada duplikat
        if (! ($request->nis === $request->old_nis)) {
            $validator = Validator::make($request->all(), [
                'nis' => 'unique:App\Siswa,nis'
            ]);

            if ($validator->fails()) {
                return back()->withInput($request->all())
                             ->withErrors($validator)
                             ->with('edit', true);
            }
        }

        Siswa::where('nis', $request->old_nis)
            ->update($request->except('_token', 'old_nis'));

        return back()->with('status', [
            'success',
            "Sukses mengedit siswa {$request->nama}",
        ]);
    }

    public function kick(Request $request)
    {
        Siswa::where('nis', $request->old_nis)
            ->update([
                'id_industri' => null,
            ]);

        return back()->with('status', [
            'success',
            "Sukses mengeluarkan siswa {$request->nama} dari industri",
        ]);
    }

    public function download()
    {
        return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx',
        ]);

        try {
            Excel::import(new SiswaImport, $request->file('file'));
        } catch (Exception $e) {
            return back()->with('status', [
                'danger',
                "Gagal mengupload data siswa, laporkan pengembang: {$e}",
            ]);
        }

        return back()->with('status', [
            'success',
            "Sukses mengupload data siswa",
        ]);
    }
}
