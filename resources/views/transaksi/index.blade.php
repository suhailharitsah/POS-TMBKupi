@extends('layouts.app')

@section('title', 'Transaksi - TMB Kupi')
@section('page-title', 'Transaksi')

@section('content')
  <div x-data="kasirApp()" class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 rounded-2xl">
    <div class="max-w-7xl mx-auto space-y-6 pt-6">

      {{-- Header & Search --}}
      <div class="mb-8">
        <div class="text-center mb-6">
          <h1 class="text-3xl font-bold text-white-800 mb-2">☕ TMB Kupi POS</h1>
          <p class="text-gray-600">Sistem Point of Sale</p>
          <p class="text-gray-800 text-sm">
            Mau tambah produk?
            <a href="{{ route('master.produk.index') }}" class="text-blue-600 hover:underline">
              klik disini!
            </a>
          </p>
        </div>

        <form method="GET" action="{{ route('transaksi.index') }}" class="max-w-md mx-auto">
          <div class="relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Cari produk..."
              class="w-full pl-4 pr-12 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all">
            <button type="submit"
              class="absolute right-2 top-2 bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </button>
          </div>
        </form>
      </div>

      <div class="grid lg:grid-cols-3 gap-8">

        {{-- Product Grid --}}
        <x-transaksi.product-grid :produks="$produks" />

        {{-- Cart Sidebar  --}}
        <x-transaksi.cart-sidebar />
      </div>

      {{-- Riwayat Transaksi --}}
      <x-transaksi.riwayat-transaksi :transaksis="$transaksis" />

    </div>
  </div>

  @push('scripts')
    <script>
      function kasirApp() {
        return {
          keranjang: [],
          bayarNominal: 0,
          bayarNominalDisplay: "",

          // format inputan setiap kali user mengetik
          formatInputBayar(e) {
            let angka = e.target.value.replace(/\D/g, "");
            this.bayarNominal = parseInt(angka) || 0;
            // format dengan titik ribuan
            this.bayarNominalDisplay = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          },

          get total() {
            return this.keranjang.reduce((sum, item) => sum + (item.harga * item.qty), 0);
          },

          get kembali() {
            return this.bayarNominal - this.total > 0 ? this.bayarNominal - this.total : 0;
          },

          tambahKeranjang(produk) {
            let existing = this.keranjang.find(p => p.id === produk.id);
            if (existing) {
              existing.qty++;
            } else {
              this.keranjang.push({
                ...produk,
                qty: 1
              });
            }
          },

          async bayar() {
            if (this.keranjang.length === 0) {
              Swal.fire({
                title: "Keranjang Kosong!",
                text: "Silakan pilih produk terlebih dahulu",
                icon: "warning"
              });
              return;
            }

            if (this.bayarNominal < this.total) {
              Swal.fire({
                title: "Pembayaran Kurang!",
                text: "Jumlah uang tidak mencukupi",
                icon: "error"
              });
              return;
            }

            try {
              let response = await fetch("{{ route('transaksi.store') }}", {
                method: "POST",
                headers: {
                  "Content-Type": "application/json",
                  "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                  total: this.total,
                  bayar: this.bayarNominal,
                  kembali: this.kembali,
                  keranjang: this.keranjang
                })
              });

              let result = await response.json();

              if (result.success) {
                Swal.fire({
                  title: "Pembayaran Berhasil! 🎉",
                  html: `
                <div class="text-lg mt-3">
                  <div>Tanggal: <strong>${new Date().toLocaleString("id-ID")}</strong></div>
                  <div>Total: <strong class="text-green-600">${this.formatRupiah(this.total)}</strong></div>
                  <div>Bayar: <strong>${this.formatRupiah(this.bayarNominal)}</strong></div>
                  <div>Kembali: <strong class="text-blue-600">${this.formatRupiah(this.kembali)}</strong></div>
                </div>`,
                  icon: "success",
                  confirmButtonColor: "#10B981"
                }).then(() => {
                  window.location.reload();
                });

                // reset local state
                this.keranjang = [];
                this.bayarNominal = 0;
                this.bayarNominalDisplay = "";
              }
            } catch (err) {
              console.error(err);
              Swal.fire({
                title: "Error!",
                text: "Gagal menyimpan transaksi",
                icon: "error"
              });
            }
          },

          formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
              style: 'currency',
              currency: 'IDR'
            }).format(angka);
          }
        }
      }

      // SweetAlert untuk tombol Hapus (saja)
      document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.hapus-btn').forEach(function(button) {
          button.addEventListener('click', function(e) {
            e.preventDefault();
            let form = this.closest('form');

            Swal.fire({
              title: 'Hapus transaksi ini?',
              text: "Data akan dihapus permanen dan tidak bisa dikembalikan!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#dc2626',
              cancelButtonColor: '#6b7280',
              confirmButtonText: 'Ya, Hapus',
              cancelButtonText: 'Batal'
            }).then((result) => {
              if (result.isConfirmed) {
                // submit form (server side will delete and set flash message)
                form.submit();
              }
            });
          });
        });

        // Setelah reload: tampilkan alert sukses jika ada flash message dari server
        @if (session('success'))
          Swal.fire({
            title: "Berhasil!",
            text: {!! json_encode(session('success')) !!},
            icon: "success",
            confirmButtonColor: "#10B981"
          });
        @endif
      });
    </script>
  @endpush





@endsection
