<h2 class="text-xl font-bold">Transaksi Produk</h2>

<div class="mt-4">
    <p>Nama Produk: <strong>{{ $produk->nama_produk }}</strong></p>
    <p>Harga: <strong>Rp {{ number_format($produk->harga, 0, ',', '.') }}</strong></p>
</div>

<form action="{{ route('transaksi.store') }}" method="POST">
    @csrf
    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
    <input type="number" name="jumlah" value="1" min="1" class="mt-3 p-2 border rounded">
    <button type="submit" class="mt-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Konfirmasi Beli
    </button>
</form>
