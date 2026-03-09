@extends('layouts.warga')

@section('title', 'Akun Saya')

@section('content')
<div class="container-fluid py-3">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body p-4">
                    <div class="bg-secondary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center text-white" style="width: 120px; height: 120px;">
                        <i class="fas fa-user fa-4x"></i>
                    </div>
                    <h5 class="fw-bold">{{ Auth::user()->name }}</h5>
                    <p class="text-muted">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Warga Desa' }}</p>
                    <hr>
                    <div class="text-start">
                        <p class="mb-1 text-muted small"><i class="fas fa-id-card me-2"></i>NIK</p>
                        <p class="fw-bold">{{ Auth::user()->nik }}</p>
                        
                        <p class="mb-1 text-muted small"><i class="fas fa-envelope me-2"></i>Email</p>
                        <p class="fw-bold">{{ Auth::user()->email }}</p>

                        <p class="mb-1 text-muted small"><i class="fas fa-phone me-2"></i>No. HP</p>
                        <p class="fw-bold">{{ Auth::user()->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">Update Profil</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('warga.akun.post') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" value="{{ Auth::user()->nik }}">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">No. Telepon</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Lengkap (Sesuai KTP)</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Jl. Mawar No. 12, RT 01 RW 02...">{{ Auth::user()->address }}</textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="new_password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                            </div>
                            <div class="col-md-6">
                                <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>

            <!-- Password sekarang di-update lewat form di atas -->
        </div>
    </div>
</div>
@endsection
