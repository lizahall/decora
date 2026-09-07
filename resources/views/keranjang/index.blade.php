<x-shop-layout title="Keranjang">
    <div class="max-w-6xl mx-auto px-4 py-10">
        <h1 class="text-2xl font-bold text-decora-text mb-6">Keranjang Belanja</h1>

        @if ($items->isEmpty())
            <div class="text-center py-20">
                <p class="text-decora-text/60 mb-4">Keranjang kamu masih kosong.</p>
                <x-button variant="primary" onclick="window.location='{{ route('produk.index') }}'">Mulai Belanja</x-button>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- Daftar Item --}}
                <div class="lg:col-span-2 bg-white rounded-xl border border-decora-cream-dark">

                    <div class="flex items-center gap-3 px-4 py-3 border-b border-decora-cream-dark">
                        <input type="checkbox" id="pilih-semua" checked
                               class="w-4 h-4 rounded border-decora-cream-dark text-decora-brown focus:ring-decora-sage">
                        <label for="pilih-semua" class="text-sm font-medium text-decora-text/70">Pilih Semua</label>
                    </div>

                    <div class="divide-y divide-decora-cream-dark">
                        @foreach ($items as $item)
                            <div class="flex items-center gap-4 p-4">
                                <input type="checkbox" class="item-checkbox w-4 h-4 rounded border-decora-cream-dark text-decora-brown focus:ring-decora-sage shrink-0"
                                       data-id="{{ $item->id }}"
                                       data-subtotal="{{ $item->produk->harga * $item->jumlah }}"
                                       checked>

                                <img src="{{ $item->produk->foto ? asset('storage/'.$item->produk->foto) : 'https://placehold.co/80x80' }}"
                                     class="w-16 h-16 object-cover rounded-lg shrink-0">

                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-decora-text truncate">{{ $item->produk->nama }}</p>
                                    <p class="text-sm text-decora-text/60">Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</p>
                                </div>

                                <form action="{{ route('keranjang.update', $item->id) }}" method="POST" class="flex items-center border border-decora-cream-dark rounded-lg overflow-hidden shrink-0">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="jumlah" value="{{ max(1, $item->jumlah - 1) }}"
                                            class="w-8 h-8 text-decora-text/60 hover:bg-decora-cream" {{ $item->jumlah <= 1 ? 'disabled' : '' }}>−</button>
                                    <span class="w-10 text-center text-sm">{{ $item->jumlah }}</span>
                                    <button type="submit" name="jumlah" value="{{ min($item->produk->stok, $item->jumlah + 1) }}"
                                            class="w-8 h-8 text-decora-text/60 hover:bg-decora-cream" {{ $item->jumlah >= $item->produk->stok ? 'disabled' : '' }}>+</button>
                                </form>

                                <p class="font-semibold text-decora-text w-28 text-right shrink-0">
                                    Rp {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}
                                </p>

                                <form id="hapus-form-{{ $item->id }}" action="{{ route('keranjang.destroy', $item->id) }}" method="POST" class="shrink-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="konfirmasiHapus({{ $item->id }}, '{{ addslashes($item->produk->nama) }}')"
                                            class="w-8 h-8 rounded-full text-decora-text/40 hover:bg-red-50 hover:text-red-600 transition">
                                        🗑
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Ringkasan Belanja --}}
                <div class="bg-white rounded-xl border border-decora-cream-dark p-5 sticky top-20">
                    <p class="font-semibold text-decora-text mb-4">Ringkasan Belanja</p>

                    <div class="flex justify-between text-sm text-decora-text/70 mb-2">
                        <span id="label-jumlah-terpilih">Subtotal (0 produk)</span>
                        <span id="teks-subtotal">Rp 0</span>
                    </div>

                    <div class="border-t border-decora-cream-dark my-3"></div>

                    <div class="flex justify-between font-bold text-decora-text mb-5">
                        <span>Total</span>
                        <span id="teks-total">Rp 0</span>
                    </div>

                    <x-button id="btn-checkout" variant="primary" class="w-full">
                        Checkout
                    </x-button>
                    <p id="peringatan-kosong" class="text-xs text-red-500 mt-2 hidden">Pilih minimal 1 produk untuk checkout.</p>
                </div>
            </div>
        @endif
    </div>

    <script>
        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        function hitungUlangRingkasan() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            let total = 0;
            let jumlahProduk = 0;

            checkboxes.forEach(cb => {
                if (cb.checked) {
                    total += parseInt(cb.dataset.subtotal);
                    jumlahProduk += 1;
                }
            });

            document.getElementById('label-jumlah-terpilih').textContent = `Subtotal (${jumlahProduk} produk)`;
            document.getElementById('teks-subtotal').textContent = formatRupiah(total);
            document.getElementById('teks-total').textContent = formatRupiah(total);

            const pilihSemua = document.getElementById('pilih-semua');
            pilihSemua.checked = jumlahProduk === checkboxes.length;
        }

        document.querySelectorAll('.item-checkbox').forEach(cb => {
            cb.addEventListener('change', hitungUlangRingkasan);
        });

        document.getElementById('pilih-semua')?.addEventListener('change', function () {
            document.querySelectorAll('.item-checkbox').forEach(cb => cb.checked = this.checked);
            hitungUlangRingkasan();
        });

        document.getElementById('btn-checkout')?.addEventListener('click', function () {
            const terpilih = Array.from(document.querySelectorAll('.item-checkbox:checked')).map(cb => cb.dataset.id);

            if (terpilih.length === 0) {
                document.getElementById('peringatan-kosong').classList.remove('hidden');
                return;
            }

            const params = terpilih.map(id => `keranjang_ids[]=${id}`).join('&');
            window.location = `{{ route('checkout.create') }}?${params}`;
        });

        hitungUlangRingkasan();

        function konfirmasiHapus(id, nama) {
            Swal.fire({
                title: 'Hapus produk ini?',
                text: nama + ' akan dihapus dari keranjang.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6B4E3D',
                cancelButtonColor: '#9CA3AF',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('hapus-form-' + id).submit();
                }
            });
        }
    </script>
</x-shop-layout>