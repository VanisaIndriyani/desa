@extends('layouts.warga')

@section('title', 'Layanan Aduan')

@section('content')
<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="fw-bold text-danger m-0">Sampaikan Aspirasi Anda</h2>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalAduan">
                    <i class="fa-solid fa-bullhorn me-2"></i> Buat Aduan
                </button>
            </div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">Terjadi kesalahan. Periksa kembali formulir Anda.</div>
            @endif
            <div class="modal fade" id="modalAduan" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title fw-bold"><i class="fas fa-exclamation-circle me-2"></i>Form Pengaduan / Aspirasi</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('warga.aduan.post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="judul" class="form-label fw-bold">Judul Laporan</label>
                                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Contoh: Lampu jalan mati di RT 01" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label fw-bold">Kategori</label>
                                    <select class="form-select" id="kategori" name="kategori" required>
                                        <option value="">Pilih Kategori...</option>
                                        <option value="fasilitas">Kerusakan Fasilitas Umum</option>
                                        <option value="keamanan">Keamanan & Ketertiban</option>
                                        <option value="kebersihan">Kebersihan Lingkungan</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="isi" class="form-label fw-bold">Isi Laporan</label>
                                    <textarea class="form-control" id="isi" name="isi" rows="5" placeholder="Jelaskan detail laporan Anda..." required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label fw-bold">Lampirkan Foto (Opsional)</label>
                                    <input class="form-control" type="file" id="foto" name="foto" accept="image/*">
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="1" id="anonim" name="anonim">
                                    <label class="form-check-label text-muted" for="anonim">
                                        Kirim sebagai anonim (Nama tidak ditampilkan ke publik)
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Kirim Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-list me-2 text-danger"></i>Laporan Terakhir</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($complaints) && $complaints->count())
                            <div class="list-group">
                                @foreach($complaints as $c)
                                    @php
                                        $color = $c->status === 'menunggu' ? 'warning' : ($c->status === 'diproses' ? 'info' : ($c->status === 'selesai' ? 'success' : 'danger'));
                                    @endphp
                                    <div class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="fw-semibold">{{ $c->judul }}</div>
                                                <div class="text-muted small">{{ ucfirst($c->kategori) }} • {{ $c->created_at->format('d M Y') }}</div>
                                            </div>
                                            <span class="badge bg-{{ $color }}">{{ ucfirst($c->status) }}</span>
                                        </div>
                                        @if($c->foto_path)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/'.$c->foto_path) }}" alt="Lampiran" class="img-fluid rounded" style="max-height:160px">
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-muted">Belum ada laporan.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
