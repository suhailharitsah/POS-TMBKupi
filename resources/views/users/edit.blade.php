@extends('layouts.app')

@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Pengguna')

@section('content')
  <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">

      {{-- Header Card --}}
      <div class="bg-white rounded-t-2xl shadow-lg border-b-2 border-indigo-100 p-6">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <div
              class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
              <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 20h9M12 4h9m-9 8h9M4 8h.01M4 16h.01" />
              </svg>
            </div>
            <div>
              <h2 class="text-2xl font-bold text-gray-900">Edit Pengguna</h2>
              <p class="text-sm text-gray-500 mt-1">Perbarui informasi pengguna yang sudah terdaftar</p>
            </div>
          </div>
          <a href="{{ route('users.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition-all duration-200 font-medium shadow-sm hover:shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
          </a>
        </div>
      </div>

      {{-- Form Card --}}
      <div class="bg-white rounded-b-2xl shadow-lg p-8">
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
          @csrf
          @method('PUT')

          {{-- Nama Lengkap --}}
          <div>
            <label class="flex items-center text-gray-700 font-semibold mb-2">
              <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              Nama Lengkap
              <span class="text-red-500 ml-1">*</span>
            </label>
            <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" required
              class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all duration-200 hover:border-gray-300"
              placeholder="Masukkan nama lengkap">
            @error('nama')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Email --}}
          <div>
            <label class="flex items-center text-gray-700 font-semibold mb-2">
              <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
              Email
              <span class="text-red-500 ml-1">*</span>
            </label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
              class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all duration-200 hover:border-gray-300"
              placeholder="contoh@email.com">
            @error('email')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Nomor Telepon --}}
          <div>
            <label class="flex items-center text-gray-700 font-semibold mb-2">
              <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
              Nomor Telepon
            </label>
            <input type="text" name="telepon" value="{{ old('telepon', $user->telepon) }}"
              class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all duration-200 hover:border-gray-300"
              placeholder="08xxxxxxxxxx">
            @error('telepon')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Hak Akses --}}
          <div x-data="{ open: false, selected: '{{ old('role', $user->role) }}', options: ['admin', 'kasir', 'pegawai'] }">
            <label class="flex items-center text-gray-700 font-semibold mb-2">
              <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
              </svg>
              Hak Akses
            </label>
            <div class="relative">
              <button type="button" @click="open = !open"
                class="w-full flex justify-between items-center px-4 py-3 border-2 border-gray-200 rounded-xl bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 hover:border-gray-300 transition-all">
                <span x-text="selected ? selected.charAt(0).toUpperCase() + selected.slice(1) : 'Pilih Hak Akses'"
                  :class="selected ? 'text-gray-900' : 'text-gray-400'"></span>
                <svg xmlns="http://www.w3.org/2000/svg"
                  class="w-5 h-5 text-gray-500 transform transition-transform duration-200"
                  :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                  stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div x-show="open" @click.away="open = false"
                class="absolute z-10 mt-2 w-full bg-white border-2 border-gray-200 rounded-xl shadow-xl overflow-hidden">
                <template x-for="option in options" :key="option">
                  <button type="button" @click="selected = option; open = false"
                    class="w-full text-left px-4 py-3 hover:bg-indigo-50 text-gray-700 flex items-center space-x-3"
                    :class="{ 'bg-indigo-100 font-semibold text-indigo-700': selected === option }">
                    <svg x-show="selected === option" class="w-5 h-5 text-indigo-600" fill="currentColor"
                      viewBox="0 0 20 20">
                      <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                    </svg>
                    <span x-text="option.charAt(0).toUpperCase() + option.slice(1)"></span>
                  </button>
                </template>
              </div>
              <input type="hidden" name="role" :value="selected">
            </div>
          </div>

          {{-- Password (opsional ubah) --}}
          <div x-data="{ show: false }">
            <label class="flex items-center text-gray-700 font-semibold mb-2">
              <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
              Password Baru (Opsional)
            </label>
            <div class="relative">
              <input :type="show ? 'text' : 'password'" name="password"
                placeholder="Kosongkan jika tidak ingin mengubah"
                class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 hover:border-gray-300 transition-all">
              <button type="button" @click="show = !show"
                class="absolute inset-y-0 right-0 flex items-center pr-4 group">
                <svg x-show="!show" class="w-5 h-5 text-gray-500 group-hover:text-indigo-600" fill="none"
                  stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg x-show="show" class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.944-9.542-7a9.97 9.97 0 012.47-4.357m3.378-2.313A9.969 9.969 0 0112 5c4.478 0 8.269 2.944 9.542 7a9.974 9.974 0 01-4.07 5.218M15 12a3 3 0 00-3-3m-3 3l-9 9" />
                </svg>
              </button>
            </div>
          </div>

          {{-- Tombol Simpan --}}
          <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
            <a href="{{ route('users.index') }}"
              class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all duration-200 shadow-sm hover:shadow-md">
              Batal
            </a>
            <button type="submit"
              class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center space-x-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              <span>Update Pengguna</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
