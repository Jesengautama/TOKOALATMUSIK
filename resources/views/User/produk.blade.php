@extends('layouts.app')

@section('content')
<style>
    .grid-produk {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    .produk-item {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: 0.3s;
        display: flex;
        flex-direction: column;
    }

    .produk-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .produk-item img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .produk-info {
        padding: 15px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .produk-nama {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .produk-harga {
        font-size: 1.1rem;
        color: #16a34a;
        font-weight: bold;
        margin-bottom: 12px;
    }

    .produk-btn {
    display: flex;
    gap: 8px;
    margin-top: auto;
}

.produk-btn a,
.produk-btn button {
    flex: 1;
    padding: 10px 0;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
    text-align: center;
    height: 42px;
    line-height: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.produk-btn a {
    background: #3b82f6;
    color: white;
    text-decoration: none;
}

.produk-btn form {
    flex: 1;
    margin: 0;
    display: flex;
}
.produk-btn button {
    background: #10b981;
    color: white;
}
.col-span-full {
        grid-column: 1 / -1;
    }

</style>


<div class="container py-6">
    

<form action="{{ route('produk.user.index') }}" method="GET" style="margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap;">
    <input type="text" name="search" placeholder="Cari nama produk..." value="{{ request('search') }}"
    style="padding: 8px; border-radius: 6px; border: 1px solid #ccc; width: 200px;">

    <select name="kategori" style="padding: 8px; border-radius: 6px; border: 1px solid #ccc;">
        <option value="">Semua Kategori</option>
        <option value="gitar" {{ request('kategori') == 'gitar' ? 'selected' : '' }}>Gitar</option>
        <option value="drum" {{ request('kategori') == 'drum' ? 'selected' : '' }}>Drum</option>
        <option value="bass" {{ request('kategori') == 'bass' ? 'selected' : '' }}>Bass</option>
        <option value="keyboard" {{ request('kategori') == 'keyboard' ? 'selected' : '' }}>Keyboard</option>
    </select>

    <select name="sort" style="padding: 8px; border-radius: 6px; border: 1px solid #ccc;">
        <option value="">Urutkan Harga</option>
        <option value="murah" {{ request('sort') == 'murah' ? 'selected' : '' }}>Harga Termurah</option>
        <option value="mahal" {{ request('sort') == 'mahal' ? 'selected' : '' }}>Harga Termahal</option>
    </select>

    <button type="submit" style="padding: 8px 16px; border-radius: 6px; background: #3b82f6; color: white; border: none;">
        Terapkan
    </button>

</form>


    <div class="grid-produk">
        @forelse ($produk as $item)
            <div class="produk-item">
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}">
                <div class="produk-info">
                    <div class="produk-nama">{{ $item->nama_produk }}</div>
                    <div class="produk-harga">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>

                    <div class="produk-btn">
                        <a href="{{ route('produk.user.show', $item->id) }}" class="btn-detail">Detail</a>

                        <a href="{{ route('transaksi.create', ['produk_id' => $item->id]) }}" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 w-full text-center block">
    Beli
</a>
                    </div>
                </div>
            </div>
       @empty
    <div class="col-span-full flex flex-col items-center justify-center py-16 text-center">
        <img src="https://cdn-icons-png.flaticon.com/512/2748/2748558.png" alt="Not Found" width="100" class="mb-4 opacity-70">
        <h3 class="text-lg text-gray-300 font-semibold" style="color:grey">Produk tidak ditemukan</h3>
        <p class="text-sm text-gray-400">Coba kata kunci lain atau reset filter</p>
        <a href="{{ route('produk.user.index') }}" class="mt-4 inline-block bg-gray-200 text-black px-4 py-2 rounded hover:bg-gray-300" style="color:white">
            🔁 Reset Filter
        </a>
    </div>
@endforelse
    </div>

    <div class="mt-8 flex justify-center">
        {{ $produk->links() }}
    </div>
</div>
@endsection
