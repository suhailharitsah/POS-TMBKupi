<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    // Tampilkan daftar
    public function index(Request $request)
    {
        $query = Pengeluaran::query();

        // 🔹 Jika ada input 'tanggal' (single date atau range dari flatpickr)
        if ($request->filled('tanggal')) {
            $tanggal = $request->input('tanggal');

            // flatpickr range bisa memberi "YYYY-MM-DD to YYYY-MM-DD" atau "YYYY-MM-DD - YYYY-MM-DD"
            if (strpos($tanggal, ' to ') !== false) {
                [$start, $end] = explode(' to ', $tanggal);
                $query->whereBetween('tanggal', [$start, $end]);
            } elseif (strpos($tanggal, ' - ') !== false) {
                [$start, $end] = explode(' - ', $tanggal);
                $query->whereBetween('tanggal', [$start, $end]);
            } else {
                // single date
                $query->whereDate('tanggal', $tanggal);
            }
        } else {
            // 🔹 Jika tidak ada 'tanggal', cek filter rentang terpisah (tanggal_mulai/tanggal_akhir)
            if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
                $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_akhir]);
            } elseif ($request->filled('tanggal_mulai')) {
                $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
            } elseif ($request->filled('tanggal_akhir')) {
                $query->whereDate('tanggal', '<=', $request->tanggal_akhir);
            }

            // 🔹 (opsional) kalau ingin juga mendukung filter bulan/tahun lewat query
            if ($request->filled('bulan') || $request->filled('tahun')) {
                $bulan = $request->input('bulan', now()->month);
                $tahun = $request->input('tahun', now()->year);
                $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
            }
        }

        // 🔹 Urutkan terbaru (tanggal terbaru dulu, lalu created_at terbaru di dalam tanggal yang sama)
        $pengeluarans = $query->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('master.pengeluaran.index', compact('pengeluarans'));
    }

    // Simpan pengeluaran baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'nominal' => 'required',
            'tanggal' => 'required|date',
        ]);

        // bersihkan nominal (hilangkan titik/koma/karakter non-digit)
        $validated['nominal'] = (int) preg_replace('/\D/', '', $request->nominal);

        Pengeluaran::create($validated);

        return redirect()->route('master.pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        return redirect()->route('master.pengeluaran.index');
    }

    // Update pengeluaran
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'nominal' => 'required',
            'tanggal' => 'required|date',
        ]);

        $validated['nominal'] = (int) preg_replace('/\D/', '', $request->nominal);

        $pengeluaran->update($validated);

        return redirect()->route('master.pengeluaran.index')->with('success', 'Pengeluaran berhasil diperbarui');
    }

    // Hapus pengeluaran
    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return redirect()->route('master.pengeluaran.index')->with('success', 'Pengeluaran berhasil dihapus');
    }
}
