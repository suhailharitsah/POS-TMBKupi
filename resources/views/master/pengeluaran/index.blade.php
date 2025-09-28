@extends('layouts.app')

@section('title', 'Pengeluaran')
@section('page-title', 'Pengeluaran')

@section('content')
  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-4 lg:p-8">
    <div class="max-w-7xl mx-auto space-y-2">

      {{-- Tombol Back --}}
      <div>
        <a href="{{ route('master.index') }}"
          class="inline-flex items-center justify-center w-10 h-10 text-gray-600 hover:text-white hover:bg-sky-500 rounded-lg transition duration-200">
          <span class="iconify text-2xl" data-icon="solar:alt-arrow-left-bold"></span>
        </a>
      </div>

      {{-- Header --}}
      <div class="text-center pb-4">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Kelola Pengeluaran</h1>
        <p class="text-gray-600">Catat dan pantau pengeluaran bisnis Anda</p>
      </div>

      {{-- Form Card --}}
      <x-pengeluaran.form-card />

      {{-- Data Table Card --}}
      <x-pengeluaran.data-table-card :pengeluarans="$pengeluarans" />

    </div>
  </div>

  {{-- Modal Edit --}}
  <div id="editModal" class="fixed inset-0 hidden bg-black bg-opacity-50 items-center justify-center z-50 transition">
    <div id="modalContent"
      class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 transform transition-all duration-300 scale-95 opacity-0">

      {{-- Header --}}
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-gray-800">Edit Pengeluaran</h2>
        <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
          ✕
        </button>
      </div>

      {{-- Form --}}
      <form id="editForm" method="POST">
        @csrf
        @method('PUT')

        {{-- Keterangan --}}
        <div class="mb-4">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
          <input type="text" id="edit_keterangan" name="keterangan" required
            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl
                 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 text-sm">
        </div>

        {{-- Kategori --}}
        <div class="group relative" x-data="{ open: false, selected: '' }" @click.away="open = false" id="kategoriEditWrapper">
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
            class="absolute left-0 mt-2 w-full bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden z-80">
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
          <input type="hidden" name="kategori" x-model="selected" id="edit_kategori">
        </div>

        {{-- Nominal --}}
        <div class="mb-4">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Nominal</label>
          <div class="flex items-center">
            <span class="px-3 py-3 bg-gray-100 border border-r-0 border-gray-200 rounded-l-xl text-sm text-gray-600">
              Rp
            </span>
            <input type="text" id="edit_nominal" name="nominal" required
              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-r-xl
                   focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 text-sm"
              placeholder="0">
          </div>
        </div>

        {{-- Tanggal --}}
        <div class="mb-4">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
          <input type="date" id="edit_tanggal" name="tanggal" required
            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl
                 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 text-sm">
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-3">
          <button type="button" onclick="closeModal()"
            class="px-4 py-2 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-100">
            Batal
          </button>
          <button type="submit" class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection

