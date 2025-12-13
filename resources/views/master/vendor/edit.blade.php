@extends('layouts.app')

@section('content')
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6">
    <div class="max-w-3xl mx-auto space-y-6">

      {{-- Header --}}
      <div class="flex items-center gap-4">
        <a href="{{ route('master.vendor.index') }}"
          class="group flex items-center justify-center w-12 h-12 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 hover:bg-gradient-to-br hover:from-blue-50 hover:to-indigo-50 border border-gray-100">
          <span class="iconify text-gray-600 group-hover:text-blue-600 transition-colors duration-300"
            data-icon="solar:arrow-left-outline" data-width="24"></span>
        </a>

        <div>
          <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">
            Edit Vendor
          </h1>
          <p class="text-sm text-gray-500 mt-1 flex items-center gap-1.5">
            <span class="iconify text-blue-500" data-icon="solar:pen-outline" data-width="16"></span>
            Perbarui data vendor
          </p>
        </div>
      </div>

      {{-- Form Card --}}
      <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden backdrop-blur-sm bg-white/80">

        {{-- Card Header --}}
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-8 py-6">
          <h2 class="text-xl font-semibold text-white flex items-center gap-2">
            <span class="iconify" data-icon="solar:pen-bold-duotone" data-width="24"></span>
            Informasi Vendor
          </h2>
          <p class="text-amber-100 text-sm mt-1">Form edit data vendor</p>
        </div>

        {{-- Form --}}
        <form action="{{ route('master.vendor.update', $vendor->id) }}" method="POST"
          class="p-8 space-y-6">
          @csrf
          @method('PUT')

          {{-- Nama Vendor --}}
          <div class="group">
            <label class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
              <span class="iconify text-blue-500" data-icon="solar:buildings-2-bold-duotone" data-width="18"></span>
              Nama Vendor <span class="text-red-500">*</span>
            </label>
            <input type="text" name="nama" required
              value="{{ old('nama', $vendor->nama) }}"
              class="w-full px-5 py-3.5 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 outline-none">
          </div>

          {{-- Kontak --}}
          <div class="group">
            <label class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
              <span class="iconify text-green-500" data-icon="solar:phone-bold-duotone" data-width="18"></span>
              Kontak <span class="text-gray-400 text-xs">(Opsional)</span>
            </label>
            <input type="text" name="kontak"
              value="{{ old('kontak', $vendor->kontak) }}"
              class="w-full px-5 py-3.5 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 outline-none">
          </div>

          {{-- Divider --}}
          <div class="border-t border-gray-200 my-8"></div>

          {{-- Button --}}
          <div class="flex justify-end gap-3">
            <a href="{{ route('master.vendor.index') }}"
              class="px-6 py-3.5 bg-gray-100 text-gray-700 rounded-2xl hover:bg-gray-200 transition font-medium">
              Batal
            </a>

            <button type="submit"
              class="px-8 py-3.5 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-2xl shadow-xl hover:shadow-2xl transition font-semibold flex items-center gap-2">
              <span class="iconify" data-icon="solar:diskette-bold-duotone" data-width="22"></span>
              Simpan Perubahan
            </button>
          </div>

        </form>
      </div>

    </div>
  </div>
@endsection
