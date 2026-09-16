<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class PengembalianController extends Controller
{
    /**
     * Menampilkan daftar transaksi pengembalian.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pengembalian = Pengembalian::with(['peminjaman.user', 'petugas', 'user'])
            ->when($search, function ($query, $search) {
                $query->whereHas('peminjaman.user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('petugas', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhere('status', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.pengembalian.index', compact('pengembalian'));
    }

    /**
     * Memperbarui status pengembalian.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status pengembalian berhasil diperbarui!');
    }

    /**
     * Verifikasi pengembalian alat.
     */
    public function verifikasi(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $pengembalian = Pengembalian::findOrFail($id);

            // Update status pengembalian
            $pengembalian->update([
                'status' => 'Dikembalikan',
                'petugas_id' => auth()->id(),
            ]);

            // Update status transaksi peminjaman terkait jika ada
            if ($pengembalian->peminjaman) {
                $pengembalian->peminjaman->update([
                    'status' => 'Dikembalikan'
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Pengembalian berhasil diverifikasi!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memverifikasi: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus data pengembalian.
     */
    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();

        return redirect()->back()->with('success', 'Data pengembalian berhasil dihapus!');
    }
}