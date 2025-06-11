@extends('layouts.app')

@section('content')
<div class="admin-container p-4 bg-white rounded shadow-sm text-center">
    <h2 class="mb-4">📦 Daftar Laptop</h2>
    <a href="{{ route('admin.laptops.create') }}" class="btn btn-pink mb-3">➕ Tambah Laptop</a>

    @if ($errors->any())
    <div class="alert alert-danger text-start">
        <strong>Ups! Ada kesalahan:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/search" method="GET" class="mb-4">
        <div class="input-group w-50 mx-auto">
            <input type="text" name="search" placeholder="Cari laptop..." value="{{ request('search') }}" class="form-control">
            <button type="submit" class="btn btn-pink">🔍 Cari</button>
        </div>
    </form>

    <table class="table table-hover align-middle">
        <thead class="table-pink">
            <tr>
                <th>Gambar</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laptops as $laptop)
            <tr>
                <td><img src="{{ asset('storage/'.$laptop->gambar) }}" width="60" class="rounded"></td>
                <td>{{ $laptop->kode }}</td>
                <td>{{ $laptop->nama }}</td>
                <td><span class="badge bg-secondary">{{ $laptop->stok }}</span></td>
                <td>Rp {{ number_format($laptop->harga, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('admin.laptops.edit', $laptop) }}" class="btn btn-sm btn-warning me-1">✏️ Edit</a>
                    <form action="{{ route('admin.laptops.destroy', $laptop) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">🗑️ Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection