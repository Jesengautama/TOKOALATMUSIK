@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8 bg-white rounded-2xl shadow-lg mt-12">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-10 border-b border-gray-200 pb-5">
        Daftar Transaksi
    </h1>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto rounded-lg border border-gray-100 shadow-sm" style="border-collapse: separate; border-spacing: 0 16px;">
            <thead class="bg-orange-500 text-white uppercase text-sm font-semibold tracking-wide rounded-t-lg">
                <tr>
                    <th class="px-6 py-4 text-left rounded-tl-lg">ID</th>
                    <th class="px-6 py-4 text-left">Tanggal</th>
                    <th class="px-6 py-4 text-left">Nama Pembeli</th>
                    <th class="px-6 py-4 text-left">Total Harga</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-left rounded-tr-lg">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $transaksi)
                    <tr class="bg-white rounded-lg shadow-sm hover:shadow-md transform hover:scale-[1.02] transition duration-300 cursor-pointer">
                        <td class="px-6 py-5 whitespace-nowrap font-semibold text-gray-800 rounded-l-lg">
                            {{ $transaksi->id_transaksi }}
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-gray-600 font-medium">
                            {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y H:i') }}
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-gray-700 font-medium">
                            {{ $transaksi->user->name }}
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap font-semibold text-orange-600">
                            Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'lunas' => 'bg-green-50 text-green-700',
                                    'pending' => 'bg-yellow-50 text-yellow-700',
                                    'batal' => 'bg-red-50 text-red-700',
                                ];
                                $statusClass = $statusColors[$transaksi->status] ?? 'bg-gray-100 text-gray-600';
                            @endphp
                            <span class="inline-block px-4 py-1 text-xs font-semibold rounded-full tracking-wide {{ $statusClass }}">
                                {{ ucfirst($transaksi->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap rounded-r-lg">
                            <a href="{{ route('transaksi.show', $transaksi->id_transaksi) }}" 
                               class="inline-flex items-center gap-1 px-4 py-2 bg-orange-500 text-white rounded-md font-semibold text-sm hover:bg-orange-600 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M15 12H9m0 0l3-3m-3 3l3 3" />
                                </svg>
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-14 text-center text-gray-400 text-lg font-semibold">
                            Belum ada transaksi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
