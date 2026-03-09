@extends('layouts.warga')

@section('title', 'Pinjam Fasilitas')

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="fw-bold text-success mb-0">Peminjaman Fasilitas Desa</h2>
        @if(session('success'))
            <span class="badge bg-success">{{ session('success') }}</span>
        @endif
        @if(session('error'))
            <span class="badge bg-danger">{{ session('error') }}</span>
        @endif
    </div>
    <div class="row g-4">
        <div class="col-xl-8">
            <div class="row g-4">
                @forelse($facilities ?? [] as $facility)
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm border-0">
                            @if($facility->gambar_path)
                                <img src="{{ asset('storage/' . $facility->gambar_path) }}" class="card-img-top" alt="{{ $facility->nama }}" style="height: 200px; object-fit: cover;">
                            @elseif($facility->gambar_url)
                                <img src="{{ $facility->gambar_url }}" class="card-img-top" alt="{{ $facility->nama }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 200px;">
                                    <i class="fa-solid fa-image fa-3x"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $facility->nama }}</h5>
                                @if($facility->kapasitas)
                                    <div class="small text-muted mb-2">
                                        <i class="fa-solid fa-users me-2 text-success"></i>Kapasitas {{ $facility->kapasitas }}
                                    </div>
                                @endif
                                <p class="card-text text-muted small">{{ $facility->deskripsi }}</p>
                                <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $facility->id }}">
                                    Cek Jadwal & Booking
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="bookingModal{{ $facility->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Booking: {{ $facility->nama }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('warga.fasilitas.post') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="facility_id" value="{{ $facility->id }}">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control" min="{{ now()->toDateString() }}" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Mulai</label>
                                                    <input type="time" name="mulai" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Selesai</label>
                                                    <input type="time" name="selesai" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="small text-muted">Permintaan booking akan ditinjau oleh admin.</div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Kirim Permintaan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="text-muted">Belum ada data fasilitas. Admin dapat menambahkan fasilitas.</div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold"><i class="fa-solid fa-calendar-check me-2 text-success"></i>Booking Saya</h5>
                </div>
                <div class="card-body">
                    @if(isset($bookings) && $bookings->count())
                        <div class="list-group">
                            @foreach($bookings as $bk)
                                @php
                                    $st = strtolower($bk->status);
                                    $color = match($st) {
                                        'disetujui', 'selesai' => 'success',
                                        'ditolak' => 'danger',
                                        'diproses' => 'info',
                                        default => 'warning'
                                    };
                                @endphp
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fw-semibold">{{ $bk->facility->nama }}</div>
                                        <div class="text-muted small">{{ \Illuminate\Support\Carbon::parse($bk->tanggal)->format('d M Y') }} • {{ $bk->mulai }}–{{ $bk->selesai }}</div>
                                    </div>
                                    <span class="badge bg-{{ $color }}">{{ ucfirst($bk->status) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-muted">Belum ada booking.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
