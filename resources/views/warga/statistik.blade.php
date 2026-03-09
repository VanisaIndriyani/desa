@extends('layouts.warga')

@section('title', 'Statistik Desa')

@section('content')
<div class="container-fluid py-3">
    <h2 class="fw-bold mb-3 text-primary">Statistik Desa</h2>
    @if($stats->count())
        <div class="row g-3">
            @foreach($stats as $s)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="small text-muted mb-1">{{ $s->kategori ?? 'Umum' }}</div>
                            <div class="fw-semibold">{{ $s->nama }}</div>
                            <div class="display-6 fw-bold">{{ rtrim(rtrim(number_format($s->nilai, 2), '0'), '.') }} <span class="fs-6 text-muted">{{ $s->unit }}</span></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-muted">Belum ada data.</div>
    @endif
</div>
@endsection
