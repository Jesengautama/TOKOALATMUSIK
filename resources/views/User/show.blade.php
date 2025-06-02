@extends('layouts.app')

@section('content')
<style>
    .produk-container {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        padding: 24px;
        margin: 30px auto;
        max-width: 960px;
    }

    .produk-image {
        flex: 1 1 300px;
    }

    .produk-image img {
        width: 100%;
        border-radius: 8px;
        object-fit: cover;
        max-height: 400px;
    }

    .produk-info {
        flex: 2;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .produk-nama {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .produk-deskripsi {
        color: #666;
        margin-bottom: 20px;
    }

    .produk-harga {
        font-size: 28px;
        color: #e60023;
        font-weight: bold;
        margin-bottom: 16px;
    }

    .produk-stok {
        font-size: 16px;
        color: #555;
        margin-bottom: 24px;
    }

    .produk-aksi {
        display: flex;
        gap: 12px;
    }

    .btn-kembali,
    .btn-beli {
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: bold;
        border: none;
        cursor: pointer;
        text-align: center;
    }

    .btn-kembali {
        background-color: #f3f4f6;
        color: #333;
        text-decoration: none;
    }

    .btn-kembali:hover {
        background-color: #e5e7eb;
    }

    .btn-beli {
        background-color: #f97316;
        color: white;
    }

    .btn-beli:hover {
        background-color: #ea580c;
    }
</style>

<div class="produk-container">
    <div class="produk-image">
        @if($produk->gambar)
            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}">
        @else
            <div class="w-full h-64 bg-gray-200 rounded flex items-center justify-center text-gray-500">Tidak ada gambar</div>
        @endif
    </div>

    <div class="produk-info">
        <div>
            <div class="produk-nama">{{ $produk->nama_produk }}</div>
            <div class="produk-deskripsi">{{ $produk->deskripsi }}</div>
            <div class="produk-harga">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
            <div class="produk-stok">Stok tersedia: {{ $produk->stok }}</div>
        </div>

        <div class="produk-aksi">
<a href="{{ route('produk.user.index') }}" class="btn-kembali">⬅ Kembali</a>

            <form action="{{ route('cart.add', $produk->id) }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-beli">🛒 Beli Sekarang</button>
            </form>
        </div>
    </div>
</div>
@endsection
