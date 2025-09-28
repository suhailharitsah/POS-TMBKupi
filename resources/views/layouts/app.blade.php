<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }" class="h-full">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite('resources/css/app.css')
  <title>@yield('title', 'Dashboard - TMB Kupi')</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <script src="//unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.1.1/dist/flowbite.min.js"></script>

  {{-- SweetAlert2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Tom Select CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
  <!-- Tom Select JS -->
  <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

  {{-- Flatpickr --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
</head>

<body class="h-full bg-gray-100 flex">

  <x-sidebar />

  <!-- Main Content -->
  <div class="flex-1 flex flex-col md:ml-64">
    <!-- Navbar -->
    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
      <!-- Tombol Hamburger untuk mobile & tablet -->
      <button @click="sidebarOpen = true" class="md:hidden text-gray-600 focus:outline-none">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
      <h1 class="text-lg font-semibold text-gray-700">@yield('page-title', 'Dashboard')</h1>
      <span class="text-gray-500">Halo, {{ Auth::user()->name ?? 'Guest' }}</span>
    </header>

    <!-- Konten -->
    <main class="p-6 flex-1">
      <div class="bg-white rounded-xl shadow-md p-6">
        @yield('content')
      </div>
    </main>
  </div>


  {{-- Script Stack --}}
  @stack('scripts')

</body>

</html>
