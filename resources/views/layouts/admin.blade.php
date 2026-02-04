<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-800 text-white fixed inset-y-0 left-0">
        <div class="h-16 flex items-center justify-center border-b border-blue-700 font-semibold text-lg">
            Admin Panel
        </div>

    <nav class="p-4 space-y-2 text-sm">

    <!-- DASHBOARD -->
    <a href="{{ route('admin.dashboard') }}"
       class="
           block px-4 py-2 rounded-lg transition
           hover:bg-blue-700
           {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 shadow text-white' : 'text-blue-100' }}
       ">
        Dashboard
    </a>

    <!-- DAFTAR USER -->
    <a href="{{ route('admin.users.index') }}"
       class="
           block px-4 py-2 rounded-lg transition
           hover:bg-blue-700
           {{ request()->routeIs('admin.users.index') ? 'bg-blue-700 shadow text-white' : 'text-blue-100' }}
       ">
        Daftar User
    </a>

    <!-- BUAT USER -->
    <a href="{{ route('admin.users.create') }}"
       class="
           block px-4 py-2 rounded-lg transition
           hover:bg-blue-700
           {{ request()->routeIs('admin.users.create') ? 'bg-blue-700 shadow text-white' : 'text-blue-100' }}
       ">
        Buat User
    </a>

</nav>

    </aside>

    <!-- CONTENT AREA -->
    <div class="flex-1 ml-64">

        <!-- NAVBAR -->
        <header class="h-16 bg-blue-600 text-white flex items-center justify-between px-6 sticky top-0 z-50 shadow">
            <!-- LEFT -->
            <div class="flex items-center gap-3">
                <img
    src="{{ asset('images/logo csirt.png') }}"
    alt="Logo"
    class="w-24 h-24 rounded-full object-contain"
/>
                <span class="font-medium text-sm">
                    Dashboard Admin
                </span>
            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-4 text-sm">
                <span>
                    Selamat datang,
                    {{ auth()->user()->name ?? 'Admin' }}
                </span>

                <form action="/logout" method="POST">
                    @csrf
                    <button class="bg-blue-900 px-3 py-1 rounded hover:bg-blue-950">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- MAIN -->
        <main class="p-6">
            @yield('content')
        </main>

    </div>
</div>

</body>
</html>
