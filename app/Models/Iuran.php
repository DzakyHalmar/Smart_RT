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
    ];

    protected $casts = [
        'tanggal_iuran' => 'date',
        'nominal' => 'decimal:2',
    ];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}