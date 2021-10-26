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
}
