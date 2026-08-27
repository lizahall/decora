@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} type="checkbox" {!! $attributes->merge(['class' => 'rounded border-decora-cream-dark text-decora-brown shadow-sm focus:ring-decora-sage']) !!}>