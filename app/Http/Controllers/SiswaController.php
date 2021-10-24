<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Siswa;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }

    public function index()
    {
        return view('siswa.home');
    }

    public function pengaturan()
    {
        return view('siswa.pengaturan');
    }

    public function pengaturanSubmit(Request $request)
    {
        $credentials = [
            'nis' => Auth::user()->nis,
            'password' => $request->password,
        ];

        $this->validate($request, [
            'password' => 'required',
            'password_old' => 'password:siswa',
        ]);

        $affected = Siswa::where('nis', Auth::user()->nis)
            ->update([
                'password' => Hash::make($request->password),
            ]);

        if ($affected) {
            Auth::guard('siswa')->logout();
            Auth::guard('siswa')->attempt($credentials, $request->remember);

            return back()->with('status', true);
        }

        return back();
    }
}
