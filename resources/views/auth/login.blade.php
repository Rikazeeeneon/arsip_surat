<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <title>Login | Arsip Surat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">

    <h1 class="text-2xl font-semibold text-center text-blue-600 mb-2">
        Arsip Surat
    </h1>
    <p class="text-center text-gray-500 mb-6">
        Silakan masuk untuk melanjutkan
    </p>

    @if ($errors->any())
        <div class="mb-4 bg-red-50 text-red-600 p-3 rounded text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Username</label>
            <input type="text" name="username" required autofocus
                class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-200">
        </div>

      <div>
    <label class="block text-sm font-medium mb-1">Password</label>

    <div class="relative">
        <input
            type="password"
            name="password"
            id="password"
            required
            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-200 pr-10">

    </div>
</div>


        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-medium transition">
            Login
        </button>
    </form>

</div>

</body>
</html>

<script>
