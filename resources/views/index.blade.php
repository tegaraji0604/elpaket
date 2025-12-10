@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center mt-5">
    <div class="card shadow-lg p-5" style="max-width: 700px; width: 100%;">
        <h2 class="text-center mb-3">Selamat Datang di Sistem Manajemen Paket</h2>
        <p class="text-center text-muted mb-4">
            Solusi mudah untuk mengelola dan melacak pengiriman Anda.
        </p>

        <div class="text-center">
            <a href="{{ route('create') }}" class="btn btn-warning">Buat Pengiriman Baru</a>
        </div>
    </div>
</div>
@endsection
