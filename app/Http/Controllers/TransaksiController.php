<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
  public function index(Request $request)
  {
    // 🔹 Query produk
    $query = Produk::query();

    if ($request->filled('search')) {
      $query->where('nama', 'like', '%' . $request->search . '%');
    }

    $produks = $query->orderBy('kategori')->get();

    // 🔹 Query transaksi
    $transaksiQuery = Transaksi::with('details.produk')->latest();

    // 🔹 Filter tanggal
    if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
      $transaksiQuery->whereBetween('created_at', [$request->tanggal_mulai . ' 00:00:00', $request->tanggal_akhir . ' 23:59:59']);
    } elseif ($request->filled('tanggal_mulai')) {
      $transaksiQuery->whereDate('created_at', '>=', $request->tanggal_mulai);
    } elseif ($request->filled('tanggal_akhir')) {
      $transaksiQuery->whereDate('created_at', '<=', $request->tanggal_akhir);
    } else {
      // default bulan ini
      $transaksiQuery->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
    }

    $transaksis = $transaksiQuery->paginate(10)->withQueryString();

    return view('transaksi.index', compact('produks', 'transaksis'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'total' => 'required|numeric|min:1',
      'bayar' => 'required|numeric|min:1',
      'kembali' => 'required|numeric|min:0',
      'keranjang' => 'required|array|min:1',
      'keranjang.*.id' => 'required|exists:produks,id',
      'keranjang.*.qty' => 'required|integer|min:1',
      'keranjang.*.harga' => 'required|numeric|min:1',
    ]);

    $transaksi = Transaksi::create([
      'kode' => 'TRX' . now()->format('YmdHis'),
      'total' => $validated['total'],
      'bayar' => $validated['bayar'],
      'kembali' => $validated['kembali'],
      'status' => 'Sukses',
    ]);

    foreach ($validated['keranjang'] as $item) {
      TransaksiDetail::create([
        'transaksi_id' => $transaksi->id,
        'produk_id' => $item['id'],
        'qty' => $item['qty'],
        'harga' => $item['harga'],
        'subtotal' => $item['harga'] * $item['qty'],
      ]);
    }

    return response()->json([
      'success' => true,
      'message' => 'Transaksi berhasil disimpan',
      'transaksi' => $transaksi->load('details.produk'),
    ]);
  }

  public function destroy($id)
  {
    $trx = Transaksi::findOrFail($id);
    $trx->delete();

    return redirect()->back()->with('success', 'Transaksi berhasil dihapus');
  }
}
