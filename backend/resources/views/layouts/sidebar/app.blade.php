<!-- MENU KHUSUS PETUGAS & ADMIN -->
@if(in_array(auth()->user()->role, ['petugas', 'admin']))
    <a href="{{ route('petugas.peminjaman.index') }}"
       class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('petugas.peminjaman*') ? 'bg-gray-800 text-white font-medium shadow' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
        Persetujuan Peminjaman
    </a>

    <a href="{{ route('petugas.pengembalian.index') }}"
       class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('petugas.pengembalian*') ? 'bg-gray-800 text-white font-medium shadow' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
        Pemantauan Pengembalian
    </a>

    <a href="{{ route('petugas.laporan.index') }}"
       class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('petugas.laporan*') ? 'bg-gray-800 text-white font-medium shadow' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
        Cetak Laporan
    </a>
@endif