@extends('layouts.app')

@section('content')
<style>
/* ==========================================
   TRACK PAGE STYLES
   ========================================== */

/* --- DEFAULT (DARK MODE) --- */
/* Kita biarkan global style menangani Card, tapi kita bisa override detail kecil */
.card {
    transition: 0.3s;
    /* Background & Border ditangani oleh app.blade.php */
}

/* Input Default (Dark) */
#trackingInput {
    background: #1a1a1a;
    border: 1px solid #B8952B;
    color: #E4C76F;
}

#trackingInput:focus {
    border-color: #D4AF37;
    box-shadow: 0 0 10px rgba(212,175,55,0.5);
    color: #fff;
}

/* Tombol Paste Default (Dark) */
#pasteBtn {
    background: #2a2a2a;
    border: 1px solid #B8952B;
    color: #E4C76F;
    font-weight: 600;
}

#pasteBtn:hover {
    background: #3a3a3a;
}

/* Tombol Lacak (Gradient Gold) */
.btn-gold-gradient {
    background: linear-gradient(90deg, #D4AF37, #B8952B);
    color: #000;
    border: none;
    font-weight: 700;
}

.btn-gold-gradient:hover {
    background: linear-gradient(90deg, #EBCF5A, #C8A63D);
    color: #000;
}

/* ==========================================
   LIGHT MODE OVERRIDES
   ========================================== */
   
/* Input di Light Mode */
.light-mode #trackingInput {
    background: #ffffff !important;
    border: 1px solid #ccc !important;
    color: #B8860B !important; /* Emas Gelap agar terbaca */
}

.light-mode #trackingInput:focus {
    border-color: #D4AF37 !important;
    box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
}

/* Tombol Paste di Light Mode */
.light-mode #pasteBtn {
    background: #f0f0f0 !important;
    border: 1px solid #ccc !important;
    color: #B8860B !important;
}

.light-mode #pasteBtn:hover {
    background: #e0e0e0 !important;
}

/* Teks Penjelasan di Light Mode */
.light-mode .text-muted {
    color: #666 !important;
}
</style>

<div class="d-flex justify-content-center mt-4">
    <div class="card shadow p-4" style="max-width: 800px; width: 100%;">

        <h4 class="mb-2">Lacak Pengiriman Anda</h4>
        <p class="text-muted" style="margin-top: -5px;">Masukkan nomor resi atau kode tracking untuk melihat status paket.</p>

        <form action="{{ route('track') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" id="trackingInput" name="q" class="form-control"
                       placeholder="Masukkan Nomor Resi Anda..." value="{{ request('q') }}">

                {{-- Tombol Paste --}}
                <button type="button" class="btn btn-secondary" id="pasteBtn">
                    Paste
                </button>

                <button class="btn btn-gold-gradient" type="submit">Lacak</button>
            </div>
        </form>

        {{-- HASIL TRACKING --}}
        @if(isset($result))
            @if($result)
                <div class="alert alert-success">
                    <strong>Tracking Number:</strong> {{ $result->tracking_number }} <br>
                    <strong>Status:</strong> {{ $result->status ?? 'Tidak ada status' }} <br>
                    <strong>Pengirim:</strong> {{ $result->sender_name }} <br>
                    <strong>Penerima:</strong> {{ $result->receiver_name }} <br>
                </div>
            @else
                <div class="alert alert-danger">
                    Nomor resi tidak ditemukan.
                </div>
            @endif
        @endif

    </div>
</div>

{{-- SCRIPT PASTE --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const pasteBtn = document.getElementById('pasteBtn');
    const input = document.getElementById('trackingInput');

    pasteBtn.addEventListener('click', async () => {
        try {
            const text = await navigator.clipboard.readText();
            input.value = text;

            pasteBtn.innerText = "Pasted!";
            setTimeout(() => pasteBtn.innerText = "Paste", 1200);

        } catch (err) {
            alert("Gagal membaca clipboard. Izinkan akses clipboard pada browser.");
        }
    });
});
</script>

@endsection