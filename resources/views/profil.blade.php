@extends('layouts.app')

@section('title', 'Profil Desa')

@section('content')
    <div class="container py-5">
        <div class="row align-items-center g-4 mb-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="rounded-4 d-inline-flex align-items-center justify-content-center text-white" style="width: 48px; height: 48px; background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-0">Profil Desa RAKU</h1>
                        <div class="text-muted">Informasi singkat tentang Desa RAKU</div>
                    </div>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil Desa</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-4 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(13, 110, 253, 0.12); color: #0d6efd;">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">Kontak Kantor Desa</div>
                                <div class="text-muted small">+62 812-0000-0000</div>
                            </div>
                        </div>
                        <div class="mt-3 d-flex align-items-center gap-3">
                            <div class="rounded-4 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(13, 110, 253, 0.12); color: #0d6efd;">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">Alamat</div>
                                <div class="text-muted small">Kantor Desa RAKU, Kabupaten ...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($page) && $page && $page->isi)
            <div class="card mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-3">{{ $page->judul }}</h4>
                    <div class="text-muted">{!! $page->isi !!}</div>
                </div>
            </div>
        @endif
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">
                            <i class="fa-solid fa-book-open me-2 text-primary"></i>
                            {{ $sejarah->judul ?? 'Sejarah Singkat' }}
                        </h4>
                        <div class="text-muted mb-0">
                            {!! $sejarah->isi ?? 'Desa RAKU adalah desa yang berkomitmen menghadirkan pelayanan publik yang cepat, transparan, dan ramah melalui pemanfaatan teknologi. Konten sejarah ini dapat diubah melalui halaman Admin.' !!}
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">
                            <i class="fa-solid fa-chart-pie me-2 text-primary"></i>
                            Statistik & Geografis
                        </h4>
                        @if(isset($stats) && count($stats))
                            <div class="row g-3">
                                @foreach($stats as $s)
                                    <div class="col-md-6">
                                        <div class="p-3 rounded-4 border bg-white">
                                            <div class="small text-muted">{{ $s->nama }}</div>
                                            <div class="fw-semibold">{{ number_format($s->nilai, 0, ',', '.') }} {{ $s->unit }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 rounded-4 border bg-white">
                                        <div class="small text-muted">Luas Wilayah</div>
                                        <div class="fw-semibold">± 12,5 km²</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 rounded-4 border bg-white">
                                        <div class="small text-muted">Jumlah Penduduk</div>
                                        <div class="fw-semibold">1.250+ Jiwa</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 text-muted small">
                                Data belum tersedia. Silakan hubungi admin.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">
                            <i class="fa-solid fa-sitemap me-2 text-primary"></i>
                            Struktur Pemerintahan Desa
                        </h4>
                        <div class="row g-3">
                            @if(isset($officials) && count($officials))
                                @foreach($officials as $o)
                                    <div class="col-md-6">
                                        <div class="p-3 rounded-4 border bg-white d-flex align-items-center gap-3">
                                            @if($o->foto_path)
                                                <img src="{{ asset('storage/'.$o->foto_path) }}" alt="{{ $o->nama }}" class="rounded-4" style="width: 48px; height: 48px; object-fit: cover;">
                                            @else
                                                <div class="rounded-4 d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; background: rgba(13, 110, 253, 0.12); color: #0d6efd;">
                                                    @if(str_contains(strtolower($o->jabatan), 'kepala'))
                                                        <i class="fa-solid fa-user-tie"></i>
                                                    @elseif(str_contains(strtolower($o->jabatan), 'sekretaris'))
                                                        <i class="fa-solid fa-user-gear"></i>
                                                    @elseif(str_contains(strtolower($o->jabatan), 'kaur'))
                                                        <i class="fa-solid fa-people-roof"></i>
                                                    @else
                                                        <i class="fa-solid fa-id-card"></i>
                                                    @endif
                                                </div>
                                            @endif
                                            <div>
                                                <div class="small text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">{{ $o->jabatan }}</div>
                                                <div class="fw-bold">{{ $o->nama }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-muted">Belum ada data perangkat desa.</div>
                            @endif
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('visi-misi') }}" class="btn btn-primary">
                                <i class="fa-solid fa-bullseye me-2"></i>
                                Lihat Visi & Misi
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="fa-solid fa-clock me-2 text-primary"></i>
                            Jam Pelayanan
                        </h5>
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="rounded-4 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(13, 110, 253, 0.12); color: #0d6efd;">
                                <i class="fa-solid fa-calendar-day"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">Senin - Jumat</div>
                                <div class="text-muted small">08.00 - 15.00</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-3">
                            <div class="rounded-4 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(13, 110, 253, 0.12); color: #0d6efd;">
                                <i class="fa-solid fa-mug-hot"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">Istirahat</div>
                                <div class="text-muted small">12.00 - 13.00</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="fa-solid fa-circle-check me-2 text-primary"></i>
                            Layanan Digital
                        </h5>
                        <div class="d-grid gap-2">
                            <a href="{{ route('warga.surat') }}" class="btn btn-outline-primary">
                                <i class="fa-solid fa-file-signature me-2"></i>
                                Pengajuan Surat
                            </a>
                            <a href="{{ route('warga.fasilitas') }}" class="btn btn-outline-primary">
                                <i class="fa-solid fa-building me-2"></i>
                                Pinjam Fasilitas
                            </a>
                            <a href="{{ route('warga.aduan') }}" class="btn btn-outline-primary">
                                <i class="fa-solid fa-bullhorn me-2"></i>
                                Layanan Aduan
                            </a>
                        </div>
                        <div class="mt-3 text-muted small">
                            Untuk mengakses layanan, silakan login sebagai warga.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
