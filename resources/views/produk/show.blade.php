@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <a href="{{ url()->previous() }}" class="inline-block mb-4 px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400">
        ⬅ Kembali
    </a>

    <div class="bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $produk->nama_produk }}</h1>

        @if($produk->gambar)
            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="w-full h-64 object-cover rounded mb-4">
        @else
            <div class="w-full h-64 bg-gray-200 rounded flex items-center justify-center text-gray-500">Tidak ada gambar</div>
        @endif

        <p class="text-gray-600 mb-2">Deskripsi:</p>
        <p class="mb-4">{{ $produk->deskripsi }}</p>

        <p class="text-lg font-semibold text-green-600 mb-2">Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
        <p class="mb-4">Stok: {{ $produk->stok }}</p>

        <form action="{{ route('cart.add', $produk->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded w-full">
                🛒 Tambah ke Keranjang
            </button>
        </form>
    </div>
</div>
@endsection
