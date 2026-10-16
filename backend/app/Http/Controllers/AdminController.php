<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use App\Models\User;
use App\Models\LogAktivitas;
use App\Models\Peminjaman;
use App\Models\DetailPinjam;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    // ==========================================
    // DASHBOARD
    // ==========================================

    public function index()
    {
        $totalUser = User::count();
        $totalAlat = Alat::count();
        $totalKategori = Kategori::count();
        $totalPeminjaman = Peminjaman::count();
        $totalPengembalian = Pengembalian::count();
        $totalDetailPinjam = DetailPinjam::count();
        $totalLogAktivitas = LogAktivitas::count();

        $logs = LogAktivitas::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalAlat',
            'totalKategori',
            'totalPeminjaman',
            'totalPengembalian',
            'totalDetailPinjam',
            'totalLogAktivitas',
            'logs'
        ));
    }

    public function indexLogAktivitas(Request $request)
    {
        $search = $request->input('search');

        $logs = LogAktivitas::with('user')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('aktivitas', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($user) use ($search) {
                            $user->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.logaktivitas.index', compact('logs', 'search'));
    }

    // ==========================================
    // CRUD ALAT
    // ==========================================

    public function indexAlat(Request $request)
    {
        $search = $request->input('search');

        // PERBAIKAN:
        // Sebelumnya menggunakan $alat
        // Sekarang menggunakan $alats agar sesuai dengan Blade
        $alats = Alat::with('kategori')
            ->when($search, function ($query, $search) {
                return $query->where('nama_alat', 'like', "%{$search}%")
                    ->orWhere('status_kondisi', 'like', "%{$search}%")
                    ->orWhereHas('kategori', function ($q) use ($search) {
                        $q->where('nama_kategori', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.alat.index', compact('alats', 'search'));
    }

    public function createAlat()
    {
        $kategoris = Kategori::all();

        return view('admin.alat.create', compact('kategoris'));
    }

    public function storeAlat(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:0',
            'status_kondisi' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $folder = public_path('storage/alat');

            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move($folder, $filename);

            $data['gambar'] = 'storage/alat/' . $filename;
        }

        $alat = Alat::create($data);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menambahkan alat baru: ' . $alat->nama_alat . '.',
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Data alat berhasil ditambahkan.');
    }

    public function editAlat($id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all();

        return view('admin.alat.edit', compact('alat', 'kategoris'));
    }

    public function updateAlat(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:0',
            'status_kondisi' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {

            if ($alat->gambar && file_exists(public_path($alat->gambar))) {
                unlink(public_path($alat->gambar));
            }

            $folder = public_path('storage/alat');

            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move($folder, $filename);

            $data['gambar'] = 'storage/alat/' . $filename;
        }

        $alat->update($data);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Memperbarui data alat: ' . $alat->nama_alat . '.',
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Data alat berhasil diperbarui.');
    }

    public function destroyAlat($id)
    {
        $alat = Alat::findOrFail($id);

        $namaAlat = $alat->nama_alat;

        if ($alat->gambar && file_exists(public_path($alat->gambar))) {
            unlink(public_path($alat->gambar));
        }

        $alat->delete();

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menghapus data alat: ' . $namaAlat . '.',
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Data alat berhasil dihapus.');
    }

    // ==========================================
    // CRUD KATEGORI
    // ==========================================

    public function indexKategori(Request $request)
    {
        $search = $request->input('search');

        $kategoris = Kategori::when($search, function ($query, $search) {
                return $query->where('nama_kategori', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.kategori.index', compact('kategoris', 'search'));
    }

    public function createKategori()
    {
        return view('admin.kategori.create');
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori',
        ]);

        $kategori = Kategori::create($request->all());

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menambahkan kategori baru: ' . $kategori->nama_kategori . '.',
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function editKategori($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('admin.kategori.edit', compact('kategori'));
    }

    public function updateKategori(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori,' . $id,
        ]);

        $kategori->update($request->all());

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Memperbarui kategori: ' . $kategori->nama_kategori . '.',
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroyKategori($id)
    {
        $kategori = Kategori::findOrFail($id);

        $namaKategori = $kategori->nama_kategori;

        $kategori->delete();

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menghapus kategori: ' . $namaKategori . '.',
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    // ==========================================
    // USER MANAGEMENT
    // ==========================================

    public function indexUser(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('role', 'like', "%{$search}%");
                });
            })
            ->orderByRaw("
                CASE
                    WHEN role = 'admin' THEN 1
                    WHEN role = 'petugas' THEN 2
                    WHEN role = 'peminjam' THEN 3
                    ELSE 4
                END
            ")
            ->orderBy('name', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.user.index', compact('users', 'search'));
    }

    public function createUser()
    {
        return view('admin.user.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,petugas,peminjam',
            'no_hp' => 'nullable|string|max:20',
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'no_hp' => $request->no_hp,
        ];

        if ($request->hasFile('foto_profile')) {

            $folder = public_path('profile');

            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $file = $request->file('foto_profile');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move($folder, $filename);

            $data['foto_profile'] = 'profile/' . $filename;
        }

        $newUser = User::create($data);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menambahkan user baru: ' . $newUser->name . ' (' . $newUser->role . ').',
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,petugas,peminjam',
            'no_hp' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8',
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'no_hp' => $request->no_hp,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('foto_profile')) {

            if (
                $user->foto_profile &&
                file_exists(public_path($user->foto_profile))
            ) {
                unlink(public_path($user->foto_profile));
            }

            $folder = public_path('profile');

            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $file = $request->file('foto_profile');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move($folder, $filename);

            $data['foto_profile'] = 'profile/' . $filename;
        }

        $user->update($data);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Memperbarui data user: ' . $user->name . ' (' . $user->role . ').',
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return redirect()->route('admin.user.index')
                ->with('error', 'User dengan role Admin tidak dapat dihapus.');
        }

        $namaUser = $user->name;
        $roleUser  = $user->role;

        if (
            $user->foto_profile &&
            file_exists(public_path($user->foto_profile))
        ) {
            unlink(public_path($user->foto_profile));
        }

        $user->delete();

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menghapus user: ' . $namaUser . ' (' . $roleUser . ').',
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus.');
    }

    // ==========================================
    // TRANSAKSI PEMINJAMAN
    // ==========================================

    public function indexPeminjaman(Request $request)
    {
        $search = $request->input('search');

        $peminjaman = Peminjaman::with(['user', 'detailPinjam.alat'])
            ->when($search, function ($query, $search) {
                return $query->where('status', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.peminjaman.index', compact('peminjaman', 'search'));
    }

    public function createPeminjaman()
    {
        $users = User::where('role', 'peminjam')->get();

        $alat = Alat::where('stok', '>', 0)->get();

        return view('admin.peminjaman.create', compact('users', 'alat'));
    }

    public function storePeminjaman(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali_plan' => 'required|date|after_or_equal:tgl_pinjam',
            'alat_id' => 'required|array',
            'alat_id.*' => 'exists:alat,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:1',
        ]);

        DB::beginTransaction();

        try {

            $peminjaman = Peminjaman::create([
                'user_id' => $request->user_id,
                'tgl_pinjam' => $request->tgl_pinjam,
                'tgl_kembali_plan' => $request->tgl_kembali_plan,
                'status' => 'diajukan',
            ]);

            foreach ($request->alat_id as $index => $alatId) {

                $jumlahPinjam = $request->jumlah[$index];

                $alat = Alat::findOrFail($alatId);

                if ($alat->stok < $jumlahPinjam) {
                    throw new \Exception(
                        "Stok alat '{$alat->nama_alat}' tidak mencukupi."
                    );
                }

                DetailPinjam::create([
                    'peminjaman_id' => $peminjaman->id,
                    'alat_id' => $alatId,
                    'jumlah' => $jumlahPinjam,
                ]);
            }

            DB::commit();

            LogAktivitas::create([
                'user_id' => auth()->id(),
                'aktivitas' => 'Menambahkan peminjaman baru (ID: ' . $peminjaman->id . ') untuk user ID: ' . $request->user_id . '.',
            ]);

            return redirect()->route('admin.peminjaman.index')
                ->with('success', 'Data peminjaman berhasil diajukan.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function updateStatusPeminjaman(Request $request, $id)
    {
        $peminjaman = Peminjaman::with('detailPinjam.alat')
            ->findOrFail($id);

        $request->validate([
            'status' => 'required|in:diajukan,dipinjam,selesai,telat',
        ]);

        DB::beginTransaction();

        try {

            $statusLama = $peminjaman->status;
            $statusBaru = $request->status;

            if (
                $statusLama !== 'dipinjam' &&
                $statusBaru === 'dipinjam'
            ) {

                foreach ($peminjaman->detailPinjam as $detail) {

                    $alat = $detail->alat;

                    if ($alat->stok < $detail->jumlah) {
                        throw new \Exception(
                            "Stok alat {$alat->nama_alat} tidak mencukupi untuk dipinjam."
                        );
                    }

                    $alat->decrement('stok', $detail->jumlah);
                }

            } elseif (
                $statusLama === 'dipinjam' &&
                $statusBaru === 'selesai'
            ) {

                foreach ($peminjaman->detailPinjam as $detail) {
                    $detail->alat->increment('stok', $detail->jumlah);
                }
            }

            $peminjaman->update([
                'status' => $statusBaru
            ]);

            DB::commit();

            LogAktivitas::create([
                'user_id' => auth()->id(),
                'aktivitas' => 'Memperbarui status peminjaman ID: ' . $peminjaman->id . ' dari ' . $statusLama . ' menjadi ' . $statusBaru . '.',
            ]);

            return redirect()->route('admin.peminjaman.index')
                ->with('success', 'Status peminjaman berhasil diperbarui.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->with('error', $e->getMessage());
        }
    }

    public function destroyPeminjaman($id)
    {
        $peminjaman = Peminjaman::with('detailPinjam')
            ->findOrFail($id);

        if ($peminjaman->status === 'dipinjam') {

            foreach ($peminjaman->detailPinjam as $detail) {
                $detail->alat->increment('stok', $detail->jumlah);
            }
        }

        $peminjamanId = $peminjaman->id;

        $peminjaman->delete();

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menghapus data peminjaman ID: ' . $peminjamanId . '.',
        ]);

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }

    // ==========================================
    // TRANSAKSI PENGEMBALIAN
    // ==========================================

    public function indexPengembalian(Request $request)
    {
        $search = $request->input('search');

        $pengembalians = Pengembalian::with([
                'peminjaman.user',
                'peminjaman.detailPinjam.alat',
                'petugas',
            ])
            ->when($search, function ($query, $search) {
                return $query->where('kondisi_kembali', 'like', "%{$search}%")
                    ->orWhereHas('peminjaman.user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.pengembalian.index',
            compact('pengembalians', 'search')
        );
    }

    public function createPengembalian()
    {
        $peminjaman = Peminjaman::with([
                'user',
                'detailPinjam.alat'
            ])
            ->whereIn('status', ['dipinjam', 'telat'])
            ->whereDoesntHave('pengembalian')
            ->get();

        return view(
            'admin.pengembalian.create',
            compact('peminjaman')
        );
    }

    public function storePengembalian(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'tgl_kembali' => 'required|date',
            'kondisi_kembali' => 'required|string|max:255',
            'denda_tambahan' => 'nullable|integer|min:0',
        ]);

        DB::beginTransaction();

        try {

            $peminjaman = Peminjaman::with('detailPinjam.alat')
                ->findOrFail($request->peminjaman_id);

            $tglPlan = Carbon::parse($peminjaman->tgl_kembali_plan);
            $tglAktual = Carbon::parse($request->tgl_kembali);

            $dendaOtomatis = 0;
            $tarifDendaPerHari = 5000;

            if ($tglAktual->greaterThan($tglPlan)) {

                $selisihHari = $tglPlan->diffInDays($tglAktual);

                $dendaOtomatis = $selisihHari * $tarifDendaPerHari;
            }

            $dendaTambahan = $request->denda_tambahan ?? 0;

            $totalDenda = $dendaOtomatis + $dendaTambahan;

            Pengembalian::create([
                'peminjaman_id' => $request->peminjaman_id,
                'tgl_kembali' => $request->tgl_kembali,
                'kondisi_kembali' => $request->kondisi_kembali,
                'denda' => $totalDenda,
                'petugas_id' => auth()->id(),
            ]);

            $peminjaman->update([
                'status' => 'selesai'
            ]);

            foreach ($peminjaman->detailPinjam as $detail) {

                if ($detail->alat) {
                    $detail->alat->increment(
                        'stok',
                        $detail->jumlah
                    );
                }
            }

            DB::commit();

            LogAktivitas::create([
                'user_id' => auth()->id(),
                'aktivitas' => 'Memproses pengembalian untuk peminjaman ID: ' . $peminjaman->id . '. Denda: Rp ' . number_format($totalDenda, 0, ',', '.') . '.',
            ]);

            return redirect()->route('admin.pengembalian.index')
                ->with(
                    'success',
                    'Pengembalian berhasil diproses. Denda otomatis terhitung: Rp ' .
                    number_format($totalDenda, 0, ',', '.')
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroyPengembalian($id)
    {
        $pengembalian = Pengembalian::with(
            'peminjaman.detailPinjam.alat'
        )->findOrFail($id);

        DB::beginTransaction();

        try {

            $peminjaman = $pengembalian->peminjaman;

            if ($peminjaman) {

                $peminjaman->update([
                    'status' => 'dipinjam'
                ]);

                foreach ($peminjaman->detailPinjam as $detail) {

                    if ($detail->alat) {
                        $detail->alat->decrement(
                            'stok',
                            $detail->jumlah
                        );
                    }
                }
            }

            $pengembalianId = $pengembalian->id;

            $pengembalian->delete();

            DB::commit();

            LogAktivitas::create([
                'user_id' => auth()->id(),
                'aktivitas' => 'Menghapus data pengembalian ID: ' . $pengembalianId . '.',
            ]);

            return redirect()->route('admin.pengembalian.index')
                ->with(
                    'success',
                    'Data pengembalian berhasil dihapus.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->with('error', $e->getMessage());
        }
    }
}