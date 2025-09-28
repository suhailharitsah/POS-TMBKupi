@extends('layouts.app')

@section('title', 'Dashboard - TMB Kupi')
@section('page-title', 'Dashboard')

@section('content')
  <div class="space-y-6">

    {{-- 📊 Ringkasan Utama --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="p-5 bg-white rounded-2xl shadow hover:shadow-md transition w-full max-w-sm">
        <div class="flex items-center justify-between">
          <h2 class="text-sm font-medium text-gray-500">Sisa Kas</h2>
          <span class="iconify text-orange-600" data-icon="solar:dollar-bold-duotone" data-width="24"></span>
        </div>

        <div class="mt-2 flex flex-col">
          <span class="text-sm font-medium text-orange-500">Rp</span>
          <span class="text-2xl md:text-xl font-bold text-orange-600 truncate">500.000</span>
        </div>

        <p class="text-xs text-gray-400">Hari ini</p>
      </div>

      <div class="p-5 bg-white rounded-2xl shadow hover:shadow-md transition w-full max-w-sm">
        <div class="flex items-center justify-between">
          <h2 class="text-sm font-medium text-gray-500">Pendapatan</h2>
          <span class="iconify text-green-500" data-icon="solar:wallet-bold-duotone" data-width="24"></span>
        </div>

        <div class="mt-2 flex flex-col">
          <span class="text-sm font-medium text-green-500">Rp</span>
          <span class="text-2xl md:text-xl font-bold text-green-600 truncate">5.000.000</span>
        </div>

        <p class="text-xs text-gray-400">Total bulan ini</p>
      </div>

      <div class="p-5 bg-white rounded-2xl shadow hover:shadow-md transition w-full max-w-sm">
        <div class="flex items-center justify-between">
          <h2 class="text-sm font-medium text-gray-500">Pengeluaran</h2>
          <span class="iconify text-red-500" data-icon="solar:cart-cross-bold-duotone" data-width="24"></span>
        </div>

        <div class="mt-2 flex flex-col">
          <span class="text-sm font-medium text-red-500">Rp</span>
          <span class="text-2xl md:text-xl font-bold text-red-600 truncate">4.000.000</span>
        </div>

        <p class="text-xs text-gray-400">Total bulan ini</p>
      </div>

      <div class="p-5 bg-white rounded-2xl shadow hover:shadow-md transition w-full max-w-sm">
        <div class="flex items-center justify-between">
          <h2 class="text-sm font-medium text-gray-500">Transaksi</h2>
          <span class="iconify text-purple-500" data-icon="solar:clipboard-check-bold-duotone" data-width="24"></span>
        </div>

        <div class="mt-2 flex flex-col">
          <span class="text-sm font-medium text-purple-500">Rp</span>
          <span class="text-2xl md:text-xl font-bold text-purple-600 truncate">821.000</span>
        </div>

        <p class="text-xs text-gray-400">Hari ini</p>
      </div>
    </div>

    {{-- 📈 Grafik Penjualan --}}
    <div class="bg-white rounded-2xl shadow p-6">
      <h2 class="text-lg font-semibold mb-4">Grafik Penjualan</h2>
      <div class="h-64">
        <canvas id="salesChart"></canvas>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      {{-- 🛍️ Transaksi Terbaru --}}
      <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Transaksi Terbaru</h2>
        <ul class="divide-y divide-gray-100">
          <li class="py-3 flex justify-between">
            <span class="text-gray-600">INV-001</span>
            <span class="font-semibold text-green-600">Rp 50.000</span>
          </li>
          <li class="py-3 flex justify-between">
            <span class="text-gray-600">INV-002</span>
            <span class="font-semibold text-green-600">Rp 75.000</span>
          </li>
          <li class="py-3 flex justify-between">
            <span class="text-gray-600">INV-003</span>
            <span class="font-semibold text-green-600">Rp 120.000</span>
          </li>
        </ul>
      </div>

      {{-- 🍵 Produk Terlaris --}}
      <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Produk Terlaris</h2>
        <ul class="space-y-3">
          <li class="flex justify-between">
            <span class="text-gray-700">Es Kopi Susu</span>
            <span class="font-semibold text-gray-900">120x</span>
          </li>
          <li class="flex justify-between">
            <span class="text-gray-700">Americano</span>
            <span class="font-semibold text-gray-900">95x</span>
          </li>
          <li class="flex justify-between">
            <span class="text-gray-700">Cappuccino</span>
            <span class="font-semibold text-gray-900">80x</span>
          </li>
        </ul>
      </div>
    </div>

    {{-- 📦 Stok Menipis --}}
    <div class="bg-white rounded-2xl shadow p-6">
      <h2 class="text-lg font-semibold mb-4">Stok Menipis</h2>
      <ul class="space-y-3">
        <li class="flex justify-between text-red-600">
          <span>Susu Full Cream</span>
          <span>2 Liter</span>
        </li>
        <li class="flex justify-between text-red-600">
          <span>Gula Aren</span>
          <span>1 Kg</span>
        </li>
        <li class="flex justify-between text-yellow-600">
          <span>Kopi Bubuk</span>
          <span>5 Kg</span>
        </li>
      </ul>
    </div>

    {{-- 🔔 Reminder / Notifikasi --}}
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg shadow">
      <h2 class="text-base font-semibold text-yellow-700 mb-1">Notifikasi</h2>
      <p class="text-sm text-yellow-600">Ada 3 pesanan Take-Away belum diambil.</p>
    </div>
  </div>

  {{-- Script untuk Chart.js --}}
  <script>
    const ctx = document.getElementById('salesChart');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        datasets: [{
          label: 'Penjualan',
          data: [12, 19, 14, 20, 25, 30, 28],
          borderColor: '#10B981',
          backgroundColor: 'rgba(16,185,129,0.2)',
          tension: 0.3,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false // wajib untuk bisa diatur tingginya via CSS
      }
    });
  </script>
@endsection
