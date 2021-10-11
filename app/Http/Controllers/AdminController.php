<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Admin;
use App\Siswa;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.home');
    }

    public function pengaturan()
    {
        return view('admin.pengaturan');
    }

    public function pengaturanSubmit(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'password_old' => 'password:admin',
        ]);

        $affected = Admin::where('username', Auth::user()->username)
            ->update([
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);

        if ($affected) {
            Auth::guard('admin')->logout();
            Auth::guard('admin')->attempt($credentials, $request->remember);
            return redirect()->back()->with('status', true);
        }

        return redirect()->back()->withInput($credentials);
    }

    public function dataSiswa()
    {
        $datasiswa = Siswa::toBase()->get();
        return view('admin.siswa', compact('datasiswa'));
    }

    public function tambahSiswa(Request $request)
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
    
        $affected = Siswa::insert([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'tahun' => $request->tahun,
        ]);

        if ($affected) {
            return back()->with('status', ['success', 'Sukses tambah siswa']);
        }
    }
}
