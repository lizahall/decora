@props(['status'])

@php
    $colors = [
        'menunggu'   => 'bg-yellow-100 text-yellow-700',
        'diproses'   => 'bg-blue-100 text-blue-700',
        'dikemas'    => 'bg-blue-100 text-blue-700',
        'dikirim'    => 'bg-decora-sage/40 text-decora-brown-dark',
        'selesai'    => 'bg-green-100 text-green-700',
        'dibatalkan' => 'bg-red-100 text-red-700',
    ];

    $class = $colors[$status] ?? 'bg-gray-100 text-gray-700';
@endphp

<span class="inline-block px-3 py-1 rounded-full text-xs font-semibold uppercase {{ $class }}">
    {{ $status }}
</span>