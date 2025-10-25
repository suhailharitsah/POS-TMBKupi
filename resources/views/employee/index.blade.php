@extends('layouts.app')

@section('title', 'Data Karyawan')
@section('page-title', 'Daftar Karyawan')

@section('content')
  <div class="bg-white shadow-lg rounded-2xl p-8">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">
      <div>
        <h2 class="text-2xl font-bold text-gray-800">Daftar Karyawan</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola data karyawan perusahaan</p>
      </div>
      <a href="{{ route('employee.create') }}"
        class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-md hover:shadow-lg font-medium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Karyawan
      </a>
    </div>

    {{-- Tabel --}}
    <div class="overflow-hidden border border-gray-200 rounded-xl">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
            <tr>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                No
              </th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Nama
              </th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Jabatan
              </th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                No. Telepon
              </th>
              <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($employees as $index => $employee)
              <tr class="hover:bg-gray-50 transition-colors duration-150">
                {{-- Gunakan formula pagination --}}
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  {{ ($employees->currentPage() - 1) * $employees->perPage() + $index + 1 }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div
                      class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                      <span class="text-white font-semibold text-sm">
                        {{ strtoupper(substr($employee->nama, 0, 1)) }}
                      </span>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">{{ $employee->nama }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                    {{ $employee->jabatan }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  {{ $employee->telepon }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                  <div class="flex items-center justify-center space-x-3">
                    <a href="{{ route('employee.edit', $employee->id) }}"
                      class="inline-flex items-center px-3 py-2 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition-colors duration-150">
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                      Edit
                    </a>
                    <form action="{{ route('employee.destroy', $employee->id) }}" method="POST"
                      class="inline-block delete-form">
                      @csrf
                      @method('DELETE')
                      <button type="button"
                        class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-150 btn-delete">
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
            @empty
              <tr>
                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                  Tidak ada data karyawan.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      {{-- ✅ Pagination --}}
      @if ($employees->hasPages())
        <div class="mt-8 px-4">
          {{-- Info dan Pagination Container --}}
          <div
            class="flex flex-col sm:flex-row justify-between items-center gap-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200">

            {{-- Informasi Data --}}
            <div class="flex items-center space-x-2">
              <div class="bg-blue-100 p-2 rounded-lg">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
              </div>
              <div class="text-sm text-gray-700">
                Menampilkan
                <span class="font-bold text-blue-600">{{ $employees->firstItem() }}</span>
                -
                <span class="font-bold text-blue-600">{{ $employees->lastItem() }}</span>
                dari
                <span class="font-bold text-gray-900">{{ $employees->total() }}</span>
                karyawan
              </div>
            </div>

            {{-- Pagination Navigation --}}
            <div class="flex items-center space-x-1">
              {{-- Previous Button --}}
              @if ($employees->onFirstPage())
                <span class="px-3 py-2 text-gray-400 bg-gray-200 rounded-lg cursor-not-allowed">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                  </svg>
                </span>
              @else
                <a href="{{ $employees->previousPageUrl() }}"
                  class="px-3 py-2 text-gray-700 bg-white hover:bg-blue-50 rounded-lg transition-all duration-150 shadow-sm hover:shadow border border-gray-300 hover:border-blue-300">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                  </svg>
                </a>
              @endif

              {{-- Page Numbers --}}
              <div class="hidden sm:flex items-center space-x-1">
                @foreach ($employees->getUrlRange(1, $employees->lastPage()) as $page => $url)
                  @if ($page == $employees->currentPage())
                    <span
                      class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg shadow-md">
                      {{ $page }}
                    </span>
                  @elseif ($page == 1 || $page == $employees->lastPage() || abs($page - $employees->currentPage()) <= 2)
                    <a href="{{ $url }}"
                      class="px-4 py-2 text-gray-700 bg-white hover:bg-blue-50 rounded-lg transition-all duration-150 shadow-sm hover:shadow border border-gray-300 hover:border-blue-300 font-medium">
                      {{ $page }}
                    </a>
                  @elseif (abs($page - $employees->currentPage()) == 3)
                    <span class="px-2 text-gray-500">...</span>
                  @endif
                @endforeach
              </div>

              {{-- Mobile: Current Page Info --}}
              <div
                class="sm:hidden px-4 py-2 bg-white rounded-lg border border-gray-300 text-sm font-medium text-gray-700">
                {{ $employees->currentPage() }} / {{ $employees->lastPage() }}
              </div>

              {{-- Next Button --}}
              @if ($employees->hasMorePages())
                <a href="{{ $employees->nextPageUrl() }}"
                  class="px-3 py-2 text-gray-700 bg-white hover:bg-blue-50 rounded-lg transition-all duration-150 shadow-sm hover:shadow border border-gray-300 hover:border-blue-300">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                </a>
              @else
                <span class="px-3 py-2 text-gray-400 bg-gray-200 rounded-lg cursor-not-allowed">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                </span>
              @endif
            </div>

          </div>

          {{-- Quick Jump (Optional) --}}
          @if ($employees->lastPage() > 5)
            <div class="mt-3 text-center">
              <form action="{{ $employees->url(1) }}" method="GET" class="inline-flex items-center space-x-2">
                <label class="text-sm text-gray-600">Loncat ke halaman:</label>
                <input type="number" name="page" min="1" max="{{ $employees->lastPage() }}"
                  class="w-20 px-3 py-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  placeholder="{{ $employees->currentPage() }}">
                <button type="submit"
                  class="px-4 py-1 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-150">
                  Go
                </button>
              </form>
            </div>
          @endif
        </div>
      @endif
    </div>
  </div>

@endsection

@push('scripts')
  <script>
    // 🔔 Notifikasi sukses (SweetAlert)
    @if (session('success'))
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 2500,
        showConfirmButton: false,
        toast: true,
        position: 'top-end',
        timerProgressBar: true,
        background: '#fff',
        iconColor: '#10b981',
        customClass: {
          popup: 'rounded-xl shadow-lg'
        }
      });
    @endif

    // 🗑️ Konfirmasi hapus
    document.querySelectorAll('.btn-delete').forEach(button => {
      button.addEventListener('click', function(e) {
        const form = this.closest('form');
        Swal.fire({
          title: 'Yakin ingin menghapus?',
          text: "Data karyawan akan dihapus permanen!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#ef4444',
          cancelButtonColor: '#6b7280',
          confirmButtonText: '<i class="fas fa-trash mr-2"></i>Ya, hapus!',
          cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
          reverseButtons: true,
          customClass: {
            popup: 'rounded-xl',
            confirmButton: 'rounded-lg px-6 py-2.5 shadow-lg',
            cancelButton: 'rounded-lg px-6 py-2.5 shadow-lg'
          },
          buttonsStyling: true
        }).then((result) => {
          if (result.isConfirmed) {
            // Loading indicator
            Swal.fire({
              title: 'Menghapus...',
              text: 'Mohon tunggu sebentar',
              allowOutsideClick: false,
              showConfirmButton: false,
              willOpen: () => {
                Swal.showLoading();
              }
            });
            form.submit();
          }
        });
      });
    });

    // 🔄 Scroll ke atas otomatis saat ganti halaman (modern UX)
    document.addEventListener('click', e => {
      const paginationLink = e.target.closest('a[href*="page="]');
      if (paginationLink) {
        e.preventDefault();

        // Smooth scroll to top
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });

        // Navigate after scroll animation
        setTimeout(() => {
          window.location.href = paginationLink.href;
        }, 300);
      }
    });

    // ⌨️ Keyboard navigation untuk pagination
    document.addEventListener('keydown', (e) => {
      const prevButton = document.querySelector('a[rel="prev"]');
      const nextButton = document.querySelector('a[rel="next"]');

      // Arrow Left = Previous Page
      if (e.key === 'ArrowLeft' && prevButton) {
        prevButton.click();
      }

      // Arrow Right = Next Page
      if (e.key === 'ArrowRight' && nextButton) {
        nextButton.click();
      }
    });
  </script>
@endpush
