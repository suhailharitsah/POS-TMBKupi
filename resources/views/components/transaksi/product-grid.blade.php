{{-- Product Grid --}}
<div class="lg:col-span-2">
  {{-- Makanan Section --}}
  <div class="mb-8">
    <div class="flex items-center mb-4 bg-gradient-to-br from-amber-800 to-yellow-400/50 rounded-xl px-4 py-2">
      <div class="w-1 h-8 bg-gradient-to-b from-amber-400 to-orange-200 rounded-full mr-3"></div>
      <h2 class="text-2xl font-bold text-white">🍽️ Makanan</h2>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
      @forelse($makanan as $produk)
        <div
          @click="tambahKeranjang({ id: {{ $produk->id }}, nama: '{{ $produk->nama }}', harga: {{ $produk->harga }}, kategori: '{{ $produk->kategori }}' })"
          class="group cursor-pointer bg-white rounded-2xl p-4 shadow-md hover:shadow-xl border-2 border-transparent hover:border-orange-200 hover:bg-orange-100 transition-all duration-300 transform hover:-translate-y-1">
          <div class="text-center">
            <div
              class="w-16 h-16 bg-orange-400/50 shadow-lg rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
              <span class="text-2xl">🍽️</span>
            </div>
            <h3 class="font-semibold text-gray-800 mb-2 text-sm md:text-base">{{ $produk->nama }}</h3>
            <p class="text-orange-600 font-bold text-sm md:text-base">Rp
              {{ number_format($produk->harga, 0, ',', '.') }}</p>
            <span
              class="inline-block mt-2 px-3 py-1 text-xs rounded-full shadow-md bg-orange-500 text-white">Makanan</span>
          </div>
        </div>
      @empty
        <div class="col-span-full text-center py-12">
          <div class="text-6xl mb-4">🍽️</div>
          <p class="text-gray-500">Tidak ada makanan tersedia</p>
        </div>
      @endforelse
    </div>
  </div>

  {{-- Minuman Section --}}
  <div>
    <div class="flex items-center mb-4 bg-gradient-to-br from-blue-800 to-cyan-400/50 rounded-xl px-4 py-2">
      <div class="w-1 h-8 bg-gradient-to-b from-blue-400 to-cyan-200 rounded-full mr-3"></div>
      <h2 class="text-2xl font-bold text-white">🥤 Minuman</h2>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
      @forelse($minuman as $produk)
        <div
          @click="tambahKeranjang({ id: {{ $produk->id }}, nama: '{{ $produk->nama }}', harga: {{ $produk->harga }}, kategori: '{{ $produk->kategori }}' })"
          class="group cursor-pointer bg-white rounded-2xl p-4 shadow-md hover:shadow-xl border-2 border-transparent hover:border-blue-200 hover:bg-blue-100 transition-all duration-300 transform hover:-translate-y-1">
          <div class="text-center">
            <div
              class="w-16 h-16 bg-blue-400/50 shadow-lg rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
              <span class="text-2xl">🥤</span>
            </div>
            <h3 class="font-semibold text-gray-800 mb-2 text-sm md:text-base">{{ $produk->nama }}</h3>
            <p class="text-blue-600 font-bold text-sm md:text-base">Rp
              {{ number_format($produk->harga, 0, ',', '.') }}</p>
            <span
              class="inline-block mt-2 px-3 py-1 text-xs rounded-full shadow-md bg-blue-500 text-white">Minuman</span>
          </div>
        </div>
      @empty
        <div class="col-span-full text-center py-12">
          <div class="text-6xl mb-4">🥤</div>
          <p class="text-gray-500">Tidak ada minuman tersedia</p>
        </div>
      @endforelse
    </div>
  </div>
</div>
