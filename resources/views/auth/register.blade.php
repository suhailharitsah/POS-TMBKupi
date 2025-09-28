<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register TMB Kupi</title>
  @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center bg-[#D3DAD9]">
  <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden">

    {{-- Bagian Kiri: Form Register --}}
    <div class="w-full md:w-1/2 p-6 sm:p-8 lg:p-10 flex flex-col justify-center">
      <div class="text-center mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">TMBKupi</h1>
        <p class="text-gray-500 text-sm sm:text-base mt-1">Buat akun baru untuk kasir</p>
      </div>

      <form action="#" method="POST" class="space-y-4 sm:space-y-5">
        @csrf
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
          <input type="text" name="name" id="name" required
            class="mt-1 w-full border rounded-lg border-gray-300 focus:outline-none focus:ring-0 focus:border-orange-400 p-2 sm:p-3 text-sm sm:text-base">
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" name="email" id="email" required
            class="mt-1 w-full border rounded-lg border-gray-300 focus:outline-none focus:ring-0 focus:border-orange-400 p-2 sm:p-3 text-sm sm:text-base">
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="password" id="password" required
            class="mt-1 w-full border rounded-lg border-gray-300 focus:outline-none focus:ring-0 focus:border-orange-400 p-2 sm:p-3 text-sm sm:text-base">
        </div>
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" id="password_confirmation" required
            class="mt-1 w-full border rounded-lg border-gray-300 focus:outline-none focus:ring-0 focus:border-orange-400 p-2 sm:p-3 text-sm sm:text-base">
        </div>

        <button type="submit"
          class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg py-2 sm:py-3 transition duration-200 text-sm sm:text-base">
          Register
        </button>
      </form>

      <p class="text-center text-xs sm:text-sm text-gray-600 mt-4">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-orange-500 hover:underline font-medium">Login di sini</a>
      </p>

      <p class="text-center text-xs sm:text-sm text-gray-500 mt-6">
        © {{ date('Y') }} TMB Kupi - Sistem Kasir TMBKupi
      </p>
    </div>

    {{-- Bagian Kanan: Gambar --}}
    <div class="hidden md:block md:w-1/2">
      <img
        src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0"
        alt="Wallpaper" class="h-full w-full object-cover">
    </div>
  </div>
</body>

</html>
