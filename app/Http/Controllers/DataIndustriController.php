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
                'jurusan' => $jurusan,
            ] + $request->except('_token', 'jurusan'));

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

        $industri = Industri::where('id', $request->id);
        $industri->update([
            'jurusan' => $jurusan,
        ] + $request->except('_token', 'jurusan'));

        return back()->with('status', ['success', "Sukses mengedit {$request->nama}"]);
    }

    public function cari(Request $request)
    {
        $dataindustri = Industri::query();

        /* TODO: Ganti percabangan if? */
        if ($request->nama) $dataindustri = $dataindustri->where('nama', 'like', "%{$request->nama}%");
        if ($request->alamat) $dataindustri = $dataindustri->where('alamat', 'like', "%{$request->alamat}%");
        if ($request->tahun) $dataindustri = $dataindustri->whereYear('tahun', $request->tahun);

        $dataindustri = $dataindustri->get();

        /* TODO: Optimisasi pengecekan jurusan? */
        if ($request->jurusan) {
            $dataindustri = $dataindustri->filter(function($industri) use ($request) {
                $jurusan = explode(',', $industri->jurusan);
                return array_intersect($jurusan, $request->jurusan);
            });
        }

        return view('admin.industri')->with([
            'cari' => true,
            'dataindustri' => $dataindustri,
        ] + $request->all());
    }
}
