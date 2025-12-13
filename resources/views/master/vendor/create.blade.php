@extends('layouts.app')

@section('content')
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6">
    <div class="max-w-3xl mx-auto space-y-6">

      {{-- Success Alert --}}
      @if (session('success'))
        <div id="successAlert"
          class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-4 rounded-2xl shadow-xl shadow-green-500/30 flex items-center gap-4 animate-slideDown">
          <div class="flex-shrink-0 w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
            <span class="iconify text-white" data-icon="solar:check-circle-bold" data-width="24"></span>
          </div>
          <div class="flex-1">
            <p class="font-semibold text-lg">Berhasil!</p>
            <p class="text-sm text-green-50">{{ session('success') }}</p>
          </div>
          <button onclick="document.getElementById('successAlert').remove()"
            class="flex-shrink-0 w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-colors">
            <span class="iconify" data-icon="solar:close-circle-outline" data-width="20"></span>
          </button>
        </div>
      @endif

      {{-- Header --}}
      <div class="flex items-center gap-4">
        <a href="{{ route('master.vendor.index') }}"
          class="group flex items-center justify-center w-12 h-12 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 hover:bg-gradient-to-br hover:from-blue-50 hover:to-indigo-50 border border-gray-100">
          <span class="iconify text-gray-600 group-hover:text-blue-600 transition-colors duration-300"
            data-icon="solar:arrow-left-outline" data-width="24"></span>
        </a>

        <div>
          <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">
            Tambah Vendor
          </h1>
          <p class="text-sm text-gray-500 mt-1 flex items-center gap-1.5">
            <span class="iconify text-blue-500" data-icon="solar:info-circle-outline" data-width="16"></span>
            Lengkapi data vendor baru
          </p>
        </div>
      </div>

      {{-- Form Card --}}
      <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden backdrop-blur-sm bg-white/80">

        {{-- Card Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
          <h2 class="text-xl font-semibold text-white flex items-center gap-2">
            <span class="iconify" data-icon="solar:user-plus-rounded-bold" data-width="24"></span>
            Informasi Vendor
          </h2>
          <p class="text-blue-100 text-sm mt-1">Form pendaftaran vendor baru</p>
        </div>

        {{-- Form Body --}}
        <form action="{{ route('master.vendor.store') }}" method="POST" class="p-8 space-y-6">
          @csrf

          {{-- Nama Vendor --}}
          <div class="group">
            <label class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
              <span class="iconify text-blue-500" data-icon="solar:buildings-2-bold-duotone" data-width="18"></span>
              Nama Vendor
              <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <input type="text" name="nama" required
                class="w-full px-5 py-3.5 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 placeholder:text-gray-400 hover:border-gray-300 group-hover:border-blue-300 outline-none"
                placeholder="Contoh: PT. Indo Jaya Abadi">
              <div
                class="absolute inset-y-0 right-4 flex items-center pointer-events-none opacity-0 group-focus-within:opacity-100 transition-opacity">
                <span class="iconify text-blue-500" data-icon="solar:pen-bold-duotone" data-width="20"></span>
              </div>
            </div>
            <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
              <span class="iconify" data-icon="solar:info-circle-outline" data-width="14"></span>
              Nama vendor wajib diisi
            </p>
          </div>

          {{-- Kontak --}}
          <div class="group">
            <label class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
              <span class="iconify text-green-500" data-icon="solar:phone-bold-duotone" data-width="18"></span>
              Kontak
              <span class="text-gray-400 text-xs font-normal">(Opsional)</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                <span class="iconify text-gray-400 group-focus-within:text-green-500 transition-colors"
                  data-icon="solar:phone-calling-rounded-bold-duotone" data-width="20"></span>
              </div>
              <input type="text" name="kontak"
                class="w-full pl-12 pr-5 py-3.5 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 placeholder:text-gray-400 hover:border-gray-300 group-hover:border-green-300 outline-none"
                placeholder="+62 812-3456-7890">
            </div>
            <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
              <span class="iconify" data-icon="solar:chat-round-line-bold-duotone" data-width="14"></span>
              Nomor telepon atau WhatsApp vendor
            </p>
          </div>

          {{-- Divider --}}
          <div class="border-t border-gray-200 my-8"></div>

          {{-- Button --}}
          <div class="flex justify-end gap-3">
            <a href="{{ route('master.vendor.index') }}"
              class="group px-6 py-3.5 bg-gray-100 text-gray-700 rounded-2xl hover:bg-gray-200 transition-all duration-300 font-medium flex items-center gap-2 hover:scale-105 active:scale-95">
              <span class="iconify group-hover:-translate-x-1 transition-transform" data-icon="solar:close-circle-outline"
                data-width="20"></span>
              Batal
            </a>

            <button type="submit"
              class="group px-8 py-3.5 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 text-white rounded-2xl shadow-xl shadow-blue-500/40 hover:shadow-2xl hover:shadow-blue-500/50 hover:from-blue-700 hover:via-blue-800 hover:to-indigo-800 transition-all duration-300 font-semibold flex items-center gap-2 hover:scale-105 active:scale-95">
              <span class="iconify group-hover:scale-110 transition-transform" data-icon="solar:diskette-bold-duotone"
                data-width="22"></span>
              Simpan Vendor
            </button>
          </div>

        </form>

      </div>

      {{-- Info Card --}}
      <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
        <div class="flex items-start gap-4">
          <div class="flex-shrink-0 w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
            <span class="iconify text-white" data-icon="solar:lightbulb-bolt-bold" data-width="20"></span>
          </div>
          <div>
            <h3 class="font-semibold text-gray-800 mb-1">Tips Pengisian Data</h3>
            <ul class="text-sm text-gray-600 space-y-1">
              <li class="flex items-start gap-2">
                <span class="iconify text-blue-500 flex-shrink-0 mt-0.5" data-icon="solar:check-circle-bold"
                  data-width="16"></span>
                Pastikan nama vendor ditulis dengan lengkap dan benar
              </li>
              <li class="flex items-start gap-2">
                <span class="iconify text-blue-500 flex-shrink-0 mt-0.5" data-icon="solar:check-circle-bold"
                  data-width="16"></span>
                Kontak dapat berisi nomor WhatsApp untuk komunikasi lebih mudah
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
