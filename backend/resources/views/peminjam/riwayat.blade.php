<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Peminjaman</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #eef6ff;
            color: #173b68;
        }

        .header {
            min-height: 70px;
            background: linear-gradient(90deg, #0878d1, #2398ed);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 5%;
            gap: 12px;
            flex-wrap: wrap;
        }

        .header-title { font-size: 21px; font-weight: bold; }

        .header a {
            color: white;
            text-decoration: none;
            border: 1px solid #ffffff70;
            border-radius: 9px;
            padding: 10px 14px;
            font-size: 12px;
        }

        .container {
            max-width: 1320px;
            margin: auto;
            padding: 28px 20px;
        }

        .hero, .card {
            background: white;
            border: 1px solid #dcecff;
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 18px;
            box-shadow: 0 5px 20px #2364a010;
        }

        h1 { margin: 0; font-size: 28px; }
        .subtitle { color: #7188a5; font-size: 13px; }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 18px;
        }

        .stat {
            background: white;
            border: 1px solid #dcecff;
            border-radius: 13px;
            padding: 18px;
        }

        .stat-label { font-size: 12px; color: #7188a5; }
        .stat-number { font-size: 27px; font-weight: bold; margin-top: 7px; }

        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        input, select {
            padding: 10px;
            border: 1px solid #d8e7f5;
            border-radius: 8px;
            color: #315578;
            background: white;
            max-width: 100%;
        }

        .filters input[type="text"] { flex: 1; min-width: 150px; }

        .table-wrapper {
            overflow-x: auto;
            border: 1px solid #dcecff;
            border-radius: 10px;
        }

        table {
            width: 100%;
            min-width: 950px;
            border-collapse: collapse;
        }

        th {
            background: #eaf5ff;
            color: #275b8f;
            text-align: left;
            padding: 14px 12px;
            font-size: 12px;
        }

        td {
            padding: 14px 12px;
            border-top: 1px solid #edf3f8;
            font-size: 12px;
            vertical-align: top;
        }

        .alat-item { margin-bottom: 7px; }
        .alat-item:last-child { margin-bottom: 0; }

        .status {
            display: inline-block;
            padding: 7px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            white-space: nowrap;
        }

        .blue { background: #e3f1ff; color: #1683d8; }
        .green { background: #ddf8ed; color: #08794e; }
        .orange { background: #fff0d9; color: #a76500; }
        .red { background: #ffe7e7; color: #c83232; }
        .gray { background: #f0f3f6; color: #687b8f; }

        .btn {
            display: inline-block;
            border: 0;
            background: #168be4;
            color: white;
            padding: 10px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
        }

        .btn:hover { background: #0878d1; }

        .return-form {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 150px;
        }

        .notice {
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .success { background: #ddf8ed; color: #08794e; }
        .error { background: #ffe7e7; color: #b42323; }

        .empty {
            padding: 35px;
            text-align: center;
            color: #7188a5;
        }

        .footer {
            padding: 15px 2px;
            color: #7188a5;
            font-size: 11px;
        }

        @media (max-width: 850px) {
            .stats { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 550px) {
            .stats { grid-template-columns: 1fr 1fr; }
            .container { padding: 16px 10px; }
            .hero, .card { padding: 15px; }
            h1 { font-size: 22px; }
            .filters { flex-direction: column; }
            .filters input { width: 100%; }
        }
    </style>
</head>

<body>

<header class="header">
    <div class="header-title">Panel Peminjam</div>

    <nav>
        <a href="{{ url('/peminjam/katalog') }}">Katalog Alat</a>
    </nav>
</header>

<main class="container">

    @if (session('success'))
        <div class="notice success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="notice error">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="notice error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <section class="hero">
        <h1>Riwayat Peminjaman</h1>
        <p class="subtitle">
            Lihat status peminjaman dan ajukan pengembalian alat.
        </p>
    </section>

    @php
        $totalPeminjaman = $peminjaman->count();

        $totalSelesai = $peminjaman->filter(function ($item) {
            return in_array(strtolower($item->status ?? ''), [
                'selesai', 'dikembalikan'
            ]);
        })->count();

        $totalDipinjam = $peminjaman->filter(function ($item) {
            return in_array(strtolower($item->status ?? ''), [
                'dipinjam', 'terlambat'
            ]);
        })->count();

        $totalMenunggu = $peminjaman->filter(function ($item) {
            return $item->pengembalian
                && $item->pengembalian->status === 'menunggu_verifikasi';
        })->count();
    @endphp

    <section class="stats">
        <div class="stat">
            <div class="stat-label">Total Peminjaman</div>
            <div class="stat-number">{{ $totalPeminjaman }}</div>
        </div>

        <div class="stat">
            <div class="stat-label">Selesai</div>
            <div class="stat-number">{{ $totalSelesai }}</div>
        </div>

        <div class="stat">
            <div class="stat-label">Sedang Dipinjam</div>
            <div class="stat-number">{{ $totalDipinjam }}</div>
        </div>

        <div class="stat">
            <div class="stat-label">Menunggu Verifikasi</div>
            <div class="stat-number">{{ $totalMenunggu }}</div>
        </div>
    </section>

    <section class="card">

        <div class="filters">
            <input
                type="text"
                id="searchInput"
                placeholder="Cari alat, tanggal, atau status..."
            >

            <input type="date" id="dateFilter">
        </div>

        @if ($peminjaman->isEmpty())

            <div class="empty">
                <p>Belum ada riwayat peminjaman.</p>
                <a href="{{ url('/peminjam/katalog') }}">Lihat Katalog Alat</a>
            </div>

        @else

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Pinjam</th>
                            <th>Rencana Kembali</th>
                            <th>Alat</th>
                            <th>Status Peminjaman</th>
                            <th>Pengembalian</th>
                        </tr>
                    </thead>

                    <tbody id="historyTableBody">

                    @foreach ($peminjaman as $item)

                        @php
                            $status = strtolower($item->status ?? '');
                            $pengembalian = $item->pengembalian;

                            $namaAlat = $item->detailPinjam
                                ->map(function ($detail) {
                                    return $detail->alat->nama_alat
                                        ?? 'Alat tidak ditemukan';
                                })
                                ->implode(' ');

                            $tanggalPinjam = $item->tgl_pinjam
                                ? \Illuminate\Support\Carbon::parse(
                                    $item->tgl_pinjam
                                )->format('d-m-Y')
                                : '-';

                            $tanggalRencana = $item->tgl_kembali_plan
                                ? \Illuminate\Support\Carbon::parse(
                                    $item->tgl_kembali_plan
                                )->format('d-m-Y')
                                : '-';

                            $tanggalFilter = $item->created_at
                                ? $item->created_at->format('Y-m-d')
                                : '';

                            $searchText = strtolower(
                                $item->id . ' ' .
                                $status . ' ' .
                                $tanggalPinjam . ' ' .
                                $tanggalRencana . ' ' .
                                $namaAlat
                            );
                        @endphp

                        <tr
                            class="history-row"
                            data-search="{{ $searchText }}"
                            data-date="{{ $tanggalFilter }}"
                        >
                            <td>#{{ $item->id }}</td>

                            <td>{{ $tanggalPinjam }}</td>

                            <td>{{ $tanggalRencana }}</td>

                            <td>
                                @forelse ($item->detailPinjam as $detail)
                                    <div class="alat-item">
                                        <strong>
                                            {{ $detail->alat->nama_alat
                                                ?? 'Alat tidak ditemukan' }}
                                        </strong>
                                        <br>
                                        <span style="color:#7188a5">
                                            {{ $detail->jumlah }} unit
                                        </span>
                                    </div>
                                @empty
                                    -
                                @endforelse
                            </td>

                            <td>
                                @if ($status === 'dipinjam')
                                    <span class="status blue">Dipinjam</span>
                                @elseif ($status === 'diajukan')
                                    <span class="status orange">Diajukan</span>
                                @elseif ($status === 'terlambat')
                                    <span class="status red">Terlambat</span>
                                @elseif (in_array($status, ['selesai', 'dikembalikan']))
                                    <span class="status green">Selesai</span>
                                @else
                                    <span class="status gray">
                                        {{ ucfirst($status ?: '-') }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if ($pengembalian)
                                    @if ($pengembalian->status === 'menunggu_verifikasi')
                                        <span class="status orange">
                                            Menunggu Verifikasi
                                        </span>
                                        <p style="color:#7188a5">
                                            Kondisi:
                                            {{ ucfirst($pengembalian->kondisi_kembali) }}
                                        </p>
                                    @elseif ($pengembalian->status === 'diterima')
                                        <span class="status green">
                                            Pengembalian Diterima
                                        </span>
                                    @elseif ($pengembalian->status === 'ditolak')
                                        <span class="status red">
                                            Pengembalian Ditolak
                                        </span>
                                    @else
                                        <span class="status gray">
                                            {{ ucfirst(str_replace(
                                                '_', ' ', $pengembalian->status
                                            )) }}
                                        </span>
                                    @endif

                                @elseif (in_array($status, ['dipinjam', 'terlambat']))

                                    <form
                                        class="return-form"
                                        action="{{ route(
                                            'peminjam.pengembalian.ajukan',
                                            $item->id
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Yakin ingin mengajukan pengembalian alat ini?'
                                        )"
                                    >
                                        @csrf

                                        <select
                                            name="kondisi_kembali"
                                            required
                                        >
                                            <option value="">
                                                Pilih kondisi
                                            </option>
                                            <option value="baik">Baik</option>
                                            <option value="rusak">Rusak</option>
                                        </select>

                                        <button class="btn" type="submit">
                                            Kembalikan Alat
                                        </button>
                                    </form>

                                @else
                                    <span class="status gray">
                                        Belum bisa dikembalikan
                                    </span>
                                @endif
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>

            <div id="noSearch" class="empty" style="display:none">
                Tidak ada riwayat yang sesuai dengan pencarian.
            </div>

        @endif

        <div class="footer">
            Sistem Peminjaman Alat â€” Riwayat peminjaman akun Anda.
        </div>

    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const dateFilter = document.getElementById('dateFilter');
    const rows = document.querySelectorAll('.history-row');
    const noSearch = document.getElementById('noSearch');

    function filterHistory() {
        const keyword = searchInput.value.toLowerCase().trim();
        const selectedDate = dateFilter.value;
        let found = 0;

        rows.forEach(function (row) {
            const text = (row.dataset.search || '').toLowerCase();
            const date = row.dataset.date || '';

            const matchesKeyword =
                keyword === '' || text.includes(keyword);

            const matchesDate =
                selectedDate === '' || date === selectedDate;

            if (matchesKeyword && matchesDate) {
                row.style.display = '';
                found++;
            } else {
                row.style.display = 'none';
            }
        });

        if (noSearch) {
            noSearch.style.display =
                rows.length > 0 && found === 0 ? 'block' : 'none';
        }
    }

    searchInput.addEventListener('input', filterHistory);
    dateFilter.addEventListener('change', filterHistory);
});
</script>

</body>
</html>
