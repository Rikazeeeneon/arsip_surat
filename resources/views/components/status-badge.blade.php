@props(['status'])

@php
$classes = match($status) {
    'diproses' => 'bg-orange-100 text-orange-700',
    'disetujui' => 'bg-green-100 text-green-700',
    'ditolak' => 'bg-red-100 text-red-700',
    default => 'bg-blue-100 text-blue-700'
};
@endphp

<span class="px-2 py-1 rounded text-xs font-medium {{ $classes }}">
    {{ strtoupper(str_replace('_',' ',$status)) }}
</span>