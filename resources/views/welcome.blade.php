@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
<!-- Hero Section -->
<div class="bg-primary text-white py-5 text-center position-relative overflow-hidden" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
    <div class="container position-relative z-1">
        <h1 class="display-3 fw-bold mb-3 animate__animated animate__fadeInDown">Selamat Datang di Desa RAKU</h1>
        <p class="lead mb-4 animate__animated animate__fadeInUp">Desa Maju, Mandiri, dan Sejahtera dengan Pelayanan Digital Terintegrasi.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 gap-3 fw-bold text-primary">Daftar Sekarang</a>
            <a href="#layanan" class="btn btn-outline-light btn-lg px-4">Lihat Layanan</a>
        </div>
    </div>
    <!-- Decorative Circle -->
    <div class="position-absolute top-0 start-0 translate-middle rounded-circle bg-white opacity-10" style="width: 300px; height: 300px;"></div>
    <div class="position-absolute bottom-0 end-0 translate-middle rounded-circle bg-white opacity-10" style="width: 400px; height: 400px;"></div>
</div>

<!-- Info Stats -->
<div class="container my-5">
    <div class="row text-center g-4">
        @if(isset($stats) && count($stats))
            @foreach($stats as $s)
                <div class="col-md-4">
                    <div class="card p-4 h-100 border-0 shadow-sm hover-shadow">
                        <div class="card-body">
                            @if(str_contains(strtolower($s->nama), 'penduduk'))
                                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                            @elseif(str_contains(strtolower($s->nama), 'rt') || str_contains(strtolower($s->nama), 'rw') || str_contains(strtolower($s->nama), 'wilayah'))
                                <i class="fas fa-map-marked-alt fa-3x text-primary mb-3"></i>
                            @elseif(str_contains(strtolower($s->nama), 'anggaran'))
                                <i class="fas fa-coins fa-3x text-primary mb-3"></i>
                            @else
                                <i class="fas fa-chart-bar fa-3x text-primary mb-3"></i>
                            @endif
                            <h3 class="card-title fw-bold">{{ number_format($s->nilai, 0, ',', '.') }} {{ $s->unit != 'Unit' ? $s->unit : '' }}</h3>
                            <p class="card-text text-muted">{{ $s->nama }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-4">
                <div class="card p-4 h-100 border-0 shadow-sm hover-shadow">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h3 class="card-title fw-bold">1,250+</h3>
                        <p class="card-text text-muted">Penduduk Desa</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100 border-0 shadow-sm hover-shadow">
                    <div class="card-body">
                        <i class="fas fa-map-marked-alt fa-3x text-primary mb-3"></i>
                        <h3 class="card-title fw-bold">5 RT / 2 RW</h3>
                        <p class="card-text text-muted">Wilayah Administratif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100 border-0 shadow-sm hover-shadow">
                    <div class="card-body">
                        <i class="fas fa-hand-holding-heart fa-3x text-primary mb-3"></i>
                        <h3 class="card-title fw-bold">24 Jam</h3>
                        <p class="card-text text-muted">Layanan Online</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Layanan Section -->
<section id="layanan" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Layanan Unggulan</h2>
            <p class="text-muted">Kemudahan akses layanan administrasi desa untuk warga.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm transition-hover">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-envelope-open-text fa-lg"></i>
                        </div>
                        <h4 class="card-title fw-bold">Pengajuan Surat</h4>
                        <p class="card-text text-muted">Buat surat keterangan domisili, usaha, dan lainnya secara online tanpa antri.</p>
                        <a href="{{ route('warga.surat') }}" class="btn btn-outline-primary mt-3">Ajukan Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm transition-hover">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-building fa-lg"></i>
                        </div>
                        <h4 class="card-title fw-bold">Pinjam Fasilitas</h4>
                        <p class="card-text text-muted">Booking gedung serbaguna atau fasilitas desa lainnya dengan mudah.</p>
                        <a href="{{ route('warga.fasilitas') }}" class="btn btn-outline-success mt-3">Booking Fasilitas</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm transition-hover">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-bullhorn fa-lg"></i>
                        </div>
                        <h4 class="card-title fw-bold">Layanan Aduan</h4>
                        <p class="card-text text-muted">Sampaikan aspirasi, kritik, dan saran untuk kemajuan desa kita.</p>
                        <a href="{{ route('warga.aduan') }}" class="btn btn-outline-danger mt-3">Buat Aduan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<div class="py-5 text-center container">
    <div class="bg-white p-5 rounded-3 shadow-lg border border-primary">
        <h2 class="fw-bold mb-3">Belum punya akun warga?</h2>
        <p class="lead text-muted mb-4">Daftarkan diri Anda sekarang untuk menikmati kemudahan layanan digital Desa RAKU.</p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 rounded-pill shadow">Daftar Akun Warga</a>
    </div>
</div>
@endsection

@push('styles')
<style>
    .transition-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .opacity-10 {
        opacity: 0.1;
    }
</style>
@endpush
