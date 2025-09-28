<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar produk dengan fitur pencarian dan paginasi.
     */
    public function index(Request $request)
    {
        // Mulai kueri dari model Produk
        $query = Produk::query();

        // Menggunakan "when" untuk menerapkan kondisi secara opsional
        $query->when($request->filled('search'), function ($q) use ($request) {
            return $q->where('nama', 'like', '%' . $request->search . '%');
        });

        $query->when($request->filled('kategori'), function ($q) use ($request) {
            return $q->where('kategori', $request->kategori);
        });

        // Terapkan urutan dan paginasi
        $produks = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('master.produk.index', compact('produks'));
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data masukan
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:Makanan,Minuman',
            'harga' => 'required|numeric|min:1', // Harga minimal 1, bukan 0
        ]);

        // Gunakan Mass Assignment dengan data yang sudah divalidasi
        Produk::create($validated);

        return redirect()->route('master.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Memperbarui produk yang sudah ada.
     */
    public function update(Request $request, Produk $produk)
    {
        // Validasi data masukan
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:Makanan,Minuman',
            'harga' => 'required|numeric|min:1', // Harga minimal 1, bukan 0
        ]);

        $produk->update($validated);

        return redirect()->route('master.produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Menghapus produk. Menggunakan Soft Deletes jika tersedia.
     */
    public function destroy(Produk $produk)
    {
        // Pastikan produk tidak terkait dengan transaksi
        if ($produk->details()->count() > 0) {
            return redirect()->back()->with('error', 'Produk tidak dapat dihapus karena sudah ada di riwayat transaksi.');
        }

        // Cek jika model menggunakan Soft Deletes
        if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($produk))) {
            $produk->delete(); // Ini akan melakukan Soft Delete
        } else {
            $produk->forceDelete(); // Menghapus permanen
        }

        return redirect()->route('master.produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
