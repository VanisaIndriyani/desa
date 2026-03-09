@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="container d-flex flex-column justify-content-center" style="min-height: calc(100vh - 200px);">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4 my-5">
                <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                    <h3 class="fw-bold my-2">Login Warga</h3>
                </div>
                <div class="card-body p-4 p-md-5">
                    @if(session('error'))
                        <div class="alert alert-danger rounded-3 mb-4">
                            <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success rounded-3 mb-4">
                            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label text-muted">Alamat Email</label>
                            <input class="form-control bg-transparent" id="inputEmail" type="email" name="email" placeholder="name@example.com" required style="border-radius: 12px; border: 1px solid #dee2e6; padding: 12px 15px;" />
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label text-muted">Password</label>
                            <div class="input-group">
                                <input class="form-control bg-transparent border-end-0" id="inputPassword" type="password" name="password" placeholder="Password" required style="border-radius: 12px 0 0 12px; border: 1px solid #dee2e6; padding: 12px 15px;" />
                                <span class="input-group-text bg-transparent border-start-0" style="border-radius: 0 12px 12px 0; border: 1px solid #dee2e6; cursor: pointer;" onclick="togglePassword('inputPassword', this)">
                                    <i class="fa-regular fa-eye text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small text-decoration-none" href="#">Lupa Password?</a>
                            <button class="btn btn-primary px-4 py-2 fw-semibold rounded-3" type="submit">
                                <i class="fa-solid fa-right-to-bracket me-2"></i>Masuk
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3 bg-light rounded-bottom-4">
                    <div class="small"><a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Belum punya akun? Daftar!</a></div>
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