@push('scripts')
  <script>
    @if (session('success'))
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end',
        background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
        color: 'white',
        customClass: {
          popup: 'backdrop-blur-sm'
        }
      });
    @endif

    // ==============================
    // Nama hari Indonesia
    // ==============================
    const namaHari = {
      'Monday': 'Senin',
      'Tuesday': 'Selasa',
      'Wednesday': 'Rabu',
      'Thursday': 'Kamis',
      'Friday': 'Jumat',
      'Saturday': 'Sabtu',
      'Sunday': 'Minggu'
    };

    // ==============================
    // Format Rupiah
    // ==============================
    function setupRupiahInput(inputEl) {
      if (!inputEl) return;

      inputEl.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value) {
          value = value.replace(/^0+/, '');
          if (value === '') value = '0';
          this.value = new Intl.NumberFormat('id-ID').format(value);
        } else {
          this.value = '';
        }
      });

      inputEl.form.addEventListener('submit', function() {
        inputEl.value = inputEl.value.replace(/\./g, '');
      });
    }

    setupRupiahInput(document.getElementById('nominalInput'));
    setupRupiahInput(document.getElementById('edit_nominal'));

    // ==============================
    // Search + Filter
    // ==============================
    function setupSearchAndFilter() {
      const searchInput = document.getElementById('searchInput');
      const tableRows = document.querySelectorAll('.expense-row');
      const emptyState = document.getElementById('emptyState');
      const noResultsState = document.getElementById('noResultsState');
      const tableBody = document.getElementById('expenseTableBody');

      let currentCategoryFilter = '';

      // Search
      if (searchInput) {
        searchInput.addEventListener('input', debounce(function() {
          const searchTerm = this.value.toLowerCase().trim();
          filterTable(searchTerm, currentCategoryFilter);
        }, 300));
      }

      // Filter kategori
      window.filterByCategory = function(category) {
        currentCategoryFilter = category;
        const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
        filterTable(searchTerm, category);
        updateTotalDisplay(category);
      };

      function filterTable(searchTerm, categoryFilter) {
        let visibleCount = 0;

        tableRows.forEach(row => {
          const keterangan = row.dataset.keterangan || '';
          const kategori = row.dataset.kategori || '';

          const matchesSearch = !searchTerm || keterangan.includes(searchTerm);
          const matchesCategory = !categoryFilter || kategori === categoryFilter;

          if (matchesSearch && matchesCategory) {
            row.style.display = '';
            visibleCount++;
          } else {
            row.style.display = 'none';
          }
        });

        if (emptyState) emptyState.style.display = 'none';

        if (visibleCount === 0 && tableRows.length > 0) {
          if (noResultsState) noResultsState.classList.remove('hidden');
        } else {
          if (noResultsState) noResultsState.classList.add('hidden');
        }
      }

      function updateTotalDisplay(categoryFilter) {
        const totalElement = document.getElementById('totalThisMonth');
        if (!totalElement) return;

        let total = 0;
        tableRows.forEach(row => {
          if (row.style.display !== 'none') {
            const nominalText = row.querySelector('td:nth-child(4) div').textContent;
            const nominal = parseInt(nominalText.replace(/\D/g, ''));
            if (!isNaN(nominal)) {
              total += nominal;
            }
          }
        });

        totalElement.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);

        const label = totalElement.previousElementSibling;
        if (label && categoryFilter) {
          label.textContent = `Total ${categoryFilter} Bulan Ini`;
        } else if (label) {
          label.textContent = 'Total Bulan Ini';
        }
      }
    }
    document.addEventListener('DOMContentLoaded', setupSearchAndFilter);

    // ==============================
    // Modal Edit
    // ==============================
    function editItem(id, keterangan, kategori, nominal, tanggal) {
      const editForm = document.getElementById('editForm');
      const editKeterangan = document.getElementById('edit_keterangan');
      const editNominal = document.getElementById('edit_nominal');
      const editTanggal = document.getElementById('edit_tanggal');

      if (editForm) editForm.action = `/master/pengeluaran/${id}`;
      if (editKeterangan) editKeterangan.value = keterangan;
      if (editNominal) editNominal.value = new Intl.NumberFormat('id-ID').format(nominal);
      if (editTanggal) editTanggal.value = tanggal;

      const wrapper = document.getElementById('kategoriEditWrapper');
      if (wrapper && wrapper.__x && wrapper.__x.$data) {
        wrapper.__x.$data.selected = kategori;
      }

      const hiddenKategori = document.getElementById('edit_kategori');
      if (hiddenKategori) hiddenKategori.value = kategori;

      const trigger = wrapper ? wrapper.querySelector('[x-text]') : null;
      if (trigger) {
        trigger.textContent = kategori || 'Pilih kategori';
      }

      if (wrapper) {
        wrapper.querySelectorAll('li').forEach(li => {
          if (li.textContent.trim().includes(kategori)) {
            li.classList.add('bg-blue-50');
          } else {
            li.classList.remove('bg-blue-50');
          }
        });
      }

      showModal();
    }

    function showModal() {
      const modal = document.getElementById('editModal');
      const content = document.getElementById('modalContent');

      if (modal && content) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        modal.offsetHeight;

        setTimeout(() => {
          modal.classList.add('backdrop-blur-sm');
          content.classList.remove('scale-95', 'opacity-0');
          content.classList.add('scale-100', 'opacity-100');
        }, 10);
      }
    }

    function closeModal() {
      const modal = document.getElementById('editModal');
      const content = document.getElementById('modalContent');

      if (modal && content) {
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        modal.classList.remove('backdrop-blur-sm');

        setTimeout(() => {
          modal.classList.add('hidden');
          modal.classList.remove('flex');
        }, 300);
      }
    }

    // ==============================
    // Delete
    // ==============================
    function deleteItem(id) {
      Swal.fire({
        title: 'Hapus Pengeluaran?',
        text: 'Data yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        background: 'white',
        customClass: {
          popup: 'backdrop-blur-sm border border-gray-200 shadow-2xl rounded-3xl',
          actions: 'space-x-3', // 🔹 kasih jarak antar tombol
          confirmButton: 'bg-red-600 hover:bg-red-700 text-white rounded-2xl px-6 py-3 font-semibold',
          cancelButton: 'bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-2xl px-6 py-3 font-semibold'
        },
        buttonsStyling: false
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Menghapus...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            showConfirmButton: false,
            background: 'white',
            customClass: {
              popup: 'backdrop-blur-sm border border-gray-200 shadow-2xl rounded-3xl'
            },
            didOpen: () => {
              Swal.showLoading();
            }
          });

          const form = document.createElement('form');
          form.method = 'POST';
          form.action = `/master/pengeluaran/${id}`;
          form.innerHTML = `@csrf @method('DELETE')`;
          document.body.appendChild(form);
          form.submit();
        }
      });
    }



    // ==============================
    // Shortcut
    // ==============================
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeModal();
      }
      if (e.ctrlKey && e.key === 'f') {
        e.preventDefault();
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
          searchInput.focus();
          searchInput.select();
        }
      }
    });

    // ==============================
    // Animasi saat load
    // ==============================
    document.addEventListener('DOMContentLoaded', function() {
      const now = new Date();
      const timeString = now.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
      });

      const addForm = document.getElementById('addExpenseForm');
      if (addForm && !document.getElementById('waktu_input')) {
        const timeInput = document.createElement('input');
        timeInput.type = 'hidden';
        timeInput.name = 'waktu';
        timeInput.id = 'waktu_input';
        timeInput.value = timeString;
        addForm.appendChild(timeInput);
      }

      const rows = document.querySelectorAll('.expense-row');
      rows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';

        setTimeout(() => {
          row.style.transition = 'all 0.5s ease';
          row.style.opacity = '1';
          row.style.transform = 'translateY(0)';
        }, index * 100);
      });
    });

    // ==============================
    // Utility
    // ==============================
    function formatTanggalIndonesia(dateString) {
      const date = new Date(dateString);
      const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      };
      return date.toLocaleDateString('id-ID', options);
    }

    function debounce(func, wait) {
      let timeout;
      return function executedFunction(...args) {
        const later = () => {
          clearTimeout(timeout);
          func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
      };
    }

    // ==============================
    // Filter Tanggal dengan Flatpickr
    // ==============================
    document.addEventListener("DOMContentLoaded", function() {
      if (document.getElementById("filterTanggal")) {
        flatpickr("#filterTanggal", {
          dateFormat: "Y-m-d",
          altInput: true,
          altFormat: "l, d F Y",
          locale: "id",
          allowInput: true,
          defaultDate: "{{ request('tanggal') }}"
        });
      }
    });
  </script>
@endpush
