@extends('layouts.app')

@section('content')
<style>
/* ==========================================
   HISTORY PAGE STYLES
   ========================================== */

/* --- DEFAULT (DARK MODE) --- */
/* Hapus !important background pada Card agar global style app.blade.php bekerja */
.card {
    /* Style border & color sudah ikut app.blade.php */
    box-shadow: 0 0 15px rgba(212,175,55,0.25);
}

.card h3 {
    color: #E4C76F; /* Judul Emas */
}

/* Tabel Default (Dark) */
.table thead {
    background: #1c1c1c;
    color: #E4C76F;
}

.table tbody tr:hover {
    background: #1a1a1a;
}

/* Tombol Copy Default */
.copy-btn {
    background: #1a1a1a;
    border: 1px solid #A8852E;
    color: #E4C76F;
}

/* Badge Selesai/Proses */
.badge.bg-success {
    background: #D4AF37 !important;
    color: #000 !important;
}

.badge.bg-warning {
    background: #B8952B !important;
    color: #000 !important;
}

/* Tombol Export PDF (Merah) */
.btn-danger {
    background: #B22222;
    border: none;
    color: #fff;
    font-weight: 600;
}
.btn-danger:hover { background: #d33; }

/* Tombol Tandai Selesai (Emas) */
.btn-success {
    background: #D4AF37;
    color: #000;
    border: none;
    font-weight: 700;
}
.btn-success:hover { background: #EBCF5A; }


/* ==========================================
   LIGHT MODE OVERRIDES
   ========================================== */

/* Judul di Light Mode */
.light-mode .card h3 {
    color: #B8860B !important; /* Emas Gelap */
}

/* Tabel di Light Mode */
.light-mode .table thead {
    background: #f8f9fa !important; /* Header Terang */
    color: #B8860B !important;      /* Teks Header Emas Gelap */
    border-bottom: 2px solid #D4AF37;
}

.light-mode .table tbody tr:hover {
    background: #fff8e1 !important; /* Hover Kuning Sangat Muda */
}

/* Tombol Copy di Light Mode */
.light-mode .copy-btn {
    background: #fff !important;
    border: 1px solid #ccc !important;
    color: #B8860B !important;
}

.light-mode .copy-btn:hover {
    background: #eee !important;
}

</style>

<div class="d-flex justify-content-center mt-4">
    <div class="card shadow p-4" style="max-width: 900px; width: 100%;">

        {{-- HEADER & EXPORT --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Riwayat Pengiriman</h3>

            <a href="{{ route('export.pdf') }}" class="btn btn-danger">
                Export PDF
            </a>
        </div>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No. Resi</th>
                        <th>Tanggal Status</th>
                        <th>Pengirim</th>
                        <th>Penerima</th>
                        <th>Status</th>
                        <th>Completed</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($history as $item)
                        <tr>
                            <td>{{ $item->tracking_number }}
                                <button 
                                    class="btn btn-sm copy-btn"
                                    data-value="{{ $item->tracking_number }}"
                                    style="padding: 2px 6px; font-size: 11px; margin-left: 5px;"
                                >
                                    Copy
                                </button>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_status)->format('d M Y') }}</td>
                            <td>{{ $item->sender_name }}</td>
                            <td>{{ $item->receiver_name }}</td>

                            {{-- STATUS TERBARU --}}
                            <td>
                                @if($item->current_status === 'Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-warning text-dark">Diproses</span>
                                @endif
                            </td>

                            {{-- COMPLETED_AT --}}
                            <td>
                                @if($item->completed_at)
                                    {{ \Carbon\Carbon::parse($item->completed_at)->format('d M Y') }}
                                @else
                                    <span class="text-muted">Belum selesai</span>
                                @endif
                            </td>

                            {{-- BUTTON AKSI --}}
                            <td>
                                @php
                                    $status = isset($item->current_status) ? strtolower(trim($item->current_status)) : '';
                                @endphp

                                @if($status !== 'selesai')
                                    <form action="{{ route('shipment.complete', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button class="btn btn-success btn-sm" type="submit">
                                            Tandai Selesai
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const copyButtons = document.querySelectorAll(".copy-btn");

    copyButtons.forEach(btn => {
        btn.addEventListener("click", function () {
            const text = this.getAttribute("data-value");

            navigator.clipboard.writeText(text)
                .then(() => {
                    const originalText = this.innerText;
                    this.innerText = "Copied!";
                    setTimeout(() => {
                        this.innerText = originalText; // Kembalikan ke teks awal (bisa 'Copy' atau icon)
                    }, 1500);
                })
                .catch(err => console.error("Copy failed:", err));
        });
    });
});
</script>

@endsection