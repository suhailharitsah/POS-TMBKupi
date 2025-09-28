      <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6 pb-16 relative z-50">
        <div class="flex items-center gap-3 mb-6">
          <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
          </div>
          <h2 class="text-xl font-semibold text-gray-800">Tambah Pengeluaran Baru</h2>
        </div>

        <form action="{{ route('master.pengeluaran.store') }}" method="POST"
          class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
          @csrf

          {{-- Keterangan --}}
          <div class="group">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
            <input type="text" name="keterangan" required
              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-transparent focus:ring-2 focus:ring-sky-500/40 text-sm"
              placeholder="Keterangan">
          </div>


          {{-- Kategori --}}
          <div class="group relative z-50" x-data="{ open: false, selected: '' }" @click.away="open = false">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>

            <!-- Trigger -->
            <div @click="open = !open"
              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl flex items-center justify-between cursor-pointer hover:bg-gray-100 transition">
              <span x-text="selected || 'Pilih kategori'" class="text-sm text-gray-600"></span>
              <svg class="w-4 h-4 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>

            <!-- Options -->
            <div x-show="open" x-transition
              class="absolute left-0 mt-2 w-full bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden z-[999]">
              <ul class="divide-y divide-gray-100 text-sm">
                <li @click="selected = 'Operasional'; open = false"
                  class="px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center gap-2">
                  🏢 <span>Operasional</span>
                </li>
                <li @click="selected = 'Gaji'; open = false"
                  class="px-4 py-2 hover:bg-green-50 cursor-pointer flex items-center gap-2">
                  💰 <span>Gaji</span>
                </li>
                <li @click="selected = 'Pinjaman'; open = false"
                  class="px-4 py-2 hover:bg-orange-50 cursor-pointer flex items-center gap-2">
                  📝 <span>Pinjaman</span>
                </li>
                <li @click="selected = 'Lainnya'; open = false"
                  class="px-4 py-2 hover:bg-gray-50 cursor-pointer flex items-center gap-2">
                  📋 <span>Lainnya</span>
                </li>
              </ul>
            </div>
            <!-- Hidden input untuk form -->
            <input type="hidden" name="kategori" x-model="selected">
          </div>

          {{-- Nominal --}}
          <div class="group">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nominal</label>
            <div class="flex items-center">
              <span
                class="px-3 py-3 bg-gray-100 border border-r-0 border-gray-200 rounded-l-xl text-sm text-gray-600">Rp</span>
              <input type="text" name="nominal" id="nominalInput" required
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-r-xl focus:outline-none focus:border-transparent focus:ring-2 focus:ring-sky-500/40 text-sm"
                placeholder="0">
            </div>
          </div>

          {{-- Tanggal --}}
          <div class="group">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
            <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}"
              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-transparent focus:ring-2 focus:ring-sky-500/40 text-sm">
          </div>

          {{-- Tombol Simpan --}}
          <div class="group flex justify-end md:col-start-2 xl:col-span-4 mt-8">
            <button type="submit"
              class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:ring-blue-500/50 transition-all duration-200 font-semibold shadow-lg">
              Simpan
            </button>
          </div>
        </form>
      </div>
