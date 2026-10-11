<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';

    protected $fillable = [
        'nik',
        'nama',
        'no_kk',
        'alamat',
        'no_telepon',
        'status',
    ];
}
