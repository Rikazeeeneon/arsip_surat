@extends('layouts.admin')

@section('content')

<!-- HEADER -->
<div class="mb-6">
    <h1 class="text-2xl font-semibold">Edit User</h1>
    <p class="text-sm text-gray-500">Perbarui data akun user</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-xl">

    @if ($errors->any())
        <div class="mb-4 bg-red-50 text-red-700 p-3 rounded text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('super_admin.users.update', $user->id) }}" class="space-y-4">
        @csrf
        @method('PUT')
        

        <!-- USERNAME -->
        <div>
            <label class="block text-sm font-medium mb-1">Username</label>
            <input
                type="text"
                name="username"
                value="{{ old('username', $user->username) }}"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                required
            >
        </div>

        <!-- PASSWORD -->
        <div>
            <label class="block text-sm font-medium mb-1">
                Password <span class="text-xs text-gray-400">(kosongkan jika tidak diubah)</span>
            </label>
             <input
            type="password"
            name="password"
            id="password"
            required
            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-200 pr-10">

        <button
            type="button"
            onclick="togglePassword()"
            class=" text-gray-500 hover:text-blue-600">
            <span id="eye">👁</span>
        </button>
        </div>

        <!-- ROLE -->
        <div>
            <label class="block text-sm font-medium mb-1">Role</label>
            <select
                name="role"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
            >
                <option value="user" @selected($user->role === 'user')>User</option>
                <option value="admin" @selected($user->role === 'admin')>Admin</option>
            </select>
        </div>

        <!-- BUTTON -->
        <div class="pt-2 flex gap-3">
            <button
                type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                Simpan Perubahan
            </button>

            <a href="{{ route('super_admin.users.index') }}"
               class="px-5 py-2 rounded-lg border hover:bg-gray-50 transition">
                Batal
            </a>
        </div>

    </form>
</div>

@endsection
<script>
function togglePassword() {
    const input = document.getElementById('password');
    const eye = document.getElementById('eye');

    if (input.type === 'password') {
        input.type = 'text';
        eye.textContent = '🙈';
    } else {
        input.type = 'password';
        eye.textContent = '👁';
    }
}
</script>