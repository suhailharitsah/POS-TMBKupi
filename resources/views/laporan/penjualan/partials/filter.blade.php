<div class="bg-white p-4 rounded-xl shadow">
  <form action="{{ route('laporan.penjualan') }}" method="GET" class="flex items-end gap-4">

    <div>
      <label class="text-sm font-medium">Tanggal Mulai</label>
      <input type="date" name="start_date" value="{{ $tanggalStart }}" class="mt-1 border rounded-lg p-2">
    </div>

    <div>
      <label class="text-sm font-medium">Tanggal Akhir</label>
      <input type="date" name="end_date" value="{{ $tanggalEnd }}" class="mt-1 border rounded-lg p-2">
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
      Filter
    </button>

  </form>
</div>
