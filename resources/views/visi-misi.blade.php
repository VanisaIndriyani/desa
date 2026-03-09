@extends('layouts.app')

@section('title', 'Visi & Misi')

@section('content')
    <div class="container py-5">
        <div class="row align-items-center g-4 mb-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="rounded-4 d-inline-flex align-items-center justify-content-center text-white" style="width: 48px; height: 48px; background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-0">Visi & Misi Desa RAKU</h1>
                        <div class="text-muted">Arah pembangunan dan pelayanan Desa RAKU</div>
                    </div>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Visi & Misi</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-4 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(13, 110, 253, 0.12); color: #0d6efd;">
                                <i class="fa-solid fa-flag"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">Target Utama</div>
                                <div class="text-muted small">Pelayanan cepat & transparan</div>
                            </div>
                        </div>
                        <div class="mt-3 d-flex align-items-center gap-3">
                            <div class="rounded-4 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(13, 110, 253, 0.12); color: #0d6efd;">
                                <i class="fa-solid fa-people-group"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">Fokus</div>
                                <div class="text-muted small">Warga sebagai prioritas</div>
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
            <div class="col-lg-7">
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">
                            <i class="fa-solid fa-eye me-2 text-primary"></i>
                            Visi
                        </h4>
                        <div class="p-4 rounded-4 border bg-white">
                            <div class="d-flex align-items-start gap-3">
                                <div class="rounded-4 d-inline-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 44px; height: 44px; background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                                    <i class="fa-solid fa-quote-left"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold mb-1">Visi Desa RAKU</div>
                                    <div class="text-muted">
                                        Mewujudkan Desa RAKU yang maju, mandiri, sejahtera, dan berdaya saing melalui pelayanan publik
                                        yang profesional, transparan, dan berbasis teknologi.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 text-muted small">
                            Teks visi bisa kamu ubah sesuai dokumen resmi desa.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">
                            <i class="fa-solid fa-list-check me-2 text-primary"></i>
                            Misi
                        </h4>
                        <div class="vstack gap-3">
                            <div class="p-3 rounded-4 border bg-white d-flex align-items-start gap-3">
                                <div class="text-primary mt-1"><i class="fa-solid fa-circle-check"></i></div>
                                <div>
                                    <div class="fw-semibold">Meningkatkan kualitas pelayanan</div>
                                    <div class="text-muted small">Pelayanan cepat, ramah, dan akuntabel untuk seluruh warga.</div>
                                </div>
                            </div>
                            <div class="p-3 rounded-4 border bg-white d-flex align-items-start gap-3">
                                <div class="text-primary mt-1"><i class="fa-solid fa-circle-check"></i></div>
                                <div>
                                    <div class="fw-semibold">Digitalisasi layanan desa</div>
                                    <div class="text-muted small">Pengajuan surat, aduan, dan informasi desa lebih mudah diakses.</div>
                                </div>
                            </div>
                            <div class="p-3 rounded-4 border bg-white d-flex align-items-start gap-3">
                                <div class="text-primary mt-1"><i class="fa-solid fa-circle-check"></i></div>
                                <div>
                                    <div class="fw-semibold">Pemberdayaan masyarakat</div>
                                    <div class="text-muted small">Mendorong partisipasi warga dan penguatan ekonomi lokal.</div>
                                </div>
                            </div>
                            <div class="p-3 rounded-4 border bg-white d-flex align-items-start gap-3">
                                <div class="text-primary mt-1"><i class="fa-solid fa-circle-check"></i></div>
                                <div>
                                    <div class="fw-semibold">Tata kelola yang transparan</div>
                                    <div class="text-muted small">Informasi program dan kegiatan desa terbuka dan mudah dipantau.</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('profil') }}" class="btn btn-outline-primary">
                                <i class="fa-solid fa-circle-info me-2"></i>
                                Lihat Profil Desa
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="fa-solid fa-gem me-2 text-primary"></i>
                            Nilai Utama
                        </h5>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="p-3 rounded-4 border bg-white">
                                    <div class="text-primary mb-1"><i class="fa-solid fa-handshake"></i></div>
                                    <div class="fw-semibold">Integritas</div>
                                    <div class="text-muted small">Jujur & bertanggung jawab</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded-4 border bg-white">
                                    <div class="text-primary mb-1"><i class="fa-solid fa-bolt"></i></div>
                                    <div class="fw-semibold">Responsif</div>
                                    <div class="text-muted small">Cepat menanggapi warga</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded-4 border bg-white">
                                    <div class="text-primary mb-1"><i class="fa-solid fa-shield-heart"></i></div>
                                    <div class="fw-semibold">Pelayanan</div>
                                    <div class="text-muted small">Ramah & profesional</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded-4 border bg-white">
                                    <div class="text-primary mb-1"><i class="fa-solid fa-chart-line"></i></div>
                                    <div class="fw-semibold">Kemajuan</div>
                                    <div class="text-muted small">Inovasi berkelanjutan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="fa-solid fa-circle-question me-2 text-primary"></i>
                            Ringkas
                        </h5>
                        <div class="text-muted">
                            Visi & misi ini menjadi dasar arah pembangunan Desa RAKU agar program desa selaras dan manfaatnya
                            terasa langsung oleh warga.
                        </div>
                        <div class="mt-3 d-grid gap-2">
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                <i class="fa-solid fa-user-plus me-2"></i>
                                Daftar Akun Warga
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                <i class="fa-solid fa-right-to-bracket me-2"></i>
                                Masuk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
