<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanPenjualanController extends Controller
{
  public function index(Request $request)
  {
    // Ambil tanggal dari request, atau default hari ini
    $tanggalStart = $request->start_date ?? now()->startOfMonth()->toDateString();
    $tanggalEnd = $request->end_date ?? now()->toDateString();

    // Ambil data transaksi
    $transaksi = Transaksi::whereBetween('created_at', [$tanggalStart, $tanggalEnd])
      ->orderBy('created_at', 'desc')
      ->get();

    // Hitung ringkasan
    $totalPendapatan = $transaksi->sum('total');
    $totalTransaksi = $transaksi->count();
    $rataRata = $totalTransaksi > 0 ? round($totalPendapatan / $totalTransaksi) : 0;

    return view('laporan.penjualan.index', compact(
      'transaksi',
      'tanggalStart',
      'tanggalEnd',
      'totalPendapatan',
      'totalTransaksi',
      'rataRata'
    ));
  }
}
