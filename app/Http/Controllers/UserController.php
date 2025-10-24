<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  // 🔹 Tampilkan daftar pengguna
  public function index()
  {
    $users = User::latest()->get();
    return view('users.index', compact('users'));
  }

  // 🔹 Form tambah pengguna
  public function create()
  {
    return view('users.create');
  }

  // 🔹 Simpan pengguna baru
  public function store(Request $request)
  {
    $validated = $request->validate([
      'nama' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'telepon' => 'nullable|string|max:20',
      'role' => 'required|string|in:admin,kasir,pegawai',
      'password' => 'required|min:8',
    ]);

    User::create([
      'name' => $validated['nama'],
      'email' => $validated['email'],
      'telepon' => $validated['telepon'] ?? null,
      'role' => $validated['role'],
      'password' => Hash::make($validated['password']),
    ]);

    return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
  }

  // 🔹 Form edit pengguna
  public function edit($id)
  {
    $user = User::findOrFail($id);
    return view('users.edit', compact('user'));
  }

  // 🔹 Update pengguna
  public function update(Request $request, $id)
  {
    $user = User::findOrFail($id);

    $validated = $request->validate([
      'nama' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email,' . $user->id,
      'telepon' => 'nullable|string|max:20',
      'role' => 'required|string|in:admin,kasir,pegawai',
      'password' => 'nullable|min:8',
    ]);

    // Update field
    $user->name = $validated['nama'];
    $user->email = $validated['email'];
    $user->telepon = $validated['telepon'] ?? null;
    $user->role = $validated['role'];

    if (!empty($validated['password'])) {
      $user->password = Hash::make($validated['password']);
    }

    $user->save();

    return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui.');
  }

  // 🔹 Hapus pengguna
  public function destroy($id)
  {
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
  }
}
