{{-- Cart Sidebar --}}
<div class="lg:col-span-1">
  <div class="sticky top-6 bg-white rounded-2xl shadow-xl p-6 border border-gray-100">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
        <span class="iconify" data-icon="mdi:cart-outline" data-width="22"></span>
        Keranjang
      </h2>
      <span x-text="keranjang.length"
        class="bg-blue-500 text-white text-sm px-2 py-1 rounded-full min-w-[24px] text-center"></span>
    </div>

    {{-- List Item Keranjang --}}
    <div class="space-y-3" x-show="keranjang.length > 0" x-transition>
      <template x-for="(item, idx) in keranjang" :key="idx">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-3 rounded-xl gap-2"
          :class="item.kategori === 'Makanan' ? 'bg-orange-50' : 'bg-blue-50'">

          <!-- Detail Produk -->
          <div class="flex-1 min-w-0">
            <!-- Nama Produk -->
            <div class="font-medium text-gray-800 text-sm break-words" x-text="item.nama"></div>

            <!-- Kategori + Qty -->
            <div class="flex items-center gap-2 mt-1 flex-wrap">
              <span class="text-xs px-2 py-1 rounded-full"
                :class="item.kategori === 'Makanan' ? 'bg-orange-700 text-white' : 'bg-blue-600 text-white'"
                x-text="item.kategori"></span>
              <span class="text-sm text-gray-500">× <span x-text="item.qty"></span></span>
            </div>
          </div>

          <!-- Harga + Tombol Hapus -->
          <div class="flex items-center gap-2">
            <!-- Harga -->
            <div class="text-sm font-semibold text-gray-700 whitespace-nowrap">
              <span x-text="formatRupiah(item.harga * item.qty)"></span>
            </div>

            <!-- Tombol Hapus -->
            <button @click="keranjang.splice(idx, 1)"
              class="bg-red-100 hover:bg-red-200 text-red-600 rounded-full p-1.5 transition">
              <span class="iconify" data-icon="mdi:close" data-width="16"></span>
            </button>
          </div>
        </div>
      </template>
    </div>

    {{-- Keranjang Kosong --}}
    <div x-show="keranjang.length === 0" class="text-center py-8" x-transition>
      <div class="text-4xl mb-3">🛒</div>
      <p class="text-gray-500">Keranjang masih kosong</p>
    </div>

    {{-- Total + Input Bayar --}}
    <div x-show="keranjang.length > 0" x-transition>
      <div class="border-t pt-4 mb-6 mt-4">
        <div class="flex justify-between items-center text-xl font-bold text-gray-800">
          <span>Total:</span>
          <span x-text="formatRupiah(total)" class="text-green-600 whitespace-nowrap"></span>
        </div>
      </div>

      {{-- 🔹 Input Nominal Bayar --}}
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Nominal Bayar</label>
        <input type="text" x-model="bayarNominalDisplay" @input="formatInputBayar" inputmode="numeric"
          class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-500 outline-none"
          placeholder="Masukkan jumlah uang">
      </div>

      {{-- 🔹 Kembalian --}}
      <div x-show="bayarNominal > 0" class="mb-4">
        <p class="text-gray-700 font-medium">
          Kembalian:
          <span x-text="formatRupiah(kembali)" class="font-bold text-green-600"></span>
        </p>

        {{-- 🔹 Pesan jika nominal kurang --}}
        <p x-show="bayarNominal > 0 && bayarNominal < total" class="text-pink-600 text-sm mt-[-2px]">
          <span class="text-pink-600">*</span> Nominal tidak cukup
        </p>
      </div>

      {{-- Tombol Bayar --}}
      <button @click="bayar()"
        class="w-full bg-gradient-to-r from-green-600 to-blue-700 text-white py-4 rounded-xl font-semibold text-lg hover:from-green-500/90 hover:to-blue-600/90 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
        <span class="iconify" data-icon="solar:card-bold-duotone" data-width="22"></span>
        Bayar Sekarang
      </button>
    </div>
  </div>
</div>
