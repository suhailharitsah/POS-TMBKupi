@extends('layouts.app')

@section('content')
  <div class="p-6 space-y-6">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
      <a href="{{ route('master.index') }}" class="text-gray-600 hover:text-gray-900 transition">
        <span class="iconify" data-icon="solar:arrow-left-outline" data-width="26"></span>
      </a>

      <h1 class="text-xl font-semibold">Vendor</h1>

      {{-- Tombol Tambah Vendor --}}
      <button onclick="openModal()" class="ml-auto px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
        Tambah Vendor
      </button>
    </div>


    {{-- Table --}}
    <div class="bg-white shadow rounded-xl p-4 overflow-x-auto">
      <table class="w-full">
        <thead class="bg-gray-100">
          <tr>
            <th class="p-3 text-left">Nama Vendor</th>
            <th class="p-3 text-left">Kontak</th>
            <th class="p-3 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($vendors as $vendor)
            <tr class="border-t">
              <td class="p-3">{{ $vendor->nama }}</td>
              <td class="p-3">{{ $vendor->kontak ?? '-' }}</td>
              <td class="p-3 text-center">
                <form action="{{ route('master.vendor.destroy', $vendor->id) }}" method="POST"
                  onsubmit="return confirm('Hapus vendor ini?')">
                  @csrf
                  @method('DELETE')
                  <button class="px-3 py-1 bg-red-500 text-white rounded">Hapus</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="mt-4">
        {{ $vendors->links() }}
      </div>
    </div>
  </div>
@endsection
