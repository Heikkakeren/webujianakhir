@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-pastel shadow-sm">
                <div class="card-header bg-pink text-white text-center">
                    <h3 class="mb-0">➕ Tambah Laptop Baru</h3>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Ups! Ada kesalahan:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.laptops.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="kode" class="form-label fw-bold">Kode Laptop</label>
                            <input type="text" name="kode" id="kode" class="form-control" value="{{ old('kode') }}" required>
                            @error('kode') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama Laptop</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                            @error('nama') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label fw-bold">Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga') }}" required>
                            @error('harga') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stok" class="form-label fw-bold">Stok</label>
                            <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok') }}" required>
                            @error('stok') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label fw-bold">Gambar Laptop</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                            @error('gambar') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-4">
                            <a href="{{ route('admin.laptops.index') }}" class="btn btn-secondary btn-pink-outline">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-pastel">
                                Simpan 💾
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection