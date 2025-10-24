<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
  /**
   * Tampilkan daftar karyawan.
   */
  public function index()
  {
    // Ambil semua data karyawan dari database
    $employees = Employee::orderBy('nama')->get();

    return view('employee.index', compact('employees'));
  }

  /**
   * Tampilkan form tambah karyawan.
   */
  public function create()
  {
    return view('employee.create');
  }

  /**
   * Simpan data karyawan baru.
   */
  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required|string|max:100',
      'jabatan' => 'required|string|max:50',
      'telepon' => 'required|string|max:20',
    ]);

    Employee::create([
      'nama' => $request->nama,
      'jabatan' => $request->jabatan,
      'telepon' => $request->telepon,
    ]);

    return redirect()->route('employee.index')->with('success', 'Karyawan baru berhasil ditambahkan!');
  }

  /**
   * Tampilkan form edit karyawan.
   */
  public function edit($id)
  {
    $employee = Employee::findOrFail($id);

    return view('employee.edit', compact('employee'));
  }

  /**
   * Update data karyawan.
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required|string|max:100',
      'jabatan' => 'required|string|max:50',
      'telepon' => 'required|string|max:20',
    ]);

    $employee = Employee::findOrFail($id);
    $employee->update([
      'nama' => $request->nama,
      'jabatan' => $request->jabatan,
      'telepon' => $request->telepon,
    ]);

    return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil diperbarui!');
  }

  /**
   * Hapus data karyawan.
   */
  public function destroy($id)
  {
    $employee = Employee::findOrFail($id);
    $employee->delete();

    return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil dihapus!');
  }
}
