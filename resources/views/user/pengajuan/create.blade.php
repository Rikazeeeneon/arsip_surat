@extends('layouts.user')

@section('content')
{{-- PESAN BERHASIL --}}
@if(session('success'))
    <div class="mb-6 rounded-lg border border-green-300 bg-green-50 p-4 text-green-800">
        <h4 class="font-semibold mb-1">Pengajuan Berhasil</h4>
        <p>{{ session('success') }}</p>
    </div>
@endif
{{-- PESAN ERROR --}}
@if ($errors->any())
    <div class="mb-6 rounded-lg border border-red-300 bg-red-50 p-4 text-red-800">
        <h4 class="font-semibold mb-2">
            Silakan lengkapi form terlebih dahulu
        </h4>
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="max-w-4xl mx-auto space-y-6">

    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-semibold">Pengajuan Surat</h1>
        <p class="text-sm text-gray-500">
            Lengkapi data berikut untuk mengajukan surat
        </p>
    </div>

    <form method="POST" action="{{ route('pengajuan.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- CARD 1: INFO SURAT -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold mb-4">📄 Informasi Surat</h2>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium">Nomor Surat</label>
                    <input type="text" name="nomor_surat"
                        class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="text-sm font-medium">Tanggal Surat</label>
                    <input type="date" name="tanggal_surat"
                        class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

          <div>
    <label class="text-sm text-gray-600">Asal Surat</label>

    <select name="asal_surat"
            id="asalSurat"
            class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring focus:ring-blue-200"
            required>
        @foreach (config('surat.asal_surat') as $asal)
            <option value="{{ $asal }}">{{ $asal }}</option>
        @endforeach
    </select>

    <input name="asal_surat_lainnya"
           id="asalLainnya"
           placeholder="Isi asal surat lainnya..."
           class="w-full border rounded-lg px-3 py-2 mt-2 hidden">
</div>


            <div class="mt-4">
                <label class="text-sm font-medium">Asal Surat Lainnya</label>
                <input type="text" name="asal_surat_lainnya"
                    placeholder="Isi jika tidak ada di pilihan"
                    class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <!-- CARD 2: TUJUAN & TEMBUSAN -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold mb-4">🎯 Tujuan & Tembusan</h2>

            <div class="grid md:grid-cols-2 gap-4">
              <div class="bg-white rounded-xl shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-lg">Tujuan Surat</h2>
        <button type="button"
                onclick="addTujuan()"
                class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-orange-700">
            + Tambah
        </button>
    </div>

    <div id="tujuanContainer" class="space-y-2">
        <select name="tujuan[]" class="w-full border rounded-lg px-3 py-2">
            @foreach (config('surat.tujuan_surat') as $tujuan)
                <option value="{{ $tujuan }}">{{ $tujuan }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="mt-6">
    <label class="block font-semibold mb-1">
        Tembusan
    </label>

    <p class="text-sm text-gray-500 mb-2">
        Isi jika ada
    </p>

    <div class="max-h-64 overflow-y-auto rounded-lg border p-3 space-y-2 bg-white">
        @foreach (config('surat.tembusan_surat') as $t)
            <label class="flex items-center gap-3 p-2 rounded cursor-pointer
                          hover:bg-gray-50 transition">

                <input type="checkbox"
                       name="tembusan_surat[]"
                       value="{{ $t }}"
                       class="rounded text-blue-600 focus:ring-blue-500"
                       @checked(collect(old('tembusan_surat'))->contains($t))>

                <span class="text-sm">
                    {{ $t }}
                </span>
            </label>
        @endforeach
    </div>
</div>


</div>


                </div>
            </div>

          
        </div>

        <!-- CARD 3: TUJUAN DAERAH -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold mb-4">📍 Tujuan Kabupaten / Kota</h2>
<div class="mt-6">
    <label class="block font-semibold mb-2">
        Tujuan Kabupaten / Kota (opsional)
    </label>

    <div class="max-h-40 overflow-y-auto border rounded p-3 space-y-2">
@foreach (config('surat.kabkota') as $k)
    <label class="flex items-center gap-2 text-sm">
        <input
            type="checkbox"
            name="kabkota[]"
            value="{{ $k }}"
            class="rounded text-blue-600"
        >
        {{ $k }}
    </label>
@endforeach
</div>

</div>


</div>

        </div>

        <!-- CARD 4: UPLOAD BERKAS -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-semibold mb-4">📎 Upload Berkas</h2>

            <input type="file" name="berkas[]" multiple
                class="w-full border rounded-lg px-3 py-2 bg-white">

            <p class="text-xs text-gray-500 mt-2">
                * Bisa upload lebih dari satu file
            </p>
        </div>

        <!-- ACTION -->
        <div class="flex justify-end gap-3">
            <button type="reset"
                class="px-5 py-2 rounded-lg border hover:bg-gray-50 transition">
                Reset
            </button>

            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-orange-700 transition">
                Kirim Pengajuan
            </button>
        </div>

    </form>
</div>

@endsection
<script>
document.getElementById('asalSurat').addEventListener('change', function () {
    document.getElementById('asalLainnya')
        .classList.toggle('hidden', this.value !== 'Lainnya');
});
</script>
<script>
function addTujuan() {
    document.getElementById('tujuanContainer').insertAdjacentHTML('beforeend', `
        <div class="flex gap-2">
            <select name="tujuan[]" class="w-full border rounded-lg px-3 py-2">
                @foreach (config('surat.tujuan_surat') as $tujuan)
                    <option value="{{ $tujuan }}">{{ $tujuan }}</option>
                @endforeach
            </select>
            <button type="button"
                    onclick="this.parentElement.remove()"
                    class="text-red-600 font-bold">✕</button>
        </div>
    `);
}
</script>
