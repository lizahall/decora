@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-decora-text/80 mb-1']) }}>
    {{ $value ?? $slot }}
</label>