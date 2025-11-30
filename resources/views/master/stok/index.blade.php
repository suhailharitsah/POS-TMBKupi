@extends('layouts.app')

@section('content')
  <div class="p-6 space-y-6">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-4">
      <a href="{{ route('master.index') }}" class="text-gray-600 hover:text-gray-900 transition">
        <span class="iconify" data-icon="solar:arrow-left-outline" data-width="26"></span>
      </a>
      <h1 class="text-xl font-semibold">Stok Produk</h1>
    </div>

    {{-- Card Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

      <div class="p-4 bg-white shadow rounded-xl">
        <p class="text-sm text-gray-600">Total Produk</p>
        <h3 class="text-xl font-semibold">{{ $totalProduk }}</h3>
      </div>

      <div class="p-4 bg-white shadow rounded-xl">
        <p class="text-sm text-gray-600">Stok Minimum</p>
        <h3 class="text-xl font-semibold">
          {{-- Karena stok BELUM ADA di DB --}}
          <span class="text-gray-400">Belum tersedia</span>
        </h3>
      </div>

      <div class="p-4 bg-white shadow rounded-xl">
        <p class="text-sm text-gray-600">Produk Hampir Habis</p>
        <h3 class="text-xl font-semibold text-red-500">
          {{-- Karena stok BELUM ADA di DB --}}
          <span class="text-gray-400">Belum tersedia</span>
        </h3>
      </div>

    </div>

    {{-- Table --}}
    <div class="bg-white shadow rounded-xl p-4 overflow-x-auto">

      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-gray-100">
            <th class="p-3 text-left">Produk</th>
            <th class="p-3 text-center">Kategori</th>
            <th class="p-3 text-center">Harga</th>
            <th class="p-3 text-center">Stok</th>
            <th class="p-3 text-center">Status</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($produk as $item)
            <tr class="border-t">
              <td class="p-3">{{ $item->nama }}</td>

              <td class="p-3 text-center">{{ $item->kategori }}</td>

              <td class="p-3 text-center">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>

              {{-- Karena field stok BELUM tersedia --}}
              <td class="p-3 text-center text-gray-400 italic">
                - belum ada -
              </td>

              <td class="p-3 text-center text-gray-400 italic">
                - tidak diketahui -
              </td>
            </tr>
          @endforeach

        </tbody>
      </table>

    </div>

  </div>
@endsection
