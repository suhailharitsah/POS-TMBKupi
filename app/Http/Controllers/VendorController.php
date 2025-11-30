<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
  public function index()
  {
    $vendors = Vendor::orderBy('nama')->paginate(10);

    return view('master.vendor.index', compact('vendors'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'nama' => 'required|string|max:255',
      'kontak' => 'nullable|string|max:255',
    ]);

    Vendor::create($validated);

    return redirect()->route('master.vendor.index')->with('success', 'Vendor berhasil ditambahkan.');
  }

  public function update(Request $request, Vendor $vendor)
  {
    $validated = $request->validate([
      'nama' => 'required|string|max:255',
      'kontak' => 'nullable|string|max:255',
    ]);

    $vendor->update($validated);

    return redirect()->route('master.vendor.index')->with('success', 'Vendor berhasil diperbarui.');
  }

  public function destroy(Vendor $vendor)
  {
    if ($vendor->produks()->count() > 0) {
      return back()->with('error', 'Vendor tidak bisa dihapus karena memiliki produk.');
    }

    $vendor->delete();

    return redirect()->route('master.vendor.index')->with('success', 'Vendor berhasil dihapus.');
  }
}
