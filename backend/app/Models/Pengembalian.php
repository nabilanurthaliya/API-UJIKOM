<?php

namespace App\Models;
use App\Models\Pengembalian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';

    protected $fillable = [
        'peminjaman_id',
        'petugas_id',
        'tgl_kembali',
        'kondisi_kembali',
        'denda',
        'status',
    ];

    protected $casts = [
        'tgl_kembali' => 'date',
        'denda' => 'integer',
    ];

    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(
            Peminjaman::class,
            'peminjaman_id'
        );
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'petugas_id'
        );
    }
}
