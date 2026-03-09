@extends('layouts.admin')

@section('title', 'Kelola Aduan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold m-0">Kelola Aduan Warga</h3>
        <input type="text" id="searchAduan" class="form-control" style="max-width:300px" placeholder="Cari warga/judul/kategori/status">
    </div>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0" id="tableAduan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Warga</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggapan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $c)
                        <tr>
                            <td>{{ ($complaints->firstItem() ?? 1) + $loop->index }}</td>
                            <td>{{ $c->anonim ? 'Anonim' : ($c->user->name ?? '-') }}</td>
                            <td>{{ $c->judul }}</td>
                            <td>{{ ucfirst($c->kategori) }}</td>
                            <td>
                                @php
                                    $st = strtolower($c->status);
                                    $bg = match($st) {
                                        'selesai' => 'success',
                                        'diproses' => 'info',
                                        'ditolak' => 'danger',
                                        default => 'warning'
                                    };
                                @endphp
                                <span class="badge bg-{{ $bg }}">{{ ucfirst($c->status) }}</span>
                            </td>
                            <td class="small">{{ $c->tanggapan }}</td>
                            <td>
                                <form action="{{ route('admin.aduan.update', $c) }}" method="POST" class="d-grid gap-2">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-flex align-items-center gap-2">
                                        <select name="status" class="form-select form-select-sm" required>
                                            @foreach(['menunggu','diproses','selesai','ditolak'] as $s)
                                                <option value="{{ $s }}" @selected($c->status === $s)>{{ ucfirst($s) }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-sm btn-primary">Simpan</button>
                                    </div>
                                    <textarea name="tanggapan" rows="2" class="form-control form-control-sm" placeholder="Tanggapan admin...">{{ $c->tanggapan }}</textarea>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{ $complaints->links() }}
        </div>
    </div>
</div>
@push('scripts')
<script>
    (function(){
        const input = document.getElementById('searchAduan');
        const table = document.getElementById('tableAduan');
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
