<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Industri;
use App\Siswa;

class PemetaanController extends Controller
{
    public function index()
    {
        $dataindustri = Industri::withCount('siswa')
            ->toBase()
            ->orderBy('nama')
            ->get();

        return view('pemetaan')->with('dataindustri', $dataindustri);
    }

    public function detail($id)
    {
        $industri = Industri::withCount('siswa')->find($id);
        $siswa = $industri->siswa;

        return view('detail')->with([
            'industri' => $industri,
            'siswa' => $siswa,
        ]);
    }

    public function hasil()
    {
        $dataindustri = Industri::withCount('siswa')
            ->whereNotNull('nama_pembimbing')
            ->orWhereNotNull('nip_pembimbing')
            ->havingRaw('siswa_count = kuota')
            ->orderBy('nama')
            ->getModels();

        return view('hasil')->with('dataindustri', $dataindustri);
    }
}
