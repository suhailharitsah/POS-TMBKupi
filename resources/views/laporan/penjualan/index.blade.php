@extends('layouts.app')

@section('content')
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto space-y-6">

      {{-- Header dengan Glassmorphism --}}
      <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20 p-6">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-4">
            {{-- Tombol Back --}}
            <a href="{{ route('laporan.index') }}"
              class="group flex items-center justify-center w-11 h-11 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 hover:from-indigo-50 hover:to-indigo-100 border border-gray-200 hover:border-indigo-300 transition-all duration-300 hover:shadow-md hover:scale-105">
              <span class="iconify text-gray-600 group-hover:text-indigo-600 transition-colors"
                data-icon="solar:arrow-left-outline" data-width="22"></span>
            </a>

            {{-- Judul dengan Icon --}}
            <div class="flex items-center gap-3">
              <div
                class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/30">
                <span class="iconify text-white" data-icon="solar:chart-2-bold" data-width="24"></span>
              </div>
              <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                  Laporan Penjualan
                </h1>
                <p class="text-sm text-gray-500 mt-0.5">Analisis dan ringkasan transaksi penjualan</p>
              </div>
            </div>
          </div>

          {{-- Action Buttons --}}
          <div class="hidden sm:flex items-center gap-2">
            <button
              class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white hover:bg-gray-50 border border-gray-200 hover:border-gray-300 transition-all duration-300 hover:shadow-md text-gray-700 hover:text-gray-900">
              <span class="iconify" data-icon="solar:download-outline" data-width="18"></span>
              <span class="text-sm font-medium">Export</span>
            </button>
            <button
              class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 hover:shadow-lg hover:shadow-indigo-500/30 text-white">
              <span class="iconify" data-icon="solar:printer-outline" data-width="18"></span>
              <span class="text-sm font-medium">Print</span>
            </button>
          </div>
        </div>
      </div>

      {{-- Filter dengan Card Modern --}}
      <div
        class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20 p-6 hover:shadow-xl transition-shadow duration-300">
        <div class="flex items-center gap-2 mb-4">
          <span class="iconify text-indigo-600" data-icon="solar:filter-bold" data-width="20"></span>
          <h2 class="text-lg font-semibold text-gray-800">Filter Periode</h2>
        </div>
        @include('laporan.penjualan.partials.filter', [
            'tanggalStart' => $tanggalStart,
            'tanggalEnd' => $tanggalEnd,
        ])
      </div>

      {{-- Summary Cards dengan Gradient --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Total Pendapatan --}}
        <div
          class="group relative bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden hover:scale-105">
          <div
            class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
          </div>
          <div class="relative p-6">
            <div class="flex items-start justify-between mb-4">
              <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm">
                <span class="iconify text-white" data-icon="solar:wallet-money-bold" data-width="24"></span>
              </div>
              <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm text-white text-xs font-medium">
                Total
              </span>
            </div>
            <div>
              <p class="text-emerald-100 text-sm font-medium mb-1">Total Pendapatan</p>
              <h3 class="text-3xl font-bold text-white mb-1">
                Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
              </h3>
              <p class="text-emerald-100 text-xs flex items-center gap-1">
                <span class="iconify" data-icon="solar:arrow-up-bold" data-width="14"></span>
                <span>+12.5% dari periode sebelumnya</span>
              </p>
            </div>
          </div>
        </div>

        {{-- Total Transaksi --}}
        <div
          class="group relative bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden hover:scale-105">
          <div
            class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
          </div>
          <div class="relative p-6">
            <div class="flex items-start justify-between mb-4">
              <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm">
                <span class="iconify text-white" data-icon="solar:cart-check-bold" data-width="24"></span>
              </div>
              <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm text-white text-xs font-medium">
                Jumlah
              </span>
            </div>
            <div>
              <p class="text-blue-100 text-sm font-medium mb-1">Total Transaksi</p>
              <h3 class="text-3xl font-bold text-white mb-1">
                {{ number_format($totalTransaksi ?? 0, 0, ',', '.') }}
              </h3>
              <p class="text-blue-100 text-xs flex items-center gap-1">
                <span class="iconify" data-icon="solar:arrow-up-bold" data-width="14"></span>
                <span>+8.3% dari periode sebelumnya</span>
              </p>
            </div>
          </div>
        </div>

        {{-- Rata-rata Transaksi --}}
        <div
          class="group relative bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden hover:scale-105">
          <div
            class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
          </div>
          <div class="relative p-6">
            <div class="flex items-start justify-between mb-4">
              <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm">
                <span class="iconify text-white" data-icon="solar:chart-bold" data-width="24"></span>
              </div>
              <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm text-white text-xs font-medium">
                Rata-rata
              </span>
            </div>
            <div>
              <p class="text-purple-100 text-sm font-medium mb-1">Rata-rata per Transaksi</p>
              <h3 class="text-3xl font-bold text-white mb-1">
                Rp {{ number_format($rataRata ?? 0, 0, ',', '.') }}
              </h3>
              <p class="text-purple-100 text-xs flex items-center gap-1">
                <span class="iconify" data-icon="solar:arrow-up-bold" data-width="14"></span>
                <span>+5.7% dari periode sebelumnya</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      {{-- Table dengan Modern Design --}}
      <div
        class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-white/20 overflow-hidden hover:shadow-xl transition-shadow duration-300">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <span class="iconify text-indigo-600" data-icon="solar:list-bold" data-width="22"></span>
              <h2 class="text-lg font-semibold text-gray-800">Detail Transaksi</h2>
            </div>
            <div class="flex items-center gap-2">
              <input type="search" placeholder="Cari transaksi..."
                class="px-4 py-2 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 outline-none transition-all text-sm">
              <button class="p-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors">
                <span class="iconify text-gray-600" data-icon="solar:magnifer-outline" data-width="18"></span>
              </button>
            </div>
          </div>
        </div>

        <div class="overflow-x-auto">
          @include('laporan.penjualan.partials.table', [
              'transaksi' => $transaksi,
          ])
        </div>
      </div>

    </div>
  </div>
@endsection
