<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'ElPaket' }}</title>
  <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
<header class="nav">
  <h1>ElPaket</h1>
  <nav>
    <a href="/">Home</a>
    <a href="/create">Buat Pengiriman</a>
    <a href="/track">Lacak Paket</a>
    <a href="/history">Riwayat</a>
    <a href="/about">About</a>
  </nav>
</header>

<main class="container">
  @yield('content')
</main>

<footer class="footer">ElPaket — Sistem Informasi Manajemen Paket</footer>
</body>
</html>
