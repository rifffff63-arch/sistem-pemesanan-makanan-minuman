@extends('layouts.app')

@section('content')

<!-- Memanggil Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark">
        <i class="bi bi-graph-up-arrow text-primary me-2"></i> Laporan Pesanan
    </h2>

    <div>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary rounded-pill px-4 shadow-sm me-2">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
        </a>
        
        <button onclick="window.print()" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-printer-fill me-1"></i> Cetak Laporan
        </button>
    </div>
</div>

<!-- ================= PROSES DATA UNTUK GRAFIK (SUDAH DIPERBAIKI) ================= -->
@php
    $grandTotal = 0;
    $pendapatanPerMenu = [];

    foreach($orders as $order) {
        $status = strtolower($order->status);
        
        // HANYA HITUNG JIKA STATUSNYA "SELESAI" ATAU "COMPLETED"
        if($status == 'selesai' || $status == 'completed') {
            
            $grandTotal += $order->total_price;
            $namaMenu = $order->menu->name ?? 'Lainnya';
            
            if(!isset($pendapatanPerMenu[$namaMenu])) {
                $pendapatanPerMenu[$namaMenu] = 0;
            }
            $pendapatanPerMenu[$namaMenu] += $order->total_price;
            
        }
    }

    // Jika belum ada pesanan yang selesai, buat data kosong agar grafik tidak error
    if(empty($pendapatanPerMenu)) {
        $labelGrafik = json_encode(['Belum ada pendapatan']);
        $dataGrafik = json_encode([0]);
    } else {
        $labelGrafik = json_encode(array_keys($pendapatanPerMenu));
        $dataGrafik = json_encode(array_values($pendapatanPerMenu));
    }
@endphp
<!-- ============================================================================== -->

<!-- CARD GRAFIK MEWAH -->
<div class="card shadow-sm border-0 mb-4 print-hide" style="border-radius: 20px;">
    <div class="card-body p-4">
        <h5 class="fw-bold text-secondary mb-1">
            <i class="bi bi-bar-chart-fill text-indigo me-2"></i> Grafik Pendapatan per Menu
        </h5>
        <p class="text-muted small mb-4">
            <i class="bi bi-info-circle me-1"></i> Hanya menghitung pesanan dengan status <b>Selesai</b>
        </p>
        
        <!-- Area tempat grafik akan dirender -->
        <div style="position: relative; height: 320px; width: 100%;">
            <canvas id="laporanGrafik"></canvas>
        </div>
    </div>
</div>

<!-- CARD TABEL -->
<div class="card shadow-sm border-0 mb-5" style="border-radius: 20px; overflow: hidden;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="py-3 text-center">No</th>
                        <th class="py-3">Pelanggan</th>
                        <th class="py-3">Menu</th>
                        <th class="py-3 text-center">Jumlah</th>
                        <th class="py-3">Total Harga</th>
                        <th class="py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle fw-semibold">{{ $order->customer_name }}</td>
                            <td class="align-middle">{{ $order->menu->name ?? '-' }}</td>
                            <td class="text-center align-middle">{{ $order->quantity }}</td>
                            
                            <!-- Harga dicoret jika dibatalkan -->
                            <td class="align-middle fw-bold {{ strtolower($order->status) == 'batal' ? 'text-danger text-decoration-line-through' : 'text-success' }}">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            
                            <td class="text-center align-middle">
                                @if(strtolower($order->status) == 'selesai' || strtolower($order->status) == 'completed')
                                    <span class="badge bg-success px-3 py-2 rounded-pill">Selesai</span>
                                @elseif(strtolower($order->status) == 'pending' || strtolower($order->status) == 'proses')
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Proses</span>
                                @elseif(strtolower($order->status) == 'batal' || strtolower($order->status) == 'cancelled')
                                    <span class="badge bg-danger px-3 py-2 rounded-pill">Batal</span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-folder2-open d-block mb-2" style="font-size: 2.5rem;"></i>
                                Belum ada data laporan pesanan saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-light">
                    <tr>
                        <th colspan="4" class="text-end py-3 fs-5">Total Pendapatan Bersih :</th>
                        <th colspan="2" class="py-3 fs-5 text-primary fw-bold">
                            Rp {{ number_format($grandTotal, 0, ',', '.') }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- SCRIPT GRAFIK PREMIUM -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('laporanGrafik').getContext('2d');
        
        const labels = {!! $labelGrafik !!};
        const dataPendapatan = {!! $dataGrafik !!};

        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(79, 70, 229, 0.9)');  
        gradient.addColorStop(1, 'rgba(59, 130, 246, 0.2)');  

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan',
                    data: dataPendapatan,
                    backgroundColor: gradient,
                    borderColor: '#4f46e5',
                    borderWidth: 2,
                    borderRadius: 8, 
                    barPercentage: 0.6, 
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    y: {
                        duration: 1500,
                        easing: 'easeOutBounce' 
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.9)', 
                        titleFont: { size: 14, family: "'Poppins', sans-serif" },
                        bodyFont: { size: 15, weight: 'bold', family: "'Poppins', sans-serif" },
                        padding: 15,
                        cornerRadius: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Total: Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: "'Poppins', sans-serif", weight: '500' } }
                    },
                    y: {
                        border: { display: false },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)', 
                            borderDash: [5, 5] 
                        },
                        ticks: {
                            font: { family: "'Poppins', sans-serif" },
                            callback: function(value) {
                                if (value >= 1000000) {
                                    return 'Rp ' + (value / 1000000) + ' Jt';
                                } else if (value >= 1000) {
                                    return 'Rp ' + (value / 1000) + 'k';
                                }
                                return 'Rp ' + value;
                            }
                        }
                    }
                }
            }
        });
    });
</script>

<style>
    .text-indigo { color: #4f46e5; }
    
    @media print {
        .btn, .sidebar, .topbar, .print-hide { display: none !important; }
        .main { margin-left: 0 !important; padding: 0 !important; }
        .card { box-shadow: none !important; border: 1px solid #ddd !important; }
        .table-dark { background-color: #212529 !important; color: white !important; -webkit-print-color-adjust: exact; }
    }
</style>

@endsection