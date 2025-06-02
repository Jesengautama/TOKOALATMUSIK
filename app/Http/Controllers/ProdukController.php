<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
{
    $query = \App\Models\Produk::query();

    // Filter kategori (asumsi ada kolom kategori di tabel produk)
    if ($request->filled('kategori')) {
        $query->where('kategori', $request->kategori);
    }

    // Filter stok
    if ($request->filled('stok_filter')) {
        if ($request->stok_filter == 'besar') {
            $query->where('stok', '>', 5);
        } elseif ($request->stok_filter == 'kecil') {
            $query->where('stok', '<=', 5);
        }
    }

    // Filter harga
    if ($request->filled('harga_filter')) {
        if ($request->harga_filter == 'murah') {
            $query->orderBy('harga', 'desc');
        } elseif ($request->harga_filter == 'mahal') {
            $query->orderBy('harga', 'asc');
        }
    }

    $produk = $query->paginate(10)->withQueryString();

    return view('produk.index', compact('produk'));
}


    public function store(Request $request)
{
    $request->validate([
        'nama_produk' => 'required|string',
        'kategori'    => 'required|string',    // tambahkan ini
        'deskripsi'   => 'required|string',
        'harga'       => 'required|numeric',
        'stok'        => 'required|integer',
        'gambar'      => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $path = null;
    if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('produk', 'public');
    }

    Produk::create([
        'nama_produk' => $request->nama_produk,
        'kategori'    => $request->kategori,   // tambahkan ini
        'deskripsi'   => $request->deskripsi,
        'harga'       => $request->harga,
        'stok'        => $request->stok,
        'gambar'      => $path,
    ]);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
}


    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
{
    $request->validate([
        'nama_produk' => 'required',
        'deskripsi' => 'required',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
    ]);

    $produk->update($request->only(['nama_produk', 'deskripsi', 'harga', 'stok']));

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate.');
}


    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
    public function create()
{
    return view('produk.create');
}
    public function show($id)
    {
        $produk = Produk::findOrFail($id); // Ambil data produk sesuai id, kalau gak ada akan 404
        return view('produk.detail', compact('produk'));
    }
}
