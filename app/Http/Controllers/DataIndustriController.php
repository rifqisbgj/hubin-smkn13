<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\DataIndustri;
use App\Exports\IndustriExport;
use App\Imports\IndustriImport;
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

        return back()->with('status', ['success', "Sukses menambahkan industri {$request->nama}"]);
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
        ] + $request->except('_token', 'jurusan', 'status'));

        // Jika ada nis_pengaju maka industri adalah ajuan dan status dapat berubah
        if ($request->nis_pengaju) {
            $industri->update([
                'status' => $request->status ? true : false,
            ]);
        }

        return back()->with('status', ['success', "Sukses mengedit {$request->nama}"]);
    }

    public function cari(Request $request)
    {
        $dataindustri = Industri::query();

        if ($request->nama) {
            $dataindustri = $dataindustri->where('nama', 'like', "%{$request->nama}%");
        }
        if ($request->alamat) {
            $dataindustri = $dataindustri->where('alamat', 'like', "%{$request->alamat}%");
        }
        if ($request->tahun) {
            $dataindustri = $dataindustri->whereYear('tahun', $request->tahun);
        }

        $dataindustri = $dataindustri->get();

        /* TODO: Optimisasi pengecekan jurusan? */
        if ($request->jurusan) {
            $dataindustri = $dataindustri->filter(function ($industri) use ($request) {
                $jurusan = explode(',', $industri->jurusan);

                return array_intersect($jurusan, $request->jurusan);
            });
        }

        return view('admin.industri')->with([
            'cari' => true,
            'dataindustri' => $dataindustri,
        ] + $request->all());
    }

    public function download()
    {
        return Excel::download(new IndustriExport, 'Industri.xlsx');
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx',
        ]);

        try {
            Excel::import(new IndustriImport, $request->file('file'));
        } catch (Exception $e) {
            return back()->with('status', ['danger', "Gagal mengupload data industri, laporkan pengembang: {$e}"]);
        }

        return back()->with('status', ['success', "Sukses mengupload data industri"]);
    }
}
