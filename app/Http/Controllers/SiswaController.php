<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Siswa;
use App\Industri;

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

    public function ajukan()
    {
        return view('siswa.ajukan');
    }

    public function ajukanSubmit(Request $request)
    {
        $rules = [
            'nama' => 'required|unique:App\Industri,nama',
            'bidang' => 'required',
            'kontak' => 'required',
            'alamat' => 'required',
            'catatan' => 'nullable',
            'kuota' => 'required|integer|min:1',
            'jurusan' => 'required|array|min:1',
            'jurusan.*' => [
                'required',
                'distinct',
                Rule::in(['AK', 'RPL', 'TKJ']),
            ],
            'nis' => 'nullable|array|min:1',
            'nis.*' => 'nullable|integer|exists:App\Siswa,nis',
        ];
        $messages = [
            'nama.unique' => 'Industri sudah terdaftar',
            'nis.*.exists' => 'Salah satu NIS tidak terdaftar',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withInput($request->all())
                         ->withErrors($validator);
        }

        /* Proses menambahkan industri */
        $jurusan = implode(',', $request->jurusan);
        $tahun = date('Y');

        $id_industri = Industri::insertGetId([
            'jurusan' => $jurusan,
            'tahun' => $tahun,
            'status' => false,
        ] + $request->except('_token', 'jurusan', 'nis'));

        /* Proses mengubah id_industri pada siswa yang diisi */
        Siswa::where('nis', $nis_pengaju)
            ->update('id_industri', $id_industri);

        foreach ($request->nis as $nis) {
            Siswa::where('nis', $nis_pengaju)
                ->update('id_industri', $id_indsutri);
        }

        return back()->with('status', 'success');
    }
}
