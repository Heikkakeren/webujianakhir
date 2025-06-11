@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2>✨ Daftar Akun</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Nama:</label>
        <input type="text" name="name" required autofocus>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Konfirmasi Password:</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Daftar</button>
        <p>Sudah punya akun? <a href="{{ route('login') }}">Login disini</a></p>
    </form>
</div>
@endsection