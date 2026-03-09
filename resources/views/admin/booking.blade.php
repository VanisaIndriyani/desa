@extends('layouts.admin')

@section('title', 'Kelola Booking Fasilitas')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold m-0">Kelola Booking Fasilitas</h3>
        <input type="text" id="searchBooking" class="form-control" style="max-width:300px" placeholder="Cari warga/fasilitas/tanggal/status">
    </div>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0" id="tableBooking">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Warga</th>
                        <th>Fasilitas</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $bk)
                        <tr>
                            <td>{{ ($bookings->firstItem() ?? 1) + $loop->index }}</td>
                            <td>{{ $bk->user->name ?? '-' }}</td>
                            <td>{{ $bk->facility->nama ?? '-' }}</td>
                            <td>{{ $bk->tanggal }}</td>
                            <td>{{ $bk->mulai }}–{{ $bk->selesai }}</td>
                            <td>
                                @php
                                    $st = strtolower($bk->status);
                                    $bg = match($st) {
                                        'disetujui' => 'success',
                                        'ditolak' => 'danger',
                                        default => 'warning'
                                    };
                                @endphp
                                <span class="badge bg-{{ $bg }}">{{ ucfirst($bk->status) }}</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.booking.update', $bk) }}" method="POST" class="d-flex align-items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm" required>
                                        @foreach(['menunggu','disetujui','ditolak'] as $s)
                                            <option value="{{ $s }}" @selected($bk->status === $s)>{{ ucfirst($s) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-primary">Simpan</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{ $bookings->links() }}
        </div>
    </div>
@push('scripts')
<script>
    (function(){
        const input = document.getElementById('searchBooking');
        const table = document.getElementById('tableBooking');
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
