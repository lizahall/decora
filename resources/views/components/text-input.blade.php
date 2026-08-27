@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-decora-cream-dark bg-decora-cream/40 text-decora-text focus:border-decora-sage focus:ring-decora-sage rounded-lg shadow-sm w-full']) !!}>