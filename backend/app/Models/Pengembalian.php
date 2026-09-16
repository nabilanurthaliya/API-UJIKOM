<?php

namespace App\Models;

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

    // Relasi ke Peminjaman
    public function peminjaman(): BelongsTo 
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    // Relasi ke User (Peminjam)
    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Petugas (Ubah User::class ke Petugas::class jika kamu punya Model Petugas terpisah)
    public function petugas(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}