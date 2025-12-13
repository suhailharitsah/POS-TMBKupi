  @extends('layouts.app')

  @section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 p-6">
      <div class="max-w-7xl mx-auto space-y-6">

        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div class="flex items-center gap-4">
            <a href="{{ route('master.index') }}"
              class="group flex items-center justify-center w-10 h-10 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 hover:bg-blue-50">
              <span class="iconify text-gray-600 group-hover:text-blue-600 transition-colors"
                data-icon="solar:arrow-left-outline" data-width="22"></span>
            </a>

            <div>
              <h1 class="text-2xl font-bold text-gray-900">Data Vendor</h1>
              <p class="text-sm text-gray-500 mt-0.5">Kelola informasi vendor Anda</p>
            </div>
          </div>

          {{-- Tombol Tambah Vendor --}}
          <a href="{{ route('master.vendor.create') }}"
            class="group flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 hover:from-blue-700 hover:to-blue-800 transition-all duration-200 font-medium">
            <span class="iconify" data-icon="solar:add-circle-bold" data-width="20"></span>
            <span>Tambah Vendor</span>
          </a>
        </div>

        {{-- Stats Cards (Optional) --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3">
              <div class="p-3 bg-blue-50 rounded-lg">
                <span class="iconify text-blue-600" data-icon="solar:shop-bold-duotone" data-width="24"></span>
              </div>
              <div>
                <p class="text-sm text-gray-500">Total Vendor</p>
                <p class="text-2xl font-bold text-gray-900">{{ $vendors->total() }}</p>
              </div>
            </div>
          </div>
        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

          {{-- Table Header --}}
          <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
            <h2 class="text-lg font-semibold text-gray-900">Daftar Vendor</h2>
          </div>

          {{-- Table Content --}}
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Nama Vendor
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Kontak
                  </th>
                  <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Aksi
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100">
                @forelse ($vendors as $vendor)
                  <tr class="group hover:bg-blue-50/30 transition-colors duration-150">
                    <td class="px-6 py-4">
                      <div class="flex items-center gap-3">
                        <div
                          class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-sm">
                          <span class="text-white font-semibold text-sm">
                            {{ strtoupper(substr($vendor->nama, 0, 2)) }}
                          </span>
                        </div>
                        <div>
                          <p class="font-semibold text-gray-900">{{ $vendor->nama }}</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      @if ($vendor->kontak)
                        <div class="flex items-center gap-2 text-gray-700">
                          <span class="iconify text-gray-400" data-icon="solar:phone-outline" data-width="18"></span>
                          <span>{{ $vendor->kontak }}</span>
                        </div>
                      @else
                        <span class="text-gray-400 italic">Tidak ada kontak</span>
                      @endif
                    </td>
                    <td class="px-6 py-4">
                      <div class="flex items-center justify-center gap-2">
                        <a href="{{ route('master.vendor.edit', $vendor->id) }}"
                          class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-150"
                          title="Edit">
                          <span class="iconify" data-icon="solar:pen-bold" data-width="20"></span>
                        </a>


                        <form id="deleteForm-{{ $vendor->id }}"
                          action="{{ route('master.vendor.destroy', $vendor->id) }}" method="POST" class="inline">
                          @csrf
                          @method('DELETE')
                          <button type="button" onclick="confirmDelete('deleteForm-{{ $vendor->id }}')"
                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-150"
                            title="Hapus">
                            <span class="iconify" data-icon="solar:trash-bin-trash-bold" data-width="20"></span>
                          </button>
                        </form>

                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" class="px-6 py-12 text-center">
                      <div class="flex flex-col items-center gap-3">
                        <div class="p-4 bg-gray-50 rounded-full">
                          <span class="iconify text-gray-300" data-icon="solar:box-bold-duotone" data-width="48"></span>
                        </div>
                        <div>
                          <p class="text-gray-900 font-semibold">Belum ada vendor</p>
                          <p class="text-gray-500 text-sm mt-1">Klik tombol "Tambah Vendor" untuk memulai</p>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          {{-- Pagination --}}
          @if ($vendors->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
              {{ $vendors->links() }}
            </div>
          @endif
        </div>

      </div>
    </div>
  @endsection

  @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- SweetAlert2: Success Toast --}}
    @if (session('success'))
      <script>
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true,
          background: "#ffffff",
          color: "#333",
          customClass: {
            popup: "rounded-xl shadow-lg",
          }
        });

        Toast.fire({
          icon: "success",
          title: "{{ session('success') }}"
        });
      </script>
    @endif

    {{-- SweetAlert2: Error Toast --}}
    @if (session('error'))
      <script>
        const ToastErr = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2500,
          timerProgressBar: true,
          background: "#ffe6e6",
          color: "#b00000",
          customClass: {
            popup: "rounded-xl shadow-lg",
          }
        });

        ToastErr.fire({
          icon: "error",
          title: "{{ session('error') }}"
        });
      </script>
    @endif

    {{-- Dialog Konfirmasi Delete --}}
    <script>
      function confirmDelete(formId) {
        Swal.fire({
          title: "Hapus Vendor?",
          text: "Vendor akan terhapus permanen!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#e3342f",
          cancelButtonColor: "#6c757d",
          confirmButtonText: "Ya, hapus!",
          cancelButtonText: "Batal",
          reverseButtons: true,
        }).then((result) => {
          if (result.isConfirmed) {
            document.getElementById(formId).submit();
          }
        });
      }
    </script>
  @endpush
