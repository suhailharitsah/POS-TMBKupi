<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

  <div class="bg-white p-5 rounded-xl shadow">
    <p class="text-gray-500 text-sm">Total Pendapatan</p>
    <p class="text-xl font-semibold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
  </div>

  <div class="bg-white p-5 rounded-xl shadow">
    <p class="text-gray-500 text-sm">Total Transaksi</p>
    <p class="text-xl font-semibold">{{ $totalTransaksi }}</p>
  </div>

  <div class="bg-white p-5 rounded-xl shadow">
    <p class="text-gray-500 text-sm">Rata-rata Per Transaksi</p>
    <p class="text-xl font-semibold">Rp {{ number_format($rataRata, 0, ',', '.') }}</p>
  </div>

</div>
