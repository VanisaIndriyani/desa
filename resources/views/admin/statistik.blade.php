@extends('layouts.admin')

@section('title', 'Kelola Statistik Desa')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center gap-3">
            <h3 class="fw-bold m-0">Kelola Statistik Desa</h3>
            <input type="text" id="searchStat" class="form-control" style="max-width:300px" placeholder="Cari nama/kategori/unit">
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddStat">
            <i class="fa-solid fa-plus me-2"></i> Tambah Data
        </button>
    </div>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="modal fade" id="modalAddStat" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.statistik.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Tambah Data Statistik</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label">Nama Data</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama data" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Kategori</label>
                                <input type="text" name="kategori" class="form-control" placeholder="Kategori">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Unit</label>
                                <input type="text" name="unit" class="form-control" placeholder="Unit">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Nilai</label>
                                <input type="number" step="0.01" name="nilai" class="form-control" placeholder="Nilai" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Urutan</label>
                                <input type="number" name="urut" class="form-control" placeholder="Urut" value="0">
                            </div>
                            <div class="col-md-3 d-flex align-items-end pb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" checked>
                                    <label class="form-check-label" for="published">Tampilkan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0" id="tableStat">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Unit</th>
                        <th>Nilai</th>
                        <th>Urut</th>
                        <th>Tampil</th>
                        <th style="width:220px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats as $s)
                        <tr>
                            <td>{{ ($stats->firstItem() ?? 1) + $loop->index }}</td>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->kategori }}</td>
                            <td>{{ $s->unit }}</td>
                            <td>{{ $s->nilai }}</td>
                            <td>{{ $s->urut }}</td>
                            <td><span class="badge {{ $s->published ? 'bg-success' : 'bg-secondary' }}">{{ $s->published ? 'Ya' : 'Tidak' }}</span></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editStat{{ $s->id }}">Edit</button>
                                    <form action="{{ route('admin.statistik.destroy', $s) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                                    <div class="modal fade" id="editStat{{ $s->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.statistik.update', $s->id) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bold">Edit Data Statistik</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <div class="row g-3">
                                                            <div class="col-md-5">
                                                                <label class="form-label">Nama Data</label>
                                                                <input type="text" name="nama" class="form-control" value="{{ $s->nama }}" required>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Kategori</label>
                                                                <input type="text" name="kategori" class="form-control" value="{{ $s->kategori }}">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label">Unit</label>
                                                                <input type="text" name="unit" class="form-control" value="{{ $s->unit }}">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label">Nilai</label>
                                                                <input type="number" step="0.01" name="nilai" class="form-control" value="{{ $s->nilai }}" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label">Urutan</label>
                                                                <input type="number" name="urut" class="form-control" value="{{ $s->urut }}">
                                                            </div>
                                                            <div class="col-md-3 d-flex align-items-end pb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="published" id="published{{ $s->id }}" value="1" {{ $s->published ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="published{{ $s->id }}">Tampilkan</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{ $stats->links() }}
        </div>
    </div>
@push('scripts')
<script>
(function(){
    const input = document.getElementById('searchStat');
    const table = document.getElementById('tableStat');
    if (!input || !table) return;
    const rows = () => Array.from(table.querySelectorAll('tbody tr'));
    function filter(){
        const q = input.value.toLowerCase();
        rows().forEach(tr => {
            const text = tr.innerText.toLowerCase();
            tr.style.display = text.includes(q) ? '' : 'none';
        });
    }
    input.addEventListener('input', filter);
})();
</script>
@endpush
</div>
@endsection
