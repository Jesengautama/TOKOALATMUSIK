@extends('layouts.app')
@section('content')
<style>
    .container {
        max-width: 900px;
        margin: 30px auto;
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .add-button {
        display: inline-block;
        margin-bottom: 20px;
        padding: 8px 16px;
        background-color: #2c3e50;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: 0.3s;
    }

    .add-button:hover {
        background-color: #34495e;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #2c3e50;
        color: white;
    }

    .btn-edit, .btn-delete {
        padding: 6px 10px;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-edit {
        background-color: #f39c12;
    }

    .btn-delete {
        background-color: #e74c3c;
    }

    .btn-edit:hover {
        background-color: #e67e22;
    }

    .btn-delete:hover {
        background-color: #c0392b;
    }

    .text-center {
        text-align: center;
    }
    .menu-button {
  background-color: #2c3e50;
  border: none;
  border-radius: 5px;
  color: white;
  cursor: pointer;
  font-size: 20px;
  padding: 4px 8px;
  transition: background-color 0.3s ease;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.menu-button:hover,
.menu-button:focus {
  background-color: #34495e;
  outline: none;
}

.dropdown-menu {
  position: absolute;
  right: 0;
  margin-top: 6px;
  width: 120px;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  display: none;
  z-index: 1000;
}

.dropdown-menu.show {
  display: block;
}

.dropdown-menu a,
.dropdown-menu form button {
  display: block;
  width: 100%;
  padding: 8px 12px;
  text-align: left;
  color: #333;
  background: none;
  border: none;
  cursor: pointer;
  font-size: 14px;
  text-decoration: none;
}

.dropdown-menu a:hover,
.dropdown-menu form button:hover {
  background-color: #f0f0f0;
  color: #000;
}


</style>

<div class="container">
    <h2>Daftar Produk</h2>
    <a href="{{ route('produk.create') }}" class="add-button">+ Tambah Produk</a>
<form action="{{ route('produk.index') }}" method="GET" style="margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap;">

    <select name="kategori" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
        <option value="">Semua Kategori</option>
        <option value="gitar" {{ request('kategori') == 'gitar' ? 'selected' : '' }}>Gitar</option>
        <option value="drum" {{ request('kategori') == 'drum' ? 'selected' : '' }}>Drum</option>
        <option value="bass" {{ request('kategori') == 'bass' ? 'selected' : '' }}>Bass</option>
        <!-- Tambah kategori lain sesuai database -->
    </select>

    <select name="stok_filter" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
        <option value="">Filter Stok</option>
        <option value="besar" {{ request('stok_filter') == 'besar' ? 'selected' : '' }}>Stok > 5</option>
        <option value="kecil" {{ request('stok_filter') == 'kecil' ? 'selected' : '' }}>Stok ≤ 5</option>
    </select>

    <select name="harga_filter" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
        <option value="">Urutkan Harga</option>
        <option value="murah" {{ request('harga_filter') == 'murah' ? 'selected' : '' }}>Harga Termurah</option>
        <option value="mahal" {{ request('harga_filter') == 'mahal' ? 'selected' : '' }}>Harga Termahal</option>
    </select>

    <button type="submit" style="background-color: #2c3e50; color: white; padding: 8px 16px; border-radius: 5px; border: none; cursor: pointer;">
        Filter
    </button>
</form>
    <table>
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($produk as $item)
        <tr>
            <td>
                @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" style="width: 80px; height: auto; border-radius: 5px;">
                @else
                    <span>Tidak ada gambar</span>
                @endif
            </td>
            <td>{{ $item->nama_produk }}</td>
            <td>{{ $item->deskripsi }}</td>
            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
            <td>{{ $item->stok }}</td>
           <td>
  <div class="relative inline-block text-left">
    <button type="button" class="menu-button" id="menu-button-{{ $item->id }}" aria-expanded="false" aria-haspopup="true">
      &#x22EE;
    </button>

    <div class="dropdown-menu" role="menu" aria-labelledby="menu-button-{{ $item->id }}" tabindex="-1">
      <a href="{{ route('produk.edit', $item->id) }}" role="menuitem">Edit</a>
      <form method="POST" action="{{ route('produk.destroy', $item->id) }}" onsubmit="return confirm('Yakin hapus produk ini?');" role="none">
        @csrf
        @method('DELETE')
        <button type="submit" role="menuitem">Hapus</button>
      </form>
    </div>
  </div>
</td>

        </tr>
        @endforeach
    </tbody>
</table>

</div>
<script>
document.querySelectorAll('.menu-button').forEach(button => {
  button.addEventListener('click', () => {
    const menu = button.nextElementSibling;
    menu.classList.toggle('show');
  });
});

// Klik di luar untuk tutup dropdown
window.addEventListener('click', e => {
  document.querySelectorAll('.menu-button').forEach(button => {
    if (!button.contains(e.target) && !button.nextElementSibling.contains(e.target)) {
      button.nextElementSibling.classList.remove('show');
    }
  });
});

</script>
@endsection
