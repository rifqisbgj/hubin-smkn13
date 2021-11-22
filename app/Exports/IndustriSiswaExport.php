<?php

namespace App\Exports;

use App\Industri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterSheet;

class IndustriSiswaExport implements FromCollection, WithEvents, WithHeadings, WithMapping, ShouldAutoSize
{
    use RegistersEventListeners;

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
            'Siswa',
        ];
    }

    public function map($industri): array
    {
        $datasiswa = '';

        $industri->siswa->each(function ($siswa) use (&$datasiswa) {
            $datasiswa = $datasiswa . "$siswa->nama ($siswa->nis)\r\n";
        });

        return [
            $industri->id,
            $industri->nama,
            $industri->bidang,
            $industri->kontak,
            $industri->jurusan,
            $industri->tahun,
            $industri->alamat,
            $industri->kuota,
            $industri->catatan,
            $industri->nis_pengaju,
            $industri->status,
            $industri->nama_pembimbing,
            $industri->nip_pembimbing,
            $datasiswa,
        ];
    }

    public static function afterSheet(AfterSheet $event)
    {
        $event->sheet->getDelegate()->getStyle('2')->getAlignment()->setWrapText(true);
    }
}
