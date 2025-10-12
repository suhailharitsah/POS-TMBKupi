<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  // Tampilkan daftar pengguna
  public function index()
  {
    $users = User::latest()->get();
    return view('users.index', compact('users'));
  }

  // Hapus pengguna
  public function destroy($id)
  {
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
  }
}
