<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    protected $table = 'siswa';
    protected $guard = 'siswa';
    protected $primaryKey = 'nis';
    public $timestamps = false;

    protected $fillable = [
        'nis',
        'password',
        'nama',
        'jenis_kelamin',
        'jurusan',
        'kelas',
        'tahun',
        'id_industri',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function industri()
    {
        return $this->belongsTo(Industri::class, 'id_industri', 'id');
    }
}
