@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-8 bg-white rounded-xl shadow-xl mt-12">

    <table class="w-full border-collapse rounded-lg overflow-hidden shadow-lg">
        <tbody>
            <tr class="bg-gradient-to-r from-blue-50 to-white hover:bg-gradient-to-r hover:from-blue-100 hover:to-white transition duration-300">
                <th class="text-left px-8 py-6 font-semibold text-blue-700 text-lg border-b border-blue-200 w-1/3">Gambar :</th>
                <td class="px-8 py-6 border-b border-blue-200">
                    @if($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="max-h-64 rounded-lg shadow-md object-contain mx-auto" />
                    @else
                        <div class="w-64 h-64 bg-gray-100 text-gray-400 flex items-center justify-center rounded-lg mx-auto font-semibold">
                            Tidak ada gambar
                        </div>
                    @endif
                </td>
            </tr>
            <tr class="bg-gradient-to-r from-blue-50 to-white hover:bg-gradient-to-r hover:from-blue-100 hover:to-white transition duration-300">
                <th class="text-left px-8 py-6 font-semibold text-blue-700 text-lg border-b border-blue-200 w-1/3">Nama Barang : </th>
                <td class="px-8 py-6 border-b border-blue-200 text-gray-900 font-semibold text-lg">
                    {{ $produk->nama_produk }}
                </td>
            </tr>

            <tr class="bg-white hover:bg-blue-50 transition-colors duration-300">
                <th class="text-left px-8 py-6 font-semibold text-blue-700 border-b border-blue-200 align-top text-lg">Harga :</th>
                <td class="px-8 py-6 border-b border-blue-200 text-green-600 font-bold text-xl align-top">
                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                </td>
            </tr>

            <tr class="bg-gradient-to-r from-blue-50 to-white hover:bg-gradient-to-r hover:from-blue-100 hover:to-white transition duration-300">
                <th class="text-left px-8 py-6 font-semibold text-blue-700 border-b border-blue-200 align-top text-lg">Stok :</th>
                <td class="px-8 py-6 border-b border-blue-200 align-top text-gray-700">
                    {{ $produk->stok }}
                </td>
            </tr>

            <tr class="bg-white hover:bg-blue-50 transition-colors duration-300">
                <th class="text-left px-8 py-6 font-semibold text-blue-700 align-top text-lg">Deskripsi : </th>
                <td class="px-8 py-6 align-top text-gray-700 whitespace-pre-line leading-relaxed">
                    {{ $produk->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="mt-10 flex gap-5 justify-start">
    <a href="{{ url('/dashboard') }}" 
   style="
     display: inline-block;
     padding: 12px 28px;
     background-color: #000000; /* Hitam */
     color: white;
     border-radius: 10px;
     text-decoration: none;
     font-weight: 700;
     font-size: 18px;
     user-select: none;
     transition: background-color 0.3s ease;
   "
   onmouseover="this.style.backgroundColor='#222222';"
   onmouseout="this.style.backgroundColor='#000000';"
>
    &lt; Kembali
</a>
</div>

</div>
@endsection
