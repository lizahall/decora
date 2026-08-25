<x-guest-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Checkout</h1>

        @if (session('error'))
            <p class="text-red-600 mb-4">{{ session('error') }}</p>
        @endif
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Ringkasan barang --}}
        <div class="border border-gray-300 rounded mb-6">
            @foreach ($items as $item)
                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 last:border-b-0">
                    <div>
                        <p class="font-semibold">{{ $item->produk->nama }}</p>
                        <p class="text-sm text-gray-600">{{ $item->jumlah }} x Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</p>
                    </div>
                    <p class="font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                </div>
            @endforeach
            <div class="px-4 py-3 flex justify-between font-bold bg-gray-50">
                <span>Total</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="mode" value="{{ $mode }}">

            @if ($mode === 'langsung')
                <input type="hidden" name="produk_id" value="{{ $items->first()->produk->id }}">
                <input type="hidden" name="jumlah" value="{{ $items->first()->jumlah }}">
            @endif

            <div>
                <label class="block text-sm font-medium mb-1">Alamat Pengiriman</label>
                <textarea name="alamat_pengiriman" rows="3" class="w-full border border-gray-400 rounded-sm px-3 py-2">{{ old('alamat_pengiriman') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
                <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" class="w-full border border-gray-400 rounded-sm px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="w-full border border-gray-400 rounded-sm px-3 py-2">
                    <option value="">-- Pilih Metode --</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="COD">COD (Bayar di Tempat)</option>
                    <option value="E-Wallet">E-Wallet</option>
                </select>
            </div>

            <button type="submit" class="w-full py-3 bg-green-200 border border-gray-400 rounded-sm font-semibold">
                Buat Pesanan
            </button>
        </form>
    </div>
</x-guest-layout>