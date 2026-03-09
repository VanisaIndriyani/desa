@extends('layouts.admin')

@section('title', 'Kelola Perangkat Desa')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center gap-3">
            <h3 class="fw-bold m-0">Kelola Perangkat Desa</h3>
            <input type="text" id="searchOfficial" class="form-control" style="max-width:300px" placeholder="Cari nama/jabatan">
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddOfficial">
            <i class="fa-solid fa-plus me-2"></i> Tambah Perangkat
        </button>
    </div>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <div class="modal fade" id="modalAddOfficial" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.perangkat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Tambah Perangkat Desa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" placeholder="Jabatan" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Urutan</label>
                                <input type="number" name="urut" class="form-control" placeholder="Urut" value="0">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Foto (Opsional)</label>
                                <input type="file" name="foto" class="form-control" accept="image/*">
                            </div>
                            <div class="col-md-4 d-flex align-items-end pb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" checked>
                                    <label class="form-check-label" for="published">Tampilkan di Profil</label>
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
            <table class="table align-middle mb-0" id="tableOfficial">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Urut</th>
                        <th>Tampil</th>
                        <th style="width:220px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($officials as $o)
                        <tr>
                            <td>{{ ($officials->firstItem() ?? 1) + $loop->index }}</td>
                            <td>
                                @if($o->foto_path)
                                    <img src="{{ asset('storage/'.$o->foto_path) }}" alt="Foto" class="rounded" style="width:48px;height:48px;object-fit:cover">
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>{{ $o->nama }}</td>
                            <td>{{ $o->jabatan }}</td>
                            <td>{{ $o->urut }}</td>
                            <td><span class="badge {{ $o->published ? 'bg-success' : 'bg-secondary' }}">{{ $o->published ? 'Ya' : 'Tidak' }}</span></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editOfficial{{ $o->id }}">Edit</button>
                                    <form action="{{ route('admin.perangkat.destroy', $o) }}" method="POST" onsubmit="return confirm('Hapus perangkat ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                                    <div class="modal fade" id="editOfficial{{ $o->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.perangkat.update', $o->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bold">Edit Perangkat Desa</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Nama Lengkap</label>
                                                                <input type="text" name="nama" class="form-control" value="{{ $o->nama }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Jabatan</label>
                                                                <input type="text" name="jabatan" class="form-control" value="{{ $o->jabatan }}" required>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Urutan</label>
                                                                <input type="number" name="urut" class="form-control" value="{{ $o->urut }}">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label class="form-label">Ganti Foto (Opsional)</label>
                                                                <input type="file" name="foto" class="form-control" accept="image/*">
                                                            </div>
                                                            <div class="col-md-4 d-flex align-items-end pb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="published" id="published{{ $o->id }}" value="1" {{ $o->published ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="published{{ $o->id }}">Tampilkan di Profil</label>
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
            {{ $officials->links() }}
        </div>
    </div>
@push('scripts')
<script>
(function(){
    const input = document.getElementById('searchOfficial');
    const table = document.getElementById('tableOfficial');
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
