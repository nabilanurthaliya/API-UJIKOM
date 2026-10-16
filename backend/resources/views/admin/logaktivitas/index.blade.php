@extends('layouts.app')

@section('title', 'Log Aktivitas - Sistem Peminjaman')
@section('header_title', 'Log Aktivitas')

@section('content')

    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">

        <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-bold text-gray-800">
                Log Aktivitas
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Riwayat aktivitas pengguna dalam sistem.
            </p>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="bg-gray-100 text-gray-600 text-sm uppercase tracking-wider">

                        <th class="px-3 py-3 border-b">
                            Waktu
                        </th>

                        <th class="px-3 py-3 border-b">
                            User
                        </th>

                        <th class="px-3 py-3 border-b">
                            Aktivitas
                        </th>

                    </tr>
                </thead>

                <tbody class="text-gray-700 text-sm">

                    @forelse($logs as $log)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-3 py-3 border-b">
                                {{ $log->created_at }}
                            </td>

                            <td class="px-3 py-3 border-b font-medium text-gray-900">
                                {{ $log->user->name ?? 'Sistem' }}
                            </td>

                            <td class="px-3 py-3 border-b">
                                {{ $log->aktivitas }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3" class="py-4 text-center text-gray-500">
                                Belum ada log aktivitas.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if($logs->hasPages())
            <div class="px-5 py-4 border-t border-gray-200">
                {{ $logs->links() }}
            </div>
        @endif

    </div>

@endsection