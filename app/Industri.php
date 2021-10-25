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
        'catatan',
        'nis_pengaju',
        'status',
        'nama_pembimbing',
        'nip_pembimbing',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_industri', 'id');
    }

    public function pengaju()
    {
        return $this->hasOne(Siswa::class, 'nis', 'nis_pengaju');
    }
}
