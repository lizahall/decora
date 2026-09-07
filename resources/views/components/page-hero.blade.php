@props(['title', 'subtitle' => null, 'height' => 'h-[420px] sm:h-[520px]'])

<div class="relative {{ $height }} overflow-hidden">
    <img src="{{ asset('images/hero-living-room.jpg') }}" alt="{{ $title }}" class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-decora-text/55"></div>

    {{-- Fade halus ke background cream di bawah --}}
    <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-b from-transparent to-decora-cream pointer-events-none"></div>

    <div class="relative h-full max-w-6xl mx-auto px-4 flex flex-col items-center justify-center text-center">
        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2 animate-fade-up">{{ $title }}</h1>
        @if ($subtitle)
            <p class="text-white/80 max-w-md animate-fade-up" style="animation-delay: 0.1s">{{ $subtitle }}</p>
        @endif
    </div>
</div>