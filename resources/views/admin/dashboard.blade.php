@extends('layouts.admin')

@section('content')

<!-- HEADER -->
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold">Dashboard Admin</h1>
        <p class="text-sm text-gray-500">Ringkasan data pengajuan surat</p>
    </div>

    <div class="text-sm text-gray-500">
        {{ now()->format('d M Y') }}
    </div>
</div>

<!-- STATISTIC -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-5 rounded-lg shadow hover:shadow-md transition">
        <p class="text-sm text-gray-500">Total Pengajuan</p>
        <p class="text-3xl font-bold mt-1" id="total">0</p>
    </div>

    <div class="bg-white p-5 rounded-lg shadow hover:shadow-md transition">
        <p class="text-sm text-gray-500">Diproses</p>
        <p class="text-3xl font-bold text-orange-500 mt-1" id="diproses">0</p>
    </div>

    <div class="bg-white p-5 rounded-lg shadow hover:shadow-md transition">
        <p class="text-sm text-gray-500">Disetujui</p>
        <p class="text-3xl font-bold text-green-600 mt-1" id="disetujui">0</p>
    </div>
</div>

<!-- TABLE -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 border-b flex justify-between items-center">
        <h2 class="font-semibold">Daftar Pengajuan</h2>
        <span class="text-xs text-gray-500">Live update</span>
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
            <tbody id="pengajuan-body"></tbody>
        </table>
    </div>
</div>

<!-- SCRIPT LIVE -->
<script>
async function loadPengajuan() {
    const res = await fetch('/admin/pengajuan/live');
    if (!res.ok) return;

    const data = await res.json();
    const body = document.getElementById('pengajuan-body');

    body.innerHTML = '';
    let diproses = 0, disetujui = 0;

    data.forEach((p, i) => {
        if (p.status === 'diproses') diproses++;
        if (p.status === 'disetujui') disetujui++;

        let badgeClass = 'bg-blue-100 text-blue-700';

        if (p.status === 'diproses') {
            badgeClass = 'bg-orange-100 text-orange-700';
        } else if (p.status === 'disetujui') {
            badgeClass = 'bg-green-100 text-green-700';
        } else if (p.status === 'ditolak') {
            badgeClass = 'bg-red-100 text-red-700';
        }

        body.innerHTML += `
            <tr class="border-b hover:bg-gray-50 transition">
                <td class="px-4 py-3">${i + 1}</td>
                <td class="px-4 py-3">${p.nomor_surat ?? '-'}</td>
                <td class="px-4 py-3">${p.tanggal_surat ?? '-'}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded text-xs font-medium ${badgeClass}">
                        ${p.status.replaceAll('_',' ').toUpperCase()}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <a href="/admin/pengajuan/${p.id}"
                       class="text-blue-600 hover:underline font-medium">
                        Detail
                    </a>
                </td>
            </tr>
        `;
    });

    document.getElementById('total').innerText = data.length;
    document.getElementById('diproses').innerText = diproses;
    document.getElementById('disetujui').innerText = disetujui;
}

loadPengajuan();
setInterval(loadPengajuan, 5000);
</script>

@endsection
