<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Paket - ElPaket</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&display=swap" rel="stylesheet">

<style>
/* ======================================================
   1. BASE DARK LUXURY THEME (DEFAULT / MODE GELAP)
====================================================== */
body {
    background: radial-gradient(circle at center, #0e0e0e 0%, #000 70%);
    color: #E4C76F; 
    font-family: "Segoe UI", sans-serif;
    transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
    overflow-x: hidden;
    min-height: 100vh;
}

/* --- LOGO TEXT STYLING --- */
.logo-text-gradient {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800; 
    font-size: 2.2rem;
    background: linear-gradient(to right, #BF953F, #FCF6BA, #B38728, #FBF5B7, #AA771C);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    filter: drop-shadow(0 2px 2px rgba(0,0,0,0.5));
    margin-left: 10px;
    letter-spacing: 1px;
}

/* ======================================================
   2. KOMPONEN UI (DEFAULT DARK MODE)
====================================================== */

/* NAVBAR */
.navbar-dark.bg-dark {
    background-color: #000 !important;
    border-bottom: 2px solid #D4AF37;
    box-shadow: 0 0 20px rgba(212,175,55,0.25);
    padding: 10px 0;
    transition: background-color 0.3s ease;
}
.navbar-brand { display: flex; align-items: center; }
.navbar-dark .nav-link { color: #D4AF37 !important; font-weight: 500; }
.navbar-dark .nav-link:hover { color: #F1E4A3 !important; text-shadow: 0 0 5px rgba(212, 175, 55, 0.5); }

/* CARD */
.card {
    background: rgba(20, 20, 20, 0.95);
    border: 1px solid #D4AF37;
    box-shadow: 0 0 15px rgba(212,175,55,0.2);
    color: #E4C76F;
    transition: background-color 0.3s ease;
}
.card-header { border-bottom: 1px solid #D4AF37; background: transparent; }

/* --- INPUT FORM DARK MODE (Latar Hitam, Teks Emas Terang) --- */
input.form-control, 
textarea.form-control, 
select.form-select,
.input-group-text {
    background-color: #111 !important;      /* Hitam */
    border: 1px solid #D4AF37 !important;   /* Border Emas */
    color: #F8E6A0 !important;              /* EMAS TERANG (Agar terbaca di hitam) */
}

/* Saat Input Fokus (Dark Mode) */
input.form-control:focus,
textarea.form-control:focus {
    background-color: #000 !important;
    border-color: #FFF !important;
    box-shadow: 0 0 10px rgba(212,175,55,0.5);
    color: #FFF !important; /* Putih saat mengetik agar jelas */
}

.form-control::placeholder { color: #bfa76a !important; opacity: 0.7; }
.form-label { color: #D4AF37; font-weight: 600; }

/* TABEL DARK MODE */
.table { --bs-table-bg: transparent; color: #F8E6A0 !important; border-color: #D4AF37; }
.table thead th { color: #D4AF37 !important; border-bottom: 2px solid #D4AF37; }
.table tbody td { color: #F8E6A0 !important; border-bottom: 1px solid #443812; }
.table-hover tbody tr:hover td { color: #FFF !important; background-color: rgba(212, 175, 55, 0.15) !important; }

/* TOMBOL */
.btn-primary, .btn-warning {
    background: linear-gradient(45deg, #B8952B, #D4AF37, #F1E4A3);
    border: none;
    color: #000 !important;
    font-weight: bold;
    transition: 0.5s;
}
.btn-primary:hover { box-shadow: 0 0 15px #D4AF37; }

/* ======================================================
   3. LIGHT MODE OVERRIDES (PERBAIKAN RESPONSIF)
====================================================== */

/* Body Putih */
.light-mode {
    background: #f8f9fa !important; 
    color: #333 !important;
}

/* Navbar Putih */
.light-mode .navbar-dark.bg-dark {
    background-color: #ffffff !important;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
.light-mode .navbar-brand .logo-text-gradient { filter: drop-shadow(0 1px 1px rgba(0,0,0,0.3)); }

/* Card Putih */
.light-mode .card {
    background-color: #ffffff !important;
    border: 1px solid #ddd !important;
    border-top: 3px solid #D4AF37 !important;
    color: #333 !important;
}

/* --- INPUT FORM LIGHT MODE (Latar Putih, Teks Emas Gelap) --- */
.light-mode input.form-control,
.light-mode textarea.form-control,
.light-mode select.form-select,
.light-mode .input-group-text {
    background-color: #ffffff !important;   /* Latar PUTIH */
    border: 1px solid #ccc !important;      /* Border Abu soft */
    
    /* PENTING: Menggunakan EMAS GELAP (#B8860B) 
       Agar tetap terlihat "Gold" tapi bisa dibaca di latar putih. */
    color: #B8860B !important; 
    font-weight: 600;
}

/* Saat Input Fokus (Light Mode) */
.light-mode input.form-control:focus,
.light-mode textarea.form-control:focus {
    background-color: #fff !important;
    border-color: #D4AF37 !important;
    box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25) !important;
    /* Tetap Emas Gelap saat mengetik */
    color: #B8860B !important; 
}

/* Placeholder Light Mode */
.light-mode .form-control::placeholder {
    color: #aaa !important; /* Abu-abu agar tidak silau */
    font-weight: normal;
}

/* Label Form Light Mode */
.light-mode .form-label {
    color: #B8860B !important; /* Label Emas Gelap */
}

/* Tombol Paste/Addon Light Mode */
.light-mode .input-group-text {
    background-color: #f0f0f0 !important;
    color: #B8860B !important; /* Teks addon Emas Gelap */
    border-color: #ccc !important;
}

/* TABEL LIGHT MODE */
.light-mode .table { color: #B8860B !important; border-color: #eee !important; }
.light-mode .table thead th { color: #B8860B !important; border-bottom: 2px solid #D4AF37 !important; }
.light-mode .table tbody td { color: #9c7208 !important; } /* Isi tabel sedikit lebih gelap lagi */
.light-mode .table-hover tbody tr:hover td { color: #000 !important; background-color: #fff8e1 !important; }

/* Toggle Button */
#themeToggle {
    background: transparent;
    border: 1px solid #D4AF37;
    border-radius: 50%;
    width: 40px; height: 40px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; font-size: 1.2rem; color: #D4AF37;
}
.light-mode #themeToggle { background: #eee; color: #333; border-color: #ccc; }

/* Particles */
.particle {
    position: fixed; bottom: -10px; width: 6px; height: 6px;
    background: #D4AF37; border-radius: 50%;
    animation: floatParticle 8s infinite linear; opacity: 0; pointer-events: none; z-index: -1;
}
@keyframes floatParticle {
    0% { transform: translateY(0) rotate(0deg); opacity: 0; }
    20% { opacity: 0.5; }
    50% { opacity: 0.7; }
    100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
}
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" style="width:50px; height:50px; object-fit:contain;">
            <span class="logo-text-gradient">ElPaket</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-3">
                    <button id="themeToggle" title="Ganti Tema">🌙</button>
                </li>
                <li class="nav-item"><a class="nav-link" href="/">Halaman Utama</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('create') }}">Buat Pesanan</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('track') }}">Lacak Paket</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('history') }}">Riwayat</a></li>
                @guest
                <li class="nav-item ms-2"><a class="btn btn-outline-warning btn-sm px-3" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item ms-2"><a class="btn btn-primary btn-sm px-3" href="{{ route('register') }}">Register</a></li>
                @endguest
                @auth
                <li class="nav-item ms-3">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf <button class="btn btn-danger btn-sm px-3">Logout</button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById('themeToggle');
    const body = document.body;

    if(localStorage.getItem('theme') === 'light') {
        body.classList.add('light-mode');
        toggle.innerText = "🌞";
    } else {
        toggle.innerText = "🌙";
    }

    toggle.addEventListener('click', function () {
        body.classList.toggle('light-mode');
        if (body.classList.contains('light-mode')) {
            this.innerText = "🌞";
            localStorage.setItem('theme', 'light');
        } else {
            this.innerText = "🌙";
            localStorage.setItem('theme', 'dark');
        }
    });

    for (let i = 0; i < 20; i++) {
        let p = document.createElement("div");
        p.classList.add("particle");
        p.style.left = Math.random() * 100 + "vw";
        p.style.animationDelay = Math.random() * 5 + "s";
        p.style.animationDuration = 5 + Math.random() * 5 + "s";
        let size = Math.random() * 5 + 3;
        p.style.width = size + "px"; p.style.height = size + "px";
        document.body.appendChild(p);
    }
});
</script>

</body>
</html>