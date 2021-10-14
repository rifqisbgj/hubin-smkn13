<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DataIndustri;
use App\Industri;
use App\Siswa;

class DataIndustriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $dataindustri = Industri::toBase()->get();
        return view('admin.industri')->with('dataindustri', $dataindustri);
    }

    public function informasi($id)
    {
        $dataindustri = Industri::find($id);
        if ($dataindustri->nis_pengaju) {
            $pengaju = Siswa::find($dataindustri->nis_pengaju);
        }
        return response()->json([
            'industri' => $dataindustri, 
            'pengaju' => $pengaju ?? '',
        ]);
    }

    public function tambah(DataIndustri $request)
    {
        // Mengubah array jurusan menjadi string
        $jurusan = implode(',', $request->jurusan);

        Industri::insert([
            'nama' => $request->nama,
            'bidang' => $request->bidang,
            'kontak' => $request->kontak,
            'jurusan' => $jurusan,
            'tahun' => $request->tahun,
            'alamat' => $request->alamat,
            'kuota' => $request->kuota,
            /* Data pengajuan dan pembimbing tidak perlu dimasukkan */
        ]);

        return back()->with('status', ['success', 'Sukses menambahkan industri']);
    }

    public function hapus(Request $request)
    {
        $industri = Industri::find($request->id);
        $industri->delete();

        // Perbarui semua id industri, atau biarkan?

        return back()->with('status', ['danger', "Sukses menghapus {$industri->nama}"]);
    }

    public function update(DataIndustri $request)
    {
        // Mengubah array jurusan menjadi string
        $jurusan = implode(',', $request->jurusan);

        Industri::where('id', $request->id)
            ->update([
            'nama' => $request->nama,
            'bidang' => $request->bidang,
            'kontak' => $request->kontak,
            'jurusan' => $jurusan,
            'tahun' => $request->tahun,
            'alamat' => $request->alamat,
            'kuota' => $request->kuota,
            ]);

        return back()->with('status', ['success', "Sukses mengedit {$request->nama}"]);
    }
}
