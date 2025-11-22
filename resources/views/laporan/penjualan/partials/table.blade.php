<div class="bg-white rounded-xl shadow overflow-hidden">

  <table class="w-full text-left">
    <thead class="bg-gray-100 text-gray-700">
      <tr>
        <th class="p-3">Tanggal</th>
        <th class="p-3">Kode</th>
        <th class="p-3">Pelanggan</th>
        <th class="p-3">Total</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($transaksi as $t)
        <tr class="border-t">
          <td class="p-3">{{ \Carbon\Carbon::parse($t->created_at)->translatedFormat('d M Y H:i') }}</td>
          <td class="p-3">{{ $t->kode }}</td>
          <td class="p-3">{{ $t->pelanggan?->nama ?? '-' }}</td>
          <td class="p-3 font-semibold">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="text-center p-4 text-gray-500">Tidak ada data pada rentang tanggal ini</td>
        </tr>
      @endforelse
    </tbody>
  </table>

</div>
