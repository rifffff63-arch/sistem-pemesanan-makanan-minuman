@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark">
        <i class="bi bi-receipt text-primary me-2"></i> Data Pesanan
    </h2>

    <!-- Tombol Buat Pesanan -->
    <a href="{{ route('food-orders.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="bi bi-plus-circle me-1"></i> Buat Pesanan Baru
    </a>
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
                        <th class="py-3 text-center">Qty</th>
                        <th class="py-3">Total Harga</th>
                        <th class="py-3 text-center">Status</th>
                        
                        <!-- HEADER AKSI HANYA MUNCUL UNTUK ADMIN -->
                        @if(Auth::user()->role == 'admin')
                            <th class="py-3 text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle fw-semibold text-dark">{{ $order->customer_name }}</td>
                            <td class="align-middle">{{ $order->menu->name ?? '-' }}</td>
                            <td class="text-center align-middle">{{ $order->quantity }}</td>
                            <td class="align-middle text-success fw-bold">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            
                            <!-- BADGE STATUS -->
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

                            <!-- TOMBOL EDIT & HAPUS HANYA MUNCUL UNTUK ADMIN -->
                            @if(Auth::user()->role == 'admin')
                                <td class="text-center align-middle">
                                    <a href="{{ route('food-orders.edit', $order->id) }}" class="btn btn-warning btn-sm rounded-pill px-3 shadow-sm me-1">
                                        <i class="bi bi-pencil-square"></i> Ubah Status
                                    </a>

                                    <form action="{{ route('food-orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data pesanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <!-- Colspan otomatis menyesuaikan berdasarkan role yang login -->
                            <td colspan="{{ Auth::user()->role == 'admin' ? '7' : '6' }}" class="text-center py-5 text-muted">
                                <i class="bi bi-basket d-block mb-2" style="font-size: 2.5rem;"></i>
                                Belum ada data pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>
</div>

@endsection