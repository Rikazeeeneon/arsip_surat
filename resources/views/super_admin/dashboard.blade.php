@extends('layouts.admin')

@section('content')

@if(session('success'))
    <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold">Dashboard Super Admin</h1>
        <p class="text-sm text-gray-500">Monitoring seluruh pengajuan surat</p>
    </div>

    <div class="text-sm text-gray-500">
        {{ now()->format('d M Y') }}
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-5 rounded-lg shadow">
        <p class="text-sm text-gray-500">Total Pengajuan</p>
        <p class="text-3xl font-bold mt-1">{{ $total }}</p>
    </div>

    <div class="bg-white p-5 rounded-lg shadow">
        <p class="text-sm text-gray-500">Diproses</p>
        <p class="text-3xl font-bold text-orange-500 mt-1">{{ $diproses }}</p>
    </div>

    <div class="bg-white p-5 rounded-lg shadow">
        <p class="text-sm text-gray-500">Disetujui</p>
        <p class="text-3xl font-bold text-green-600 mt-1">{{ $disetujui }}</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 border-b">
        <h2 class="font-semibold">Daftar Pengajuan</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Nomor Surat</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengajuans as $pengajuan)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">{{ $pengajuan->nomor_surat }}</td>
                    <td class="px-4 py-3">{{ $pengajuan->tanggal_surat }}</td>
                    <td class="px-4 py-3">
                        <x-status-badge :status="$pengajuan->status" />
                    
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('super_admin.pengajuan.show', $pengajuan->id) }}"
                           class="text-blue-600 hover:underline font-medium">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                        Belum ada pengajuan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection