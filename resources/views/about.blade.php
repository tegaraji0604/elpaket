@extends('layouts.app')

@section('content')
<style>
    .button {
        width: 100%;
        padding: 8px;
        font-size: 14px;
        border-radius: 8px;
        background: #7d7d7d;     /* warna utama abu-abu */
        color: white;
        border: 1px solid #a1a1a1;
        transition: 0.25s ease-in-out;
        outline: none !important;
    }
</style>
<div class="hero-section text-center py-5">
    <h1 class="fw-bold display-5">Selamat Datang di Manajemen Paket</h1>
    <p class="mt-3 fs-5">
        Aplikasi sederhana untuk melacak, mengirim, dan melihat riwayat pengiriman paket.
    </p>

    <a href="{{ route('create') }}" class="button">
        Mulai Buat Pesanan
    </a>
</div>
@endsection
