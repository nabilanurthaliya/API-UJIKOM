<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Katalog Alat - Peminjam</title>

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
            gap: 8px;
        }

        /* =====================================================
           NAMA USER YANG LOGIN
        ===================================================== */

        .logged-user {
            display: flex;
            align-items: center;
            color: white;
            font-size: 12px;
            font-weight: 500;
            padding: 9px 10px;
            white-space: nowrap;
        }

        .logged-user strong {
            margin-left: 4px;
            font-weight: 700;
        }

        .header-menu a,
        .logout-button {
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

        .logout-button {
            cursor: pointer;
        }

        .logout-button:hover {
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
           HERO
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

        .catalog-icon {
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
           STATISTIK
        ===================================================== */

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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
           CARD
        ===================================================== */

        .card {
            background: white;
            border: 1px solid #dcecff;
            border-radius: 17px;
            padding: 14px;
            box-shadow: 0 5px 20px rgba(35, 100, 160, .07);
        }

        /* =====================================================
           FORM
        ===================================================== */

        .filter-area {
            display: grid;
            grid-template-columns: 1fr 230px;
            gap: 10px;
            padding: 4px 0 13px;
        }

        .field-label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            color: #56728f;
            margin-bottom: 6px;
        }

        .search-wrapper {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-15%);
            color: #7891ae;
            font-size: 16px;
        }

        .search-input,
        .date-input {
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

        .date-input {
            padding: 0 12px;
        }

        .search-input:focus,
        .date-input:focus {
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
            min-width: 900px;
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
           CHECKBOX
        ===================================================== */

        .alat-checkbox {
            width: 17px;
            height: 17px;
            cursor: pointer;
            accent-color: #168be4;
        }

        /* =====================================================
           NOMOR
        ===================================================== */

        .number-badge {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: #edf6ff;
            color: #2772aa;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
        }

        /* =====================================================
           FOTO ALAT
        ===================================================== */

        .alat-photo {
            width: 58px;
            height: 52px;
            object-fit: contain;
            border-radius: 8px;
            background: #f3f8fc;
            border: 1px solid #e0ebf4;
            display: block;
        }

        .alat-info {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .alat-name {
            color: #1d4d80;
            font-weight: 600;
            font-size: 12px;
        }

        .alat-category {
            color: #8095ac;
            font-size: 10px;
        }

        /* =====================================================
           STOK
        ===================================================== */

        .stock-box {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .stock-number {
            font-weight: 700;
            color: #214b79;
        }

        .stock-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 700;
            background: #ddf8ed;
            color: #10a86e;
            white-space: nowrap;
        }

        .stock-status::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .stock-empty {
            background: #ffe7e7;
            color: #df4141;
        }

        /* =====================================================
           JUMLAH
        ===================================================== */

        .quantity-control {
            display: inline-flex;
            align-items: center;
            border: 1px solid #dce6ef;
            border-radius: 8px;
            overflow: hidden;
            height: 34px;
            background: white;
        }

        .quantity-btn {
            width: 31px;
            height: 32px;
            border: none;
            background: #f5f9fd;
            color: #3e6284;
            cursor: pointer;
            font-size: 17px;
            font-weight: 700;
        }

        .quantity-btn:hover {
            background: #e7f3ff;
            color: #1683d8;
        }

        .quantity-input {
            width: 42px;
            height: 32px;
            border: none;
            border-left: 1px solid #e1e8ee;
            border-right: 1px solid #e1e8ee;
            text-align: center;
            font-size: 11px;
            color: #315578;
            outline: none;
        }

        /* =====================================================
           BOTTOM
        ===================================================== */

        .bottom-area {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 4px 2px;
        }

        .info-text {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #7990a8;
            font-size: 10px;
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

        .submit-button {
            border: none;
            background: linear-gradient(90deg, #0878d1, #2398ed);
            color: white;
            padding: 10px 18px;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
            box-shadow: 0 4px 10px rgba(22, 131, 216, .18);
        }

        .submit-button:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(22, 131, 216, .25);
        }

        .submit-button:disabled {
            background: #b9d4eb;
            cursor: not-allowed;
            box-shadow: none;
        }

        /* =====================================================
           EMPTY / SEARCH
        ===================================================== */

        .empty,
        .no-search {
            text-align: center;
            padding: 45px 20px;
            color: #7c91a8;
            font-size: 12px;
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

        .no-search {
            display: none;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .container {
                padding: 20px 15px;
            }

            .hero {
                padding: 20px;
            }

            .filter-area {
                grid-template-columns: 1fr;
            }

            .bottom-area {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .submit-button {
                width: 100%;
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

            .header-menu a,
            .logout-button {
                font-size: 9px;
                padding: 7px 9px;
            }

            .logged-user {
                font-size: 9px;
                padding: 7px 4px;
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

            .hero-left {
                gap: 12px;
            }

            .catalog-icon {
                width: 52px;
                height: 52px;
                font-size: 25px;
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

            <!-- =================================================
                 USER YANG SEDANG LOGIN
            ================================================= -->

            <div class="logged-user">
                👤 &nbsp; Logged in as :
                <strong>
                    {{ Auth::user()->name ?? Auth::user()->nama ?? 'Peminjam' }}
                </strong>
            </div>

            <!-- =================================================
                 RIWAYAT PINJAM
            ================================================= -->

            <a href="{{ route('peminjam.riwayat') }}">
                ↻ &nbsp; Riwayat Pinjam
            </a>

            <!-- =================================================
                 LOGOUT
            ================================================= -->

            <form
                action="{{ route('logout') }}"
                method="POST"
                style="margin:0;"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
                    ⇥ &nbsp; Logout
                </button>

            </form>

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

                <div class="catalog-icon">
                    🧰
                </div>

                <div>

                    <h1 class="page-title">
                        Katalog Alat Tersedia
                    </h1>

                    <p class="page-subtitle">
                        Pilih alat yang ingin Anda pinjam, tentukan jumlah dan tanggal pengembalian.
                    </p>

                </div>

            </div>

            <div class="hero-decoration">
                🔧
            </div>

        </div>


        <!-- =================================================
             STATISTIK
        ================================================= -->

        @php

            $totalAlat = $alats->count();

            $totalStok = $alats->sum(function ($alat) {
                return (int) $alat->stok;
            });

            $alatTersedia = $alats->filter(function ($alat) {
                return $alat->stok > 0;
            })->count();

        @endphp


        <div class="stats">


            <!-- TOTAL ALAT -->

            <div class="stat-card stat-blue">

                <div class="stat-icon icon-blue">
                    ▣
                </div>

                <div>

                    <div class="stat-label">
                        Total Jenis Alat
                    </div>

                    <div class="stat-number">
                        {{ $totalAlat }}
                        <span>jenis</span>
                    </div>

                </div>

            </div>


            <!-- TERSEDIA -->

            <div class="stat-card stat-green">

                <div class="stat-icon icon-green">
                    ✓
                </div>

                <div>

                    <div class="stat-label">
                        Alat Tersedia
                    </div>

                    <div class="stat-number">
                        {{ $alatTersedia }}
                        <span>jenis</span>
                    </div>

                </div>

            </div>


            <!-- TOTAL STOK -->

            <div class="stat-card stat-orange">

                <div class="stat-icon icon-orange">
                    📦
                </div>

                <div>

                    <div class="stat-label">
                        Total Stok
                    </div>

                    <div class="stat-number">
                        {{ $totalStok }}
                        <span>unit</span>
                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             FORM PEMINJAMAN
        ================================================= -->

        <form
            action="{{ route('peminjam.peminjaman.ajukan') }}"
            method="POST"
            id="peminjamanForm"
        >

            @csrf


            <div class="card">


                <!-- =================================================
                     FILTER
                ================================================= -->

                <div class="filter-area">


                    <div>

                        <label class="field-label">
                            🔍 &nbsp; Cari Alat
                        </label>

                        <div class="search-wrapper">

                            <span class="search-icon">
                                🔍
                            </span>

                            <input
                                type="search"
                                id="searchInput"
                                class="search-input"
                                placeholder="Cari nama alat atau kategori..."
                                autocomplete="off"
                            >

                        </div>

                    </div>


                    <div>

                        <label class="field-label">
                            📅 &nbsp; Rencana Tanggal Kembali
                        </label>

                        <input
                            type="date"
                            name="tgl_kembali_plan"
                            id="returnDate"
                            class="date-input"
                            required
                        >

                    </div>

                </div>


                <!-- =================================================
                     TABLE
                ================================================= -->

                @if ($alats->isEmpty())

                    <div class="empty">

                        <div class="empty-icon">
                            🧰
                        </div>

                        Tidak ada alat yang tersedia saat ini.

                    </div>

                @else

                    <div class="table-wrapper">

                        <table>

                            <thead>

                                <tr>

                                    <th
                                        width="55"
                                        style="text-align:center;"
                                    >
                                        ✓
                                    </th>

                                    <th
                                        width="60"
                                        style="text-align:center;"
                                    >
                                        #
                                    </th>

                                    <th width="90">
                                        🔧 Alat
                                    </th>

                                    <th>
                                        Nama Alat
                                    </th>

                                    <th width="150">
                                        🔷 Kategori
                                    </th>

                                    <th width="180">
                                        📦 Stok
                                    </th>

                                    <th width="160">
                                        🔢 Jumlah Pinjam
                                    </th>

                                </tr>

                            </thead>


                            <tbody id="alatTableBody">


                                @foreach ($alats as $index => $alat)

                                    <tr
                                        class="alat-row"
                                        data-name="{{ strtolower($alat->nama_alat) }}"
                                        data-category="{{ strtolower($alat->kategori->nama_kategori ?? '') }}"
                                    >


                                        <!-- CHECKBOX -->

                                        <td style="text-align:center;">

                                            <input
                                                type="checkbox"
                                                name="alat_id[]"
                                                value="{{ $alat->id }}"
                                                class="alat-checkbox"
                                                @disabled($alat->stok <= 0)
                                            >

                                        </td>


                                        <!-- NOMOR -->

                                        <td style="text-align:center;">

                                            <span class="number-badge">
                                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                            </span>

                                        </td>


                                        <!-- FOTO -->

                                        <td>

                                            @php

                                                $namaLower = strtolower($alat->nama_alat);

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

                                                    $foto = 'https://placehold.co/58x52/f3f8fc/7890a8?text=Alat';

                                                }

                                            @endphp


                                            <img
                                                src="{{ $foto }}"
                                                class="alat-photo"
                                                alt="{{ $alat->nama_alat }}"
                                                loading="lazy"
                                                onerror="this.onerror=null;this.src='https://placehold.co/58x52/f3f8fc/7890a8?text=Alat';"
                                            >

                                        </td>


                                        <!-- NAMA -->

                                        <td>

                                            <div class="alat-info">

                                                <div class="alat-name">
                                                    {{ $alat->nama_alat }}
                                                </div>

                                                <div class="alat-category">
                                                    {{ $alat->kategori->nama_kategori ?? 'Tanpa kategori' }}
                                                </div>

                                            </div>

                                        </td>


                                        <!-- KATEGORI -->

                                        <td>

                                            <span class="stock-status"
                                                style="background:#e5f2ff;color:#1683d8;">

                                                {{ $alat->kategori->nama_kategori ?? '-' }}

                                            </span>

                                        </td>


                                        <!-- STOK -->

                                        <td>

                                            <div class="stock-box">

                                                <span class="stock-number">
                                                    {{ $alat->stok }}
                                                </span>

                                                @if ($alat->stok > 0)

                                                    <span class="stock-status">
                                                        Tersedia
                                                    </span>

                                                @else

                                                    <span class="stock-status stock-empty">
                                                        Stok Habis
                                                    </span>

                                                @endif

                                            </div>

                                        </td>


                                        <!-- JUMLAH -->

                                        <td>

                                            <div class="quantity-control">


                                                <button
                                                    type="button"
                                                    class="quantity-btn minus-btn"
                                                    data-target="jumlah-{{ $alat->id }}"
                                                >
                                                    −
                                                </button>


                                                <input
                                                    type="number"
                                                    name="jumlah[]"
                                                    id="jumlah-{{ $alat->id }}"
                                                    class="quantity-input jumlah-input"
                                                    value="1"
                                                    min="1"
                                                    max="{{ max((int)$alat->stok, 1) }}"
                                                    data-stock="{{ $alat->stok }}"
                                                    disabled
                                                >


                                                <button
                                                    type="button"
                                                    class="quantity-btn plus-btn"
                                                    data-target="jumlah-{{ $alat->id }}"
                                                >
                                                    +
                                                </button>


                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>


                        <!-- TIDAK ADA HASIL -->

                        <div
                            class="no-search"
                            id="noSearch"
                        >
                            Tidak ada alat yang sesuai dengan pencarian.
                        </div>

                    </div>


                    <!-- =================================================
                         BOTTOM
                    ================================================= -->

                    <div class="bottom-area">

                        <div class="info-text">

                            <div class="info-icon">
                                i
                            </div>

                            Pilih alat, tentukan jumlah dan tanggal kembali.

                        </div>


                        <button
                            type="submit"
                            class="submit-button"
                            id="submitButton"
                            disabled
                        >
                            ✈ &nbsp; Ajukan Peminjaman &nbsp; ❯
                        </button>

                    </div>

                @endif


            </div>

        </form>

    </div>


    <!-- =====================================================
         JAVASCRIPT
    ===================================================== -->

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const searchInput =
                document.getElementById('searchInput');

            const rows =
                document.querySelectorAll('.alat-row');

            const checkboxes =
                document.querySelectorAll('.alat-checkbox');

            const totalSelected =
                document.getElementById('submitButton');

            const submitButton =
                document.getElementById('submitButton');

            const returnDate =
                document.getElementById('returnDate');

            const noSearch =
                document.getElementById('noSearch');


            /* =================================================
               TANGGAL MINIMAL HARI INI
            ================================================= */

            if (returnDate) {

                const today = new Date();

                const year =
                    today.getFullYear();

                const month =
                    String(today.getMonth() + 1).padStart(2, '0');

                const day =
                    String(today.getDate()).padStart(2, '0');

                returnDate.min =
                    `${year}-${month}-${day}`;

            }


            /* =================================================
               CHECKBOX
            ================================================= */

            checkboxes.forEach(function (checkbox) {

                checkbox.addEventListener('change', function () {

                    const row =
                        checkbox.closest('.alat-row');

                    const quantityInput =
                        row.querySelector('.jumlah-input');


                    if (checkbox.checked) {

                        quantityInput.disabled = false;

                    } else {

                        quantityInput.disabled = true;

                        quantityInput.value = 1;

                    }


                    updateButton();

                });

            });


            /* =================================================
               UPDATE BUTTON
            ================================================= */

            function updateButton() {

                let selected = 0;

                checkboxes.forEach(function (checkbox) {

                    if (checkbox.checked) {
                        selected++;
                    }

                });

                submitButton.disabled =
                    selected === 0;

            }


            /* =================================================
               MINUS
            ================================================= */

            document.querySelectorAll('.minus-btn')
                .forEach(function (button) {

                    button.addEventListener('click', function () {

                        const input =
                            document.getElementById(
                                button.dataset.target
                            );

                        if (!input || input.disabled) {
                            return;
                        }

                        let value =
                            parseInt(input.value) || 1;

                        if (value > 1) {
                            input.value = value - 1;
                        }

                    });

                });


            /* =================================================
               PLUS
            ================================================= */

            document.querySelectorAll('.plus-btn')
                .forEach(function (button) {

                    button.addEventListener('click', function () {

                        const input =
                            document.getElementById(
                                button.dataset.target
                            );

                        if (!input || input.disabled) {
                            return;
                        }

                        let value =
                            parseInt(input.value) || 1;

                        let max =
                            parseInt(input.dataset.stock) || 1;

                        if (value < max) {
                            input.value = value + 1;
                        }

                    });

                });


            /* =================================================
               SEARCH
            ================================================= */

            function searchAlat() {

                const keyword =
                    searchInput.value
                        .toLowerCase()
                        .trim();

                let found = 0;


                rows.forEach(function (row) {

                    const nama =
                        row.dataset.name || '';

                    const kategori =
                        row.dataset.category || '';


                    if (
                        nama.includes(keyword) ||
                        kategori.includes(keyword)
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

                    noSearch.style.display =
                        'block';

                } else {

                    noSearch.style.display =
                        'none';

                }

            }


            if (searchInput) {
                searchInput.addEventListener(
                    'input',
                    searchAlat
                );
            }


            /* =================================================
               SUBMIT
            ================================================= */

            const form =
                document.getElementById('peminjamanForm');

            if (form) {
                form.addEventListener('submit', function (event) {
                    let selected = 0;

                    checkboxes.forEach(function (checkbox) {
                        if (checkbox.checked) {
                            selected++;
                        }
                    });


                    if (selected === 0) {
                        event.preventDefault();
                        alert(
                            'Silakan pilih minimal satu alat.'
                        );
                        return;
                    }


                    if (!returnDate.value) {
                        event.preventDefault();
                        alert(
                            'Silakan tentukan tanggal kembali.'
                        );
                        return;

                    }
                });
            }

            updateButton();
        });
    </script>
</body>
</html>