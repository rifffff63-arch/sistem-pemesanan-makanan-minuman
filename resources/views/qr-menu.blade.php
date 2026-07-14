@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <div class="card shadow-sm border-0 p-5 mx-auto" style="border-radius: 25px; max-width: 400px;">
        <h2 class="fw-bold mb-4">Scan QR Menu</h2>
        
        <div class="mb-4">
            <!-- Menghasilkan QR Code secara lokal -->
            {!! QrCode::size(250)->generate($url) !!}
        </div>
        
        <p class="text-muted">Arahkan kamera ke QR Code di atas.</p>
        <a href="{{ $url }}" class="btn btn-primary rounded-pill px-4">Buka Menu</a>
    </div>
</div>
@endsection