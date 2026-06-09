
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Tambah Pesanan</h2>

    <form action="{{ route('food-orders.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label>Nama Pelanggan</label>
            <input type="text" name="customer_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nomor Meja</label>
            <input type="text" name="table_number" class="form-control">
        </div>

        <div class="mb-3">
            <label>Menu</label>
            <select name="menu_id" class="form-control">

                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">
                        {{ $menu->name }} - Rp {{ number_format($menu->price,0,',','.') }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="quantity" class="form-control">
        </div>

        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="special_request" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Simpan
        </button>

        <a href="{{ route('food-orders.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

</body>
</html>
```
