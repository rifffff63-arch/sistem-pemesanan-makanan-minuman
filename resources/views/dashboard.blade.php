@extends('layouts.app')

@section('content')
<style>
    .welcome-card { background: linear-gradient(135deg, #4f46e5, #3b82f6); color: white; border: none; border-radius: 25px; overflow: hidden; }
    .welcome-icon { font-size: 120px; opacity: .25; }
    .role-badge { font-size: 14px; padding: 8px 18px; border-radius: 50px; letter-spacing: 1px; }
    .dashboard-card { border: none; border-radius: 22px; transition: .35s; height: 100%; }
    .dashboard-card:hover { transform: translateY(-8px); box-shadow: 0 18px 35px rgba(0,0,0,.15); }
    .dashboard-card .card-body { display: flex; flex-direction: column; text-align: center; padding: 35px; }
    .dashboard-card h4, .dashboard-card h3 { min-height: 60px; font-weight: 700; }
    .dashboard-card p { color: #6b7280; min-height: 85px; margin-bottom: 30px; }
    .icon-circle { width: 95px; height: 95px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; box-shadow: 0 10px 25px rgba(0,0,0,.08); }
    .btn-custom { border-radius: 50px; padding: 12px; font-weight: 600; transition: .3s; margin-top: auto; }
    .btn-custom:hover { transform: translateY(-2px); }
    .divider { width: 60px; height: 4px; border-radius: 20px; margin: 0 auto 20px; }
    .stat-card { border: none; border-radius: 20px; transition: .3s; }
    .stat-card:hover { transform: translateY(-6px); }
</style>

{{-- WELCOME SECTION --}}
<div class="card welcome-card shadow-lg mb-5">
    <div class="card-body p-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3">👋 Selamat Datang, {{ Auth::user()->name }}</h2>
                @if(Auth::user()->role == 'admin')
                    <span class="badge bg-warning text-dark role-badge mb-3">
                        <i class="bi bi-shield-lock-fill me-1"></i> ADMIN
                    </span>
                    <p class="fs-5 opacity-75">Anda login sebagai <strong>Administrator</strong>.<br>Kelola menu makanan, proses pesanan pelanggan, dan pantau laporan restoran.</p>
                @else
                    <span class="badge bg-light text-dark role-badge mb-3">
                        <i class="bi bi-person-fill me-1"></i> USER
                    </span>
                    <p class="fs-5 opacity-75">Anda login sebagai <strong>User</strong>.<br>Jelajahi menu makanan dan pantau pesanan Anda.</p>
                @endif
            </div>
            <div class="col-lg-4 text-center">
                <i class="bi {{ Auth::user()->role == 'admin' ? 'bi-person-badge-fill' : 'bi-person-circle' }} welcome-icon"></i>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->role == 'admin')
    {{-- STATISTIK ADMIN --}}
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="card stat-card bg-primary text-white shadow">
                <div class="card-body d-flex justify-content-between">
                    <div><small>Total Menu</small><h2 class="fw-bold">{{ $totalMenu }}</h2></div>
                    <i class="bi bi-cup-hot-fill fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card stat-card bg-success text-white shadow">
                <div class="card-body d-flex justify-content-between">
                    <div><small>Total User</small><h2 class="fw-bold">{{ $totalUser }}</h2></div>
                    <i class="bi bi-people-fill fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card stat-card bg-warning shadow">
                <div class="card-body d-flex justify-content-between">
                    <div><small>Total Pesanan</small><h2 class="fw-bold">{{ $totalPesanan }}</h2></div>
                    <i class="bi bi-bag-check-fill fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card stat-card bg-danger text-white shadow">
                <div class="card-body d-flex justify-content-between">
                    <div><small>Pendapatan</small><h5 class="fw-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h5></div>
                    <i class="bi bi-cash-stack fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- MENU DASHBOARD --}}
<div class="row g-4">
    @if(Auth::user()->role == 'admin')
        <div class="col-lg-4 col-md-6">
            <div class="card dashboard-card shadow">
                <div class="card-body">
                    <div class="icon-circle bg-primary bg-opacity-10"><i class="bi bi-cup-hot-fill text-primary" style="font-size:42px;"></i></div>
                    <h4>Kelola Menu</h4>
                    <div class="divider bg-primary"></div>
                    <p>Tambahkan, ubah, dan hapus menu makanan maupun minuman restoran dengan mudah.</p>
                    <a href="{{ route('menu-items.index') }}" class="btn btn-primary btn-custom"><i class="bi bi-arrow-right-circle me-2"></i> Buka Menu</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card dashboard-card shadow">
                <div class="card-body">
                    <div class="icon-circle bg-success bg-opacity-10"><i class="bi bi-bag-check-fill text-success" style="font-size:42px;"></i></div>
                    <h4>Kelola Pesanan</h4>
                    <div class="divider bg-success"></div>
                    <p>Lihat seluruh pesanan pelanggan, ubah status pesanan, dan proses transaksi.</p>
                    <a href="{{ route('food-orders.index') }}" class="btn btn-success btn-custom"><i class="bi bi-arrow-right-circle me-2"></i> Buka Pesanan</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card dashboard-card shadow">
                <div class="card-body">
                    <div class="icon-circle bg-danger bg-opacity-10"><i class="bi bi-file-earmark-bar-graph-fill text-danger" style="font-size:42px;"></i></div>
                    <h4>Laporan Penjualan</h4>
                    <div class="divider bg-danger"></div>
                    <p>Lihat total transaksi, pendapatan restoran, serta rekapitulasi penjualan.</p>
                    <a href="{{ route('reports.index') }}" class="btn btn-danger btn-custom"><i class="bi bi-file-earmark-text me-2"></i> Lihat Laporan</a>
                </div>
            </div>
        </div>
    @else
        <div class="col-lg-6">
            <div class="card dashboard-card shadow">
                <div class="card-body">
                    <div class="icon-circle bg-info bg-opacity-10"><i class="bi bi-shop text-info" style="font-size:45px;"></i></div>
                    <h3>Daftar Menu</h3>
                    <div class="divider bg-info"></div>
                    <p>Jelajahi makanan dan minuman yang tersedia sebelum melakukan pemesanan.</p>
                    <a href="{{ route('menu-items.index') }}" class="btn btn-info text-white btn-custom"><i class="bi bi-eye-fill me-2"></i> Lihat Menu</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card dashboard-card shadow">
                <div class="card-body">
                    <div class="icon-circle bg-warning bg-opacity-10"><i class="bi bi-clock-history text-warning" style="font-size:45px;"></i></div>
                    <h3>Pesanan Saya</h3>
                    <div class="divider bg-warning"></div>
                    <p>Pantau status pesanan, apakah sedang diproses, selesai, atau dibatalkan.</p>
                    <a href="{{ route('food-orders.index') }}" class="btn btn-warning btn-custom"><i class="bi bi-receipt me-2"></i> Cek Pesanan</a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection