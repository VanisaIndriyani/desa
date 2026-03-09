@extends('layouts.warga')

@section('title', 'Dashboard Warga')

@section('content')
<div class="container-fluid py-3">
    @php
        $h = (int) now()->format('H');
        $sapaan = $h < 12 ? 'Selamat Pagi' : ($h < 15 ? 'Selamat Siang' : ($h < 18 ? 'Selamat Sore' : 'Selamat Malam'));
    @endphp
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <h3 class="fw-bold mb-1">
                            {{ $sapaan }}, {{ Auth::user()->name }}!
                        </h3>
                        <div class="text-muted">
                            Dashboard Warga Desa RAKU — ringkas, cepat, dan responsif.
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('warga.surat') }}" class="btn btn-primary">
                            <i class="fa-solid fa-file-signature me-2"></i> Ajukan Surat
                        </a>
                        <a href="{{ route('warga.aduan') }}" class="btn btn-outline-primary">
                            <i class="fa-solid fa-bullhorn me-2"></i> Buat Aduan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-4 d-inline-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                        <i class="fa-solid fa-file-circle-check"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Pengajuan Surat</div>
                        <div class="fw-bold fs-5">{{ $suratCount ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-4 d-inline-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background: linear-gradient(135deg, #198754 0%, #157347 100%);">
                        <i class="fa-solid fa-building"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Pinjam Fasilitas</div>
                        <div class="fw-bold fs-5">{{ $bookingCount ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-4 d-inline-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Aduan Terkirim</div>
                        <div class="fw-bold fs-5">{{ $aduanCount ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-4 d-inline-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background: linear-gradient(135deg, #6c757d 0%, #5c636a 100%);">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Kelengkapan Profil</div>
                        <div class="fw-bold fs-5">{{ $profilePercent ?? 0 }}%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>Aktivitas Terakhir</h5>
                </div>
                <div class="card-body">
                    @php
                        $hasActivity = ($latestSurat ?? collect())->count() || ($latestBooking ?? collect())->count() || ($latestAduan ?? collect())->count();
                    @endphp
                    @if($hasActivity)
                        <div class="vstack gap-2">
                            @foreach(($latestSurat ?? []) as $s)
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted small"><i class="fa-solid fa-file-circle-check text-primary me-2"></i>Pengajuan surat: {{ $s->jenis }}</div>
                                    <span class="badge bg-secondary">{{ $s->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                            @foreach(($latestBooking ?? []) as $b)
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted small"><i class="fa-solid fa-building text-success me-2"></i>Booking fasilitas: {{ $b->facility->nama }} ({{ $b->tanggal }} {{ $b->mulai }}–{{ $b->selesai }})</div>
                                    <span class="badge bg-secondary">{{ $b->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                            @foreach(($latestAduan ?? []) as $a)
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted small"><i class="fa-solid fa-bullhorn text-danger me-2"></i>Aduan: {{ $a->judul }}</div>
                                    <span class="badge bg-secondary">{{ $a->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-muted">Belum ada aktivitas. Mulai dengan pengajuan surat atau aduan.</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold"><i class="fa-solid fa-bolt me-2 text-primary"></i>Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('warga.surat') }}" class="btn btn-primary">
                            <i class="fa-solid fa-file-signature me-2"></i> Ajukan Surat
                        </a>
                        <a href="{{ route('warga.fasilitas') }}" class="btn btn-success">
                            <i class="fa-solid fa-building me-2"></i> Booking Fasilitas
                        </a>
                        <a href="{{ route('warga.aduan') }}" class="btn btn-danger">
                            <i class="fa-solid fa-bullhorn me-2"></i> Buat Aduan
                        </a>
                        <a href="{{ route('warga.akun') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-user-gear me-2"></i> Kelola Akun
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection
