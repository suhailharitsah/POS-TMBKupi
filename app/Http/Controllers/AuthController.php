<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  // Tampilkan halaman login
  public function showLogin()
  {
    return view('auth.login');
  }

  // Proses login
  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->intended(route('dashboard'));
    }

    return back()
      ->withErrors([
        'email' => 'Email atau password salah.',
      ])
      ->onlyInput('email');
  }

  // Tampilkan halaman register
  public function showRegister()
  {
    return view('auth.register');
  }

  // Proses register
  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users',
      'password' => 'required|confirmed|min:6',
    ]);

    \App\Models\User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
    ]);

    return back()->with('success', 'Akun berhasil didaftarkan! Silakan login terlebih dahulu.');
  }

  // Logout
  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
  }
}
