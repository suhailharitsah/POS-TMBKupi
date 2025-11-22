@extends('layouts.app')

@section('content')
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto space-y-8">

      {{-- Header Section --}}
      <div class="text-center space-y-4">
        <div
          class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-2xl shadow-indigo-500/30 mb-4">
          <span class="iconify text-white" data-icon="solar:document-text-bold" data-width="40"></span>
        </div>
        <div>
          <h1
            class="text-4xl font-bold bg-gradient-to-r from-gray-800 via-indigo-600 to-purple-600 bg-clip-text text-transparent mb-2">
            Menu Laporan
          </h1>
          <p class="text-gray-600 text-lg">Pilih jenis laporan yang ingin Anda lihat</p>
        </div>
      </div>

      {{-- Report Cards Grid --}}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Laporan Penjualan --}}
        <a href="{{ route('laporan.penjualan') }}"
          class="group relative bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20 p-6 hover:shadow-2xl transition-all duration-300 hover:scale-105 overflow-hidden">
          {{-- Gradient Background on Hover --}}
          <div
            class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-teal-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          </div>

          {{-- Content --}}
          <div class="relative z-10">
            <div class="flex items-start justify-between mb-4">
              <div
                class="flex items-center justify-center w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 shadow-lg shadow-emerald-500/30 group-hover:shadow-emerald-500/50 transition-shadow">
                <span class="iconify text-white" data-icon="solar:chart-2-bold" data-width="28"></span>
              </div>
              <span class="iconify text-gray-400 group-hover:text-emerald-600 transition-colors"
                data-icon="solar:arrow-right-outline" data-width="24"></span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-emerald-600 transition-colors">
              Laporan Penjualan
            </h3>
            <p class="text-sm text-gray-600 leading-relaxed">
              Lihat ringkasan dan detail transaksi penjualan
            </p>
          </div>

          {{-- Corner Decoration --}}
          <div
            class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/5 to-transparent rounded-bl-full transform translate-x-16 -translate-y-16 group-hover:scale-150 transition-transform duration-500">
          </div>
        </a>

        {{-- Laporan Pengeluaran --}}
        <a href="#"
          class="group relative bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20 p-6 hover:shadow-2xl transition-all duration-300 hover:scale-105 overflow-hidden">
          <div
            class="absolute inset-0 bg-gradient-to-br from-rose-500/10 to-red-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          </div>

          <div class="relative z-10">
            <div class="flex items-start justify-between mb-4">
              <div
                class="flex items-center justify-center w-14 h-14 rounded-xl bg-gradient-to-br from-rose-500 to-red-600 shadow-lg shadow-rose-500/30 group-hover:shadow-rose-500/50 transition-shadow">
                <span class="iconify text-white" data-icon="solar:wallet-money-bold" data-width="28"></span>
              </div>
              <span class="iconify text-gray-400 group-hover:text-rose-600 transition-colors"
                data-icon="solar:arrow-right-outline" data-width="24"></span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-rose-600 transition-colors">
              Laporan Pengeluaran
            </h3>
            <p class="text-sm text-gray-600 leading-relaxed">
              Pantau semua pengeluaran operasional bisnis
            </p>
          </div>

          <div
            class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-rose-500/5 to-transparent rounded-bl-full transform translate-x-16 -translate-y-16 group-hover:scale-150 transition-transform duration-500">
          </div>
        </a>

        {{-- Laporan Laba Kotor --}}
        <a href="#"
          class="group relative bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20 p-6 hover:shadow-2xl transition-all duration-300 hover:scale-105 overflow-hidden">
          <div
            class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-orange-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          </div>

          <div class="relative z-10">
            <div class="flex items-start justify-between mb-4">
              <div
                class="flex items-center justify-center w-14 h-14 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 shadow-lg shadow-amber-500/30 group-hover:shadow-amber-500/50 transition-shadow">
                <span class="iconify text-white" data-icon="solar:dollar-minimalistic-bold" data-width="28"></span>
              </div>
              <span class="iconify text-gray-400 group-hover:text-amber-600 transition-colors"
                data-icon="solar:arrow-right-outline" data-width="24"></span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-amber-600 transition-colors">
              Laporan Laba Kotor
            </h3>
            <p class="text-sm text-gray-600 leading-relaxed">
              Analisis pendapatan dan laba kotor bisnis
            </p>
          </div>

          <div
            class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-500/5 to-transparent rounded-bl-full transform translate-x-16 -translate-y-16 group-hover:scale-150 transition-transform duration-500">
          </div>
        </a>

        {{-- Laporan Stok Produk --}}
        <a href="#"
          class="group relative bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20 p-6 hover:shadow-2xl transition-all duration-300 hover:scale-105 overflow-hidden">
          <div
            class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-indigo-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          </div>

          <div class="relative z-10">
            <div class="flex items-start justify-between mb-4">
              <div
                class="flex items-center justify-center w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg shadow-blue-500/30 group-hover:shadow-blue-500/50 transition-shadow">
                <span class="iconify text-white" data-icon="solar:box-bold" data-width="28"></span>
              </div>
              <span class="iconify text-gray-400 group-hover:text-blue-600 transition-colors"
                data-icon="solar:arrow-right-outline" data-width="24"></span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors">
              Laporan Stok Produk
            </h3>
            <p class="text-sm text-gray-600 leading-relaxed">
              Monitor ketersediaan stok produk real-time
            </p>
          </div>

          <div
            class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/5 to-transparent rounded-bl-full transform translate-x-16 -translate-y-16 group-hover:scale-150 transition-transform duration-500">
          </div>
        </a>

        {{-- Laporan Penjualan per Produk --}}
        <a href="#"
          class="group relative bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20 p-6 hover:shadow-2xl transition-all duration-300 hover:scale-105 overflow-hidden">
          <div
            class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-pink-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          </div>

          <div class="relative z-10">
            <div class="flex items-start justify-between mb-4">
              <div
                class="flex items-center justify-center w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 shadow-lg shadow-purple-500/30 group-hover:shadow-purple-500/50 transition-shadow">
                <span class="iconify text-white" data-icon="solar:cart-check-bold" data-width="28"></span>
              </div>
              <span class="iconify text-gray-400 group-hover:text-purple-600 transition-colors"
                data-icon="solar:arrow-right-outline" data-width="24"></span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-purple-600 transition-colors">
              Penjualan per Produk
            </h3>
            <p class="text-sm text-gray-600 leading-relaxed">
              Detail penjualan untuk setiap produk
            </p>
          </div>

          <div
            class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/5 to-transparent rounded-bl-full transform translate-x-16 -translate-y-16 group-hover:scale-150 transition-transform duration-500">
          </div>
        </a>

        {{-- Laporan Per Kasir --}}
        <a href="#"
          class="group relative bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20 p-6 hover:shadow-2xl transition-all duration-300 hover:scale-105 overflow-hidden">
          <div
            class="absolute inset-0 bg-gradient-to-br from-cyan-500/10 to-teal-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          </div>

          <div class="relative z-10">
            <div class="flex items-start justify-between mb-4">
              <div
                class="flex items-center justify-center w-14 h-14 rounded-xl bg-gradient-to-br from-cyan-500 to-teal-600 shadow-lg shadow-cyan-500/30 group-hover:shadow-cyan-500/50 transition-shadow">
                <span class="iconify text-white" data-icon="solar:user-check-rounded-bold" data-width="28"></span>
              </div>
              <span class="iconify text-gray-400 group-hover:text-cyan-600 transition-colors"
                data-icon="solar:arrow-right-outline" data-width="24"></span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-cyan-600 transition-colors">
              Laporan Per Kasir
            </h3>
            <p class="text-sm text-gray-600 leading-relaxed">
              Evaluasi performa transaksi setiap kasir
            </p>
          </div>

          <div
            class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-cyan-500/5 to-transparent rounded-bl-full transform translate-x-16 -translate-y-16 group-hover:scale-150 transition-transform duration-500">
          </div>
        </a>

      </div>

      {{-- Quick Stats Section (Optional) --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
        <div class="bg-white/80 backdrop-blur-xl rounded-xl shadow-md border border-white/20 p-4 text-center">
          <div
            class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-1">
            6
          </div>
          <p class="text-sm text-gray-600">Total Laporan Tersedia</p>
        </div>

        <div class="bg-white/80 backdrop-blur-xl rounded-xl shadow-md border border-white/20 p-4 text-center">
          <div
            class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-1">
            Real-time
          </div>
          <p class="text-sm text-gray-600">Update Data Otomatis</p>
        </div>

        <div class="bg-white/80 backdrop-blur-xl rounded-xl shadow-md border border-white/20 p-4 text-center">
          <div
            class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-1">
            Export
          </div>
          <p class="text-sm text-gray-600">Unduh dalam Format PDF/Excel</p>
        </div>
      </div>

    </div>
  </div>
@endsection
