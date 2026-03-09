@extends('layouts.admin')

@section('title', 'Kelola Surat')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold m-0">Kelola Pengajuan Surat</h3>
        <input type="text" id="searchSurat" class="form-control" style="max-width:300px" placeholder="Cari warga/jenis/nomor/status">
    </div>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0" id="tableSurat">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Warga</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th>Nomor</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($letters as $l)
                        <tr>
                            <td>{{ ($letters->firstItem() ?? 1) + $loop->index }}</td>
                            <td>{{ $l->user->name ?? '-' }}</td>
                            <td>{{ $l->jenis }}</td>
                            <td><span class="badge bg-secondary">{{ ucfirst($l->status) }}</span></td>
                            <td>{{ $l->nomor_surat }}</td>
                            <td>
                                @if(!empty($l->file_path))
                                    <a href="{{ asset('storage/'.$l->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat PDF</a>
                                @else
                                    <span class="text-muted">Belum ada</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.surat.update', $l) }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm" required>
                                        @foreach(['menunggu','diproses','selesai','ditolak'] as $s)
                                            <option value="{{ $s }}" @selected($l->status === $s)>{{ ucfirst($s) }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="nomor_surat" class="form-control form-control-sm" placeholder="Nomor" value="{{ $l->nomor_surat }}">
                                    <input type="file" name="file" class="form-control form-control-sm" accept="application/pdf">
                                    <button class="btn btn-sm btn-primary">Simpan</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{ $letters->links() }}
        </div>
    </div>
</div>
@push('scripts')
<script>
    (function(){
        const input = document.getElementById('searchSurat');
        const table = document.getElementById('tableSurat');
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
@endsection
