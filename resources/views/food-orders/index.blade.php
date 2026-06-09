@extends('layouts.app')

@section('content')

<h2>Data Pesanan</h2>

<a href="{{ route('food-orders.create') }}" class="btn btn-primary mb-3">
    Tambah Pesanan
</a>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>No</th>
        <th>Pelanggan</th>
        <th>Menu</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    </thead>

```
<tbody>
@forelse($orders as $order)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $order->customer_name }}</td>
    <td>{{ $order->menu->name ?? '-' }}</td>
    <td>{{ $order->quantity }}</td>
    <td>Rp {{ number_format($order->total_price,0,',','.') }}</td>
    <td>{{ $order->status }}</td>

    <td>
        <a href="{{ route('food-orders.edit',$order->id) }}"
           class="btn btn-warning btn-sm">
            Edit
        </a>

        <form action="{{ route('food-orders.destroy',$order->id) }}"
              method="POST"
              class="d-inline">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn btn-danger btn-sm">
                Hapus
            </button>

        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="7" class="text-center">
        Belum ada data pesanan
    </td>
</tr>
@endforelse
</tbody>
```

</table>

@endsection
