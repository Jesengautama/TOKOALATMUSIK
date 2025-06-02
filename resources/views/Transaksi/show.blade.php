@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-8 bg-white rounded-xl shadow-md mt-10">
    <h1 class="text-3xl font-bold mb-6">Detail Transaksi #{{ $transaksi->id }}</h1>

    <div class="mb-6">
        <p><strong>Tanggal:</strong> {{ $transaksi->tanggal_transaksi->format('d M Y H:i') }}</p>
        <p><strong>Pembeli:</strong> {{ $transaksi->user->name }}</p>
        <p><strong>Status:</strong> {{ ucfirst($transaksi->status) }}</p>
        <p><strong>Total Harga:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
    </div>

    {{-- Kalau kamu sudah punya relasi detail transaksi dengan produk --}}
    @if($transaksi->detailTransaksi && $transaksi->detailTransaksi->count() > 0)
        <table class="w-full border-collapse rounded-lg shadow overflow-hidden">
            <thead>
                <tr class="bg-gray-700 text-white">
                    <th class="p-4 text-left">Produk</th>
                    <th class="p-4 text-left">Jumlah</th>
                    <th class="p-4 text-left">Harga Satuan</th>
                    <th class="p-4 text-left">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->detailTransaksi as $detail)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="p-4">{{ $detail->produk->nama_produk }}</td>
                        <td class="p-4">{{ $detail->jumlah }}</td>
                        <td class="p-4">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td class="p-4">Rp {{ number_format($detail->jumlah * $detail->harga_satuan, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada detail transaksi.</p>
    @endif

    <div class="mt-6">
        <a href="{{ route('transaksi.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Kembali ke Daftar</a>
    </div>
</div>
@endsection
