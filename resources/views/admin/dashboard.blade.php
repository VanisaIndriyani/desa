@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <h3 class="fw-bold mb-3">Dashboard Admin</h3>
    <div class="row g-3">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-4 d-inline-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background: linear-gradient(135deg, #6610f2 0%, #520dc2 100%);">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Penduduk</div>
                        <div class="fw-bold fs-5">{{ number_format($stats['penduduk'] ?? 0) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-4 d-inline-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background: linear-gradient(135deg, #fd7e14 0%, #ca6510 100%);">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Anggaran (Juta)</div>
                        <div class="fw-bold fs-5">{{ number_format($stats['anggaran'] ?? 0) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-4 d-inline-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background: linear-gradient(135deg, #20c997 0%, #198754 100%);">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Fasilitas</div>
                        <div class="fw-bold fs-5">{{ $stats['fasilitas'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-4 d-inline-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Perangkat Desa</div>
                        <div class="fw-bold fs-5">{{ $stats['perangkat'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h5 class="fw-bold mb-3 mt-4">Status Layanan</h5>
    <div class="row g-3">
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-4 d-inline-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Surat Menunggu</div>
                        <div class="fw-bold fs-5">{{ $suratMenunggu }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-4 d-inline-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background: linear-gradient(135deg, #198754 0%, #157347 100%);">
                        <i class="fa-solid fa-building"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Booking Menunggu</div>
                        <div class="fw-bold fs-5">{{ $bookingMenunggu }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-4 d-inline-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Aduan Menunggu</div>
                        <div class="fw-bold fs-5">{{ $aduanMenunggu }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-2">
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Terbaru: Surat</div>
                <div class="card-body">
                    @foreach($latestSurat as $s)
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">{{ $s->jenis }} • {{ $s->status }}</div>
                            <span class="badge bg-secondary">{{ $s->created_at->diffForHumans() }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Terbaru: Booking</div>
                <div class="card-body">
                    @foreach($latestBooking as $b)
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">{{ $b->facility->nama ?? '-' }} • {{ $b->status }}</div>
                            <span class="badge bg-secondary">{{ $b->created_at->diffForHumans() }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Terbaru: Aduan</div>
                <div class="card-body">
                    @foreach($latestAduan as $a)
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">{{ $a->judul }} • {{ $a->status }}</div>
                            <span class="badge bg-secondary">{{ $a->created_at->diffForHumans() }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
