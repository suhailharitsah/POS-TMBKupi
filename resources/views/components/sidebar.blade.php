<!-- Sidebar Mobile & Tablet -->
<div x-show="sidebarOpen" class="fixed inset-0 flex z-40 md:hidden" role="dialog" aria-modal="true">
  <!-- Overlay -->
  <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900 bg-opacity-75" @click="sidebarOpen = false">
  </div>

  <!-- Sidebar -->
  <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full" class="relative flex-1 flex flex-col max-w-xs w-full bg-gray-800">

    <!-- Tombol close -->
    <div class="absolute top-0 right-0 -mr-12 pt-2">
      <button @click="sidebarOpen = false"
        class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-white">
        <span class="sr-only">Close sidebar</span>
        <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Isi Sidebar -->
    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
      <div class="flex items-center px-4 text-xl font-bold gap-2 text-white">
        <span class="text-green-400">
          <span class="iconify" data-icon="fluent:leaf-24-filled" data-width="24"></span>
        </span>
        TMBKupi
      </div>
      <nav class="mt-5 space-y-1 px-2 text-white">
        <a href="{{ route('dashboard') }}"
          class="flex items-center px-2 py-2 text-base font-medium hover:bg-gray-700 rounded-md gap-3">
          <span class="iconify" data-icon="solar:home-bold-duotone" data-width="20"></span>
          Dashboard
        </a>
        <a href="{{ route('master.index') }}"
          class="flex items-center px-2 py-2 text-base font-medium hover:bg-gray-700 rounded-md gap-3">
          <span class="iconify" data-icon="solar:database-bold-duotone" data-width="20"></span>
          Master
        </a>
        <a href="{{ route('transaksi.index') }}"
          class="flex items-center px-2 py-2 text-base font-medium hover:bg-gray-700 rounded-md gap-3">
          <span class="iconify" data-icon="solar:cart-3-bold-duotone" data-width="20"></span>
          Transaksi
        </a>
        <a href="#" class="flex items-center px-2 py-2 text-base font-medium hover:bg-gray-700 rounded-md gap-3">
          <span class="iconify" data-icon="solar:clipboard-bold-duotone" data-width="20"></span>
          Laporan
        </a>
        <a href="#" class="flex items-center px-2 py-2 text-base font-medium hover:bg-gray-700 rounded-md gap-3">
          <span class="iconify" data-icon="solar:shield-user-bold-duotone" data-width="20"></span>
          Karyawan
        </a>
        <a href="{{ route('users.index') }}"
          class="flex items-center px-2 py-2 text-base font-medium hover:bg-gray-700 rounded-md gap-3">
          <span class="iconify" data-icon="solar:users-group-two-rounded-bold-duotone" data-width="20"></span>
          Pengguna
        </a>
      </nav>
    </div>
  </div>
</div>

<!-- Sidebar Desktop -->
<aside class="hidden md:flex md:w-64 bg-gray-800 text-white flex-col fixed inset-y-0">
  <div class="p-4 text-xl font-bold flex items-center gap-2">
    <span class="text-amber-800">
      <span class="iconify" data-icon="mdi:coffee" data-width="24"></span>
    </span>
    TMBKupi
  </div>
  <nav class="flex-1 space-y-1">

    {{-- Dashboard --}}
    <a href="{{ route('dashboard') }}"
      class="flex items-center gap-3 px-4 py-2 mx-2 rounded-lg font-medium
        {{ request()->is('dashboard') ? 'bg-blue-100 text-blue-700' : 'text-white hover:bg-gray-50 hover:text-gray-900' }}">
      <span class="iconify" data-icon="solar:home-bold-duotone" data-width="20"></span>
      Dashboard
    </a>

    {{-- Master --}}
    <a href="{{ route('master.index') }}"
      class="flex items-center gap-3 px-4 py-2 mx-2 rounded-lg font-medium
        {{ request()->is('master') || request()->is('master/*') ? 'bg-blue-100 text-blue-700' : 'text-white hover:bg-gray-50 hover:text-gray-900' }}">
      <span class="iconify" data-icon="solar:database-bold-duotone" data-width="20"></span>
      Master
    </a>

    {{-- Transaksi --}}
    <a href="{{ route('transaksi.index') }}"
      class="flex items-center gap-3 px-4 py-2 mx-2 rounded-lg font-medium
        {{ request()->is('transaksi') || request()->is('transaksi/*') ? 'bg-blue-100 text-blue-700' : 'text-white hover:bg-gray-50 hover:text-gray-900' }}">
      <span class="iconify" data-icon="solar:cart-3-bold-duotone" data-width="20"></span>
      Transaksi
    </a>

    {{-- Laporan --}}
    <a href="#"
      class="flex items-center gap-3 px-4 py-2 mx-2 rounded-lg font-medium
        {{ request()->is('#') ? 'bg-blue-100 text-blue-700' : 'text-white hover:bg-gray-50 hover:text-gray-900' }}">
      <span class="iconify" data-icon="solar:clipboard-bold-duotone" data-width="20"></span>
      Laporan
    </a>

    {{-- Karyawan --}}
    <a href="#"
      class="flex items-center gap-3 px-4 py-2 mx-2 rounded-lg font-medium
        {{ request()->is('#') ? 'bg-blue-100 text-blue-700' : 'text-white hover:bg-gray-50 hover:text-gray-900' }}">
      <span class="iconify" data-icon="solar:shield-user-bold-duotone" data-width="20"></span>
      Karyawan
    </a>

    {{-- Pengguna --}}
    <a href="{{ route('users.index') }}"
      class="flex items-center gap-3 px-4 py-2 mx-2 rounded-lg font-medium
        {{ request()->is('users') || request()->is('users/*') ? 'bg-blue-100 text-blue-700' : 'text-white hover:bg-gray-50 hover:text-gray-900' }}">
      <span class="iconify" data-icon="solar:users-group-two-rounded-bold-duotone" data-width="20"></span>
      Pengguna
    </a>
  </nav>
  <div class="p-4 border-t border-gray-700">
    <div class="flex items-center gap-3">
      <img src="https://i.pravatar.cc/40" alt="avatar" class="w-8 h-8 rounded-full">
      <div>
        <p class="font-semibold">Super Admin</p>
        <p class="text-xs text-gray-400">Admin Kasir</p>
      </div>
    </div>
    <form action="{{ route('logout') }}" method="POST" class="mt-3">
      @csrf
      <button type="submit" class="flex items-center gap-2 px-4 py-2 w-full hover:bg-gray-700">
        <span class="iconify" data-icon="solar:logout-2-bold-duotone" data-width="20"></span>
        Logout
      </button>
    </form>
  </div>
</aside>
