<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa RAKU - @yield('title', 'Website Resmi')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        :root {
            --raku-blue: #0d6efd;
            --raku-blue-700: #0a58ca;
            --raku-ink: #0b1f3a;
        }
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(900px circle at 10% 0%, rgba(13, 110, 253, 0.12), transparent 55%),
                        radial-gradient(900px circle at 90% 10%, rgba(13, 110, 253, 0.10), transparent 55%),
                        #f8fafc;
            color: var(--raku-ink);
        }
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1032;
            background: linear-gradient(135deg, var(--raku-blue) 0%, var(--raku-blue-700) 100%);
            box-shadow: 0 10px 24px rgba(13, 110, 253, 0.25);
        }
        /* Offcanvas (Sidebar Mobile) Styles */
        @media (max-width: 991.98px) {
            .offcanvas {
                max-width: 280px;
                border-radius: 16px 0 0 16px;
                border: none;
            }
            .offcanvas-body {
                background: linear-gradient(135deg, var(--raku-blue) 0%, var(--raku-blue-700) 100%);
                padding: 1.5rem;
            }
            .navbar-nav .nav-link {
                width: 100%;
                justify-content: flex-start;
                padding: 12px 16px;
                margin-bottom: 6px;
                font-size: 0.95rem;
            }
            .navbar-nav .nav-link:hover {
                background: rgba(255, 255, 255, 0.15);
                transform: translateX(4px);
            }
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .navbar-brand {
            letter-spacing: 0.2px;
        }
        .navbar-brand .brand-badge {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .navbar-nav .nav-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 12px;
            position: relative;
            transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }
        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.14);
            transform: translateY(-1px);
        }
        .navbar-nav .nav-link::after {
            content: "";
            position: absolute;
            left: 14px;
            right: 14px;
            bottom: 6px;
            height: 2px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.85);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.22s ease;
        }
        .navbar-nav .nav-link:hover::after {
            transform: scaleX(1);
        }
        .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.20);
            box-shadow: 0 10px 20px rgba(255, 255, 255, 0.10) inset;
        }
        .navbar-nav .nav-link.active::after {
            transform: scaleX(1);
        }
        .dropdown-menu {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 18px 36px rgba(2, 6, 23, 0.15);
        }
        .dropdown-item {
            border-radius: 10px;
        }
        .dropdown-item:hover {
            background-color: rgba(13, 110, 253, 0.10);
        }
        .btn-primary {
            background-color: var(--raku-blue);
            border-color: var(--raku-blue);
            box-shadow: 0 12px 28px rgba(13, 110, 253, 0.20);
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 40px rgba(13, 110, 253, 0.28);
            filter: brightness(1.02);
        }
        .btn-outline-light:hover {
            color: var(--raku-blue);
        }
        .footer {
            background: linear-gradient(135deg, var(--raku-blue) 0%, var(--raku-blue-700) 100%);
            color: white;
            padding: 20px 0;
            margin-top: 50px;
        }
        .card {
            border: none;
            box-shadow: 0 10px 26px rgba(2, 6, 23, 0.08);
            border-radius: 10px;
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(2, 6, 23, 0.12);
        }
        .main-content {
            min-height: calc(100vh - 160px);
        }
        .page-enter {
            animation: rakuPageIn 0.55s ease both;
        }
        @keyframes rakuPageIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .brand-badge i {
            animation: rakuPulse 2.8s ease-in-out infinite;
        }
        @keyframes rakuPulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.07); opacity: 0.95; }
        }
        #scrollProgress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            width: 0%;
            z-index: 1031;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.65));
            box-shadow: 0 6px 16px rgba(13, 110, 253, 0.25);
        }
        #backToTop {
            position: fixed;
            right: 18px;
            bottom: 18px;
            z-index: 1030;
            width: 44px;
            height: 44px;
            border: 0;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--raku-blue) 0%, var(--raku-blue-700) 100%);
            color: #fff;
            box-shadow: 0 14px 34px rgba(13, 110, 253, 0.30);
            opacity: 0;
            transform: translateY(8px);
            pointer-events: none;
            transition: opacity 0.2s ease, transform 0.2s ease, filter 0.2s ease;
        }
        #backToTop.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }
        #backToTop:hover {
            filter: brightness(1.05);
            transform: translateY(-1px);
        }
        #backToTop:active {
            transform: translateY(0);
        }
        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            .page-enter { animation: none; }
            .brand-badge i { animation: none; }
            .navbar-nav .nav-link,
            .btn-primary,
            .card,
            #backToTop { transition: none; }
        }
    </style>
    @stack('styles')
</head>
<body class="d-flex flex-column">
    <div id="scrollProgress" aria-hidden="true"></div>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <span class="brand-badge me-2">
                    <i class="fa-solid fa-landmark"></i>
                </span>
                Desa RAKU
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header" style="background: linear-gradient(135deg, var(--raku-blue) 0%, var(--raku-blue-700) 100%); color: white;">
                    <h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel">
                        <span class="brand-badge me-2" style="width: 32px; height: 32px;">
                            <i class="fa-solid fa-landmark"></i>
                        </span>
                        Desa RAKU
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="fa-solid fa-house"></i>
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profil') ? 'active' : '' }}" href="{{ route('profil') }}">
                            <i class="fa-solid fa-circle-info"></i>
                            Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('visi-misi') ? 'active' : '' }}" href="{{ route('visi-misi') }}">
                            <i class="fa-solid fa-bullseye"></i>
                            Visi & Misi
                        </a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                Masuk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">
                                <i class="fa-solid fa-user-plus"></i>
                                Daftar
                            </a>
                        </li>
                    @else
                        @if(Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="fa-solid fa-gauge-high"></i>
                                    Dashboard Admin
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('warga.dashboard') ? 'active' : '' }}" href="{{ route('warga.dashboard') }}">
                                    <i class="fa-solid fa-gauge-high"></i>
                                    Dashboard Warga
                                </a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-circle-user"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(Auth::user()->role == 'warga')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('warga.akun') }}">
                                            <i class="fa-solid fa-user-gear me-2"></i>
                                            Akun Saya
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>
                                            Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
        </div>
    </nav>

    <div class="main-content flex-grow-1 page-enter">
        @yield('content')
    </div>

    <button id="backToTop" type="button" aria-label="Kembali ke atas">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <footer class="footer text-center">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
                <div class="fw-semibold">
                    <i class="fa-solid fa-landmark me-2"></i>
                    &copy; {{ date('Y') }} Desa RAKU
                </div>
                <div class="small opacity-75">
                    <i class="fa-solid fa-heart me-1"></i>
                    Melayani dengan Sepenuh Hati
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            const progress = document.getElementById('scrollProgress');
            const backToTop = document.getElementById('backToTop');

            function update() {
                const doc = document.documentElement;
                const scrollTop = window.pageYOffset || doc.scrollTop || 0;
                const scrollHeight = doc.scrollHeight - doc.clientHeight;
                const pct = scrollHeight > 0 ? (scrollTop / scrollHeight) * 100 : 0;
                progress.style.width = pct + '%';

                if (scrollTop > 300) {
                    backToTop.classList.add('show');
                } else {
                    backToTop.classList.remove('show');
                }
            }

            window.addEventListener('scroll', update, { passive: true });
            window.addEventListener('resize', update);
            document.addEventListener('DOMContentLoaded', update);

            backToTop.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
