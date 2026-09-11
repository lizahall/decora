@extends('layouts.shop')

@section('title', 'Edit Profil')

@section('content')

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

@endsection

@push('scripts')
    @if (session('status') === 'profile-updated')
        <script>
            Swal.fire({
                toast: true, position: 'top-end', icon: 'success',
                title: 'Profil berhasil diperbarui.',
                showConfirmButton: false, timer: 3000, timerProgressBar: true,
            });
        </script>
    @endif

    @if (session('status') === 'password-updated')
        <script>
            Swal.fire({
                toast: true, position: 'top-end', icon: 'success',
                title: 'Password berhasil diperbarui.',
                showConfirmButton: false, timer: 3000, timerProgressBar: true,
            });
        </script>
    @endif
@endpush