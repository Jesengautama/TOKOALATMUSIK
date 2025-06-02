@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md mt-8">
 <a href="{{ route('produk.user.index') }}" class="inline-flex items-center px-4 py-2 mb-6 text-sm font-semibold text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
    </a>
    <h2 class="text-2xl font-bold mb-6">Checkout Produk</h2>

    <div class="flex gap-6 mb-6">
        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="w-40 h-40 object-cover rounded-lg" />

        <div class="flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-semibold">{{ $produk->nama_produk }}</h3>
                <p class="text-green-600 font-bold text-lg mt-2">Rp {{ number_format($produk->harga_produk ?? $produk->harga, 0, ',', '.') }}</p>
                <p class="mt-1 text-sm text-gray-500">Stok tersedia: {{ $produk->stok }}</p>
                <p class="mt-1 text-sm text-gray-600">Deskripsi: {{ $produk->deskripsi ?? '-' }}</p>
            </div>
        </div>
    </div>

    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6">
        @csrf

        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
        <input type="hidden" id="harga_produk" value="{{ $produk->harga_produk ?? $produk->harga }}">

        <div>
            <label for="qty" class="block mb-2 font-medium text-gray-700">Jumlah</label>
            <input
                type="number"
                id="qty"
                name="qty"
                min="1"
                max="{{ $produk->stok }}"
                value="1"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                required
            />
            @error('qty')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="total_harga" class="block mb-2 font-medium text-gray-700">Total Harga</label>
            <input
                type="text"
                id="total_harga"
                name="total_harga"
                value="Rp {{ number_format($produk->harga_produk ?? $produk->harga, 0, ',', '.') }}"
                readonly
                class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100 cursor-not-allowed"
            />
        </div>

        <div>
            <label for="metode_pembayaran" class="block mb-2 font-medium text-gray-700">Metode Pembayaran</label>
            <select
                id="metode_pembayaran"
                name="metode_pembayaran"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                required
            >
                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="COD">COD (Bayar di Tempat)</option>
                <option value="E-Wallet">E-Wallet</option>
            </select>
            @error('metode_pembayaran')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="w-full bg-orange-500 hover:bg-orange-600 text-black font-bold py-3 rounded-md transition"
            style="background-color: hotpink; height: 40px;">
            Bayar Sekarang
        </button>
    </form>
</div>

<script>
    const qtyInput = document.getElementById('qty');
    const hargaProduk = parseInt(document.getElementById('harga_produk').value);
    const totalHargaInput = document.getElementById('total_harga');

   qtyInput.addEventListener('input', function () {
    let qty = parseInt(this.value);
    if (!qty || qty < 1) qty = 1;
    if (qty > {{ $produk->stok }}) qty = {{ $produk->stok }};
    this.value = qty;

    let totalHarga = qty * hargaProduk;
    totalHargaInput.value = 'Rp ' + totalHarga.toLocaleString('id-ID');
});

</script>
@endsection
