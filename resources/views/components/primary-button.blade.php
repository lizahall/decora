<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full inline-flex items-center justify-center px-6 py-2.5 bg-decora-brown border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-decora-brown-dark transition']) }}>
    {{ $slot }}
</button>