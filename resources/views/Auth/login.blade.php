@extends('layouts.app')

@section('content')
<style>
/* ==========================================
   AUTH CONTAINER STYLES
   ========================================== */

/* Container Default (Dark Mode) */
.auth-container {
    max-width: 420px;
    margin: 50px auto;
    padding: 25px;
    border-radius: 12px;
    background: #0d0d0d; 
    border: 1px solid #D4AF37;
    box-shadow: 0 0 15px rgba(212,175,55,0.25);
    transition: 0.3s;
}

/* Title Default */
.auth-title {
    font-weight: 700;
    font-size: 26px;
    text-align: center;
    margin-bottom: 20px;
    color: #E4C76F;
}

/* Label Default */
label {
    color: #E4C76F;
    font-weight: 500;
}

/* Tombol (Tetap Nuansa Emas) */
.auth-btn {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 8px;
    background: linear-gradient(90deg, #D4AF37, #B8952B);
    color: #000;
    font-weight: 700;
    border: none;
    transition: 0.25s;
    margin-top: 10px;
}

.auth-btn:hover {
    background: linear-gradient(90deg, #EBCF5A, #C8A63D);
    box-shadow: 0 0 14px rgba(255, 220, 100, 0.8);
}

/* Link */
.auth-link {
    text-align: center;
    margin-top: 15px;
    color: #E4C76F;
}

.auth-link a {
    color: #4EA3FF;
    text-decoration: none;
}

.auth-link a:hover {
    text-decoration: underline;
    color: #86c1ff;
}

/* ==========================================
   LIGHT MODE OVERRIDES (RESPONSIF)
   ========================================== */
.light-mode .auth-container {
    background: #ffffff;
    border: 1px solid #ccc;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.light-mode .auth-title {
    color: #B8860B; /* Emas Gelap */
}

.light-mode label {
    color: #B8860B; /* Label Emas Gelap/Hitam agar terbaca */
}

.light-mode .auth-link {
    color: #555;
}

/* CATATAN: Style .form-control KITA HAPUS DARI SINI 
   agar mengikuti aturan Global di app.blade.php */

</style>

<div class="auth-container">
    <h2 class="auth-title">Login</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required placeholder="Masukkan email...">
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required placeholder="Masukkan password...">
        </div>

        <button type="submit" class="auth-btn">Masuk</button>

        <div class="auth-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </div>
    </form>
</div>
@endsection