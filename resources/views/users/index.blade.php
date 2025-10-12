@extends('layouts.app')

@section('title', 'Pengguna')
@section('page-title', 'Daftar Pengguna')

@section('content')
  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 lg:p-8">
    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-2xl p-6 border border-gray-200">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h2>
        <a href="#" class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
          + Tambah Pengguna
        </a>
      </div>

      {{-- Table pengguna --}}
      <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
          <thead class="bg-indigo-600 text-white">
            <tr>
              <th class="px-4 py-2 text-left text-sm font-semibold">#</th>
              <th class="px-4 py-2 text-left text-sm font-semibold">Nama</th>
              <th class="px-4 py-2 text-left text-sm font-semibold">Email</th>
              <th class="px-4 py-2 text-left text-sm font-semibold">Tanggal Dibuat</th>
              <th class="px-4 py-2 text-center text-sm font-semibold">Aksi</th>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            @forelse ($users as $user)
              <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">{{ $user->created_at->format('d M Y') }}</td>
                <td class="px-4 py-2 text-center">
                  <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                    onsubmit="return confirm('Yakin hapus pengguna ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                      Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data pengguna</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
