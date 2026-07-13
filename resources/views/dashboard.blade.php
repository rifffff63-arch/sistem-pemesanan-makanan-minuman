@extends('layouts.app')

@section('content')

<style>
    .welcome-card {
        background: linear-gradient(135deg, #4f46e5, #3b82f6);
        color: white;
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .welcome-icon {
        font-size: 90px;
        opacity: 0.9;
    }

    .dashboard-card {
        border: none;
        border-radius: 20px;
        transition: 0.3s;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    .icon-circle {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
    }

    .btn-custom {
        border-radius: 50px;
        padding: 10px 30px;
        font-weight: 600;
        transition: 0.3s;
    }

    .role-badge {
        font-size: 14px;
        padding: 8px 16px;
        border-radius: 30px;
        letter-spacing: 1px;
    }
</style>

<!-- WELCOME CARD -->
<div class="card welcome-card shadow-lg mb-5">
    <div class="card-body p-5">
        <div class="row align-items-center">

            <div class="col-md-8">
                <h2 class="fw-bold mb-3">
                    👋 Selamat Datang, {{ Auth::user()->name }}
                </h2>

                @if(Auth::user()->role == 'admin')
                    <span class="badge bg-warning text-dark role-badge mb-3">
                        <i class="bi bi-shield-lock-fill me-1"></i> ADMIN
                    </span>
                    <p class="fs-5 opacity-75 mb-0">
                        Anda login sebagai <b>Administrator</b>. <br>
                        Kelola menu makanan, proses pesanan pelanggan, dan pantau laporan restoran.
                    </p>
                @else
                    <span class="badge bg-light text-dark role-badge mb-3">
                        <i class="bi bi-person-fill me-1"></i> USER
                    </span>
                    <p class="fs-5 opacity-75 mb-0">
                        Anda login sebagai <b>User</b>. <br>
                        Jelajahi menu lezat kami dan pantau pesanan makanan Anda.
                    </p>
                @endif
            </div>

            <div class="col-md-4 text-center border-start border-light border-opacity-25">
                @if(Auth::user()->role == 'admin')
                    <i class="bi bi-person-badge-fill welcome-icon d-block"></i>
                @else
                    <i class="bi bi-person-circle welcome-icon d-block"></i>
                @endif
            </div>

        </div>
    </div>
</div>

<div class="row g-4">

    @if(Auth::user()->role == 'admin')

    <!-- ==================== TAMPILAN ADMIN ==================== -->
    
    <!-- KELOLA MENU -->
    <div class="col-lg-4 col-md-6">
        <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body text-center p-4">
                <div class="icon-circle bg-primary bg-opacity-10 mb-4">
                    <i class="bi bi-cup-hot-fill text-primary" style="font-size:40px;"></i>
                </div>
                <h4 class="fw-bold">Kelola Menu</h4>
                <p class="text-muted mt-2 mb-4">
                    Tambahkan, edit, atau hapus menu makanan dan minuman restoran.
                </p>
                <a href="{{ route('menu-items.index') }}" class="btn btn-primary btn-custom w-100">
                    <i class="bi bi-arrow-right-circle me-2"></i> Buka Menu
                </a>
            </div>
        </div>
    </div>

    <!-- KELOLA PESANAN -->
    <div class="col-lg-4 col-md-6">
        <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body text-center p-4">
                <div class="icon-circle bg-success bg-opacity-10 mb-4">
                    <i class="bi bi-bag-check-fill text-success" style="font-size:40px;"></i>
                </div>
                <h4 class="fw-bold">Kelola Pesanan</h4>
                <p class="text-muted mt-2 mb-4">
                    Pantau dan proses semua pesanan yang masuk dari pelanggan.
                </p>
                <a href="{{ route('food-orders.index') }}" class="btn btn-success btn-custom w-100">
                    <i class="bi bi-arrow-right-circle me-2"></i> Buka Pesanan
                </a>
            </div>
        </div>
    </div>

    <!-- LAPORAN -->
    <div class="col-lg-4 col-md-12">
        <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body text-center p-4">
                <div class="icon-circle bg-danger bg-opacity-10 mb-4">
                    <i class="bi bi-file-earmark-bar-graph-fill text-danger" style="font-size:40px;"></i>
                </div>
                <h4 class="fw-bold">Laporan Penjualan</h4>
                <p class="text-muted mt-2 mb-4">
                    Lihat rekapitulasi transaksi dan total pendapatan restoran.
                </p>
                <a href="{{ route('reports.index') }}" class="btn btn-danger btn-custom w-100">
                    <i class="bi bi-file-earmark-text me-2"></i> Lihat Laporan
                </a>
            </div>
        </div>
    </div>

    @else

    <!-- ==================== TAMPILAN USER ==================== -->
    
    <!-- DAFTAR MENU -->
    <div class="col-lg-6 col-md-6">
        <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body text-center p-5">
                <div class="icon-circle bg-info bg-opacity-10 mb-4">
                    <i class="bi bi-shop text-info" style="font-size:50px;"></i>
                </div>
                <h3 class="fw-bold">Lihat Daftar Menu</h3>
                <p class="text-muted mt-3 mb-4">
                    Jelajahi berbagai pilihan makanan dan minuman lezat yang kami sediakan dan buat pesanan Anda.
                </p>
                <a href="{{ route('menu-items.index') }}" class="btn btn-info text-white btn-custom px-5">
                    <i class="bi bi-eye-fill me-2"></i> Lihat Menu
                </a>
            </div>
        </div>
    </div>

    <!-- PESANAN SAYA -->
    <div class="col-lg-6 col-md-6">
        <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body text-center p-5">
                <div class="icon-circle bg-warning bg-opacity-10 mb-4">
                    <i class="bi bi-clock-history text-warning" style="font-size:50px;"></i>
                </div>
                <h3 class="fw-bold">Pesanan Saya</h3>
                <p class="text-muted mt-3 mb-4">
                    Pantau status makanan yang sedang Anda pesan apakah sudah diproses atau sudah siap disajikan.
                </p>
                <a href="{{ route('food-orders.index') }}" class="btn btn-warning text-dark btn-custom px-5">
                    <i class="bi bi-receipt me-2"></i> Cek Pesanan
                </a>
            </div>
        </div>
    </div>

    @endif

</div>

@endsection