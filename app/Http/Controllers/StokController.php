<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class StokController extends Controller
{
  public function index()
  {
    $produk = Produk::orderBy('nama')->get();

    return view('master.stok.index', [
      'produk' => $produk,
      'totalProduk' => $produk->count(),
      'stokMinimum' => $produk->min('stok'),
      'stokHampirHabis' => $produk->where('stok', '<=', 5)->count(),
    ]);
  }
}
