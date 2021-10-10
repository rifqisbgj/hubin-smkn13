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
        'tahun',
        'alamat',
        'kuota',
        'pembimbing',
        'nip_pembimbing',
    ];

    protected $hidden = [
        'pembimbing', 'nip_pembimbing',
    ];
}
