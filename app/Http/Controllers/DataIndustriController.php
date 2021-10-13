<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Industri;

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
        return response()->json($dataindustri);
    }
}
