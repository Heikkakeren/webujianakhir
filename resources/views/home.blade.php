@extends('layouts.app')

@section('content')
<div class="user-container">
    <h2>🛒 Belanja Laptop</h2>

    <!-- Form Pencarian -->
    <form action="{{ route('search') }}" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Cari laptop..." value="{{ request('search') }}">
        <button type="submit">🔍 Cari</button>
    </form>

    <!-- Daftar Laptop -->
    <div class="product-grid">
        @foreach ($laptops as $laptop)
        <div class="product-card">
            <img src="{{ asset('storage/'.$laptop->gambar) }}" alt="{{ $laptop->nama }}" width="100%">
            <h3>{{ $laptop->nama }}</h3>
            <p>Kode: {{ $laptop->kode }}</p>
            <p>Harga: Rp {{ number_format($laptop->harga, 0, ',', '.') }}</p>
            <form action="/checkout" method="POST">
                @csrf
                <input type="hidden" name="laptop_id" value="{{ $laptop->id }}">
                <input type="text" name="user_name" placeholder="Nama Anda" required>
                <input type="number" name="jumlah" min="1" value="1" required>
                <button type="submit" class="btn-beli">🛒 Beli</button>
            </form>
        </div>
        @endforeach
    </div>

    <!-- Riwayat Transaksi -->
    @if(auth()->check())
    <h2>Riwayat Transaksi</h2>
    <table class="transaction-table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->laptop->nama }}</td>
                <td>{{ $transaction->jumlah }}</td>
                <td>Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                <td>{{ $transaction->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection