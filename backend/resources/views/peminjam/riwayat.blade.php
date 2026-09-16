<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Peminjaman</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #eef6ff;
            color: #173b68;
        }

        /* =====================================================
           HEADER
        ===================================================== */

        .header {
            height: 70px;
            background: linear-gradient(90deg, #0878d1, #2398ed);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5%;
            box-shadow: 0 3px 12px rgba(0, 91, 170, .18);
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 21px;
            font-weight: 700;
        }

        .header-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: white;
            color: #1683d8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .header-menu {
            display: flex;
            align-items: center;
        }

        .header-menu a {
            text-decoration: none;
            color: white;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .35);
            padding: 9px 15px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 600;
            transition: .2s;
        }

        .header-menu a:hover {
            background: white;
            color: #1683d8;
        }


        /* =====================================================
           CONTAINER
        ===================================================== */

        .container {
            max-width: 1320px;
            margin: auto;
            padding: 28px 30px 35px;
        }


        /* =====================================================
           HERO / TITLE
        ===================================================== */

        .hero {
            background: white;
            border-radius: 18px;
            padding: 24px 28px;
            margin-bottom: 18px;
            border: 1px solid #dcecff;
            box-shadow: 0 5px 20px rgba(35, 100, 160, .07);
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
            position: relative;
        }

        .hero-left {
            display: flex;
            align-items: center;
            gap: 18px;
            position: relative;
            z-index: 2;
        }

        .history-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #e2f1ff;
            color: #1683d8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 31px;
        }

        .page-title {
            margin: 0;
            font-size: 29px;
            font-weight: 700;
            color: #173f70;
        }

        .page-subtitle {
            margin: 7px 0 0;
            color: #7188a5;
            font-size: 13px;
        }

        .hero-decoration {
            font-size: 72px;
            opacity: .13;
            position: absolute;
            right: 30px;
            top: 5px;
        }


        /* =====================================================
           STATISTIC CARDS
        ===================================================== */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 18px;
        }

        .stat-card {
            min-height: 92px;
            border-radius: 14px;
            padding: 15px 18px;
            display: flex;
            align-items: center;
            gap: 13px;
            border: 1px solid transparent;
        }

        .stat-blue {
            background: linear-gradient(135deg, #e8f4ff, #f5faff);
            border-color: #d6ebff;
        }

        .stat-green {
            background: linear-gradient(135deg, #e8fbf4, #f6fffb);
            border-color: #d5f4e7;
        }

        .stat-orange {
            background: linear-gradient(135deg, #fff4e3, #fffaf2);
            border-color: #ffebcb;
        }

        .stat-red {
            background: linear-gradient(135deg, #fff0f0, #fff8f8);
            border-color: #ffe0e0;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 21px;
            font-weight: bold;
        }

        .icon-blue {
            background: #168be4;
        }

        .icon-green {
            background: #16b878;
        }

        .icon-orange {
            background: #f3a11d;
        }

        .icon-red {
            background: #e65050;
        }

        .stat-label {
            font-size: 11px;
            color: #7188a5;
            margin-bottom: 4px;
        }

        .stat-number {
            font-size: 23px;
            font-weight: 700;
            color: #173f70;
        }

        .stat-number span {
            font-size: 11px;
            font-weight: 500;
            color: #8294aa;
            margin-left: 3px;
        }


        /* =====================================================
           MAIN CARD
        ===================================================== */

        .card {
            background: white;
            border: 1px solid #dcecff;
            border-radius: 17px;
            padding: 14px;
            box-shadow: 0 5px 20px rgba(35, 100, 160, .07);
        }


        /* =====================================================
           SEARCH
        ===================================================== */

        .filter-area {
            display: flex;
            gap: 10px;
            padding: 4px 0 13px;
        }

        .search-wrapper {
            flex: 1;
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #7891ae;
            font-size: 16px;
        }

        .search-input,
        .date-filter {
            width: 100%;
            height: 42px;
            border: 1px solid #d8e7f5;
            border-radius: 9px;
            background: white;
            outline: none;
            color: #315578;
            font-size: 12px;
        }

        .search-input {
            padding: 0 15px 0 40px;
        }

        .date-filter {
            width: 190px;
            padding: 0 12px;
        }

        .search-input:focus,
        .date-filter:focus {
            border-color: #2493e8;
            box-shadow: 0 0 0 3px rgba(36, 147, 232, .09);
        }


        /* =====================================================
           TABLE
        ===================================================== */

        .table-wrapper {
            overflow-x: auto;
            border: 1px solid #dcecff;
            border-radius: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        thead {
            background: linear-gradient(90deg, #eaf5ff, #f3f9ff);
        }

        th {
            padding: 13px 14px;
            text-align: left;
            font-size: 11px;
            color: #275b8f;
            font-weight: 700;
            border-bottom: 1px solid #d8e8f7;
            white-space: nowrap;
        }

        td {
            padding: 12px 14px;
            border-bottom: 1px solid #edf3f8;
            font-size: 12px;
            color: #385b7f;
            vertical-align: middle;
        }

        tbody tr {
            transition: .15s;
        }

        tbody tr:hover {
            background: #f8fcff;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }


        /* =====================================================
           ID
        ===================================================== */

        .id-number {
            font-weight: 700;
            color: #214b79;
        }


        /* =====================================================
           DATE
        ===================================================== */

        .date-main {
            color: #315a86;
            font-weight: 600;
        }


        /* =====================================================
           ALAT
        ===================================================== */

        .alat-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .alat-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alat-photo {
            width: 46px;
            height: 42px;
            object-fit: contain;
            border-radius: 7px;
            background: #f3f8fc;
            border: 1px solid #e0ebf4;
        }

        .alat-info {
            display: flex;
            flex-direction: column;
        }

        .alat-name {
            color: #1d4d80;
            font-weight: 600;
            font-size: 12px;
        }

        .alat-quantity {
            color: #8095ac;
            font-size: 10px;
            margin-top: 3px;
        }

        .alat-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #168be4;
            display: inline-block;
            margin-right: 5px;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-dipinjam {
            background: #e3f1ff;
            color: #1683d8;
        }

        .status-diajukan {
            background: #e5f8ff;
            color: #0789c8;
        }

        .status-dikembalikan,
        .status-selesai {
            background: #ddf8ed;
            color: #10a86e;
        }

        .status-terlambat {
            background: #ffe7e7;
            color: #df4141;
        }

        .status-lain {
            background: #f0f3f6;
            color: #687b8f;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty {
            text-align: center;
            padding: 55px 20px;
            color: #7c91a8;
            font-size: 13px;
        }

        .empty-icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 13px;
            border-radius: 50%;
            background: #edf6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }


        /* =====================================================
           BOTTOM INFO
        ===================================================== */

        .bottom-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 4px 2px;
            color: #7990a8;
            font-size: 10px;
        }

        .info-text {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .info-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #e4f2ff;
            color: #1683d8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }


        /* =====================================================
           NO SEARCH RESULT
        ===================================================== */

        .no-search {
            display: none;
            text-align: center;
            padding: 35px;
            color: #7890a8;
            font-size: 12px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero {
                padding: 20px;
            }

            .container {
                padding: 20px 15px;
            }
        }

        @media (max-width: 600px) {

            .header {
                padding: 0 15px;
            }

            .header-title {
                font-size: 17px;
            }

            .header-icon {
                width: 32px;
                height: 32px;
                font-size: 17px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 23px;
            }

            .page-subtitle {
                font-size: 11px;
            }

            .hero-decoration {
                display: none;
            }

            .filter-area {
                flex-direction: column;
            }

            .date-filter {
                width: 100%;
            }

            .bottom-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }
    </style>
</head>


<body>


    <!-- =====================================================
         HEADER
    ===================================================== -->

    <div class="header">

        <div class="header-title">

            <div class="header-icon">
                💼
            </div>

            Panel Peminjam

        </div>


        <div class="header-menu">

            <a href="{{ url('/peminjam/katalog') }}">
                ▦ &nbsp; Katalog Alat
            </a>

        </div>

    </div>


    <!-- =====================================================
         CONTENT
    ===================================================== -->

    <div class="container">


        <!-- =================================================
             HERO
        ================================================= -->

        <div class="hero">

            <div class="hero-left">

                <div class="history-icon">
                    ↻
                </div>

                <div>

                    <h1 class="page-title">
                        Riwayat Peminjaman
                    </h1>

                    <p class="page-subtitle">
                        Berikut adalah daftar riwayat peminjaman alat Anda.
                    </p>

                </div>

            </div>

            <div class="hero-decoration">
                📋
            </div>

        </div>


        <!-- =================================================
             HITUNG STATUS
        ================================================= -->

        @php

            $totalPeminjaman = $peminjaman->count();

            $totalSelesai = $peminjaman->filter(function ($item) {
                return in_array(strtolower($item->status ?? ''), [
                    'selesai',
                    'dikembalikan'
                ]);
            })->count();

            $totalDipinjam = $peminjaman->filter(function ($item) {
                return strtolower($item->status ?? '') === 'dipinjam';
            })->count();

            $totalTerlambat = $peminjaman->filter(function ($item) {
                return strtolower($item->status ?? '') === 'terlambat';
            })->count();

        @endphp


        <!-- =================================================
             STATISTIK
        ================================================= -->

        <div class="stats">


            <!-- TOTAL -->

            <div class="stat-card stat-blue">

                <div class="stat-icon icon-blue">
                    ▣
                </div>

                <div>

                    <div class="stat-label">
                        Total Peminjaman
                    </div>

                    <div class="stat-number">
                        {{ $totalPeminjaman }}
                        <span>kali</span>
                    </div>

                </div>

            </div>


            <!-- SELESAI -->

            <div class="stat-card stat-green">

                <div class="stat-icon icon-green">
                    ✓
                </div>

                <div>

                    <div class="stat-label">
                        Selesai
                    </div>

                    <div class="stat-number">
                        {{ $totalSelesai }}
                        <span>kali</span>
                    </div>

                </div>

            </div>


            <!-- DIPINJAM -->

            <div class="stat-card stat-orange">

                <div class="stat-icon icon-orange">
                    ◷
                </div>

                <div>

                    <div class="stat-label">
                        Dipinjam
                    </div>

                    <div class="stat-number">
                        {{ $totalDipinjam }}
                        <span>kali</span>
                    </div>

                </div>

            </div>


            <!-- TERLAMBAT -->

            <div class="stat-card stat-red">

                <div class="stat-icon icon-red">
                    !
                </div>

                <div>

                    <div class="stat-label">
                        Terlambat
                    </div>

                    <div class="stat-number">
                        {{ $totalTerlambat }}
                        <span>kali</span>
                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             TABLE CARD
        ================================================= -->

        <div class="card">


            <!-- =================================================
                 SEARCH & FILTER
            ================================================= -->

            <div class="filter-area">

                <div class="search-wrapper">

                    <span class="search-icon">
                        🔍
                    </span>

                    <input
                        type="text"
                        id="searchInput"
                        class="search-input"
                        placeholder="Cari nama alat, tanggal, atau status..."
                        autocomplete="off"
                    >

                </div>


                <input
                    type="date"
                    id="dateFilter"
                    class="date-filter"
                >

            </div>


            <!-- =================================================
                 TABLE
            ================================================= -->

            @if ($peminjaman->isEmpty())

                <div class="empty">

                    <div class="empty-icon">
                        📋
                    </div>

                    Belum ada riwayat peminjaman.

                </div>

            @else

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th width="65">
                                    #
                                </th>

                                <th width="140">
                                    📅 &nbsp; Tanggal
                                </th>

                                <th>
                                    🔧 &nbsp; Alat
                                </th>

                                <th width="150">
                                    ⚙ &nbsp; Status
                                </th>

                            </tr>

                        </thead>


                        <tbody id="historyTableBody">


                            @foreach ($peminjaman as $item)

                                <tr
                                    class="history-row"
                                    data-search="
                                        {{ strtolower(
                                            $item->id . ' ' .
                                            ($item->status ?? '') . ' ' .
                                            ($item->created_at?->format('d-m-Y') ?? '') . ' ' .
                                            $item->detailPinjam->map(function($detail) {
                                                return $detail->alat->nama_alat ?? '';
                                            })->implode(' ')
                                        ) }}
                                    "
                                    data-date="{{ $item->created_at?->format('Y-m-d') }}"
                                >


                                    <!-- ID -->

                                    <td>

                                        <span class="id-number">
                                            {{ $item->id }}
                                        </span>

                                    </td>


                                    <!-- TANGGAL -->

                                    <td>

                                        <div class="date-main">
                                            {{ $item->created_at?->format('d-m-Y') ?? '-' }}
                                        </div>

                                    </td>


                                    <!-- ALAT -->

                                    <td>

                                        <div class="alat-list">

                                            @forelse ($item->detailPinjam as $detail)

                                                @php
                                                    $namaAlat = $detail->alat->nama_alat ?? 'Alat tidak ditemukan';
                                                    $namaLower = strtolower($namaAlat);

                                                    if (str_contains($namaLower, 'router')) {
                                                        $foto = 'https://commons.wikimedia.org/wiki/Special:FilePath/Mikrotik%20Wireless%20Router%202.jpg';
                                                    } elseif (
                                                        str_contains($namaLower, 'kamera') ||
                                                        str_contains($namaLower, 'camera')
                                                    ) {
                                                        $foto = 'https://commons.wikimedia.org/wiki/Special:FilePath/Canon%20EOS%203000D%20CNE.jpg';
                                                    } elseif (
                                                        str_contains($namaLower, 'mini pc') ||
                                                        str_contains($namaLower, 'intel nuc') ||
                                                        str_contains($namaLower, 'nuc')
                                                    ) {
                                                        $foto = 'https://commons.wikimedia.org/wiki/Special:FilePath/Intel%20NUC%20Mini%20PC.jpg';
                                                    } elseif (
                                                        str_contains($namaLower, 'tang') ||
                                                        str_contains($namaLower, 'crimping') ||
                                                        str_contains($namaLower, 'crimp')
                                                    ) {
                                                        $foto = 'https://commons.wikimedia.org/wiki/Special:FilePath/CrimpZangeRJ.jpg';
                                                    } elseif (
                                                        str_contains($namaLower, 'adapter') ||
                                                        str_contains($namaLower, 'hdmi') ||
                                                        str_contains($namaLower, 'vga')
                                                    ) {
                                                        $foto = 'https://commons.wikimedia.org/wiki/Special:FilePath/HDMI%E8%BD%89VGA%E8%BD%89%E6%8E%A5%E9%A0%AD.jpg';
                                                    } else {
                                                        $foto = 'https://placehold.co/46x42/f3f8fc/7890a8?text=Alat';
                                                    }
                                                @endphp


                                                <div class="alat-item">

                                                    <img
                                                        src="{{ $foto }}"
                                                        class="alat-photo"
                                                        alt="{{ $namaAlat }}"
                                                        loading="lazy"
                                                        onerror="this.onerror=null;this.src='https://placehold.co/46x42/f3f8fc/7890a8?text=Alat';"
                                                    >


                                                    <div class="alat-info">

                                                        <div class="alat-name">
                                                            {{ $namaAlat }}
                                                        </div>

                                                        <div class="alat-quantity">

                                                            <span class="alat-dot"></span>

                                                            {{ $detail->jumlah ?? 0 }} unit

                                                        </div>

                                                    </div>

                                                </div>


                                            @empty

                                                -

                                            @endforelse

                                        </div>

                                    </td>


                                    <!-- STATUS -->

                                    <td>

                                        @php
                                            $status = strtolower($item->status ?? '');
                                        @endphp


                                        @if ($status == 'dipinjam')

                                            <span class="status status-dipinjam">
                                                Dipinjam
                                            </span>


                                        @elseif ($status == 'diajukan')

                                            <span class="status status-diajukan">
                                                Diajukan
                                            </span>


                                        @elseif (
                                            $status == 'dikembalikan' ||
                                            $status == 'selesai'
                                        )

                                            <span class="status status-selesai">
                                                Selesai
                                            </span>


                                        @elseif ($status == 'terlambat')

                                            <span class="status status-terlambat">
                                                Terlambat
                                            </span>


                                        @else

                                            <span class="status status-lain">
                                                {{ $item->status ?? '-' }}
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach


                        </tbody>

                    </table>


                    <!-- PESAN PENCARIAN -->

                    <div
                        class="no-search"
                        id="noSearch"
                    >
                        Tidak ada riwayat yang sesuai dengan pencarian.
                    </div>

                </div>


                <!-- =================================================
                     BOTTOM
                ================================================= -->

                <div class="bottom-info">

                    <div class="info-text">

                        <div class="info-icon">
                            i
                        </div>

                        Riwayat ini menunjukkan semua peminjaman alat yang pernah Anda ajukan.

                    </div>


                    <div>
                        Sistem Peminjaman Alat
                    </div>

                </div>

            @endif


        </div>

    </div>


    <!-- =====================================================
         JAVASCRIPT
    ===================================================== -->

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const searchInput =
                document.getElementById('searchInput');

            const dateFilter =
                document.getElementById('dateFilter');

            const rows =
                document.querySelectorAll('.history-row');

            const noSearch =
                document.getElementById('noSearch');


            function filterHistory() {

                const keyword =
                    searchInput.value
                        .toLowerCase()
                        .trim();

                const selectedDate =
                    dateFilter.value;

                let found = 0;


                rows.forEach(function (row) {

                    const searchData =
                        row.dataset.search
                            .toLowerCase();

                    const rowDate =
                        row.dataset.date;


                    const matchKeyword =
                        keyword === '' ||
                        searchData.includes(keyword);


                    const matchDate =
                        selectedDate === '' ||
                        rowDate === selectedDate;


                    if (
                        matchKeyword &&
                        matchDate
                    ) {

                        row.style.display = '';

                        found++;

                    } else {

                        row.style.display = 'none';

                    }

                });


                if (
                    found === 0 &&
                    rows.length > 0
                ) {

                    noSearch.style.display = 'block';

                } else {

                    noSearch.style.display = 'none';

                }

            }


            if (searchInput) {

                searchInput.addEventListener(
                    'input',
                    filterHistory
                );

            }


            if (dateFilter) {

                dateFilter.addEventListener(
                    'change',
                    filterHistory
                );

            }

        });

    </script>


</body>

</html>