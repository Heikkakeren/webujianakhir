@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">🛒 Belanja Laptop</h2>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-pink d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Pencarian -->
    <div class="d-flex justify-content-center mb-4">
        <form action="{{ route('search') }}" method="GET" class="w-75">
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-lg rounded-start" placeholder="Cari laptop..." value="{{ request('search') }}">
                <button class="btn btn-pastel" type="submit">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Daftar Laptop -->
    <div class="row g-4 justify-content-center">
        @foreach ($laptops as $laptop)
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card card-laptop shadow-sm h-100 hover-zoom">
                <img src="{{ asset('storage/'.$laptop->gambar) }}" class="card-img-top" alt="{{ $laptop->nama }}">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">{{ $laptop->nama }}</h5>
                    <p class="card-text text-muted">Kode: {{ $laptop->kode }}</p>
                    <p class="card-text text-success fw-bold">Rp {{ number_format($laptop->harga, 0, ',', '.') }}</p>
                    
                    <!-- Form Beli -->
                    <form action="{{ route('checkout') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="laptop_id" value="{{ $laptop->id }}">

                        <div class="mb-2">
                            <input type="text" name="user_name"
                                value="{{ auth()->check() ? auth()->user()->name : '' }}"
                                placeholder="Nama Anda" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <input type="number" name="jumlah" min="1" value="1" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-beli w-100">
                            <i class="bi bi-cart-dash"></i> Beli Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Riwayat Transaksi -->
    @if(auth()->check())
    <div class="mt-5">
        <h3 class="text-center fw-semibold mb-3">📦 Riwayat Pembelian</h3>

        @if (!empty($transactions) && count($transactions) > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-pink text-white">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $trans)
                    <tr>
                        <td>{{ $trans->laptop->nama }}</td>
                        <td>{{ $trans->jumlah }}</td>
                        <td>Rp {{ number_format($trans->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $trans->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center mt-4 text-muted">
            <p>Belum ada riwayat pembelian.</p>
        </div>
        @endif
    </div>
    @endif
</div>
@endsection