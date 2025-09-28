@extends('layouts.app')

@section('title', 'Master - TMB Kupi')
@section('page-title', 'Menu Master')

@section('content')
  <div class="space-y-6">
    <div class="p-5 bg-white rounded-2xl shadow hover:shadow-md transition">
      <h2 class="text-lg font-semibold text-gray-700">Master Data</h2>
      <p class="text-sm text-gray-500 mt-1">
        Kelola data master seperti produk, pengeluaran, pelanggan, dan lainnya.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <a href="{{ route('master.produk.index') }}"
        class="p-5 bg-white rounded-2xl shadow transition-all duration-300 flex flex-col gap-3 hover:shadow-xl hover:-translate-y-1 hover:bg-gradient-to-br hover:from-blue-50 hover:to-blue-100">
        <span class="iconify text-blue-500 group-hover:scale-110 transition-transform" data-icon="solar:box-bold-duotone"
          data-width="32"></span>
        <h3 class="font-semibold text-gray-700">Produk</h3>
        <p class="text-sm text-gray-500">Kelola daftar produk.</p>
      </a>

      <a href="{{ route('master.pengeluaran.index') }}"
        class="p-5 bg-white rounded-2xl shadow transition-all duration-300 flex flex-col gap-3 hover:shadow-xl hover:-translate-y-1 hover:bg-gradient-to-br hover:from-red-50 hover:to-red-100">
        <span class="iconify text-red-500 group-hover:scale-110 transition-transform"
          data-icon="solar:clipboard-remove-bold-duotone" data-width="32"></span>
        <h3 class="font-semibold text-gray-700">Pengeluaran</h3>
        <p class="text-sm text-gray-500">Kelola kas dan pengeluaran.</p>
      </a>

      <a href="#"
        class="p-5 bg-white rounded-2xl shadow transition-all duration-300 flex flex-col gap-3 hover:shadow-xl hover:-translate-y-1 hover:bg-gradient-to-br hover:from-purple-50 hover:to-purple-100">
        <span class="iconify text-purple-500 group-hover:scale-110 transition-transform"
          data-icon="solar:users-group-two-rounded-bold-duotone" data-width="32"></span>
        <h3 class="font-semibold text-gray-700">Pelanggan</h3>
        <p class="text-sm text-gray-500">Kelola data pelanggan.</p>
      </a>
    </div>

  </div>
@endsection
