<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Produk;


class TransaksiController extends Controller
{
	 public function index()
    {
        $transaksis = Transaksi::with('user')->latest()->get();
        return view('transaksi.index', compact('transaksis'));
    }
  public function show($id)
{
    $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->firstOrFail();
    return view('transaksi.show', compact('transaksi'));
}

public function create(Request $request)
{
    $produkId = $request->query('produk_id');
    $produk = Produk::findOrFail($produkId);

    return view('transaksi.create', compact('produk'));
}


public function store(Request $request)
{
    $request->validate([
        'produk_id' => 'required|exists:produks,id',
        'qty' => 'required|integer|min:1',
        'metode_pembayaran' => 'required|string',
    ]);

    $produk = Produk::findOrFail($request->produk_id);

    if ($request->qty > $produk->stok) {
        return back()->withErrors(['qty' => 'Jumlah melebihi stok yang tersedia'])->withInput();
    }

    $totalHarga = $produk->harga * $request->qty;

    $transaksi = Transaksi::create([
        'id_nota' => auth()->id(),
        'harga_produk' => $produk->harga,
        'nama_produk' => $produk->nama_produk,
        'qty' => $request->qty,
        'total_harga' => $totalHarga,
        'metode_pembayaran' => $request->metode_pembayaran,
        'user_id' => auth()->id(),
        'produk_id' => $produk->id,
    ]);

    $produk->decrement('stok', $request->qty);

    return redirect()->route('transaksi.invoice', $transaksi->id_transaksi);

}


public function invoice($id)
{
    $transaksi = Transaksi::findOrFail($id);

    return view('transaksi.invoice', compact('transaksi'));
	}
public function bayar(Request $request)
{
    $request->validate([
    'id' => 'required|exists:produks,id_produk',
    'qty' => 'required|integer|min:1',
    'metode_pembayaran' => 'required|string',
]);


    $produk = Produk::findOrFail($request->produk_id);

    // Hitung total harga
    $total_harga = $produk->harga_produk * $request->qty;

    // Simpan transaksi baru
    $transaksi = Transaksi::create([
        'id_produk' => $produk->id,
        'qty' => $request->qty,
        'total_harga' => $total_harga,
        'metode_pembayaran' => $request->metode_pembayaran,
        'id_user' => auth()->id(),  // Asumsi pakai auth user
        'waktu' => now(),
        // Tambahkan kolom lain sesuai kebutuhan
    ]);

    // Kurangi stok produk
    $produk->stok -= $request->qty;
    $produk->save();

    // Redirect ke halaman konfirmasi dengan pesan sukses
    return redirect()->route('transaksi.konfirmasi', $transaksi->id)
                     ->with('success', 'Transaksi berhasil! Silakan lanjutkan pembayaran.');
}
public function konfirmasi($id)
{
    $transaksi = Transaksi::with('produk')->findOrFail($id);

    return view('transaksi.konfirmasi', compact('transaksi'));
}

}
