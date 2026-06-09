@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body text-center">

        <h1>Sistem Pemesanan Makanan & Minuman</h1>

        <p class="text-muted">
            Restoran dan Kafetaria Kampus
        </p>

        <a href="{{ route('menu-items.index') }}"
           class="btn btn-primary">
            Kelola Menu
        </a>

        <a href="{{ route('food-orders.index') }}"
           class="btn btn-success">
            Kelola Pesanan
        </a>

    </div>
</div>

@endsection