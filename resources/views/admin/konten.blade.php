@extends('layouts.admin')

@section('title', 'Kelola Konten Beranda & Profil')

@section('content')
<div class="container-fluid">
    <h3 class="fw-bold mb-3">Kelola Konten Beranda & Profil</h3>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <form action="{{ route('admin.konten.update') }}" method="POST" class="row g-4">
        @csrf
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Beranda</div>
                <div class="card-body">
                    <div class="mb-3">
                        <input type="text" name="beranda_judul" class="form-control" placeholder="Judul Beranda" value="{{ $beranda->judul ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <textarea name="beranda_isi" rows="6" class="form-control" placeholder="Konten Beranda (HTML/teks)">{{ $beranda->isi ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Profil</div>
                <div class="card-body">
                    <div class="mb-3">
                        <input type="text" name="profil_judul" class="form-control" placeholder="Judul Profil" value="{{ $profil->judul ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <textarea name="profil_isi" rows="6" class="form-control" placeholder="Konten Profil (HTML/teks)">{{ $profil->isi ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Sejarah Desa</div>
                <div class="card-body">
                    <div class="mb-3">
                        <input type="text" name="sejarah_judul" class="form-control" placeholder="Judul Sejarah" value="{{ $sejarah->judul ?? 'Sejarah Singkat' }}">
                    </div>
                    <div class="mb-3">
                        <textarea name="sejarah_isi" rows="6" class="form-control" placeholder="Konten Sejarah Desa (HTML/teks)">{{ $sejarah->isi ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">Visi & Misi</div>
                <div class="card-body">
                    <div class="mb-3">
                        <input type="text" name="visi_judul" class="form-control" placeholder="Judul Visi & Misi" value="{{ $visiMisi->judul ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <textarea name="visi_isi" rows="8" class="form-control" placeholder="Konten Visi & Misi (HTML/teks)">{{ $visiMisi->isi ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary">Simpan Semua</button>
        </div>
    </form>
</div>
@endsection
