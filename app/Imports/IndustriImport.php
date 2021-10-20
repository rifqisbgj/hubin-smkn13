<?php

namespace App\Imports;

use App\Industri;
use Maatwebsite\Excel\Concerns\ToModel;

class IndustriImport implements ToModel
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
        $duplikat = Industri::where('nama', $row[1])->get();

        if (count($duplikat)) {
            return null;
        }

        return new Industri([
            'nama' => $row[1],
            'bidang' => $row[2] ?? null,
            'kontak' => $row[3] ?? null,
            'jurusan' => $row[4],
            'tahun' => $row[5],
            'alamat' => $row[6],
            'kuota' => $row[7],
            'catatan' => $row[8] ?? null,
            'nis_pengaju' => $row[9] ?? null,
            'status' => $row[10] ?? 0,
            'nama_pembimbing' => $row[11] ?? null,
            'nip_pembimbing'=> $row[12] ?? null,
        ]);
    }
}
