@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark">
        <i class="bi bi-graph-up-arrow text-primary me-2"></i> Laporan Pesanan
    </h2>

    <div>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary rounded-pill px-4 shadow-sm me-2">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
        </a>
        
        <!-- Tombol Print -->
        <button onclick="window.print()" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-printer-fill me-1"></i> Cetak Laporan
        </button>
    </div>
</div>

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
                        <th class="py-3">Total</th>
                        <th class="py-3 text-center">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $grandTotal = 0;
                    @endphp

                    @forelse($orders as $order)
                        @php
                            $grandTotal += $order->total_price;
                        @endphp
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle fw-semibold">{{ $order->customer_name }}</td>
                            <td class="align-middle">{{ $order->menu->name ?? '-' }}</td>
                            <td class="text-center align-middle">{{ $order->quantity }}</td>
                            <td class="align-middle text-success fw-bold">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="text-center align-middle">
                                <!-- Badge Warna Berdasarkan Status -->
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
                        <th colspan="4" class="text-end py-3 fs-5">Total Pendapatan :</th>
                        <th colspan="2" class="py-3 fs-5 text-primary fw-bold">
                            Rp {{ number_format($grandTotal, 0, ',', '.') }}
                        </th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>

<!-- CSS khusus untuk mode Print (Merapikan halaman saat di-print) -->
<style>
    @media print {
        /* Sembunyikan tombol, sidebar, dan navbar saat diprint */
        .btn, .sidebar, .topbar {
            display: none !important;
        }
        
        /* Hilangkan margin dari sidebar agar tabel memenuhi kertas */
        .main {
            margin-left: 0 !important;
            padding: 0 !important;
        }

        /* Hilangkan bayangan card */
        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }

        /* Pastikan warna background header tabel ikut tercetak */
        .table-dark {
            background-color: #212529 !important;
            color: white !important;
            -webkit-print-color-adjust: exact;
        }
    }
</style>

@endsection