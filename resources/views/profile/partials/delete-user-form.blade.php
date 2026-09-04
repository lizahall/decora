<section>
    <header class="mb-6">
        <h2 class="text-lg font-semibold text-red-600">Hapus Akun</h2>
        <p class="mt-1 text-sm text-decora-text/60">
            Setelah akun dihapus, semua data (termasuk riwayat pesanan) akan hilang permanen dan tidak bisa dikembalikan.
        </p>
    </header>

    <x-button variant="danger" onclick="document.getElementById('confirm-delete-modal').classList.remove('hidden')">
        Hapus Akun
    </x-button>

    <div id="confirm-delete-modal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full">
            <h3 class="font-semibold text-decora-text mb-2">Yakin mau hapus akun?</h3>
            <p class="text-sm text-decora-text/60 mb-4">Masukkan password kamu untuk konfirmasi. Tindakan ini tidak bisa dibatalkan.</p>

            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <x-input-label for="password" value="Password" class="sr-only" />
                <x-text-input id="password" name="password" type="password" class="block w-full mb-2" placeholder="Password" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mb-3" />

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('confirm-delete-modal').classList.add('hidden')" class="px-4 py-2 text-sm text-decora-text/70">
                        Batal
                    </button>
                    <x-button type="submit" variant="danger">Hapus Akun</x-button>
                </div>
            </form>
        </div>
    </div>
</section>