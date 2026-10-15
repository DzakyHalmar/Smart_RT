
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart RT') - RT 005 / RW 003</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/smart-rt.css') }}">
    @stack('styles')
</head>
<body>
    <header class="site-header">
        <div class="container navbar">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-icon"><i class="bi bi-houses-fill"></i></span>
                <span>SMART <b>RT</b></span>
            </a>

            <nav class="nav-links">
                <a href="{{ route('home') }}"
                   class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('profil') }}"
                   class="{{ request()->routeIs('profil') ? 'active' : '' }}">Profil RT</a>
                <a href="{{ route('pengurus') }}"
                   class="{{ request()->routeIs('pengurus') ? 'active' : '' }}">Pengurus</a>
                <a href="{{ route('pengumuman') }}"
                   class="{{ request()->routeIs('pengumuman') ? 'active' : '' }}">Pengumuman</a>
                <a href="{{ route('keuangan') }}"
                   class="{{ request()->routeIs('keuangan') ? 'active' : '' }}">Transparansi Keuangan</a>
            </nav>

            
            <a href="{{ route('login') }}" class="btn btn-primary btn-login">
                <i class="bi bi-person"></i> Login Admin
            </a>

        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div class="footer-brand">
                <i class="bi bi-houses-fill"></i>
                <div>
                    <strong>SMART <span>RT</span></strong>
                    <p>Melayani dengan hati,<br>membangun bersama.</p>
                </div>
            </div>

            <div class="footer-info">
                <i class="bi bi-geo-alt-fill"></i>
                <div>
                    <strong>RT 001 / RW 012</strong>
                    <p>Kelurahan Kebayoran Lama,<br>Kota Jakarta Selatan 12240</p>
                </div>
            </div>

            <div class="footer-info">
                <i class="bi bi-people-fill"></i>
                <div>
                    <strong>Kontak Pengurus</strong>
                    <p>Silakan hubungi pengurus RT<br>melalui kanal resmi yang tersedia.</p>
                </div>
            </div>
        </div>
        <div class="copyright">
            &copy; {{ date('Y') }} Smart RT. Sistem informasi lingkungan warga.
        </div>
    </footer>
</body>
</html>
