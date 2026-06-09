<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Edit Menu</h2>

    <form action="{{ route('menu-items.update',$menuItem->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ $menuItem->name }}">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ $menuItem->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text"
                   name="category"
                   class="form-control"
                   value="{{ $menuItem->category }}">
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number"
                   name="price"
                   class="form-control"
                   value="{{ $menuItem->price }}">
        </div>

        <div class="mb-3">
            <label>Waktu Masak</label>
            <input type="number"
                   name="preparation_time"
                   class="form-control"
                   value="{{ $menuItem->preparation_time }}">
        </div>

        <div class="mb-3">
            <label>Kalori</label>
            <input type="number"
                   name="calories"
                   class="form-control"
                   value="{{ $menuItem->calories }}">
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="text"
                   name="image"
                   class="form-control"
                   value="{{ $menuItem->image }}">
        </div>

        <button type="submit" class="btn btn-primary">
            Update
        </button>

        <a href="{{ route('menu-items.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

</body>
</html>