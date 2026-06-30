@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📊 Laporan Pesanan</h2>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

<div class="card shadow">

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead class="table-dark">

            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Status</th>
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

                <td>{{ $loop->iteration }}</td>

                <td>{{ $order->customer_name }}</td>

                <td>{{ $order->menu->name ?? '-' }}</td>

                <td>{{ $order->quantity }}</td>

                <td>
                    Rp {{ number_format($order->total_price,0,',','.') }}
                </td>

                <td>{{ $order->status }}</td>

            </tr>

            @empty

            <tr>

                <td colspan="6" class="text-center">
                    Belum ada laporan
                </td>

            </tr>

            @endforelse

            </tbody>

            <tfoot>

            <tr class="table-primary">

                <th colspan="4" class="text-end">
                    Total Pendapatan
                </th>

                <th colspan="2">
                    Rp {{ number_format($grandTotal,0,',','.') }}
                </th>

            </tr>

            </tfoot>

        </table>

    </div>

</div>

@endsection