<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa RAKU - @yield('title', 'Warga')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        :root { --raku-blue:#0d6efd; --raku-blue-700:#0a58ca; --ink:#0b1f3a; }
        body { margin:0; font-family:'Poppins',sans-serif; background:#f8fafc; color:var(--ink); height:100vh; overflow:hidden; }
        .topbar { background:linear-gradient(135deg,var(--raku-blue),var(--raku-blue-700)); color:#fff; box-shadow:0 10px 24px rgba(13,110,253,.25); flex: 0 0 auto; z-index: 50; }
        .brand-badge { width:36px; height:36px; border-radius:12px; display:inline-flex; align-items:center; justify-content:center; background:rgba(255,255,255,.14); border:1px solid rgba(255,255,255,.18); }
        .layout { display:flex; height:100vh; width: 100%; overflow: hidden; }
        .sidebar { width:260px; background:linear-gradient(135deg, var(--raku-blue), var(--raku-blue-700)); color:#ffffff; box-shadow:0 18px 36px rgba(13,110,253,.25) inset; border-right:none; height:100%; overflow-y:auto; display:flex; flex-direction:column; flex:0 0 auto; z-index: 100; }
        .sidebar.collapsed { width:72px; }
        .sidebar .nav-link { color:#f8fafc; display:flex; align-items:center; gap:12px; padding:.75rem 1rem; border-radius:12px; margin:.25rem .75rem; transition:background .18s ease, transform .18s ease, color .18s ease, box-shadow .18s ease; }
        .sidebar .nav-link:hover { background:rgba(255,255,255,.12); transform:translateX(2px); }
        .sidebar .nav-link:active { transform:translateX(1px) scale(.99); box-shadow:0 0 0 2px rgba(255,255,255,.20) inset; }
        .sidebar .nav-link.active { background:#ffffff; color:var(--raku-blue-700); box-shadow:0 10px 20px rgba(2,6,23,.12); }
        .sidebar .icon { width:22px; text-align:center; }
        .sidebar.collapsed .text { display:none; }
        .sidebar-header { padding:1rem; border-bottom:1px solid rgba(255,255,255,.18); display:flex; align-items:center; gap:.75rem; flex: 0 0 auto; }
        .sidebar-header .brand-badge { width:36px; height:36px; border-radius:12px; background:rgba(255,255,255,.14); border:1px solid rgba(255,255,255,.18); display:inline-flex; align-items:center; justify-content:center; }
        .sidebar.collapsed .sidebar-header .brand-text { display:none; }
        .main { flex:1; min-width:0; background:radial-gradient(800px circle at 10% -10%, rgba(13,110,253,.12), transparent 55%), #f8fafc; display: flex; flex-direction: column; height: 100%; overflow: hidden; }
        .content { flex:1; overflow-y:auto; padding:24px; }
        .sidebar-footer { margin-top:auto; padding:1rem; flex: 0 0 auto; }
        .toggle-btn { border:0; background:rgba(255,255,255,.18); color:#fff; border-radius:12px; padding:.5rem .75rem; }
        @media (max-width: 991.98px){
            .sidebar { position:fixed; left:0; top:0; height:100vh; transform:translateX(-100%); transition:transform .25s ease; z-index:1050; }
            .sidebar.show { transform:translateX(0); }
            .sidebar.collapsed { width:220px; }
            .sidebar-header { margin-top: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="layout">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <span class="brand-badge"><i class="fa-solid fa-landmark"></i></span>
                <span class="brand-text fw-semibold">Desa RAKU</span>
            </div>
            <div class="p-3">
                <div class="text-white-50 small mb-2">Menu Warga</div>
                <a class="nav-link {{ request()->routeIs('warga.dashboard') ? 'active' : '' }}" href="{{ route('warga.dashboard') }}">
                    <span class="icon"><i class="fa-solid fa-gauge-high"></i></span>
                    <span class="text">Dashboard</span>
                </a>
                <a class="nav-link {{ request()->routeIs('warga.surat') ? 'active' : '' }}" href="{{ route('warga.surat') }}">
                    <span class="icon"><i class="fa-solid fa-file-signature"></i></span>
                    <span class="text">Pengajuan Surat</span>
                </a>
                <a class="nav-link {{ request()->routeIs('warga.fasilitas') ? 'active' : '' }}" href="{{ route('warga.fasilitas') }}">
                    <span class="icon"><i class="fa-solid fa-building"></i></span>
                    <span class="text">Pinjam Fasilitas</span>
                </a>
                <a class="nav-link {{ request()->routeIs('warga.aduan') ? 'active' : '' }}" href="{{ route('warga.aduan') }}">
                    <span class="icon"><i class="fa-solid fa-bullhorn"></i></span>
                    <span class="text">Layanan Aduan</span>
                </a>
                <a class="nav-link {{ request()->routeIs('warga.akun') ? 'active' : '' }}" href="{{ route('warga.akun') }}">
                    <span class="icon"><i class="fa-solid fa-user-gear"></i></span>
                    <span class="text">Akun Saya</span>
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
            <div class="topbar py-2 px-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <button id="sidebarToggle" class="toggle-btn">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                   
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-white-50 small d-none d-md-inline">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                     
                    </form>
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
            const key = 'rakuSidebarCollapsed';
            try {
                const saved = localStorage.getItem(key);
                if (saved === '1') sb.classList.add('collapsed');
            } catch(e) {}
            function toggle(){
                if (window.innerWidth < 992) {
                    sb.classList.toggle('show');
                } else {
                    sb.classList.toggle('collapsed');
                    try { localStorage.setItem(key, sb.classList.contains('collapsed') ? '1' : '0'); } catch(e) {}
                }
            }
            btn.addEventListener('click', toggle);
        })();
    </script>
    @stack('scripts')
</body>
</html>
