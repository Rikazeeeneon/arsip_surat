@extends('layouts.admin')

@section('content')

@if(session('success'))
    <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
<!-- HEADER -->
<div class="flex items-start justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold">Detail Pengajuan</h1>
        <p class="text-sm text-gray-500">Informasi lengkap pengajuan surat</p>
    </div>

    <!-- STATUS BADGE -->
    @php
    $statusClass = match($pengajuan->status) {
        'disetujui' => 'bg-green-100 text-green-700',
        'diproses' => 'bg-orange-100 text-orange-700',
        'ditolak' => 'bg-red-100 text-red-700',
        default => 'bg-blue-100 text-blue-700',
    };
@endphp

<span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
    {{ strtoupper(str_replace('_',' ', $pengajuan->status)) }}
</span>

</div>

<!-- GRID -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- LEFT -->
    <div class="lg:col-span-2 space-y-6">

        <!-- INFO SURAT -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold mb-4">Informasi Surat</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Nomor Surat</p>
                    <p class="font-medium">{{ $pengajuan->nomor_surat ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Tanggal Surat</p>
                    <p class="font-medium">{{ $pengajuan->tanggal_surat ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Asal Surat</p>
                    <p class="font-medium">
                        {{ $pengajuan->asal_surat_lainnya ?: $pengajuan->asal_surat }}
                    </p>
                </div>
            </div>
        </div>

        <!-- RELASI -->
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h2 class="font-semibold">Tujuan & Distribusi</h2>

            <div class="grid md:grid-cols-3 gap-4 text-sm">

                <!-- TUJUAN -->
                <div>
                    <p class="text-gray-500 mb-2">Tujuan Surat</p>
                    <ul class="space-y-1">
                        @forelse ($pengajuan->tujuanSurats as $t)
                            <li class="px-2 py-1 bg-gray-100 rounded">
                                {{ $t->nama_tujuan }}
                            </li>
                        @empty
                            <li class="text-gray-400">-</li>
                        @endforelse
                    </ul>
                </div>

                <!-- TEMBUSAN -->
                <div>
                    <p class="text-gray-500 mb-2">Tembusan</p>
                    <ul class="space-y-1">
                        @forelse ($pengajuan->tembusanSurats as $t)
                            <li class="px-2 py-1 bg-gray-100 rounded">
                                {{ $t->nama_tembusan }}
                            </li>
                        @empty
                            <li class="text-gray-400">-</li>
                        @endforelse
                    </ul>
                </div>

                <!-- KAB/KOTA -->
                <div>
                    <p class="text-gray-500 mb-2">Kabupaten / Kota</p>
                    <ul class="space-y-1">
                        @forelse ($pengajuan->tujuanKabkotas as $k)
                            <li class="px-2 py-1 bg-gray-100 rounded">
                                {{ $k->nama_daerah }}
                            </li>
                        @empty
                            <li class="text-gray-400">-</li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>

        <!-- BERKAS -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold mb-4">Berkas Terlampir</h2>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
@forelse ($pengajuan->berkas as $b)

    @php
        $url = asset('storage/'.$b->file_path);
        $ext = pathinfo($b->file_path, PATHINFO_EXTENSION);
    @endphp

    <a href="{{ $url }}" target="_blank"
       class="block border rounded-lg p-3 hover:shadow-lg transition">

        {{-- JIKA PDF --}}
        @if ($ext === 'pdf')
            <div class="text-center">
                <embed src="{{ $url }}"
                       type="application/pdf"
                       class="w-full h-64 rounded" />

                <p class="mt-2 text-sm text-blue-600 font-medium">
                    Klik untuk buka PDF
                </p>
            </div>

        {{-- JIKA GAMBAR --}}
        @else
            <div class="text-center">
                <img src="{{ $url }}"
                     alt="Preview Berkas"
                     class="w-full h-64 object-cover rounded" />

                <p class="mt-2 text-sm text-blue-600 font-medium">
                    Klik untuk lihat gambar
                </p>
            </div>
        @endif

    </a>

@empty
    <p>-</p>
@endforelse
</div>

            </div>
        </div>

    </div>

    <!-- RIGHT -->
    <div class="space-y-6">

        <!-- PROSES -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold mb-4">Proses Pengajuan</h2>

            <form method="POST" action="/admin/pengajuan/{{ $pengajuan->id }}/status" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm mb-1">Status</label>
                    <select name="status"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        @foreach (['diterima_sistem','diproses','disetujui','ditolak'] as $s)
                            <option value="{{ $s }}" @selected($pengajuan->status==$s)>
                                {{ strtoupper(str_replace('_',' ', $s)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2 text-sm">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="verifikasi_data"
                            {{ $pengajuan->verifikasi_data ? 'checked' : '' }}>
                        Data lengkap
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="verifikasi_berkas"
                            {{ $pengajuan->verifikasi_berkas ? 'checked' : '' }}>
                        Berkas valid
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-orange-700 transition">
                    Simpan Proses
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif

    </div>
</div>

@endsection
