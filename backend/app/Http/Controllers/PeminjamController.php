<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\DetailPinjam;
use App\Models\LogAktivitas;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamController extends Controller
{
    /**
     * Menampilkan katalog alat yang tersedia.
     */
    public function katalogAlat()
    {
        $alat = Alat::with('kategori')
            ->where('stok', '>', 0)
            ->get();

        return view('peminjam.katalog', compact('alat'));
    }

    /**
     * Mengajukan peminjaman alat.
     */
    public function ajukanPeminjaman(Request $request)
    {
        $request->validate([
            'tgl_kembali_plan' => 'required|date|after:today',
            'alat_id' => 'required|array|min:1',
            'alat_id.*' => 'required|integer|exists:alat,id',
            'jumlah' => 'required|array|min:1',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $alatIds = $request->input('alat_id', []);
                $jumlahAlat = $request->input('jumlah', []);

                if (count($alatIds) !== count($jumlahAlat)) {
                    throw new \RuntimeException(
                        'Data alat dan jumlah tidak sesuai.'
                    );
                }

                // Periksa ketersediaan alat sebelum membuat pengajuan.
                foreach ($alatIds as $index => $alatId) {
                    $alat = Alat::whereKey($alatId)
                        ->lockForUpdate()
                        ->firstOrFail();

                    $jumlah = (int) $jumlahAlat[$index];

                    if ($jumlah < 1 || $alat->stok < $jumlah) {
                        throw new \RuntimeException(
                            'Stok alat ' . $alat->nama_alat
                            . ' tidak mencukupi.'
                        );
                    }
                }

                // Simpan data peminjaman.
                $peminjaman = Peminjaman::create([
                    'user_id' => auth()->id(),
                    'tgl_pinjam' => now(),
                    'tgl_kembali_plan' => $request->tgl_kembali_plan,
                    'status' => 'diajukan',
                ]);

                // Simpan detail setiap alat yang diajukan.
                foreach ($alatIds as $index => $alatId) {
                    DetailPinjam::create([
                        'peminjaman_id' => $peminjaman->id,
                        'alat_id' => $alatId,
                        'jumlah' => (int) $jumlahAlat[$index],
                    ]);
                }

                // Catat aktivitas peminjaman.
                LogAktivitas::create([
                    'user_id' => auth()->id(),
                    'aktivitas' => 'Mengajukan peminjaman dengan ID '
                        . $peminjaman->id,
                ]);
            });

            return redirect()
                ->route('peminjam.riwayat')
                ->with(
                    'success',
                    'Pengajuan peminjaman berhasil dikirim.'
                );

        } catch (\RuntimeException $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());

        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal mengajukan peminjaman. Periksa data dan konfigurasi database.'
                );
        }
    }

    /**
     * Menampilkan riwayat peminjaman milik pengguna yang login.
     */
    public function riwayatPeminjaman()
    {
        $peminjaman = Peminjaman::with([
            'detailPinjam.alat',
            'pengembalian',
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('peminjam.riwayat', compact('peminjaman'));
    }

    /**
     * Mengajukan pengembalian alat.
     */
    public function ajukanPengembalian(Request $request, $id)
    {
        $request->validate([
            'kondisi_kembali' => 'required|in:baik,rusak',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                // Pastikan peminjaman milik pengguna yang login.
                $peminjaman = Peminjaman::where(
                    'user_id',
                    auth()->id()
                )
                    ->whereKey($id)
                    ->lockForUpdate()
                    ->firstOrFail();

                // Hanya peminjaman aktif yang boleh dikembalikan.
                if (!in_array(
                    strtolower($peminjaman->status ?? ''),
                    ['dipinjam', 'terlambat']
                )) {
                    throw new \RuntimeException(
                        'Status peminjaman belum memungkinkan pengembalian.'
                    );
                }

                // Cegah pengajuan pengembalian ganda.
                if ($peminjaman->pengembalian()->exists()) {
                    throw new \RuntimeException(
                        'Pengajuan pengembalian untuk peminjaman ini sudah ada.'
                    );
                }

                // Buat pengajuan pengembalian.
                Pengembalian::create([
                    'peminjaman_id' => $peminjaman->id,
                    'petugas_id' => null,
                    'tgl_kembali' => now()->toDateString(),
                    'kondisi_kembali' => $request->kondisi_kembali,
                    'denda' => 0,
                    'status' => 'menunggu_verifikasi',
                ]);

                // Catat aktivitas pengguna.
                LogAktivitas::create([
                    'user_id' => auth()->id(),
                    'aktivitas' => 'Mengajukan pengembalian peminjaman ID '
                        . $peminjaman->id,
                ]);
            });

            return redirect()
                ->route('peminjam.riwayat')
                ->with(
                    'success',
                    'Pengajuan pengembalian berhasil. Serahkan alat kepada petugas untuk diperiksa.'
                );

        } catch (\RuntimeException $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());

        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pengajuan pengembalian gagal. Silakan periksa konfigurasi database.'
                );
        }
    }
}
