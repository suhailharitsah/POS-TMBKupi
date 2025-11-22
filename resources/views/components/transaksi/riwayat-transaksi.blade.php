@props(['produks', 'transaksis', 'bulan', 'tahun', 'periode', 'totalBulanIni'])

{{-- Riwayat Transaksi --}}
<div
  class="mt-12 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 relative rounded-3xl shadow-2xl border border-white/20 overflow-hidden">

  {{-- Overlay Efek Transparan --}}
  <div class="absolute inset-0 bg-gradient-to-r from-black/10 to-transparent"></div>

  {{-- Header Section --}}
  <div class="relative z-10 p-8 border-b border-white/20">
    <div class="flex items-center justify-between mb-8 flex-wrap gap-6">

      {{-- Judul --}}
      <div class="flex items-center gap-4">
        <div
          class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/30">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 5H7a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
            </path>
          </svg>
        </div>
        <div>
          <h2 class="text-3xl font-bold text-white">📋 Riwayat Transaksi</h2>
          <p class="text-sm text-white/80 mt-1">Kelola dan pantau semua transaksi Anda</p>
        </div>
      </div>

      {{-- 🔹 Card Total Pendapatan Bulan Ini + Dropdown Periode --}}
      <div class="flex flex-col sm:flex-row items-stretch gap-4 w-full lg:w-auto">
        {{-- Total Pendapatan Bulan Ini --}}
        <div
          class="flex-1 bg-white/20 backdrop-blur-sm rounded-2xl p-4 border border-white/30 min-w-[220px] flex items-center justify-between">
          <div>
            <div class="text-white/80 text-xs uppercase tracking-wide font-medium mb-1">
              Total Pendapatan
            </div>
            <div class="text-white text-lg md:text-xl font-bold">
              Rp {{ number_format($totalBulanIni ?? 0, 0, ',', '.') }}
            </div>
          </div>
        </div>

        {{-- 🔹 Dropdown Periode Bulan --}}
        <div class="relative" x-data="{ open: false }">
          @php
            // Ambil bulan & tahun aktif dari request (default ke 'semua')
            $bulanAktif = request('bulan', 'semua');
            $tahunAktif = request('tahun');

            // Tentukan label dropdown berdasarkan kondisi
            if ($bulanAktif === 'semua') {
                $labelDropdown = '📅 Semua Transaksi';
            } else {
                $labelDropdown = \Carbon\Carbon::create($tahunAktif ?? now()->year, $bulanAktif)->translatedFormat(
                    'F Y',
                );
            }

            // Pastikan 'semua' muncul di urutan pertama
            $periode = $periode->sortBy(function ($item) {
                return $item->bulan === 'semua' ? 0 : 1;
            });
          @endphp

          {{-- 🔹 Tombol dropdown --}}
          <button @click="open = !open"
            class="bg-white/30 text-white text-sm px-4 py-3 rounded-2xl hover:bg-white/40 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200 flex items-center gap-2 whitespace-nowrap">
            {{ $labelDropdown }}
            <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }"
              fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          {{-- 🔹 Menu dropdown --}}
          <div x-show="open" @click.outside="open = false" x-transition
            class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-gray-200 z-50 overflow-hidden">

            @foreach ($periode as $p)
              @php
                $isActive =
                    ($bulanAktif == $p->bulan && $tahunAktif == $p->tahun) ||
                    ($bulanAktif == 'semua' && $p->bulan == 'semua');
              @endphp

              <a href="{{ route('transaksi.index', ['bulan' => $p->bulan, 'tahun' => $p->tahun]) }}"
                @click="open = false"
                class="block px-4 py-3 transition-colors duration-150
          {{ $isActive ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-indigo-50 hover:text-indigo-700' }}">
                {{ $p->bulan === 'semua' ? '📅 Semua Transaksi' : \Carbon\Carbon::create($p->tahun, $p->bulan)->translatedFormat('F Y') }}
              </a>
            @endforeach
          </div>
        </div>


      </div>
    </div>

    {{-- 🔎 Filter & Search Section --}}
    <div class="mt-4">
      <div class="flex flex-col md:flex-row md:items-center gap-3">

        {{-- 📅 Filter Form --}}
        <form method="GET" action="{{ route('transaksi.index') }}" class="flex flex-col sm:flex-row gap-3 flex-1">

          {{-- Input Tanggal --}}
          <div class="relative flex-1 sm:max-w-[240px]">
            <input type="text" id="filterTanggal" name="tanggal" value="{{ request('tanggal') }}"
              placeholder="Pilih tanggal..."
              class="w-full px-3 py-2 bg-white/20 backdrop-blur-sm border border-white/30 
            rounded-xl text-sm text-white placeholder-white/60 
            focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent 
            transition-all duration-200 cursor-pointer">
            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
              <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>
          </div>

          {{-- Tombol Filter + Reset --}}
          <div class="flex gap-2 sm:gap-3">
            <button type="submit"
              class="px-4 py-2 bg-white/20 border border-white/30 rounded-xl text-white text-sm font-medium 
            hover:bg-white/30 focus:ring-2 focus:ring-white/50 transition-all duration-200 whitespace-nowrap">
              Filter
            </button>
            @if (request('tanggal'))
              <a href="{{ route('transaksi.index') }}"
                class="px-3 py-2 bg-red-500/80 hover:bg-red-600 text-white text-sm rounded-xl transition-all duration-200 whitespace-nowrap">
                Reset
              </a>
            @endif
          </div>

          {{-- 🏷️ Kategori Filter --}}
          <div class="relative w-40 md:w-48" x-data="{ open: false, selected: '{{ request('kategori') ? ucfirst(request('kategori')) : 'Semua Kategori' }}' }">
            <button type="button" @click="open = !open"
              class="w-full flex items-center justify-between gap-2 px-3 py-2 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl text-white text-sm hover:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200">
              <span x-text="selected" class="truncate">Semua Kategori</span>
              <svg class="w-4 h-4 transition-transform flex-shrink-0" :class="{ 'rotate-180': open }" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>

            <div x-show="open" @click.outside="open = false" x-transition
              class="absolute right-0 mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-200 z-50 overflow-hidden">
              <div class="py-2">
                <a href="{{ route('transaksi.index') }}" @click="selected = 'Semua Kategori'; open = false"
                  class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">
                  Semua Kategori
                </a>
                <a href="{{ route('transaksi.index', ['kategori' => 'makanan']) }}"
                  @click="selected = 'Makanan'; open = false"
                  class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">
                  Makanan
                </a>
                <a href="{{ route('transaksi.index', ['kategori' => 'minuman']) }}"
                  @click="selected = 'Minuman'; open = false"
                  class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">
                  Minuman
                </a>
              </div>
            </div>
          </div>

        </form>
      </div>
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
                      <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
          <a href="{{ route('master.produk.index') }}"
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
