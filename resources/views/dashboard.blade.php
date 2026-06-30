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
</style>

<!-- Welcome -->
<div class="card welcome-card shadow-lg mb-5">
    <div class="card-body p-5">
        <div class="row align-items-center">

            <div class="col-md-8">
                <h2 class="fw-bold mb-3">
                    👋 Selamat Datang di Dashboard Restoran
                </h2>

                <p class="fs-5 mb-0">
                    Kelola menu makanan, pesanan pelanggan, serta pantau aktivitas restoran
                    dengan mudah melalui dashboard ini.
                </p>
            </div>

            <div class="col-md-4 text-center">
                <div class="welcome-icon">
                    🍽️
                </div>
            </div>

        </div>
    </div>
</div>


<div class="row g-4">

    <!-- MENU -->
    <div class="col-lg-6">
        <div class="card dashboard-card shadow-sm h-100">

            <div class="card-body text-center p-5">

                <div class="icon-circle bg-primary bg-opacity-10 mb-4">
                    <i class="bi bi-cup-hot-fill text-primary"
                       style="font-size:50px;"></i>
                </div>

                <h3 class="fw-bold">
                    Kelola Menu
                </h3>

                <p class="text-muted mt-3">
                    Tambahkan menu baru, ubah harga, edit informasi,
                    maupun hapus menu makanan dan minuman.
                </p>

                <a href="{{ route('menu-items.index') }}"
                   class="btn btn-primary btn-custom mt-2">
                    <i class="bi bi-arrow-right-circle me-2"></i>
                    Buka Menu
                </a>

            </div>

        </div>
    </div>

    <!-- PESANAN -->
    <div class="col-lg-6">
        <div class="card dashboard-card shadow-sm h-100">

            <div class="card-body text-center p-5">

                <div class="icon-circle bg-success bg-opacity-10 mb-4">
                    <i class="bi bi-bag-check-fill text-success"
                       style="font-size:50px;"></i>
                </div>

                <h3 class="fw-bold">
                    Kelola Pesanan
                </h3>

                <p class="text-muted mt-3">
                    Lihat daftar pesanan pelanggan, proses pembayaran,
                    dan pantau status pesanan secara realtime.
                </p>

                <a href="{{ route('food-orders.index') }}"
                   class="btn btn-success btn-custom mt-2">
                    <i class="bi bi-arrow-right-circle me-2"></i>
                    Lihat Pesanan
                </a>

            </div>

        </div>
    </div>

</div>

@endsection