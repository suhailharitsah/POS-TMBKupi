<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Login TMB Kupi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    body {
      font-family: 'Inter', sans-serif;
    }

    .gradient-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .coffee-pattern {
      background-color: #f97316;
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .glass-effect {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
    }

    .input-focus {
      transition: all 0.3s ease;
    }

    .input-focus:focus {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(249, 115, 22, 0.2);
    }

    .btn-hover {
      transition: all 0.3s ease;
    }

    .btn-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(249, 115, 22, 0.4);
    }

    .fade-in {
      animation: fadeIn 0.6s ease-in;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .image-overlay {
      position: relative;
      overflow: hidden;
    }

    .image-overlay::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(135deg, rgba(249, 115, 22, 0.3) 0%, rgba(234, 88, 12, 0.5) 100%);
      z-index: 1;
    }

    .coffee-icon {
      animation: steam 2s ease-in-out infinite;
    }

    @keyframes steam {

      0%,
      100% {
        transform: translateY(0);
        opacity: 0.7;
      }

      50% {
        transform: translateY(-5px);
        opacity: 1;
      }
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center coffee-pattern p-4">
  <div class="fade-in flex flex-col lg:flex-row w-full max-w-6xl glass-effect rounded-3xl shadow-2xl overflow-hidden">

    <!-- Bagian Kiri: Form Login -->
    <div class="w-full lg:w-1/2 p-6 sm:p-8 md:p-10 lg:p-12 xl:p-16 flex flex-col justify-center">
      <!-- Logo & Header -->
      <div class="text-center mb-8 md:mb-10">
        <div
          class="inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl mb-4 shadow-lg coffee-icon">
          <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
          </svg>
        </div>
        <h1
          class="text-2xl sm:text-3xl md:text-4xl font-bold bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">
          TMBKupi</h1>
        <p class="text-gray-600 text-sm sm:text-base md:text-lg mt-2 font-medium">Selamat Datang Kembali</p>
        <p class="text-gray-500 text-xs sm:text-sm mt-1">Login ke sistem kasir Anda</p>
      </div>

      <!-- Form -->
      <form action="{{ route('login.post') }}" method="POST" class="space-y-5 md:space-y-6">
        @csrf

        <!-- Email Input -->
        <div>
          <label for="email" class="block text-sm md:text-base font-semibold text-gray-700 mb-2">Email</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
              </svg>
            </div>
            <input type="email" name="email" id="email" required
              class="input-focus w-full pl-10 pr-4 py-3 md:py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 text-sm md:text-base focus:outline-none"
              placeholder="nama@email.com">
          </div>
        </div>

        <!-- Password Input -->
        <div>
          <label for="password" class="block text-sm md:text-base font-semibold text-gray-700 mb-2">Password</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>
            <input type="password" name="password" id="password" required
              class="input-focus w-full pl-10 pr-12 py-3 md:py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 text-sm md:text-base focus:outline-none"
              placeholder="••••••••" aria-describedby="togglePasswordDesc">

            <button type="button" id="togglePassword"
              class="absolute inset-y-0 right-0 pr-3 flex items-center focus:outline-none hover:text-orange-500 transition-colors"
              aria-label="Tampilkan password" title="Tampilkan / sembunyikan password">
              <svg id="iconEye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" />
                <circle cx="12" cy="12" r="3" />
              </svg>
              <svg id="iconEyeOff" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hidden"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a19.15 19.15 0 0 1 5.13-6.02" />
                <path d="M1 1l22 22" />
                <path d="M9.88 9.88A3 3 0 0 0 14.12 14.12" />
                <path d="M14.12 9.88A3 3 0 0 1 9.88 14.12" />
              </svg>
            </button>
          </div>
          <p id="togglePasswordDesc" class="sr-only">Tombol untuk menampilkan atau menyembunyikan password</p>
        </div>

        <!-- Remember & Forgot Password -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs sm:text-sm">
          <label class="flex items-center space-x-2 cursor-pointer group">
            <input type="checkbox" name="remember"
              class="w-4 h-4 rounded border-2 border-gray-300 text-orange-500 focus:ring-2 focus:ring-orange-400 cursor-pointer">
            <span class="text-gray-600 group-hover:text-gray-800 transition-colors">Ingat saya</span>
          </label>
          <a href="#"
            class="text-orange-500 hover:text-orange-600 font-medium hover:underline transition-colors">Lupa
            password?</a>
        </div>

        <!-- Login Button -->
        <button type="submit"
          class="btn-hover w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold rounded-xl py-3 md:py-4 transition duration-200 text-sm md:text-base shadow-lg">
          Masuk Sekarang
        </button>
      </form>

      <!-- Divider -->
      <div class="relative my-6 md:my-8">
        <div class="absolute inset-0 flex items-center">
          <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-xs sm:text-sm">
          <span class="px-4 bg-white text-gray-500">atau</span>
        </div>
      </div>

      <!-- Register Link -->
      <p class="text-center text-xs sm:text-sm md:text-base text-gray-600">
        Belum punya akun?
        <a href="{{ route('register') }}"
          class="text-orange-500 hover:text-orange-600 font-semibold hover:underline transition-colors ml-1">Daftar
          sekarang</a>
      </p>

      <!-- Footer -->
      <p class="text-center text-xs sm:text-sm text-gray-400 mt-6 md:mt-8">
        © {{ date('Y') }} TMB Kupi - Sistem Kasir Professional
      </p>
    </div>

    <!-- Bagian Kanan: Gambar & Info -->
    <div class="hidden lg:flex lg:w-1/2 image-overlay relative">
      <img
        src="https://images.unsplash.com/photo-1556742526-795a8eac090e?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0"
        alt="Coffee Shop" class="h-full w-full object-cover">

      <!-- Overlay Content -->
      <div class="absolute inset-0 z-10 flex flex-col items-center justify-center p-12 text-white">
        <div class="text-center space-y-6 max-w-md">
          <h2 class="text-3xl xl:text-4xl font-bold drop-shadow-lg">Kelola Bisnis Anda</h2>
          <p class="text-base xl:text-lg drop-shadow-lg opacity-90">
            Sistem kasir modern untuk coffee shop yang memudahkan transaksi dan manajemen inventory Anda
          </p>

          <!-- Features -->
          <div class="grid grid-cols-2 gap-4 mt-8">
            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4">
              <div class="text-2xl xl:text-3xl font-bold mb-1">100%</div>
              <div class="text-xs xl:text-sm opacity-90">Mudah Digunakan</div>
            </div>
            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4">
              <div class="text-2xl xl:text-3xl font-bold mb-1">24/7</div>
              <div class="text-xs xl:text-sm opacity-90">Support</div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Script -->
  <script>
    (function() {
      const passwordInput = document.getElementById('password')
      const toggleBtn = document.getElementById('togglePassword')
      const iconEye = document.getElementById('iconEye')
      const iconEyeOff = document.getElementById('iconEyeOff')

      toggleBtn.addEventListener('click', function() {
        const isPassword = passwordInput.type === 'password'
        passwordInput.type = isPassword ? 'text' : 'password'

        if (isPassword) {
          iconEye.classList.add('hidden')
          iconEyeOff.classList.remove('hidden')
          toggleBtn.setAttribute('aria-label', 'Sembunyikan password')
          toggleBtn.title = 'Sembunyikan password'
        } else {
          iconEye.classList.remove('hidden')
          iconEyeOff.classList.add('hidden')
          toggleBtn.setAttribute('aria-label', 'Tampilkan password')
          toggleBtn.title = 'Tampilkan password'
        }
      })

      toggleBtn.addEventListener('keydown', function(e) {
        if (e.key === ' ' || e.key === 'Enter') {
          e.preventDefault()
          toggleBtn.click()
        }
      })
    })()
  </script>
</body>

</html>
