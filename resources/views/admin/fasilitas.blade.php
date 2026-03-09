@extends('layouts.admin')

@section('title', 'Kelola Master Fasilitas')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center gap-3">
            <h3 class="fw-bold m-0">Kelola Master Fasilitas</h3>
            <input type="text" id="searchFacility" class="form-control" style="max-width:300px"
                   placeholder="Cari nama/deskripsi/kapasitas">
        </div>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddFacility">
            <i class="fa-solid fa-plus me-2"></i> Tambah Fasilitas
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    {{-- CARD TABLE --}}
    <div class="card border-0 shadow-sm">

        <div class="table-responsive">
            <table class="table align-middle mb-0" id="tableFacility">

                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kapasitas</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th style="width:220px">Aksi</th>
                </tr>
                </thead>

                <tbody>
                @foreach($facilities as $f)
                    <tr>

                        <td>{{ ($facilities->firstItem() ?? 1) + $loop->index }}</td>

                        <td>{{ $f->nama }}</td>

                        <td>{{ $f->kapasitas }}</td>

                        <td>
                            @php
                                $link = $f->gambar_path
                                    ? asset('storage/'.$f->gambar_path)
                                    : ($f->gambar_url ?: null);
                            @endphp

                            @if($link)
                                <a href="{{ $link }}" target="_blank"
                                   class="btn btn-sm btn-outline-primary">Lihat</a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td class="small">{{ $f->deskripsi }}</td>

                        <td>
                            <div class="d-flex gap-2">

                                <button class="btn btn-sm btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editFacility{{ $f->id }}">
                                    Edit
                                </button>

                                <form action="{{ route('admin.fasilitas.destroy',$f) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus fasilitas ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger">
                                        Hapus
                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

        <div class="card-body">
            {{ $facilities->links() }}
        </div>

    </div>

</div>


{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalAddFacility">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Fasilitas</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Fasilitas</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama fasilitas" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Kapasitas</label>
                            <input type="number" name="kapasitas" class="form-control" placeholder="Kapasitas" min="1" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Gambar (Upload)</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="form-control" placeholder="Deskripsi"></textarea>
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


{{-- MODAL EDIT --}}
@foreach($facilities as $f)

<div class="modal fade" id="editFacility{{ $f->id }}">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Fasilitas</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('admin.fasilitas.update',$f) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="modal-body text-start">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Fasilitas</label>
                            <input type="text" name="nama" class="form-control" value="{{ $f->nama }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Kapasitas</label>
                            <input type="number" name="kapasitas" class="form-control" value="{{ $f->kapasitas }}" min="1" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Ganti Gambar</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3">{{ $f->deskripsi }}</textarea>
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

@endforeach


@push('scripts')
<script>

const input = document.getElementById('searchFacility');
const table = document.getElementById('tableFacility');

if(input){

input.addEventListener('keyup',function(){

const keyword = this.value.toLowerCase();
const rows = table.querySelectorAll("tbody tr");

rows.forEach(row=>{
row.style.display = row.innerText.toLowerCase().includes(keyword) ? "" : "none";
});

});

}

</script>
@endpush

@endsection