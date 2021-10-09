<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    protected $table = 'siswa';
    protected $guard = 'siswa';
    protected $primaryKey = 'nis';

    protected $fillable = [
        'nis', 'password', 'nama', 'kelas',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
