<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;


class UserProdukController extends Controller
{
    public function index(Request $request)
{
    $query = Produk::query();

    // Pencarian nama produk
    if ($request->filled('search')) {
        $query->where('nama_produk', 'like', '%' . $request->search . '%');
    }

    // Filter kategori
    if ($request->filled('kategori')) {
        $query->where('kategori', $request->kategori);
    }

    // Sort harga
    if ($request->filled('sort')) {
        if ($request->sort == 'murah') {
            $query->orderBy('harga', 'desc');
        } elseif ($request->sort == 'mahal') {
            $query->orderBy('harga', 'asc');
        }
    }

    $produk = $query->paginate(9)->withQueryString();

    return view('user.produk', compact('produk'));
}
	public function show($id)
{
    $produk = \App\Models\Produk::findOrFail($id);
    return view('user.show', compact('produk'));
	}
}
