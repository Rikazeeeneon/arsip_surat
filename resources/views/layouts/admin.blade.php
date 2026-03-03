<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Panel</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-800 text-white fixed inset-y-0 left-0">
        <div class="h-16 flex items-center justify-center border-b border-blue-700 font-semibold text-lg">
            {{ auth()->user()->role === 'super_admin' ? 'Super Admin Panel' : 'Admin Panel' }}
        </div>

        <nav class="p-4 space-y-2 text-sm">

            {{-- DASHBOARD --}}
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-4 py-2 rounded-lg transition hover:bg-blue-700
                   {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 shadow text-white' : 'text-blue-100' }}">
                    Dashboard
                </a>
            @endif

            @if(auth()->user()->role === 'super_admin')
                <a href="{{ route('super_admin.dashboard') }}"
                   class="block px-4 py-2 rounded-lg transition hover:bg-blue-700
                   {{ request()->routeIs('super_admin.dashboard') ? 'bg-blue-700 shadow text-white' : 'text-blue-100' }}">
                    Dashboard
                </a>
            @endif


            {{-- MENU KHUSUS SUPER ADMIN --}}
            @if(auth()->user()->role === 'super_admin')

                <a href="{{ route('super_admin.users.index') }}"
                   class="block px-4 py-2 rounded-lg transition hover:bg-blue-700
                   {{ request()->routeIs('super_admin.users.index') ? 'bg-blue-700 shadow text-white' : 'text-blue-100' }}">
                    Daftar User
                </a>

                <a href="{{ route('super_admin.users.create') }}"
                   class="block px-4 py-2 rounded-lg transition hover:bg-blue-700
                   {{ request()->routeIs('super_admin.users.create') ? 'bg-blue-700 shadow text-white' : 'text-blue-100' }}">
                    Buat User
                </a>

            @endif

        </nav>
    </aside>

    <!-- CONTENT AREA -->
    <div class="flex-1 ml-64">

        <!-- NAVBAR -->
        <header class="h-16 bg-blue-600 text-white flex items-center justify-between px-6 sticky top-0 z-50 shadow">

            <div class="flex items-center gap-3">
                <img
                    src="{{ asset('images/logo csirt.png') }}"
                    alt="Logo"
                    class="w-20 h-20 rounded-full object-contain"
                />
                <span class="font-medium text-sm">
                    {{ auth()->user()->role === 'super_admin' ? 'Dashboard Super Admin' : 'Dashboard Admin' }}
                </span>
            </div>

            <div class="flex items-center gap-4 text-sm">
                <span>
                    Selamat datang,
                    {{ auth()->user()->username ?? 'User' }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
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