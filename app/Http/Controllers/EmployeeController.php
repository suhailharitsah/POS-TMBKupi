<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
  /**
   * 🔹 Tampilkan daftar karyawan (dengan pagination)
   */
  public function index(Request $request)
  {
    // Ambil 10 data per halaman, bisa ubah jadi 5/15/20 sesuai kebutuhan
    $employees = Employee::orderBy('nama', 'asc')->paginate(10);

    // Kirim data + query string agar pagination tetap konsisten saat ada filter
    return view('employee.index', compact('employees'));
  }

  /**
   * 🔹 Form tambah karyawan
   */
  public function create()
  {
    return view('employee.create');
  }

  /**
   * 🔹 Simpan karyawan baru
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'nama' => ['required', 'string', 'max:100'],
      'jabatan' => ['required', 'string', 'max:50'],
      'telepon' => ['required', 'string', 'max:20'],
    ]);

    Employee::create($validated);

    return redirect()
      ->route('employee.index')
      ->with('success', '✅ Karyawan baru berhasil ditambahkan!');
  }

  /**
   * 🔹 Edit data karyawan
   */
  public function edit($id)
  {
    $employee = Employee::findOrFail($id);
    return view('employee.edit', compact('employee'));
  }

  /**
   * 🔹 Update data
   */
  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'nama' => ['required', 'string', 'max:100'],
      'jabatan' => ['required', 'string', 'max:50'],
      'telepon' => ['required', 'string', 'max:20'],
    ]);

    $employee = Employee::findOrFail($id);
    $employee->update($validated);

    return redirect()
      ->route('employee.index')
      ->with('success', '✏️ Data karyawan berhasil diperbarui!');
  }

  /**
   * 🔹 Hapus data
   */
  public function destroy($id)
  {
    $employee = Employee::findOrFail($id);
    $employee->delete();

    return redirect()
      ->route('employee.index')
      ->with('success', '🗑️ Data karyawan berhasil dihapus!');
  }
}
