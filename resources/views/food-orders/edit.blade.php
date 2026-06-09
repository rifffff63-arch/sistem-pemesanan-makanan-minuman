@extends('layouts.app')

@section('content')

<h2>Edit Pesanan</h2>

<form action="{{ route('food-orders.update',$order->id) }}"
      method="POST">

```
@csrf
@method('PUT')

<div class="mb-3">
    <label>Nama Pelanggan</label>
    <input type="text"
           name="customer_name"
           class="form-control"
           value="{{ $order->customer_name }}">
</div>

<div class="mb-3">
    <label>Nomor Meja</label>
    <input type="text"
           name="table_number"
           class="form-control"
           value="{{ $order->table_number }}">
</div>

<div class="mb-3">
    <label>Menu</label>

    <select name="menu_id" class="form-control">
        @foreach($menus as $menu)
        <option value="{{ $menu->id }}"
            {{ $order->menu_id == $menu->id ? 'selected' : '' }}>
            {{ $menu->name }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Jumlah</label>
    <input type="number"
           name="quantity"
           class="form-control"
           value="{{ $order->quantity }}">
</div>

<div class="mb-3">
    <label>Status</label>

    <select name="status" class="form-control">
        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
        <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Ready</option>
        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>
</div>

<div class="mb-3">
    <label>Catatan</label>

    <textarea name="special_request"
              class="form-control">{{ $order->special_request }}</textarea>
</div>

<button type="submit" class="btn btn-primary">
    Update
</button>

<a href="{{ route('food-orders.index') }}"
   class="btn btn-secondary">
    Kembali
</a>
```

</form>

@endsection
