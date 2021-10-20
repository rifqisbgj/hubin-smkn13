<?php

namespace App\Exports;

use App\Industri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class IndustriExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Industri::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Bidang',
            'Kontak',
            'Jurusan',
            'Tahun',
            'Alamat',
            'Kuota',
            'Catatan',
            'NIS Pengaju',
            'Status',
            'Nama Pembimbing',
            'NIP Pembimbing',
        ];
    }
}