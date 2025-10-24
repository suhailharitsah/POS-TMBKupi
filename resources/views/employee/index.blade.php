@extends('layouts.app')

@section('title', 'Karyawan')
@section('page-title', 'Daftar Karyawan')

@section('content')
  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 lg:p-8">
    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-xl p-6 border border-gray-100">

      {{-- Header --}}
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">👥 Daftar Karyawan</h2>
        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow">
          + Tambah Karyawan
        </a>
      </div>

      {{-- Tabel Karyawan --}}
      <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg">
          <thead class="bg-gray-100 text-gray-700">
            <tr>
              <th class="px-4 py-2 border-b text-left">#</th>
              <th class="px-4 py-2 border-b text-left">Nama</th>
              <th class="px-4 py-2 border-b text-left">Jabatan</th>
              <th class="px-4 py-2 border-b text-left">No. Telepon</th>
              <th class="px-4 py-2 border-b text-left">Aksi</th>
            </tr>
          </thead>
          <tbody class="text-gray-600">
            {{-- Nanti data di-loop di sini --}}
            <tr>
              <td class="px-4 py-2 border-b">1</td>
              <td class="px-4 py-2 border-b">Rizky</td>
              <td class="px-4 py-2 border-b">Barista</td>
              <td class="px-4 py-2 border-b">0812-3456-7890</td>
              <td class="px-4 py-2 border-b">
                <div class="flex space-x-2">
                  <a href="#" class="text-blue-600 hover:underline">Edit</a>
                  <a href="#" class="text-red-600 hover:underline">Hapus</a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
@endsection
