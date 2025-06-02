<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart($id)
{
    $produk = Produk::findOrFail($id);

    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        $cart[$id]['quantity'] += 1;
    } else {
        $cart[$id] = [
            'nama' => $produk->nama_produk,
            'harga' => $produk->harga,
            'gambar' => $produk->gambar,
            'quantity' => 1
        ];
    }

    session()->put('cart', $cart);
    session()->put('cart_count', array_sum(array_column($cart, 'quantity'))); // Hitung total

    return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
	}

}
