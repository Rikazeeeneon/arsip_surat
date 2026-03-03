@extends('layouts.admin')

@section('content')

<!-- HEADER -->
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold">Daftar User</h1>
        <p class="text-sm text-gray-500">Kelola akun user yang terdaftar</p>
    </div>

    <a href="{{ route('super_admin.users.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition">
        + Buat User
    </a>
</div>

<!-- TABLE CARD -->
<div class="bg-white rounded-lg shadow overflow-hidden">

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Username</th>
                    <th class="px-4 py-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $user->username }}</td>
                        <td class="px-4 py-3 space-x-3">

    <!-- EDIT -->
    <a href="{{ route('super_admin.users.edit', $user->id) }}"
       class="text-blue-600 hover:underline font-medium">
        Edit
    </a>

    <!-- HAPUS -->
    <form action="{{ route('super_admin.users.destroy', $user->id) }}"
          method="POST"
          class="inline"
          onsubmit="return confirm('Yakin ingin menghapus user ini?')">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="text-red-600 hover:underline font-medium">
            Hapus
        </button>
    </form>

</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                            Belum ada user
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
