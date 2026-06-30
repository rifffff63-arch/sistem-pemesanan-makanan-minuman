@extends('layouts.app')

@section('content')

<style>
    .welcome-card{
        background: linear-gradient(135deg,#4f46e5,#3b82f6);
        color:white;
        border:none;
        border-radius:20px;
        overflow:hidden;
    }

    .welcome-icon{
        font-size:90px;
        opacity:.9;
    }

    .dashboard-card{
        border:none;
        border-radius:20px;
        transition:.3s;
        overflow:hidden;
    }

    .dashboard-card:hover{
        transform:translateY(-8px);
        box-shadow:0 15px 35px rgba(0,0,0,.15);
    }

    .icon-circle{
        width:100px;
        height:100px;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        margin:auto;
    }

    .btn-custom{
        border-radius:50px;
        padding:10px 30px;
        font-weight:600;
    }

    .role-badge{
        font-size:15px;
        padding:8px 15px;
        border-radius:30px;
    }
</style>

<!-- WELCOME -->
<div class="card welcome-card shadow-lg mb-5">
    <div class="card-body p-5">
        <div class="row align-items-center">

            <div class="col-md-8">

                <h2 class="fw-bold mb-3">
                    👋 Selamat Datang, {{ Auth::user()->name }}
                </h2>

                @if(Auth::user()->role == 'admin')

                    <span class="badge bg-warning text-dark role-badge mb-3">
                        🛡 ADMIN
                    </span>

                    <p class="fs-5">
                        Anda login sebagai <b>Administrator</b>.
                        Kelola menu makanan, pesanan pelanggan, dan data restoran.
                    </p>

                @else

                    <span class="badge bg-light text-dark role-badge mb-3">
                        👤 USER
                    </span>

                    <p class="fs-5">
                        Anda login sebagai <b>User</b>.
                        Silakan melihat menu dan melakukan pemesanan makanan.
                    </p>

                @endif

            </div>

            <div class="col-md-4 text-center">

                @if(Auth::user()->role == 'admin')
                    <i class="bi bi-person-badge-fill welcome-icon"></i>
                @else
                    <i class="bi bi-person-circle welcome-icon"></i>
                @endif

            </div>

        </div>
    </div>
</div>

<div class="row g-4">

    @if(Auth::user()->role == 'admin')

    <!-- MENU -->
    <div class="col-lg-6">
        <div class="card dashboard-card shadow-sm h-100">

            <div class="card-body text-center p-5">

                <div class="icon-circle bg-primary bg-opacity-10 mb-4">
                    <i class="bi bi-cup-hot-fill text-primary" style="font-size:50px;"></i>
                </div>

                <h3 class="fw-bold">
                    Kelola Menu
                </h3>

                <p class="text-muted mt-3">
                    Tambahkan, edit, dan hapus menu makanan maupun minuman.
                </p>

                <a href="{{ route('menu-items.index') }}" class="btn btn-primary btn-custom">
                    <i class="bi bi-arrow-right-circle me-2"></i>
                    Kelola Menu
                </a>

            </div>

        </div>
    </div>

    <!-- PESANAN -->
    <div class="col-lg-6">
        <div class="card dashboard-card shadow-sm h-100">

            <div class="card-body text-center p-5">

                <div class="icon-circle bg-success bg-opacity-10 mb-4">
                    <i class="bi bi-bag-check-fill text-success" style="font-size:50px;"></i>
                </div>

                <h3 class="fw-bold">
                    Kelola Pesanan
                </h3>

                <p class="text-muted mt-3">
                    Lihat dan proses seluruh pesanan pelanggan.
                </p>

                <a href="{{ route('food-orders.index') }}" class="btn btn-success btn-custom">
                    <i class="bi bi-arrow-right-circle me-2"></i>
                    Kelola Pesanan
                </a>

            </div>

        </div>
    </div>

    @else
    <!-- LAPORAN -->
<div class="col-lg-4">
    <div class="card dashboard-card shadow-sm h-100">

        <div class="card-body text-center p-5">

            <div class="icon-circle bg-danger bg-opacity-10 mb-4">
                <i class="bi bi-file-earmark-bar-graph-fill text-danger" style="font-size:50px;"></i>
            </div>

            <h3 class="fw-bold">
                Laporan
            </h3>

            <p class="text-muted mt-3">
                Lihat laporan seluruh pesanan makanan dan minuman yang telah dilakukan pelanggan.
            </p>

            <a href="{{ route('reports.index') }}" class="btn btn-danger btn-custom">
                <i class="bi bi-file-earmark-text me-2"></i>
                Lihat Laporan
            </a>

        </div>

    </div>
</div>

    <!-- USER -->
    <div class="col-lg-12">
        <div class="card dashboard-card shadow-sm">

            <div class="card-body text-center p-5">

                <div class="icon-circle bg-info bg-opacity-10 mb-4">
                    <i class="bi bi-shop text-info" style="font-size:50px;"></i>
                </div>

                <h3 class="fw-bold">
                    Lihat Daftar Menu
                </h3>

                <p class="text-muted mt-3">
                    Silakan melihat daftar makanan dan minuman yang tersedia, kemudian lakukan pemesanan.
                </p>

                <a href="{{ route('menu-items.index') }}" class="btn btn-info text-white btn-custom">
                    <i class="bi bi-eye-fill me-2"></i>
                    Lihat Menu
                </a>

            </div>

        </div>
    </div>

    @endif

</div>

@endsection