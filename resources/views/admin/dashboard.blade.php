<x-admin-layout title="Dashboard">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
            <p class="text-sm text-decora-text/50 mb-1">Total Produk</p>
            <p class="text-2xl font-bold text-decora-text">{{ $totalProduk }}</p>
        </div>
        <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
            <p class="text-sm text-decora-text/50 mb-1">Total User Terdaftar</p>
            <p class="text-2xl font-bold text-decora-text">{{ $totalUser }}</p>
        </div>
        <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
            <p class="text-sm text-decora-text/50 mb-1">Total Pesanan</p>
            <p class="text-2xl font-bold text-decora-text">{{ $totalPesanan }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

        <div class="lg:col-span-2 bg-white border border-decora-cream-dark rounded-xl p-5">
            <p class="font-semibold text-decora-text mb-4">Grafik Penjualan (7 Hari Terakhir)</p>
            <canvas id="chartPenjualan" height="110"></canvas>
        </div>

        <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
            <p class="font-semibold text-decora-text mb-4">Produk per Kategori</p>
            @if ($labelKategori->isEmpty())
                <p class="text-sm text-decora-text/50 text-center py-10">Belum ada data produk.</p>
            @else
                <canvas id="chartKategori" height="180"></canvas>
            @endif
        </div>
    </div>

    <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
        <p class="text-decora-text/70">Selamat datang, <span class="font-semibold text-decora-text">{{ auth()->guard('admin')->user()->nama }}</span>. Gunakan menu di samping untuk mengelola data DECORA.</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const brown = '#6B4E3D';
            const sage = '#B4C7AE';

            new Chart(document.getElementById('chartPenjualan'), {
                type: 'line',
                data: {
                    labels: @json($labelPenjualan),
                    datasets: [{
                        label: 'Penjualan (Rp)',
                        data: @json($dataPenjualan),
                        borderColor: brown,
                        backgroundColor: 'rgba(107, 78, 61, 0.1)',
                        tension: 0.3,
                        fill: true,
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });

            @if ($labelKategori->isNotEmpty())
                new Chart(document.getElementById('chartKategori'), {
                    type: 'doughnut',
                    data: {
                        labels: @json($labelKategori),
                        datasets: [{
                            data: @json($dataKategori),
                            backgroundColor: [brown, sage, '#D9C4A9', '#8A9A8E', '#A97155', '#C9B896'],
                        }]
                    },
                    options: {
                        plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } }
                    }
                });
            @endif
        });
    </script>

</x-admin-layout>