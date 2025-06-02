<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
  // Pastikan model Produk sudah dibuat

class DashboardController extends Controller
{
    
public function index()
{
    $userCount = User::count();       // Hitung jumlah user
    $productCount = Produk::count();  // Hitung jumlah produk

    $latestProduk = Produk::latest()->take(5)->get();

    return view('dashboard', [
        'userCount' => $userCount,
        'productCount' => $productCount,
        'latestProduk' => $latestProduk,
    ]);
}
}
