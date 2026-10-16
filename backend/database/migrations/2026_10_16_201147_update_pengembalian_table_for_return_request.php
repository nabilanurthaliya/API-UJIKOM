<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengembalian', function (Blueprint $table) {
            $table->foreignId('petugas_id')
                ->nullable()
                ->change();

            // Hanya tambah kolom status jika belum ada
            if (!Schema::hasColumn('pengembalian', 'status')) {
                $table->string('status', 30)
                    ->default('menunggu_verifikasi')
                    ->after('denda');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengembalian', function (Blueprint $table) {
            $table->dropColumn('status');

            $table->foreignId('petugas_id')
                ->nullable(false)
                ->change();
        });
    }
};
