@extends('layouts.admin')

@section('content')

<!-- HEADER -->
<div class="flex items-start justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold">Detail Pengajuan</h1>
        <p class="text-sm text-gray-500">Informasi lengkap pengajuan surat (Read Only)</p>
    </div>

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

                        @if ($ext === 'pdf')
                            <div class="text-center">
                                <embed src="{{ $url }}"
                                       type="application/pdf"
                                       class="w-full h-64 rounded" />

                                <p class="mt-2 text-sm text-blue-600 font-medium">
                                    Klik untuk buka PDF
                                </p>
                            </div>
                        @else
                            <div class="text-center">
                                <img src="{{ $url }}"
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

    <!-- RIGHT (READ ONLY PROSES INFO) -->
    <div class="space-y-6">

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold mb-4">Status Verifikasi</h2>

            <div class="space-y-3 text-sm">

                <div class="flex justify-between">
                    <span>Verifikasi Data</span>
                    <span class="font-medium">
                        {{ $pengajuan->verifikasi_data ? '✔ Sudah Diverifikasi' : '✖ Belum Diverifikasi' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span>Verifikasi Berkas</span>
                    <span class="font-medium">
                        {{ $pengajuan->verifikasi_berkas ? '✔ Sudah Diverifikasi' : '✖ Belum Diverifikasi' }}
                    </span>
                </div>

            </div>
        </div>

        <div>
            <a href="{{ route('super_admin.dashboard') }}"
               class="block text-center bg-gray-200 hover:bg-gray-300 py-2 rounded-lg transition">
                Kembali ke Dashboard
            </a>
        </div>

    </div>
</div>

@endsection