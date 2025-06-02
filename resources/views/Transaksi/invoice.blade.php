@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow mt-8">
    <h2 class="text-2xl font-bold mb-6">Invoice Pembayaran</h2>

    <p><strong>Produk:</strong> {{ $transaksi->nama_produk }}</p>
    <p><strong>Jumlah:</strong> {{ $transaksi->qty }}</p>
    <p><strong>Total Harga:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ $transaksi->metode_pembayaran }}</p>

    @if ($transaksi->metode_pembayaran == 'Transfer Bank')
        <div class="mt-4 p-4 bg-gray-100 rounded">
            <p>Silakan transfer ke rekening berikut:</p>
            <p>Bank ABC - No Rek: 1234567890</p>
            <p>Atas nama: Toko Alat Musik</p>
        </div>
    @elseif ($transaksi->metode_pembayaran == 'E-Wallet')
        <div class="mt-4 p-4 bg-gray-100 rounded">
            <p>Scan QR Code untuk pembayaran via E-Wallet:</p>
            <img src="{{ asset('images/qrcode-ewallet.png') }}" alt="QR Code E-Wallet" class="w-48 h-48" />
        </div>
    @elseif ($transaksi->metode_pembayaran == 'COD')
        <div class="mt-4 p-4 bg-gray-100 rounded">
            <p>Pembayaran dilakukan saat barang sampai di alamat Anda.</p>
        </div>
    @endif

    <a href="{{ route('produk.user.index') }}" class="inline-block mt-6 bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2 rounded">Kembali ke Produk</a>
</div>
@endsection
