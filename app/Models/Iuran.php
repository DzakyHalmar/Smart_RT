<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Iuran extends Model
{
    protected $table = 'iuran';

    protected $fillable = [
        'warga_id',
        'jenis_iuran',
        'nominal',
        'tanggal_iuran',
        'status',
        'bulan',
        'tahun',
        'no_kk',
    ];

    protected function casts(): array
    {
        return [
            'nominal' => 'decimal:2',
            'tanggal_iuran' => 'date',
            'bulan' => 'integer',
            'tahun' => 'integer',
        ];
    }

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class);
    }
}