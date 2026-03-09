<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa RAKU - @yield('title', 'Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        :root { --admin-indigo:#0d6efd; --admin-indigo-700:#0a58ca; --ink:#0b1f3a; --sbw:260px; --sbw-collapsed:72px; }
        body { margin:0; font-family:'Poppins',sans-serif; background:#f8fafc; color:var(--ink); }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: var(--sbw); background: linear-gradient(135deg, var(--admin-indigo), var(--admin-indigo-700)); color: #fff; flex-shrink: 0; transition: width 0.3s ease, transform 0.3s ease; display: flex; flex-direction: column; position: sticky; top: 0; height: 100vh; overflow-y: auto; z-index: 1040; }
        .sidebar.collapsed { width: var(--sbw-collapsed); }
        .sidebar .nav-link { color: rgba(255,255,255,0.85); display: flex; align-items: center; gap: 12px; padding: 0.8rem 1rem; border-radius: 10px; margin: 4px 12px; transition: all 0.2s; white-space: nowrap; overflow: hidden; }
        .sidebar .nav-link:hover { background: rgba(255,255,255,0.15); color: #fff; transform: translateX(3px); }
        .sidebar .nav-link.active { background: #fff; color: var(--admin-indigo-700); font-weight: 500; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .sidebar .icon { width: 24px; text-align: center; font-size: 1.1rem; }
        .sidebar.collapsed .text, .sidebar.collapsed .sidebar-header .brand-text, .sidebar.collapsed .small-label { display: none; }
        .sidebar.collapsed .sidebar-header { justify-content: center; padding: 1rem 0; }
        .sidebar-header { padding: 1.25rem 1.5rem; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 1rem; }
        .brand-badge { width: 32px; height: 32px; background: rgba(255,255,255,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; }
        .main { flex-grow: 1; display: flex; flex-direction: column; background: #f8fafc; min-width: 0; }
        .topbar { background: #fff; padding: 0.75rem 1.5rem; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 1030; }
        .toggle-btn { background: transparent; border: none; color: var(--ink); font-size: 1.25rem; padding: 4px 8px; cursor: pointer; border-radius: 6px; }
        .toggle-btn:hover { background: #f1f5f9; }
        .content { padding: 1.5rem; flex-grow: 1; overflow-y: auto; }
        
        @media (max-width: 991.98px) {
            .sidebar { position: fixed; left: 0; top: 0; bottom: 0; height: 100%; transform: translateX(-100%); width: 260px !important; }
            .sidebar.show { transform: translateX(0); }
            .sidebar-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1035; opacity: 0; visibility: hidden; transition: all 0.3s; }
            .sidebar-overlay.show { opacity: 1; visibility: visible; }
        }
    </style>
    @stack('styles')
@yield('head')
</head>
<body>
    <div class="layout">
        <div id="sidebarOverlay" class="sidebar-overlay"></div>
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <span class="brand-badge"><i class="fa-solid fa-shield-halved"></i></span>
                <span class="brand-text fw-semibold fs-5">Admin Desa</span>
            </div>
            <div class="p-3">
                <div class="text-white-50 small mb-2">Menu Admin</div>
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <span class="icon"><i class="fa-solid fa-gauge"></i></span>
                    <span class="text">Dashboard</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.surat') ? 'active' : '' }}" href="{{ route('admin.surat') }}">
                    <span class="icon"><i class="fa-solid fa-file-signature"></i></span>
                    <span class="text">Kelola Surat</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.fasilitas') ? 'active' : '' }}" href="{{ route('admin.fasilitas') }}">
                    <span class="icon"><i class="fa-solid fa-building"></i></span>
                    <span class="text">Kelola Fasilitas</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.booking') ? 'active' : '' }}" href="{{ route('admin.booking') }}">
                    <span class="icon"><i class="fa-solid fa-calendar-check"></i></span>
                    <span class="text">Kelola Booking</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.aduan') ? 'active' : '' }}" href="{{ route('admin.aduan') }}">
                    <span class="icon"><i class="fa-solid fa-bullhorn"></i></span>
                    <span class="text">Kelola Aduan</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.statistik') ? 'active' : '' }}" href="{{ route('admin.statistik') }}">
                    <span class="icon"><i class="fa-solid fa-chart-column"></i></span>
                    <span class="text">Kelola Statistik</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.konten') ? 'active' : '' }}" href="{{ route('admin.konten') }}">
                    <span class="icon"><i class="fa-solid fa-file-lines"></i></span>
                    <span class="text">Kelola Konten</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.perangkat') ? 'active' : '' }}" href="{{ route('admin.perangkat') }}">
                    <span class="icon"><i class="fa-solid fa-users-gear"></i></span>
                    <span class="text">Kelola Perangkat</span>
                </a>
            </div>
            <div class="sidebar-footer">
                <div class="small text-white-50 mb-2">Aksi</div>
                <form action="{{ route('logout') }}" method="POST" class="d-grid gap-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">
                        <i class="fa-solid fa-power-off me-1"></i> Keluar
                    </button>
                </form>
            </div>
        </nav>
        <main class="main flex-grow-1 d-flex flex-column">
            <div class="topbar">
                <div class="d-flex align-items-center gap-3">
                    <button id="sidebarToggle" class="toggle-btn">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <h5 class="m-0 fw-semibold d-md-none">Admin Desa</h5>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-muted small d-none d-md-inline">{{ Auth::user()->name }}</span>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none text-dark" data-bs-toggle="dropdown">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center border" style="width: 36px; height: 36px;">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><h6 class="dropdown-header">{{ Auth::user()->name }}</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger"><i class="fa-solid fa-power-off me-2"></i>Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function(){
            const btn = document.getElementById('sidebarToggle');
            const sb = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const key = 'adminSidebarCollapsed';

            // Restore state on desktop
            try {
                const saved = localStorage.getItem(key);
                if (window.innerWidth >= 992 && saved === '1') {
                    sb.classList.add('collapsed');
                }
            } catch(e) {}

            function toggle() {
                if (window.innerWidth < 992) {
                    sb.classList.toggle('show');
                    overlay.classList.toggle('show');
                } else {
                    sb.classList.toggle('collapsed');
                    try { localStorage.setItem(key, sb.classList.contains('collapsed') ? '1' : '0'); } catch(e) {}
                }
            }

            function closeMobile() {
                if (window.innerWidth < 992) {
                    sb.classList.remove('show');
                    overlay.classList.remove('show');
                }
            }

            btn.addEventListener('click', toggle);
            overlay.addEventListener('click', closeMobile);

            // Close sidebar when clicking a link on mobile
            sb.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', closeMobile);
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
