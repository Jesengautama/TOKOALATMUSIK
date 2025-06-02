@extends('layouts.app')

@section('content')
{{-- Form Pencarian --}}

@if(request('search'))
    <div style="margin-top: 20px; padding: 10px 15px; background-color: #2a2a40; border-radius: 8px; color: #fff;">
        Hasil pencarian untuk: 
        <span style="font-weight: bold; color: #4f46e5;">{{ request('search') }}</span>
    </div>
@endif

<style>
    body {
        background-color: #1e1e2f;
        color: white;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
    }

    h1 {
        font-size: 28px;
        margin-bottom: 20px;
    }

    .cards {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
    }

    .card {
        background-color: #2e2e42;
        flex: 1;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }

    .card h2 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #aaa;
    }

    .card p {
        font-size: 26px;
        font-weight: bold;
        margin: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #2e2e42;
        border-radius: 10px;
        overflow: hidden;
    }

    th, td {
        padding: 12px;
        border-bottom: 1px solid #444;
        text-align: left;
    }

    th {
        background-color: #3e3e5a;
    }

    tr:hover {
        background-color: #3a3a52;
    }
</style>

<div class="container">
    <h1>📊 Dashboard</h1>

    <div class="cards">
        <div class="card">
            <h2>User Terdaftar</h2>
            <a href="{{ route('users.index') }}" style="color: inherit; text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
    {{ $userCount }}
</a>
        </div>
        <div class="card">
            <h2>Produk Tersedia</h2>
            <a href="{{ route('produk.index') }}" style="color: inherit; text-decoration: none;">
            {{ $productCount }}
        </a>
        </div>
    </div>

    <h2 style="margin-bottom: 10px;">🛒 Produk Terbaru</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($latestProduk as $product)
            <tr>
                
                <td>{{ $product->nama_produk }}</td>
                <td>{{ $product->stok }}</td>
                <td>
    <a href="{{ route('produk.show', $product->id) }}" 
   style="
      display: inline-block;
      padding: 6px 14px;
      background-color: #4f46e5; /* warna ungu */
      color: white;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      transition: background-color 0.3s ease;
   "
   onmouseover="this.style.backgroundColor='#4338ca'"
   onmouseout="this.style.backgroundColor='#4f46e5'"
>
    Detail
</a>

</td>



            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
