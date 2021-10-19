<?php

namespace App\Imports;

use App\Industri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;

class IndustriImport implements ToModel, WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!is_numeric($row[0])) {
            return null;
        }

        return new Industri([
            'nama' => row['Nama'],
            'bidang' => row['Bidang'],
            'kontak' => row['Kontak'],
            'jurusan' => row['Jurusan'],
            'tahun' => row['Tahun'],
            'alamat' => row['Alamat'],
            'kuota' => row['Kuota'],
            'nis_pengaju' => row['NIS_Pengaju'],
            'status' => row['Status'],
            'nama_pembimbing' => row['Nama_Pembimbing'],
            'nip_pembimbing'=> row['NIP_Pembimbing'],
        ]);
    }

    public function uniqueBy()
    {
        return 'nama';
    }
}
