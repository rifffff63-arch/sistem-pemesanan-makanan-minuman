@extends('layouts.app')

@section('content')

<h2>Daftar Menu Makanan & Minuman</h2>

<a href="{{ route('menu-items.create') }}" class="btn btn-primary mb-3">
    Tambah Menu
</a>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama Menu</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Waktu Masak</th>
        <th>Aksi</th>
    </tr>
    </thead>

    <tbody>
    @forelse($menuItems as $menu)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $menu->name }}</td>
            <td>{{ $menu->category }}</td>
            <td>Rp {{ number_format($menu->price,0,',','.') }}</td>
            <td>{{ $menu->preparation_time }} Menit</td>

            <td>
                <a href="{{ route('menu-items.edit',$menu->id) }}"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('menu-items.destroy',$menu->id) }}"
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
            <td colspan="6" class="text-center">
                Belum ada data menu
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

@endsection