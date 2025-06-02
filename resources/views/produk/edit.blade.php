@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #1a1a2e;">
    <div style="background-color: #16213e; padding: 30px; border-radius: 10px; width: 100%; max-width: 500px; color: #fff;">
        <h2 style="text-align: center; margin-bottom: 20px;"> Edit Produk</h2>

        @if ($errors->any())
            <div style="background-color: #e74c3c; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('produk.update', $produk->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 15px;">
                <label for="nama_produk" style="display: block; margin-bottom: 5px;">Nama Produk:</label>
                <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}"
                    style="width: 100%; padding: 8px; border-radius: 5px; border: none; color: black;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="deskripsi" style="display: block; margin-bottom: 5px;">Deskripsi:</label>
                <textarea name="deskripsi" rows="4"
                    style="width: 100%; padding: 8px; border-radius: 5px; border: none; color: black;">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="harga" style="display: block; margin-bottom: 5px;">Harga:</label>
                <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}"
                    style="width: 100%; padding: 8px; border-radius: 5px; border: none; color: black;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="stok" style="display: block; margin-bottom: 5px;">Stok:</label>
                <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}"
                    style="width: 100%; padding: 8px; border-radius: 5px; border: none; color: black;">
            </div>

            <button type="submit"
                style="width: 100%; background-color: orange; color: white; padding: 10px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
                Update Produk
            </button>
        </form>
    </div>
</div>
@endsection
