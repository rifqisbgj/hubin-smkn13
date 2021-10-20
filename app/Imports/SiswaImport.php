<?php

namespace App\Imports;

use App\Siswa;
use Illuminate\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Jika kolom pertama bukan angka, lewat
        if (!is_numeric($row[0])) {
            return null;
        }

        // Jika ada duplikat nama jangan tambah
        $duplikat = Siswa::find($row[0]);

        if ($duplikat) {
            return null;
        }

        // Memeriksa jika password ada dan sudah melalui proses hashing
        // TODO: Generasi password acak jika kosong?
        if ($row[7]) {
            $password = strpos($row[7], '$2y$') === 0 ? $row[7] : Hash::make($row[7]);
        }

        return new Siswa([
            'nis' => $row[0],
            'nama' => $row[1],
            'jenis_kelamin' => $row[2],
            'jurusan' => $row[3],
            'kelas' => $row[4],
            'tahun' => $row[5],
            'id_industri' => $row[6] ?? null,
            'password' => $password ?? null,
        ]);
    }
}
