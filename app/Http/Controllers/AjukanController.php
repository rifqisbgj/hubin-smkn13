<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Industri;
use App\Siswa;

class AjukanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }

    public function index()
    {
        // JIka sudah masuk tidak boleh mengajukan
        if (Auth::user()->id_industri) {
            return redirect(route('siswa.home'))->with('status', 'false');
        }

        return view('siswa.ajukan');
    }

    public function submit(Request $request)
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
            'nis.*' => [
                'nullable',
                'integer',
                'exists:App\Siswa,nis',
                Rule::notIn([$request->nis_pengaju]),
            ],
        ];

        $messages = [
            'nama.unique' => 'Industri sudah terdaftar',
            'nis.*.exists' => 'Salah satu NIS tidak terdaftar',
            'nis.*.not_in' => 'Tolong jangan masukkan NIS kamu lagi',
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

        /* Fungsi jika ada error
         * TODO: Optimisasi fungsi
         */
        function cancel($id_industri, $request, $message) {
            Industri::find($id_industri)->delete();
            return back()->withInput($request->all())
                         ->withErrors($message);
        }

        /* Proses validasi dan mengubah id_industri pada siswa */
        if (isset($request->nis)) {
            // TODO: Optimisasi validasi
            // Cek jika siswa sudah masuk industri
            $siswa = Siswa::whereIn('nis', $request->nis)
                ->whereNull('id_industri');

            if ($siswa->exists()) {
                $siswa = $siswa->whereIn('jurusan', $request->jurusan);

                // Cek jika siswa sesuai dengan jurusan
                if ($siswa->exists()) {
                    $siswa->update(['id_industri' => $id_industri]);
                } else {
                    return cancel($id_industri, $request, [
                        'jurusan' => "Salah satu siswa bukan jurusan {$jurusan}",
                    ]);
                }
            } else {
                return cancel($id_industri, $request, [
                    'industri' => "Salah satu sudah memasuki industri",
                ]);
            }
        }

        Siswa::where('nis', $request->nis_pengaju)
            ->update(['id_industri' => $id_industri]);

        return back()->with('status', 'success');
    }
}
