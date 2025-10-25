@extends('layouts.app')

@section('title', 'Edit Karyawan')
@section('page-title', 'Edit Karyawan')

@section('content')
  <div class="bg-white shadow-lg rounded-2xl p-8 max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
      <div class="flex items-center justify-between mb-2">
        <h2 class="text-2xl font-bold text-gray-800">Edit Data Karyawan</h2>
        <a href="{{ route('employee.index') }}"
          class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition-all duration-200 font-medium shadow-sm hover:shadow-md">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
          Kembali
        </a>
      </div>
      <p class="text-sm text-gray-500">Perbarui informasi karyawan pada formulir di bawah</p>
    </div>

    {{-- Form Edit --}}
    <form action="{{ route('employee.update', $employee->id) }}" method="POST" class="space-y-6">
      @csrf
      @method('PUT')

      {{-- Nama --}}
      <div>
        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
          <span class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Nama Lengkap
          </span>
        </label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $employee->nama) }}"
          class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-150 outline-none @error('nama') border-red-500 @enderror"
          placeholder="Masukkan nama lengkap karyawan" required>
        @error('nama')
          <div class="flex items-center mt-2 text-red-600 text-sm">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                clip-rule="evenodd" />
            </svg>
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Jabatan --}}
      <div>
        <label for="jabatan" class="block text-sm font-semibold text-gray-700 mb-2">
          <span class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            Jabatan
          </span>
        </label>
        <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $employee->jabatan) }}"
          class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-150 outline-none @error('jabatan') border-red-500 @enderror"
          placeholder="Contoh: Manager, Staff, Supervisor" required>
        @error('jabatan')
          <div class="flex items-center mt-2 text-red-600 text-sm">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                clip-rule="evenodd" />
            </svg>
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Telepon --}}
      <div>
        <label for="telepon" class="block text-sm font-semibold text-gray-700 mb-2">
          <span class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            No. Telepon
          </span>
        </label>
        <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $employee->telepon) }}"
          class="w-full px-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-150 outline-none @error('telepon') border-red-500 @enderror"
          placeholder="Contoh: 081234567890" required>
        @error('telepon')
          <div class="flex items-center mt-2 text-red-600 text-sm">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                clip-rule="evenodd" />
            </svg>
            {{ $message }}
          </div>
        @enderror
      </div>

      {{-- Info Box --}}
      <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
        <div class="flex items-start">
          <svg class="w-5 h-5 text-amber-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
              clip-rule="evenodd" />
          </svg>
          <div>
            <h4 class="text-sm font-semibold text-amber-800 mb-1">Perhatian</h4>
            <p class="text-sm text-amber-700">Pastikan data yang Anda masukkan sudah benar sebelum menyimpan perubahan.
            </p>
          </div>
        </div>
      </div>

      {{-- Divider --}}
      <div class="border-t border-gray-200 pt-6"></div>

      {{-- Action Buttons --}}
      <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
        <a href="{{ route('employee.index') }}"
          class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition-all duration-150 shadow-sm">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
          Batal
        </a>
        <button type="submit"
          class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-medium rounded-xl hover:from-amber-600 hover:to-amber-700 transition-all duration-150 shadow-md hover:shadow-lg">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
          </svg>
          Perbarui Data
        </button>
      </div>
    </form>

  </div>
@endsection
