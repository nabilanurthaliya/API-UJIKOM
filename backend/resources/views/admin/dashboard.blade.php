@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('header-title', 'Dashboard Admin')

@section('content')

    <!-- SELAMAT DATANG -->
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-lg shadow-sm">
        Selamat datang,
        <strong>{{ auth()->user()->name }}</strong>!
        Anda login sebagai hak akses
        <strong>{{ strtoupper(auth()->user()->role) }}</strong>.
    </div>


    <!-- SEARCH FITUR -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">

        <div class="mb-3">
            <h2 class="text-lg font-bold text-gray-800">
                Cari Fitur
            </h2>

            <p class="text-sm text-gray-500">
                Cari menu atau fitur yang ingin Anda buka.
            </p>
        </div>

        <div class="relative">

            <input
                type="text"
                id="searchFitur"
                placeholder="Cari fitur... contoh: user, alat, peminjaman"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg
                       focus:outline-none focus:ring-2 focus:ring-blue-500
                       focus:border-blue-500"
                autocomplete="off"
            >

            <!-- HASIL SEARCH -->
            <div
                id="hasilSearch"
                class="hidden absolute z-50 left-0 right-0 mt-2
                       bg-white border border-gray-200 rounded-lg
                       shadow-lg overflow-hidden"
            >

                <!-- USER -->
                <a
                    href="{{ route('admin.user.index') }}"
                    data-search="user pengguna kelola user manajemen pengguna"
                    class="hasil-fitur hidden block px-4 py-3 hover:bg-gray-50 border-b border-gray-100"
                >
                    <div class="font-semibold text-gray-800">
                        Kelola User
                    </div>

                    <div class="text-xs text-gray-500">
                        Mengelola data pengguna sistem
                    </div>
                </a>


                <!-- KATEGORI -->
                <a
                    href="{{ route('admin.kategori.index') }}"
                    data-search="kategori kelola kategori"
                    class="hasil-fitur hidden block px-4 py-3 hover:bg-gray-50 border-b border-gray-100"
                >
                    <div class="font-semibold text-gray-800">
                        Kelola Kategori
                    </div>

                    <div class="text-xs text-gray-500">
                        Mengelola kategori alat
                    </div>
                </a>


                <!-- ALAT -->
                <a
                    href="{{ route('admin.alat.index') }}"
                    data-search="alat kelola alat barang peralatan"
                    class="hasil-fitur hidden block px-4 py-3 hover:bg-gray-50 border-b border-gray-100"
                >
                    <div class="font-semibold text-gray-800">
                        Kelola Alat
                    </div>

                    <div class="text-xs text-gray-500">
                        Mengelola data alat dan stok
                    </div>
                </a>


                <!-- PEMINJAMAN -->
                <a
                    href="{{ route('admin.peminjaman.index') }}"
                    data-search="peminjaman kelola peminjaman transaksi pinjam"
                    class="hasil-fitur hidden block px-4 py-3 hover:bg-gray-50 border-b border-gray-100"
                >
                    <div class="font-semibold text-gray-800">
                        Kelola Peminjaman
                    </div>

                    <div class="text-xs text-gray-500">
                        Mengelola transaksi peminjaman
                    </div>
                </a>


                <!-- PENGEMBALIAN -->
                <a
                    href="{{ route('admin.pengembalian.index') }}"
                    data-search="pengembalian kelola pengembalian kembali"
                    class="hasil-fitur hidden block px-4 py-3 hover:bg-gray-50 border-b border-gray-100"
                >
                    <div class="font-semibold text-gray-800">
                        Kelola Pengembalian
                    </div>

                    <div class="text-xs text-gray-500">
                        Mengelola transaksi pengembalian
                    </div>
                </a>


                <!-- LOG AKTIVITAS -->
                <a
                    href="{{ route('admin.logaktivitas.index') }}"
                    data-search="log aktivitas logaktivitas aktivitas riwayat"
                    class="hasil-fitur hidden block px-4 py-3 hover:bg-gray-50"
                >
                    <div class="font-semibold text-gray-800">
                        Log Aktivitas
                    </div>

                    <div class="text-xs text-gray-500">
                        Melihat riwayat aktivitas sistem
                    </div>
                </a>


                <!-- TIDAK DITEMUKAN -->
                <div
                    id="tidakDitemukan"
                    class="hidden px-4 py-4 text-center text-sm text-gray-500"
                >
                    Fitur tidak ditemukan.
                </div>

            </div>

        </div>

    </div>


    <!-- JUDUL DASHBOARD -->
    <div class="mb-5">

        <h2 class="text-2xl font-bold text-gray-800">
            Dashboard Admin
        </h2>

        <p class="text-gray-500 mt-1">
            Ringkasan jumlah data pada sistem peminjaman alat.
        </p>

    </div>


    <!-- TOTAL DATA -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">


        <!-- TOTAL USER -->
        <a
            href="{{ route('admin.user.index') }}"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-5
                   hover:shadow-md hover:border-blue-300 transition"
        >

            <p class="text-sm text-gray-500 font-medium">
                Total User
            </p>

            <p class="text-3xl font-bold text-gray-800 mt-2">
                {{ $totalUser }}
            </p>

            <p class="text-xs text-blue-600 mt-4">
                Lihat data pengguna →
            </p>

        </a>


        <!-- TOTAL KATEGORI -->
        <a
            href="{{ route('admin.kategori.index') }}"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-5
                   hover:shadow-md hover:border-purple-300 transition"
        >

            <p class="text-sm text-gray-500 font-medium">
                Total Kategori
            </p>

            <p class="text-3xl font-bold text-gray-800 mt-2">
                {{ $totalKategori }}
            </p>

            <p class="text-xs text-purple-600 mt-4">
                Lihat kategori alat →
            </p>

        </a>


        <!-- TOTAL ALAT -->
        <a
            href="{{ route('admin.alat.index') }}"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-5
                   hover:shadow-md hover:border-amber-300 transition"
        >

            <p class="text-sm text-gray-500 font-medium">
                Total Alat
            </p>

            <p class="text-3xl font-bold text-gray-800 mt-2">
                {{ $totalAlat }}
            </p>

            <p class="text-xs text-amber-600 mt-4">
                Lihat data alat →
            </p>

        </a>


        <!-- TOTAL PEMINJAMAN -->
        <a
            href="{{ route('admin.peminjaman.index') }}"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-5
                   hover:shadow-md hover:border-green-300 transition"
        >

            <p class="text-sm text-gray-500 font-medium">
                Total Peminjaman
            </p>

            <p class="text-3xl font-bold text-gray-800 mt-2">
                {{ $totalPeminjaman }}
            </p>

            <p class="text-xs text-green-600 mt-4">
                Lihat data peminjaman →
            </p>

        </a>


        <!-- TOTAL PENGEMBALIAN -->
        <a
            href="{{ route('admin.pengembalian.index') }}"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-5
                   hover:shadow-md hover:border-cyan-300 transition"
        >

            <p class="text-sm text-gray-500 font-medium">
                Total Pengembalian
            </p>

            <p class="text-3xl font-bold text-gray-800 mt-2">
                {{ $totalPengembalian }}
            </p>

            <p class="text-xs text-cyan-600 mt-4">
                Lihat data pengembalian →
            </p>

        </a>


        <!-- TOTAL LOG AKTIVITAS -->
        <a
            href="{{ route('admin.logaktivitas.index') }}"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-5
                   hover:shadow-md hover:border-red-300 transition"
        >

            <p class="text-sm text-gray-500 font-medium">
                Total Log Aktivitas
            </p>

            <p class="text-3xl font-bold text-gray-800 mt-2">
                {{ $totalLogAktivitas }}
            </p>

            <p class="text-xs text-red-600 mt-4">
                Lihat log aktivitas →
            </p>

        </a>

    </div>


    <!-- JAVASCRIPT SEARCH -->
    <script>

        const searchInput = document.getElementById('searchFitur');
        const hasilSearch = document.getElementById('hasilSearch');
        const hasilFitur = document.querySelectorAll('.hasil-fitur');
        const tidakDitemukan = document.getElementById('tidakDitemukan');


        searchInput.addEventListener('input', function () {

            const keyword = this.value.toLowerCase().trim();


            // Jika search kosong
            if (keyword === '') {

                hasilSearch.classList.add('hidden');

                hasilFitur.forEach(function (item) {
                    item.classList.add('hidden');
                });

                tidakDitemukan.classList.add('hidden');

                return;
            }


            hasilSearch.classList.remove('hidden');

            let ditemukan = false;


            hasilFitur.forEach(function (item) {

                const dataSearch = item
                    .getAttribute('data-search')
                    .toLowerCase();


                if (dataSearch.includes(keyword)) {

                    item.classList.remove('hidden');

                    ditemukan = true;

                } else {

                    item.classList.add('hidden');

                }

            });


            if (ditemukan) {

                tidakDitemukan.classList.add('hidden');

            } else {

                tidakDitemukan.classList.remove('hidden');

            }

        });


        // Klik di luar search
        document.addEventListener('click', function (event) {

            if (
                !searchInput.contains(event.target) &&
                !hasilSearch.contains(event.target)
            ) {

                hasilSearch.classList.add('hidden');

            }

        });


        // Klik kembali pada search
        searchInput.addEventListener('focus', function () {

            if (this.value.trim() !== '') {

                hasilSearch.classList.remove('hidden');

            }

        });

    </script>

@endsection