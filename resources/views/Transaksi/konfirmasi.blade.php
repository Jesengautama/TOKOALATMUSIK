@extends('layouts.app')

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Detail Transaksi</h2>
    <p>Produk: {{ $transaksi->produk->nama_produk }}</p>
    <p>Jumlah: {{ $transaksi->qty }}</p>
    <p>Total Harga: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
    <p>Metode Pembayaran: {{ $transaksi->metode_pembayaran }}</p>

    <p>Silakan lakukan pembayaran sesuai metode yang Anda pilih.</p>
</div>
@endsection
