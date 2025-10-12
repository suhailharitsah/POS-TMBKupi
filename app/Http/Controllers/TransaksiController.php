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
    // ===============================
    // 🔹 Query produk
    // ===============================
    $queryProduk = Produk::query();

    if ($request->filled('search')) {
      $queryProduk->where('nama', 'like', '%' . $request->search . '%');
    }

    $produks = $queryProduk->orderBy('kategori')->get();

    // ===============================
    // 🔹 Query transaksi
    // ===============================
    $query = Transaksi::with('details.produk');

    // 🔹 Filter tanggal (single date atau range)
    if ($request->filled('tanggal')) {
      $tanggal = $request->input('tanggal');

      if (strpos($tanggal, ' to ') !== false) {
        [$start, $end] = explode(' to ', $tanggal);
      } elseif (strpos($tanggal, ' - ') !== false) {
        [$start, $end] = explode(' - ', $tanggal);
      } else {
        $start = $end = $tanggal;
      }

      // Ubah ke Carbon agar format datetime sesuai database
      $start = \Carbon\Carbon::parse($start)->startOfDay();
      $end = \Carbon\Carbon::parse($end)->endOfDay();

      $query->whereBetween('created_at', [$start, $end]);
    } else {
      // 🔹 Filter berdasarkan bulan/tahun
      if ($request->filled('bulan') && $request->bulan !== 'semua') {
        $bulan = (int) $request->bulan;
        $tahun = (int) $request->input('tahun', now()->year);
        $query->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
      } elseif ($request->filled('tahun') && $request->tahun !== 'Semua') {
        $tahun = (int) $request->tahun;
        $query->whereYear('created_at', $tahun);
      }
      // 🔹 jika bulan = semua → tampilkan semua transaksi
    }

    // 🔹 Filter kategori (opsional)
    if ($request->filled('kategori')) {
      $kategori = strtolower($request->kategori);
      $query->whereHas('details.produk', function ($q) use ($kategori) {
        $q->where('kategori', $kategori);
      });
    }

    // 🔹 Urutkan dan paginasi
    $transaksis = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

    // ===============================
    // 🔹 Total Pendapatan
    // ===============================
    $totalBulanIni = (clone $query)->sum('total');

    // ===============================
    // 🔹 Dropdown periode
    // ===============================
    $first = Transaksi::orderBy('created_at', 'asc')->first();
    $start = $first ? \Carbon\Carbon::parse($first->created_at)->startOfMonth() : now()->startOfMonth();
    $end = now()->startOfMonth();

    $periode = collect();
    $current = $end->copy();

    // Tambahkan opsi "Semua Transaksi"
    $periode->push(
      (object) [
        'bulan' => 'semua',
        'tahun' => 'Semua',
      ],
    );

    while ($current->gte($start)) {
      $periode->push(
        (object) [
          'bulan' => $current->month,
          'tahun' => $current->year,
        ],
      );
      $current->subMonth();
    }

    // ===============================
    // 🔹 Kirim ke view
    // ===============================
    $bulan = $request->input('bulan', now()->month);
    $tahun = $request->input('tahun', now()->year);
    $tanggal = $request->input('tanggal', null);

    return view('transaksi.index', compact('transaksis', 'produks', 'bulan', 'tahun', 'tanggal', 'periode', 'totalBulanIni'));
  }

  // ===============================
  // 🔹 Store transaksi
  // ===============================
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
