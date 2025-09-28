  {{-- Riwayat Transaksi --}}
  <div
    class="mt-12 bg-gradient-to-br from-purple-50 via-indigo-50 to-cyan-50 rounded-3xl shadow-2xl p-8 border border-white/20">
    {{-- Header Section --}}
    <div class="flex items-center justify-between mb-8 flex-wrap gap-6">
      <div class="flex items-center gap-4">
        <div class="w-2 h-12 bg-gradient-to-b from-purple-500 via-indigo-500 to-cyan-500 rounded-full shadow-lg"></div>
        <div>
          <h2
            class="text-3xl font-black text-gray-800 bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
            📋 Riwayat Transaksi
          </h2>
          <p class="text-sm text-gray-600 mt-1">Kelola dan pantau semua transaksi Anda</p>
        </div>
      </div>

      {{-- Enhanced Filter Kalender --}}
      <div class="flex items-center gap-4 bg-white/80 backdrop-blur-sm rounded-2xl p-4 shadow-xl border border-white/50">
        <form method="GET" action="{{ route('transaksi.index') }}" class="flex items-center gap-4">
          {{-- Date Range Filters --}}
          <div class="flex items-center gap-3">
            <div class="relative">
              <label class="block text-xs font-semibold text-gray-700 mb-1">Dari Tanggal</label>
              <div class="relative">
                <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                  class="pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-200 bg-white/90 backdrop-blur-sm">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                </div>
              </div>
            </div>

            <div class="relative">
              <label class="block text-xs font-semibold text-gray-700 mb-1">Sampai Tanggal</label>
              <div class="relative">
                <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                  class="pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-200 bg-white/90 backdrop-blur-sm">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>

          {{-- Action Buttons --}}
          <div class="flex items-center gap-2 mt-4">
            <button type="submit"
              class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-purple-700 hover:to-indigo-700 focus:ring-4 focus:ring-purple-500/30 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
              <div class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Filter
              </div>
            </button>

            @if (request('tanggal_mulai') || request('tanggal_akhir'))
              <a href="{{ route('transaksi.index') }}"
                class="px-4 py-2.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-200 transition-all duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Reset
              </a>
            @endif
          </div>

        </form>
      </div>

      {{-- Transaction Count Badge --}}
      <div
        class="hidden md:block bg-gradient-to-r from-purple-500 to-indigo-500 text-white px-6 py-3 rounded-2xl shadow-xl">
        <div class="text-center">
          <div class="text-2xl font-bold">{{ $transaksis->total() }}</div>
          <div class="text-xs opacity-90">Total Transaksi Bulan Ini</div>
        </div>
      </div>

      {{-- Enhanced Desktop & Tablet View --}}
      <div class="hidden md:block">
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/30">
          <div class="overflow-x-auto">
            <table class="min-w-full">
              <thead>
                <tr class="bg-gradient-to-r from-slate-800 via-gray-800 to-slate-900">
                  <th class="px-8 py-6 text-left">
                    <div class="flex items-center gap-3">
                      <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                          </path>
                        </svg>
                      </div>
                      <div>
                        <div class="text-sm font-bold text-white">TANGGAL & WAKTU</div>
                        <div class="text-xs text-white/70">Waktu transaksi</div>
                      </div>
                    </div>
                  </th>
                  <th class="px-8 py-6 text-left">
                    <div class="flex items-center gap-3">
                      <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                      </div>
                      <div>
                        <div class="text-sm font-bold text-white">DETAIL PRODUK</div>
                        <div class="text-xs text-white/70">Item yang dibeli</div>
                      </div>
                    </div>
                  </th>
                  <th class="px-8 py-6 text-left">
                    <div class="flex items-center gap-3">
                      <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                          </path>
                        </svg>
                      </div>
                      <div>
                        <div class="text-sm font-bold text-white">TOTAL BAYAR</div>
                        <div class="text-xs text-white/70">Jumlah pembayaran</div>
                      </div>
                    </div>
                  </th>
                  <th class="px-8 py-6 text-left">
                    <div class="flex items-center gap-3">
                      <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                      </div>
                      <div>
                        <div class="text-sm font-bold text-white">STATUS</div>
                        <div class="text-xs text-white/70">Kondisi transaksi</div>
                      </div>
                    </div>
                  </th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-100/50">
                @forelse ($transaksis as $trx)
                  <tr class="{{ $loop->odd ? 'bg-white' : 'bg-slate-100' }} transition-all duration-300 group">
                    {{-- Kolom Tanggal --}}
                    <td class="px-8 py-6">
                      <div
                        class="flex items-center gap-4 p-3 rounded-xl transition-all duration-200 group-hover:scale-105 group-hover:shadow-sm ">
                        <div
                          class="w-12 h-12 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-2xl flex items-center justify-center shadow-lg transition-all duration-300">
                          <div class="text-center">
                            <div class="text-xs font-bold text-blue-700">
                              {{ $trx->created_at->timezone('Asia/Jakarta')->format('d') }}</div>
                            <div class="text-[10px] text-blue-600">
                              {{ $trx->created_at->timezone('Asia/Jakarta')->format('M') }}</div>
                          </div>
                        </div>
                        <div>
                          <div class="text-sm font-semibold text-gray-900 truncate">
                            {{ $trx->created_at->timezone('Asia/Jakarta')->translatedFormat('l, d M Y') }}
                          </div>
                          <div class="text-xs text-gray-500 flex items-center gap-1 truncate">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $trx->created_at->timezone('Asia/Jakarta')->format('H:i') }} WIB
                          </div>
                        </div>
                      </div>
                    </td>

                    {{-- Kolom Produk --}}
                    <td class="px-8 py-6">
                      <div class="space-y-3 max-w-md">
                        @foreach ($trx->details as $detail)
                          <div
                            class="flex items-center gap-3 p-3 rounded-xl transition-all duration-200 {{ $detail->produk->kategori === 'Makanan' ? 'bg-gradient-to-r from-orange-50 to-amber-50 border-l-4 border-orange-400' : 'bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-400' }} shadow-md hover:shadow-lg group-hover:scale-105">
                            {{-- Icon kategori --}}
                            <div
                              class="w-10 h-10 rounded-xl flex items-center justify-center {{ $detail->produk->kategori === 'Makanan' ? 'bg-gradient-to-br from-orange-100 to-red-100' : 'bg-gradient-to-br from-blue-100 to-cyan-100' }} shadow-sm">
                              @if ($detail->produk->kategori === 'Makanan')
                                <span class="text-lg">🍽️</span>
                              @else
                                <span class="text-lg">🥤</span>
                              @endif
                            </div>

                            {{-- Detail produk --}}
                            <div class="flex-1 min-w-0">
                              <p class="text-sm font-semibold text-gray-900 truncate">{{ $detail->produk->nama }}</p>
                              <div class="flex items-center gap-2 mt-1">
                                <span
                                  class="px-2 py-0.5 text-xs rounded-full font-medium {{ $detail->produk->kategori === 'Makanan' ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700' }}">
                                  {{ $detail->produk->kategori }}
                                </span>
                                <span class="text-xs text-gray-600 bg-gray-100 px-2 py-0.5 rounded-full">×
                                  {{ $detail->qty }}</span>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </td>

                    {{-- Kolom Total --}}
                    <td class="px-8 py-6">
                      <div class="flex items-center gap-3">
                        <div
                          class="w-10 h-10 bg-gradient-to-br from-green-100 to-emerald-100 rounded-xl flex items-center justify-center shadow-sm">
                          <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                            </path>
                          </svg>
                        </div>
                        <div>
                          {{-- Jumlah diperoleh (total belanja) --}}
                          <div class="text-base font-extrabold text-blue-600 truncate">
                            Rp {{ number_format($trx->total, 0, ',', '.') }}
                          </div>
                          <div class="text-sm text-gray-500 truncate">Harga</div>

                          {{-- Total pembayaran (uang dibayar customer) --}}
                          <div class="text-base font-bold text-green-600 truncate mt-2">
                            Rp {{ number_format($trx->bayar, 0, ',', '.') }}
                          </div>
                          <div class="text-sm text-gray-500 truncate">Pembayaran</div>

                          {{-- Kembalian jika ada --}}
                          @if ($trx->kembali > 0)
                            <div class="text-sm font-normal text-red-700 truncate mt-1">
                              Kembalian: <span class="font-semibold text-red-800">Rp
                                {{ number_format($trx->kembali, 0, ',', '.') }}</span>
                            </div>
                          @endif
                        </div>
                      </div>
                    </td>

                    {{-- Kolom Status + Aksi --}}
                    <td class="px-8 py-6">
                      <div class="flex items-center gap-3">
                        @if ($trx->status === 'Sukses')
                          <span
                            class="bg-green-100 text-green-800 px-3 py-1 rounded-xl text-sm font-semibold flex items-center gap-1 truncate">
                            ✅ Sukses
                          </span>
                        @elseif ($trx->status === 'Pending')
                          <span
                            class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-xl text-sm font-semibold flex items-center gap-1 truncate">
                            ⏳ Pending
                          </span>
                        @else
                          <span
                            class="bg-red-100 text-red-800 px-3 py-1 rounded-xl text-sm font-semibold flex items-center gap-1 truncate">
                            ❌ Gagal
                          </span>
                        @endif

                        {{-- Tombol hapus --}}
                        <form action="{{ route('transaksi.destroy', $trx->id) }}" method="POST"
                          class="inline ml-2 hapus-form">
                          @csrf
                          @method('DELETE')
                          <button type="button"
                            class="px-3 py-1 text-xs bg-red-600 text-white rounded-lg hover:bg-red-700 hapus-btn">
                            Hapus
                          </button>
                        </form>
                      </div>
                    </td>

                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="px-8 py-16 text-center">
                      <div class="flex flex-col items-center justify-center">
                        <div
                          class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center mb-6 shadow-lg">
                          <div class="text-4xl">📋</div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Transaksi</h3>
                        <p class="text-gray-500 max-w-sm">Riwayat transaksi Anda akan muncul di sini setelah melakukan
                          pembelian</p>
                      </div>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          {{-- Pagination khusus desktop --}}
          @if ($transaksis->hasPages())
            <div
              class="hidden md:block mt-8 bg-white/60 backdrop-blur-sm rounded-2xl shadow-xl border border-white/30 p-6">
              <div class="flex justify-center">
                {{ $transaksis->withQueryString()->links('vendor.pagination.flowbite') }}
              </div>
            </div>
          @endif
        </div>
      </div>

      {{-- Mobile View --}}
      <div class="md:hidden min-h-screen w-full">
        {{-- Header dengan Total Transaksi --}}
        <div class="p-4 mb-4">
          <div
            class="bg-gradient-to-r from-purple-500 to-indigo-500 rounded-2xl shadow-lg px-6 py-5 text-center text-white">
            <div class="text-3xl font-bold mb-1">{{ $transaksis->total() }}</div>
            <div class="text-sm opacity-90 font-medium">Total Transaksi Bulan Ini</div>
          </div>
        </div>

        {{-- Container untuk List Transaksi --}}
        <div class="space-y-6">
          @forelse ($transaksis as $trx)
            {{-- Card Transaksi --}}
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
              {{-- Header Transaksi --}}
              <div class="px-5 py-5 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                <div class="flex items-center justify-between mb-3">
                  <div class="flex items-center gap-3">
                    <div
                      class="w-14 h-14 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-xl flex items-center justify-center shadow-sm">
                      <div class="text-center">
                        <div class="text-base font-bold text-blue-700">{{ $trx->created_at->format('d') }}</div>
                        <div class="text-xs text-blue-600">{{ $trx->created_at->format('M') }}</div>
                      </div>
                    </div>
                    <div>
                      <h3 class="text-base font-semibold text-gray-900">{{ $trx->created_at->format('d M Y') }}</h3>
                      <p class="text-sm text-gray-500">{{ $trx->created_at->format('H:i') }} WIB</p>
                    </div>
                  </div>

                  {{-- Status Badge --}}
                  @if ($trx->status === 'Sukses')
                    <span
                      class="inline-flex items-center gap-2 px-3 py-1 text-sm font-semibold bg-green-100 text-green-800 rounded-full">
                      ✅ Sukses
                    </span>
                  @elseif ($trx->status === 'Pending')
                    <span
                      class="inline-flex items-center gap-2 px-3 py-1 text-sm font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                      ⏳ Pending
                    </span>
                  @else
                    <span
                      class="inline-flex items-center gap-2 px-3 py-1 text-sm font-semibold bg-red-100 text-red-800 rounded-full">
                      ❌ Gagal
                    </span>
                  @endif
                </div>
              </div>

              {{-- Detail Produk --}}
              <div class="p-5">
                <h4 class="flex items-center gap-2 text-base font-semibold text-gray-700 mb-4">
                  <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                  </svg>
                  Detail Produk
                </h4>

                <div class="space-y-3">
                  @foreach ($trx->details as $detail)
                    <div
                      class="flex items-center gap-3 p-3 rounded-xl shadow-sm {{ $detail->produk->kategori === 'Makanan' ? 'bg-gradient-to-r from-orange-50 to-red-50' : 'bg-gradient-to-r from-blue-50 to-cyan-50' }}">
                      <div class="flex-shrink-0">
                        <div
                          class="w-12 h-12 rounded-xl flex items-center justify-center shadow-sm {{ $detail->produk->kategori === 'Makanan' ? 'bg-gradient-to-br from-orange-100 to-red-100' : 'bg-gradient-to-br from-blue-100 to-cyan-100' }}">
                          @if ($detail->produk->kategori === 'Makanan')
                            <span class="text-xl">🍽️</span>
                          @else
                            <span class="text-xl">🥤</span>
                          @endif
                        </div>
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-900 text-base">{{ $detail->produk->nama }}</p>
                        <div class="flex items-center gap-2 mt-1">
                          <span
                            class="inline-block px-2 py-0.5 text-xs rounded-full font-medium {{ $detail->produk->kategori === 'Makanan' ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ $detail->produk->kategori }}
                          </span>
                          <span class="text-xs text-gray-600 font-semibold bg-gray-100 px-2 py-0.5 rounded-full">
                            Qty: {{ $detail->qty }}
                          </span>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>

              {{-- Footer dengan Tombol Hapus --}}
              <div class="px-5 py-4 bg-gray-50 border-t border-gray-100">
                <form action="{{ route('transaksi.destroy', $trx->id) }}" method="POST" class="hapus-form">
                  @csrf
                  @method('DELETE')
                  <button type="button"
                    class="w-full px-5 py-3 text-base font-semibold bg-red-500 text-white rounded-xl hover:bg-red-600 hapus-btn shadow">
                    Hapus Transaksi
                  </button>
                </form>
              </div>
            </div>
          @empty
            {{-- Empty State --}}
            <div class="bg-white shadow-lg p-12 text-center border border-gray-100 rounded-2xl">
              <div
                class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mb-6 shadow-md mx-auto">
                <div class="text-4xl">📋</div>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Transaksi</h3>
              <p class="text-gray-500 text-base mb-6">Riwayat transaksi Anda akan muncul di sini setelah pembelian</p>
              <a href="{{ route('produk.index') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-purple-500 text-white text-base font-semibold rounded-xl hover:bg-purple-600 shadow">
                Mulai Belanja
              </a>
            </div>
          @endforelse

          {{-- Pagination (masuk container list) --}}
          @if ($transaksis->hasPages())
            <div>
              <div class="flex justify-center">
                {{ $transaksis->withQueryString()->links('vendor.pagination.flowbite') }}
              </div>
            </div>
          @endif
        </div>
      </div>
