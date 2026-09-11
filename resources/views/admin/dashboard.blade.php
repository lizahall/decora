@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

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

    <div class="bg-white border border-decora-cream-dark rounded-xl p-5 mb-6">
        <p class="font-semibold text-decora-text mb-4">Grafik Penjualan (7 Hari Terakhir)</p>
        <div class="h-64">
            <canvas id="chartPenjualan"></canvas>
        </div>
    </div>

    <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
        <p class="text-decora-text/70">Selamat datang, <span class="font-semibold text-decora-text">{{ auth()->guard('admin')->user()->nama }}</span>. Gunakan menu di samping untuk mengelola data DECORA.</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Chart(document.getElementById('chartPenjualan'), {
                type: 'line',
                data: {
                    labels: @json($labelPenjualan),
                    datasets: [{
                        label: 'Penjualan (Rp)',
                        data: @json($dataPenjualan),
                        borderColor: '#6B4E3D',
                        backgroundColor: 'rgba(107, 78, 61, 0.1)',
                        tension: 0.3,
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });
        });
    </script>

@endsection