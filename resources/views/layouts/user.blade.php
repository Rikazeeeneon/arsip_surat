<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>User Panel</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- NAVBAR USER -->
  <nav class="bg-blue-600 h-14 flex items-center px-6 justify-between">
    
    <!-- KIRI: PLACEHOLDER -->
    <div class="flex items-center gap-3">
        <img
    src="{{ asset('images/logo csirt.png') }}"
    alt="Logo"
    class="w-24 h-24 rounded-full object-contain"
>


        <span class="text-white font-semibold text-sm">
            Sistem Arsip Surat Masuk
        </span>
    </div>

    <!-- KANAN: USER / LOGOUT -->
    <div class="flex items-center gap-4">
        <span class="text-white text-sm">
            {{ Auth::user()->username ?? 'User' }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-blue-500 hover:bg-blue-700 px-3 py-1 rounded text-white text-sm mt-4">
                Logout
            </button>
        </form>
    </div>

</nav>


    <!-- CONTENT -->
    <main class="pt-20 px-6 max-w-7xl mx-auto">
        @yield('content')
    </main>

</body>
</html>
