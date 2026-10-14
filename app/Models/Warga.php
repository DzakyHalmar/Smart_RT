<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function iuran(): HasMany
    {
        return $this->hasMany(Iuran::class, 'warga_id');
    }
}
