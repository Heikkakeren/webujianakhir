@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2>🔐 Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>Email:</label>
        <input type="email" name="email" required autofocus>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Masuk</button>
        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a></p>
    </form>
</div>
@endsection