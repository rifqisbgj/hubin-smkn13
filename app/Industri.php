<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    protected $table = 'industri';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'bidang',
        'kontak',
        'jurusan',
        'tahun',
        'alamat',
        'kuota',
        'nis_pengaju',
        'status',
        'nama_pembimbing',
        'nip_pembimbing',
    ];
}
