<x-shop-layout title="Edit Profil">
    <div class="max-w-2xl mx-auto px-4 py-10 space-y-6">

        <h1 class="text-2xl font-bold text-decora-text mb-2">Edit Profil</h1>
        <p class="text-decora-text/60 mb-6">Kelola informasi akun dan keamanan kamu.</p>

        <div class="bg-white border border-decora-cream-dark rounded-2xl p-6 sm:p-8">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-white border border-decora-cream-dark rounded-2xl p-6 sm:p-8">
            @include('profile.partials.update-password-form')
        </div>

    </div>
</x-shop-layout>