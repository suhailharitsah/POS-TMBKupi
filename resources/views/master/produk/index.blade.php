@extends('layouts.app')

@section('title', 'Master Produk - TMB Kupi')
@section('page-title', 'Master Produk')

@section('content')
  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 p-6">
    <div class="max-w-7xl mx-auto space-y-2">

      {{-- Tombol Back --}}
      <div>
        <a href="{{ route('master.index') }}"
          class="inline-flex items-center justify-center w-10 h-10 text-gray-600 hover:text-white hover:bg-sky-500 rounded-lg transition duration-200">
          <span class="iconify text-2xl" data-icon="solar:alt-arrow-left-bold"></span>
        </a>
      </div>

      <!-- Header Section -->
      <div class="bg-white rounded-2xl shadow-lg border border-slate-200/60 p-6">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h1 class="text-2xl font-bold bg-gradient-to-r from-slate-800 to-blue-600 bg-clip-text text-transparent">
              Master Produk
            </h1>
            <p class="text-slate-600 text-sm">Kelola produk TMB Kupi dengan mudah</p>
          </div>
          <button onclick="document.getElementById('addModal').showModal()"
            class="group relative overflow-hidden bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
            <span class="relative z-10 flex items-center gap-2">
              <span class="iconify" data-icon="solar:add-circle-linear" data-width="24"></span>
              Tambah Produk
            </span>
          </button>
        </div>

        <!-- Search & Filter -->
        <form method="GET" action="{{ route('master.produk.index') }}"
          class="flex flex-col lg:flex-row gap-4 p-4 bg-slate-50/50 rounded-xl border border-slate-200/50">

          <!-- Input Search -->
          <div class="flex-1">
            <div class="relative">
              <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400 w-5 h-5" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
              <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}"
                class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl 
               focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors">
            </div>
          </div>

          <!-- Filter -->
          <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto" x-data="{ open: false, selected: '{{ request('kategori') ?? '' }}' }">

            <!-- Dropdown -->
            <div class="relative w-full sm:w-48">
              <button type="button" @click="open = !open"
                class="w-full sm:w-48 px-4 py-3 bg-white border border-slate-200 rounded-xl flex items-center justify-between 
               focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                <span x-text="selected ? selected : 'Semua Kategori'"></span>
                <svg class="w-5 h-5 text-slate-400 transform transition-transform" :class="{ 'rotate-180': open }"
                  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>

              <!-- Options -->
              <div x-show="open" @click.outside="open = false" x-transition
                class="absolute mt-2 w-full sm:w-48 bg-white border border-slate-200 rounded-xl shadow-lg z-50">
                <button type="button" @click="selected=''; open=false; $refs.hiddenKategori.value=''"
                  class="block w-full text-left px-4 py-2 hover:bg-slate-100 text-slate-700">Semua Kategori</button>
                <button type="button" @click="selected='Makanan'; open=false; $refs.hiddenKategori.value='Makanan'"
                  class="block w-full text-left px-4 py-2 hover:bg-slate-100 text-slate-700">Makanan</button>
                <button type="button" @click="selected='Minuman'; open=false; $refs.hiddenKategori.value='Minuman'"
                  class="block w-full text-left px-4 py-2 hover:bg-slate-100 text-slate-700">Minuman</button>
              </div>
            </div>

            <!-- Hidden input -->
            <input type="hidden" name="kategori" x-ref="hiddenKategori" value="{{ request('kategori') }}">

            <!-- Button Filter -->
            <button type="submit"
              class="w-full sm:w-auto px-6 py-3 bg-slate-700 hover:bg-slate-800 text-white rounded-xl 
             font-medium transition-colors shadow-lg hover:shadow-xl">
              Filter
            </button>
          </div>
        </form>
      </div>

      <!-- Products Table -->
      <div class="bg-white rounded-2xl shadow-lg border border-slate-200/60 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full min-w-[600px]"> {{-- min-w supaya scroll muncul di mobile --}}
            <thead class="bg-gradient-to-r from-slate-50 to-blue-50">
              <tr>
                <th
                  class="text-left py-3 px-4 sm:py-4 sm:px-6 font-semibold text-slate-700 text-sm uppercase tracking-wider">
                  NO</th>
                <th
                  class="text-left py-3 px-4 sm:py-4 sm:px-6 font-semibold text-slate-700 text-sm uppercase tracking-wider">
                  Produk</th>
                <th
                  class="text-left py-3 px-4 sm:py-4 sm:px-6 font-semibold text-slate-700 text-sm uppercase tracking-wider">
                  Harga</th>
                <th
                  class="text-left py-3 px-4 sm:py-4 sm:px-6 font-semibold text-slate-700 text-sm uppercase tracking-wider">
                  Kategori</th>
                <th
                  class="text-center py-3 px-4 sm:py-4 sm:px-6 font-semibold text-slate-700 text-sm uppercase tracking-wider">
                  Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              @forelse ($produks as $produk)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                  <td class="py-4 px-6 text-slate-600">
                    {{ $produks->firstItem() + $loop->index }}
                  </td>
                  <td class="py-4 px-6">
                    <div class="font-semibold text-slate-800">{{ $produk->nama }}</div>
                  </td>
                  <td class="py-4 px-6">
                    <span
                      class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold whitespace-nowrap
                      {{ $produk->kategori == 'Makanan' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                      Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </span>
                  </td>
                  <td class="py-4 px-6">
                    <span
                      class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                      {{ $produk->kategori == 'Makanan' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                      {{ $produk->kategori }}
                    </span>
                  </td>
                  <td class="py-4 px-6">
                    <div class="flex items-center justify-center gap-2">
                      <button onclick="document.getElementById('editModal{{ $produk->id }}').showModal()"
                        class="inline-flex items-center px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-colors shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                      </button>
                      <form action="{{ route('master.produk.destroy', $produk) }}" method="POST"
                        class="inline delete-form" method="POST" class="inline delete-form">
                        @csrf @method('DELETE')
                        <button type="submit"
                          class="inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg transition-colors shadow-md hover:shadow-lg">
                          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                          </svg>
                          Hapus
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>

                <!-- Edit Modal -->
                <dialog id="editModal{{ $produk->id }}"
                  class="backdrop:bg-black/50 rounded-2xl border-none shadow-2xl w-11/12 max-w-md sm:max-w-lg">
                  <div class="bg-white rounded-2xl p-6">
                    <form method="POST" action="{{ route('master.produk.update', $produk) }}" class="space-y-5">
                      @csrf @method('PUT')
                      <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-slate-800">Edit Produk</h2>
                        <button type="button" onclick="this.closest('dialog').close()"
                          class="text-slate-400 hover:text-slate-600">
                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                          </svg>
                        </button>
                      </div>

                      <div class="space-y-4">
                        <div>
                          <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Produk</label>
                          <input type="text" name="nama" value="{{ $produk->nama }}"
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"
                            required>
                        </div>
                        <div>
                          <label class="block text-sm font-semibold text-slate-700 mb-2">Harga</label>
                          <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 font-medium">Rp</span>
                            <input type="text" name="harga"
                              value="{{ number_format($produk->harga, 0, ',', '.') }}"
                              class="w-full pl-12 pr-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 currency"
                              required>
                          </div>
                        </div>

                        {{-- Edit Kategori Tom Select --}}
                        <div>
                          <label class="block text-sm font-semibold text-slate-700 mb-2 px-2 py-2">Kategori</label>
                          <select id="kategori{{ $produk->id }}" name="kategori" required
                            class="w-full border border-slate-200 rounded-xl px-4 py-3">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Makanan"
                              {{ old('kategori', $produk->kategori ?? '') == 'Makanan' ? 'selected' : '' }}>
                              Makanan
                            </option>
                            <option value="Minuman"
                              {{ old('kategori', $produk->kategori ?? '') == 'Minuman' ? 'selected' : '' }}>
                              Minuman
                            </option>
                          </select>
                        </div>

                      </div>
                      <div class="flex gap-3 pt-4">
                        <button type="button" onclick="this.closest('dialog').close()"
                          class="flex-1 px-4 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-xl font-semibold transition-colors">
                          Batal
                        </button>
                        <button type="submit"
                          class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl">
                          Simpan
                        </button>
                      </div>
                    </form>
                  </div>
                </dialog>
              @empty
                <tr>
                  <td colspan="4" class="text-center py-12">
                    <div class="flex flex-col items-center gap-3">
                      <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                      </div>
                      <div class="text-slate-500">
                        <p class="font-medium">Belum ada produk</p>
                        <p class="text-sm">Tambahkan produk pertama Anda</p>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        @if ($produks->hasPages())
          <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            <div class="flex justify-center">
              {{ $produks->withQueryString()->links('vendor.pagination.flowbite') }}
            </div>
          </div>
        @endif

      </div>
    </div>
  </div>

  <!-- Add Modal -->
  <dialog id="addModal" class="backdrop:bg-black/50 rounded-2xl border-none shadow-2xl w-11/12 max-w-md sm:max-w-lg">
    <div class="bg-white rounded-2xl p-6">
      <form method="POST" action="{{ route('master.produk.store') }}" class="space-y-5">
        @csrf
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-xl font-bold text-slate-800">Tambah Produk Baru</h2>
          <button type="button" onclick="this.closest('dialog').close()" class="text-slate-400 hover:text-slate-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <div class="space-y-4">
          <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Produk</label>
            <input type="text" name="nama"
              class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"
              placeholder="Masukkan nama produk" required>
          </div>

          <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Harga</label>
            <div class="relative">
              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 font-medium">Rp</span>
              <input type="text" name="harga"
                class="w-full pl-12 pr-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 currency"
                placeholder="0" required>
            </div>
          </div>

          <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
            <select id="kategori_tambah" name="kategori" required
              class="w-full pl-4 pr-10 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white">
              <option value="">-- Pilih kategori terlebih dahulu --</option>
              <option value="Makanan">Makanan</option>
              <option value="Minuman">Minuman</option>
            </select>
          </div>
        </div>

        <div class="flex gap-3 pt-4">
          <button type="button" onclick="this.closest('dialog').close()"
            class="flex-1 px-4 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-xl font-semibold transition-colors">
            Batal
          </button>
          <button type="submit"
            class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl">
            Tambah Produk
          </button>
        </div>
      </form>
    </div>
  </dialog>

@endsection

@push('scripts')
  {{-- Format Currency --}}
  @vite('resources/js/formatCurrency.js')

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // ✅ Notifikasi SweetAlert
      @if (session('success'))
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: "{{ session('success') }}",
          showConfirmButton: false,
          timer: 2000
        })
      @endif

      @if (session('error'))
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: "{{ session('error') }}",
          showConfirmButton: true
        })
      @endif

      // ✅ Konfirmasi Hapus Produk
      document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
          e.preventDefault();
          Swal.fire({
            title: 'Yakin ingin hapus?',
            text: "Data produk akan hilang permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit();
            }
          })
        });
      });

      // ✅ Inisialisasi Tom Select untuk semua kategori (Tambah & Edit)
      document.querySelectorAll('select[id^="kategori"]').forEach(function(el) {
        new TomSelect(el, {
          create: false,
          controlInput: null, // hilangkan cursor input
          sortField: {
            field: "text",
            direction: "asc"
          },
          placeholder: "-- Pilih Kategori --"
        });
      });
    });
  </script>
@endpush
