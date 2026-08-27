@props(['variant' => 'primary', 'type' => 'button'])

@php
    $base = 'inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-lg font-semibold text-sm transition disabled:opacity-50 disabled:cursor-not-allowed';

    $variants = [
        'primary'   => 'bg-decora-brown text-white hover:bg-decora-brown-dark',
        'secondary' => 'bg-decora-sage text-decora-text hover:bg-decora-sage-dark',
        'outline'   => 'border border-decora-brown text-decora-brown hover:bg-decora-cream-dark',
        'danger'    => 'bg-red-500 text-white hover:bg-red-600',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>