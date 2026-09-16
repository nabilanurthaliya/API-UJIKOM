@extends('layouts.app')

@section('title', 'Kelola Pengembalian - Panel Admin')
@section('header-title', 'Manajemen Transaksi Pengembalian')


@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    {{-- Alert Notification --}}
    @if(session('success'))
        <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm font-medium shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm font-medium shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- Main Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        {{-- Header & Search Bar --}}
        <div class="p-5 flex flex-col md:flex-row justify-between items-center gap-4 border-b border-gray-100">
            <h3 class="text-base font-bold text-gray-800">Riwayat Pengembalian Alat</h3>

            <div class="flex items-center gap-3 w-full md:w-auto">
                <form action="{{ route('admin.pengembalian.index') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari peminjam / kondisi..."
                        class="px-3 py-2 text-xs border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-blue-500 w-56">
                    <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 text-xs font-semibold rounded-r-md transition">
                        Cari
                    </button>
                </form>

                <a href="{{ route('admin.pengembalian.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2 rounded-md transition whitespace-nowrap shadow-sm">
                    + Proses Pengembalian
                </a>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 font-bold tracking-wider">
                        <th class="py-3.5 px-6">PEMINJAM</th>
                        <th class="py-3.5 px-6">TGL KEMBALI</th>
                        <th class="py-3.5 px-6">KONDISI ALAT</th>
                        <th class="py-3.5 px-6">DENDA</th>
                        <th class="py-3.5 px-6">PETUGAS VERIFIKASI</th>
                        <th class="py-3.5 px-6 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    @forelse($pengembalians as $item)
                        <tr class="hover:bg-gray-50/80 transition">
                            <td class="py-4 px-6 font-semibold text-gray-900">
                                {{ $item->peminjaman->user->name ?? 'Fajar Oktavian' }}
                            </td>
                            <td class="py-4 px-6 text-gray-600">
                                {{ $item->tgl_kembali }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-600 border border-blue-100">
                                    {{ $item->kondisi_kembali }}
                                </span>
                            </td>
                            <td class="py-4 px-6 font-bold text-red-500">
                                Rp {{ number_format($item->denda ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-6 text-gray-600">
                                {{ $item->petugas->name ?? 'Administrator' }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <form action="{{ route('admin.pengembalian.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengembalian ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs font-semibold transition shadow-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-400 font-medium">
                                Belum ada riwayat pengembalian alat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pengembalians->hasPages())
            <div class="p-4 border-t border-gray-100 bg-gray-50">
                {{ $pengembalians->links() }}
            </div>
        @endif
    </div>
</div>
@endsection