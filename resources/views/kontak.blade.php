<x-shop-layout title="Kontak">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <x-page-hero title="Terhubung dengan DECORA" subtitle="Kami siap membantu kebutuhan furniture & dekorasi rumahmu" />

    <div class="max-w-5xl mx-auto px-4 py-14">

        {{-- Info Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-16">

            <div class="bg-white rounded-3xl p-8 text-center border border-decora-cream-dark shadow-sm hover:shadow-xl hover:-translate-y-2 active:scale-95 transition-all duration-300 cursor-pointer">
                <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-gradient-to-br from-decora-brown to-decora-sage-dark flex items-center justify-center text-white text-xl">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3 class="font-bold text-decora-text mb-2">Alamat</h3>
                <p class="text-sm text-decora-text/60 mb-4">Jl. Melati No. 12, Purbalingga, Jawa Tengah</p>
                <a href="https://maps.google.com/?q=Purbalingga,+Jawa+Tengah" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 text-sm font-medium text-decora-brown hover:gap-3 transition-all">
                    <span>Buka di Google Maps</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="bg-white rounded-3xl p-8 text-center border border-decora-cream-dark shadow-sm hover:shadow-xl hover:-translate-y-2 active:scale-95 transition-all duration-300 cursor-pointer">
                <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-gradient-to-br from-decora-brown to-decora-sage-dark flex items-center justify-center text-white text-xl">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h3 class="font-bold text-decora-text mb-2">Telepon / WhatsApp</h3>
                <p class="text-sm font-medium text-decora-text mb-1">+62 856-4082-8760</p>
                <p class="text-xs text-decora-text/50 mb-4">(WhatsApp lebih cepat direspons)</p>
                <a href="https://wa.me/6285640828760" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 text-sm font-medium text-green-600 hover:gap-3 transition-all">
                    <span>Chat via WhatsApp</span>
                    <i class="fab fa-whatsapp text-sm"></i>
                </a>
            </div>

            <div class="bg-white rounded-3xl p-8 text-center border border-decora-cream-dark shadow-sm hover:shadow-xl hover:-translate-y-2 active:scale-95 transition-all duration-300 cursor-pointer">
                <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-gradient-to-br from-decora-brown to-decora-sage-dark flex items-center justify-center text-white text-xl">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="font-bold text-decora-text mb-2">Jam Operasional</h3>
                <p class="text-sm text-decora-text/60 mb-1">Senin - Sabtu: 09.00 - 18.00 WIB</p>
                <p class="text-xs text-decora-text/50 mb-4">Minggu: Tutup</p>

                @php
                    $sekarang = \Carbon\Carbon::now();
                    $sedangBuka = $sekarang->dayOfWeek !== 0 && $sekarang->format('H:i') >= '09:00' && $sekarang->format('H:i') <= '18:00';
                @endphp
                <div class="inline-flex items-center gap-2 text-sm font-medium {{ $sedangBuka ? 'text-green-600' : 'text-red-500' }}">
                    <span class="w-2 h-2 rounded-full {{ $sedangBuka ? 'bg-green-500' : 'bg-red-400' }} animate-pulse"></span>
                    <span>{{ $sedangBuka ? 'Sedang Buka' : 'Sedang Tutup' }}</span>
                </div>
            </div>
        </div>

        {{-- Quick Response Banner --}}
        <div class="bg-gradient-to-br from-decora-brown to-decora-brown-dark rounded-3xl p-10 text-center text-white mb-16 active:scale-[0.98] transition-transform duration-150 cursor-pointer">
            <h3 class="text-xl sm:text-2xl font-bold mb-2">Butuh Bantuan Cepat?</h3>
            <p class="text-white/70 mb-5">Tim kami siap membantu kamu</p>
            <div class="inline-flex items-center gap-2 bg-white/10 px-4 py-2 rounded-full text-sm mb-6">
                <i class="fas fa-clock"></i>
                <span>Rata-rata respon: 15 menit</span>
            </div>
            <div>
                <a href="https://wa.me/6285640828760?text=Halo%20DECORA%2C%20saya%20ingin%20bertanya" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-3 bg-green-500 hover:bg-green-600 active:scale-95 transition px-6 py-3 rounded-full font-semibold">
                    <i class="fab fa-whatsapp text-lg"></i>
                    <span>Chat via WhatsApp</span>
                </a>
            </div>
        </div>

        {{-- Map --}}
        <div>
            <h2 class="text-2xl font-bold text-decora-text text-center mb-6">
                Temukan <span class="text-decora-brown">Lokasi Kami</span>
            </h2>
            <div class="rounded-3xl overflow-hidden shadow-lg border border-decora-cream-dark">
                <iframe
                    src="https://www.google.com/maps?q=Purbalingga,+Jawa+Tengah&output=embed"
                    width="100%" height="420" style="border:0;" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <p class="text-center text-sm text-decora-text/50 mt-3">
                <i class="fas fa-map-pin mr-1"></i> Jl. Melati No. 12, Purbalingga, Jawa Tengah
            </p>
        </div>

    </div>

</x-shop-layout>