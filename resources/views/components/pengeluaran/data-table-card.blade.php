{{-- Enhanced Data Table Card --}}
<div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl border border-white/30 overflow-hidden">

  {{-- Header Section --}}
  <div class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-black/10 to-transparent"></div>
    <div class="relative z-10 p-6 md:p-8">

      {{-- Title and Monthly Total --}}
      <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-6">

        {{-- Title Section --}}
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
            <h2 class="text-2xl md:text-3xl font-bold text-white">Riwayat Pengeluaran</h2>
            <p class="text-white/80 text-sm">Kelola dan pantau pengeluaran Anda</p>
          </div>
        </div>

        {{-- 🔹 Card Total + Dropdown Periode --}}
        <div class="flex flex-col sm:flex-row items-stretch gap-4 w-full lg:w-auto">
          {{-- Card Total Bulan Ini --}}
          <div
            class="flex-1 bg-white/20 backdrop-blur-sm rounded-2xl p-4 border border-white/30 min-w-[220px] flex items-center justify-between">
            <div>
              <div class="text-white/80 text-xs uppercase tracking-wide font-medium mb-1">Total Bulan Ini</div>
              <div class="text-white text-lg md:text-xl font-bold">
                Rp {{ number_format($totalBulanIni, 0, ',', '.') }}
              </div>
            </div>
          </div>

          {{-- Dropdown Riwayat Total --}}
          <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
              class="bg-white/30 text-white text-sm px-4 py-3 rounded-2xl hover:bg-white/40 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200 flex items-center gap-2 whitespace-nowrap">
              {{ \Carbon\Carbon::create($tahun, $bulan)->translatedFormat('F Y') }}
              <svg class="w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>

            <div x-show="open" @click.outside="open = false" x-transition
              class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-gray-200 z-50 overflow-hidden">
              @foreach ($periode as $p)
                <a href="{{ route('master.pengeluaran.index', ['bulan' => $p->bulan, 'tahun' => $p->tahun]) }}"
                  @click="open = false"
                  class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors duration-150">
                  {{ \Carbon\Carbon::create($p->tahun, $p->bulan)->translatedFormat('F Y') }}
                </a>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      {{-- 🔎 Search & Filter Section --}}
      <div class="mt-4">
        <div class="flex flex-col md:flex-row md:items-center gap-3">

          {{-- 📅 Date Filter (Form GET) + Reset + Kategori --}}
          <form method="GET" action="{{ route('master.pengeluaran.index') }}"
            class="flex flex-col sm:flex-row gap-3 flex-1">

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
                <a href="{{ route('master.pengeluaran.index') }}"
                  class="px-3 py-2 bg-red-500/80 hover:bg-red-600 text-white text-sm rounded-xl transition-all duration-200 whitespace-nowrap">
                  Reset
                </a>
              @endif
            </div>

            {{-- 🏷️ Category Filter --}}
            <div class="relative w-40 md:w-48" x-data="{ open: false, selected: 'Semua Kategori' }">
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
                  <button type="button" @click="selected = 'Semua Kategori'; open = false; filterByCategory('')"
                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">
                    Semua Kategori
                  </button>
                  <button type="button"
                    @click="selected = 'Operasional'; open = false; filterByCategory('Operasional')"
                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">
                    Operasional
                  </button>
                  <button type="button" @click="selected = 'Gaji'; open = false; filterByCategory('Gaji')"
                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">
                    Gaji
                  </button>
                  <button type="button" @click="selected = 'Pinjaman'; open = false; filterByCategory('Pinjaman')"
                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">
                    Pinjaman
                  </button>
                  <button type="button" @click="selected = 'Lainnya'; open = false; filterByCategory('Lainnya')"
                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">
                    Lainnya
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  {{-- Table Section --}}
  <div class="bg-white">
    <div>
      <table class="w-full">
        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
          <tr>
            <th
              class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider whitespace-nowrap">
              Tanggal & Waktu
            </th>
            <th class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
              Keterangan
            </th>
            <th
              class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider hidden lg:table-cell whitespace-nowrap">
              Kategori
            </th>
            <th
              class="px-4 md:px-6 py-4 text-right text-xs font-bold text-gray-600 uppercase tracking-wider whitespace-nowrap">
              Nominal
            </th>
            <th
              class="px-4 md:px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider whitespace-nowrap">
              Aksi
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100" id="expenseTableBody">
          @forelse ($pengeluarans as $item)
            <tr
              class="hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-indigo-50/50 transition-all duration-200 expense-row"
              data-keterangan="{{ strtolower($item->keterangan) }}" data-kategori="{{ $item->kategori }}">

              {{-- Date & Time Column --}}
              <td class="px-4 md:px-6 py-4">
                <div class="flex items-center gap-3">
                  <div
                    class="w-12 h-12 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl flex items-center justify-center shadow-lg flex-shrink-0">
                    <span class="text-sm font-bold text-white">{{ $item->tanggal->format('d') }}</span>
                  </div>
                  <div class="text-sm min-w-0">
                    <div class="font-semibold text-gray-900">{{ $item->tanggal->format('M Y') }}</div>
                    <div class="text-gray-500 text-xs">
                      {{ $item->tanggal->locale('id')->translatedFormat('l') }}
                    </div>
                    <div class="text-gray-400 text-xs font-mono">
                      {{ $item->created_at->format('H:i') }}
                    </div>
                  </div>
                </div>
              </td>

              {{-- Description Column --}}
              <td class="px-4 md:px-6 py-4">
                <div class="text-sm font-semibold text-gray-900 leading-tight">{{ $item->keterangan }}</div>
                {{-- Mobile Category Badge --}}
                <div class="lg:hidden mt-2">
                  <span @class([
                      'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm',
                      'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border border-blue-200' =>
                          $item->kategori === 'Operasional',
                      'bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-200' =>
                          $item->kategori === 'Gaji',
                      'bg-gradient-to-r from-orange-100 to-orange-200 text-orange-800 border border-orange-200' =>
                          $item->kategori === 'Pinjaman',
                      'bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-200' => !in_array(
                          $item->kategori,
                          ['Operasional', 'Gaji', 'Pinjaman']),
                  ])>
                    {{ $item->kategori }}
                  </span>
                </div>
              </td>

              {{-- Category Column (Desktop Only) --}}
              <td class="px-4 md:px-6 py-4 hidden lg:table-cell">
                <span @class([
                    'inline-flex items-center px-4 py-2 rounded-2xl text-sm font-semibold shadow-sm border whitespace-nowrap',
                    'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border-blue-200' =>
                        $item->kategori === 'Operasional',
                    'bg-gradient-to-r from-green-100 to-green-200 text-green-800 border-green-200' =>
                        $item->kategori === 'Gaji',
                    'bg-gradient-to-r from-orange-100 to-orange-200 text-orange-800 border border-orange-200' =>
                        $item->kategori === 'Pinjaman',
                    'bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border-gray-200' => !in_array(
                        $item->kategori,
                        ['Operasional', 'Gaji', 'Pinjaman']),
                ])>
                  {{ $item->kategori }}
                </span>
              </td>

              {{-- Amount Column --}}
              <td class="px-4 md:px-6 py-4 text-right">
                <div class="text-lg md:text-xl font-bold text-gray-900 font-mono truncate">
                  Rp {{ number_format($item->nominal, 0, ',', '.') }}
                </div>
              </td>

              {{-- Action Column --}}
              <td class="px-4 md:px-6 py-4">
                <div class="flex gap-2 justify-center">
                  <button
                    onclick="editItem({{ $item->id }}, '{{ $item->keterangan }}', '{{ $item->kategori }}', {{ $item->nominal }}, '{{ $item->tanggal->format('Y-m-d') }}')"
                    class="p-3 bg-gradient-to-r from-amber-100 to-orange-100 text-amber-600 rounded-xl hover:from-amber-200 hover:to-orange-200 transition-all duration-200 transform hover:scale-110 shadow-md hover:shadow-lg border border-amber-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                      </path>
                    </svg>
                  </button>
                  <button onclick="deleteItem({{ $item->id }})"
                    class="p-3 bg-gradient-to-r from-red-100 to-pink-100 text-red-600 rounded-xl hover:from-red-200 hover:to-pink-200 transition-all duration-200 transform hover:scale-110 shadow-md hover:shadow-lg border border-red-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                      </path>
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr id="emptyState">
              <td colspan="5" class="px-6 py-16 text-center">
                <div class="text-gray-400">
                  <div
                    class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                      </path>
                    </svg>
                  </div>
                  <p class="text-xl font-semibold text-gray-500 mb-2">Belum ada data pengeluaran</p>
                  <p class="text-sm text-gray-400">Tambahkan pengeluaran pertama Anda</p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    @if ($pengeluarans->hasPages())
      <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
        <div class="flex justify-center">
          {{ $pengeluarans->withQueryString()->links('vendor.pagination.flowbite') }}
        </div>
      </div>
    @endif

    {{-- No Results State (Hidden by default) --}}
    <div id="noResultsState" class="hidden px-6 py-16 text-center">
      <div class="text-gray-400">
        <div
          class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl mx-auto mb-4 flex items-center justify-center">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <p class="text-xl font-semibold text-gray-500 mb-2">Tidak ada hasil ditemukan</p>
        <p class="text-sm text-gray-400">Coba ubah kata kunci pencarian atau filter kategori</p>
      </div>
    </div>
  </div>
</div>
