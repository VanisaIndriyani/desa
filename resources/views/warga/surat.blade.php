@extends('layouts.warga')

@section('title', 'Pengajuan Surat')

@section('content')
<div class="container-fluid py-3">
    <div class="row">
        <div class="col-md-12 mb-4">
            <h2 class="fw-bold text-primary border-bottom pb-2">Layanan Pengajuan Surat</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('warga.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengajuan Surat</li>
                </ol>
            </nav>
        </div>

        <div class="col-lg-8">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0 fw-bold"><i class="fas fa-edit me-2 text-primary"></i>Pengajuan Surat</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSurat">
                    <i class="fas fa-paper-plane me-2"></i> Ajukan Surat
                </button>
            </div>
            <div class="modal fade" id="modalSurat" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Form Pengajuan Surat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('warga.surat.post') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="jenisSurat" class="form-label">Jenis Surat</label>
                                    <select class="form-select" id="jenisSurat" name="jenis" required>
                                        <option value="">Pilih Jenis Surat...</option>
                                        <option value="Surat Keterangan Domisili">Surat Keterangan Domisili</option>
                                        <option value="Surat Keterangan Usaha">Surat Keterangan Usaha</option>
                                        <option value="Surat Keterangan Tidak Mampu">Surat Keterangan Tidak Mampu</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Tuliskan keterangan tambahan jika diperlukan"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-list me-2 text-primary"></i>Pengajuan Terakhir</h5>
                </div>
                <div class="card-body">
                    @if(isset($letters) && $letters->count())
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Jenis Surat</th>
                                        <th>Status</th>
                                        <th>Nomor</th>
                                        <th>File</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($letters as $letter)
                                        <tr>
                                            <td>{{ $letter->jenis }}</td>
                                            <td>
                                                @php
                                                    $color = $letter->status === 'menunggu' ? 'warning' : ($letter->status === 'diproses' ? 'info' : ($letter->status === 'selesai' ? 'success' : 'danger'));
                                                @endphp
                                                <span class="badge bg-{{ $color }}">{{ ucfirst($letter->status) }}</span>
                                            </td>
                                            <td>
                                                {{ $letter->nomor_surat ?? '-' }}
                                            </td>
                                            <td>
                                                @if(!empty($letter->file_path))
                                                    <a href="{{ asset('storage/'.$letter->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat PDF</a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $letter->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-muted">Belum ada pengajuan surat.</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Informasi</h5>
                    <p class="small text-muted">Pastikan data diri Anda sudah benar sebelum mengajukan surat. Proses verifikasi surat membutuhkan waktu 1-2 hari kerja.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
