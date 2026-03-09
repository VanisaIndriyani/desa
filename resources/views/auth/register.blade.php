@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="container d-flex flex-column justify-content-center" style="min-height: calc(100vh - 200px);">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4 my-5">
                <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                    <h3 class="fw-bold my-2">Pendaftaran Warga</h3>
                </div>
                <div class="card-body p-4 p-md-5">
                    @if($errors->any())
                        <div class="alert alert-danger rounded-3 mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register.post') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label for="name" class="form-label text-muted">Nama Lengkap</label>
                                    <input class="form-control bg-transparent" id="name" name="name" type="text" placeholder="Nama Lengkap" value="{{ old('name') }}" required style="border-radius: 12px; border: 1px solid #dee2e6; padding: 12px 15px;" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label for="nik" class="form-label text-muted">NIK</label>
                                    <input class="form-control bg-transparent" id="nik" name="nik" type="text" placeholder="NIK" value="{{ old('nik') }}" required style="border-radius: 12px; border: 1px solid #dee2e6; padding: 12px 15px;" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label text-muted">Nomor Telepon</label>
                            <input class="form-control bg-transparent" id="phone" name="phone" type="text" placeholder="No. HP" value="{{ old('phone') }}" required style="border-radius: 12px; border: 1px solid #dee2e6; padding: 12px 15px;" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label text-muted">Alamat Email</label>
                            <input class="form-control bg-transparent" id="email" name="email" type="email" placeholder="name@example.com" value="{{ old('email') }}" required style="border-radius: 12px; border: 1px solid #dee2e6; padding: 12px 15px;" />
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label for="password" class="form-label text-muted">Password</label>
                                    <div class="input-group">
                                        <input class="form-control bg-transparent border-end-0" id="password" name="password" type="password" placeholder="Create a password" required style="border-radius: 12px 0 0 12px; border: 1px solid #dee2e6; padding: 12px 15px;" />
                                        <span class="input-group-text bg-transparent border-start-0" style="border-radius: 0 12px 12px 0; border: 1px solid #dee2e6; cursor: pointer;" onclick="togglePassword('password', this)">
                                            <i class="fa-regular fa-eye text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label for="password_confirmation" class="form-label text-muted">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input class="form-control bg-transparent border-end-0" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm password" required style="border-radius: 12px 0 0 12px; border: 1px solid #dee2e6; padding: 12px 15px;" />
                                        <span class="input-group-text bg-transparent border-start-0" style="border-radius: 0 12px 12px 0; border: 1px solid #dee2e6; cursor: pointer;" onclick="togglePassword('password_confirmation', this)">
                                            <i class="fa-regular fa-eye text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="d-grid"><button type="submit" class="btn btn-primary btn-block fw-semibold py-3 rounded-3"><i class="fa-solid fa-user-plus me-2"></i>Buat Akun</button></div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3 bg-light rounded-bottom-4">
                    <div class="small"><a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Sudah punya akun? Masuk</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, iconSpan) {
        const input = document.getElementById(inputId);
        const icon = iconSpan.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection
