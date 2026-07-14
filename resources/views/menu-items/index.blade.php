@extends('layouts.app')

@section('content')

<!-- Judul Utama -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark">
        <i class="bi bi-cup-hot-fill text-primary me-2"></i> Daftar Menu Makanan & Minuman
    </h2>

    @if(Auth::user()->role == 'admin')
        <a href="{{ route('menu-items.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Menu
        </a>
    @endif
</div>

<!-- Card Menu Terlaris (DIPINDAH KE SINI BIAR RAPI) -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm border-0" style="border-radius: 20px; background: linear-gradient(135deg, #4f46e5, #7c3aed); color: white;">
            <div class="card-body">
                <h6 class="mb-1"><i class="bi bi-trophy-fill me-2"></i> Menu Terlaris</h6>
                <h3 class="fw-bold mb-0">{{ $topMenu ?? '-' }}</h3>
                <small class="opacity-75">Total Penjualan: Rp {{ number_format($topValue ?? 0, 0, ',', '.') }}</small>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Menu -->
<div class="card shadow-sm border-0 mb-5" style="border-radius: 20px; overflow: hidden;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="py-3 text-center">No</th>
                        <th class="py-3">Nama Menu</th>
                        <th class="py-3 text-center">Kategori</th>
                        <th class="py-3">Harga</th>
                        <th class="py-3 text-center">Waktu Masak</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menuItems as $menu)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle fw-semibold text-dark">{{ $menu->name }}</td>
                            <td class="text-center align-middle">
                                <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $menu->category }}</span>
                            </td>
                            <td class="align-middle text-success fw-bold">
                                Rp {{ number_format($menu->price, 0, ',', '.') }}
                            </td>
                            <td class="text-center align-middle">
                                <i class="bi bi-clock me-1"></i> {{ $menu->preparation_time }} Menit
                            </td>
                            <td class="text-center align-middle">
                                @if(Auth::user()->role == 'admin')
                                    <a href="{{ route('menu-items.edit', $menu->id) }}" class="btn btn-warning btn-sm rounded-pill px-3 shadow-sm me-1">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('menu-items.destroy', $menu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('food-orders.create', ['menu_id' => $menu->id]) }}" class="btn btn-success btn-sm rounded-pill px-4 shadow-sm">
                                        <i class="bi bi-cart-plus me-1"></i> Pesan
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                Belum ada data menu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection