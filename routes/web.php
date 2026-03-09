<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $stats = \App\Models\Statistic::where('published', true)->orderBy('urut')->get();
    return view('welcome', compact('stats'));
})->name('home');

Route::get('/profil', function () {
    $page = \App\Models\ContentPage::where('slug', 'profil')->first();
    $sejarah = \App\Models\ContentPage::where('slug', 'sejarah')->first();
    $officials = \App\Models\Official::where('published', true)->orderBy('urut')->get();
    $stats = \App\Models\Statistic::where('published', true)->orderBy('urut')->get();

    return view('profil', ['page' => $page, 'sejarah' => $sejarah, 'officials' => $officials, 'stats' => $stats]);
})->name('profil');
Route::get('/visi-misi', function () {
    $page = \App\Models\ContentPage::where('slug', 'visi-misi')->first();

    return view('visi-misi', ['page' => $page]);
})->name('visi-misi');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Warga Routes
Route::middleware(['auth'])->prefix('warga')->name('warga.')->group(function () {
    Route::get('/dashboard', [WargaController::class, 'dashboard'])->name('dashboard');
    Route::get('/surat', [WargaController::class, 'surat'])->name('surat');
    Route::post('/surat', [WargaController::class, 'suratStore'])->name('surat.post');
    Route::get('/fasilitas', [WargaController::class, 'fasilitas'])->name('fasilitas');
    Route::post('/fasilitas', [WargaController::class, 'fasilitasStore'])->name('fasilitas.post');
    Route::get('/aduan', [WargaController::class, 'aduan'])->name('aduan');
    Route::post('/aduan', [WargaController::class, 'aduanStore'])->name('aduan.post');
    Route::get('/akun', [WargaController::class, 'akun'])->name('akun');
    Route::post('/akun', [WargaController::class, 'akunUpdate'])->name('akun.post');
    Route::get('/statistik', [WargaController::class, 'statistik'])->name('statistik');
});

// Admin Routes (Placeholder for future)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/surat', [AdminController::class, 'surat'])->name('surat');
    Route::put('/surat/{letter}', [AdminController::class, 'suratUpdate'])->name('surat.update');
    Route::get('/fasilitas', [AdminController::class, 'fasilitasIndex'])->name('fasilitas');
    Route::post('/fasilitas', [AdminController::class, 'fasilitasStore'])->name('fasilitas.store');
    Route::put('/fasilitas/{facility}', [AdminController::class, 'fasilitasUpdate'])->name('fasilitas.update');
    Route::delete('/fasilitas/{facility}', [AdminController::class, 'fasilitasDestroy'])->name('fasilitas.destroy');
    Route::get('/booking-fasilitas', [AdminController::class, 'bookingFasilitas'])->name('booking');
    Route::put('/booking-fasilitas/{booking}', [AdminController::class, 'bookingFasilitasUpdate'])->name('booking.update');
    Route::get('/aduan', [AdminController::class, 'aduan'])->name('aduan');
    Route::put('/aduan/{complaint}', [AdminController::class, 'aduanUpdate'])->name('aduan.update');
    Route::get('/statistik', [AdminController::class, 'statistik'])->name('statistik');
    Route::post('/statistik', [AdminController::class, 'statistikStore'])->name('statistik.store');
    Route::put('/statistik/{stat}', [AdminController::class, 'statistikUpdate'])->name('statistik.update');
    Route::delete('/statistik/{stat}', [AdminController::class, 'statistikDestroy'])->name('statistik.destroy');
    Route::get('/konten', [AdminController::class, 'konten'])->name('konten');
    Route::post('/konten', [AdminController::class, 'kontenUpdate'])->name('konten.update');
    Route::get('/perangkat', [AdminController::class, 'perangkat'])->name('perangkat');
    Route::post('/perangkat', [AdminController::class, 'perangkatStore'])->name('perangkat.store');
    Route::put('/perangkat/{official}', [AdminController::class, 'perangkatUpdate'])->name('perangkat.update');
    Route::delete('/perangkat/{official}', [AdminController::class, 'perangkatDestroy'])->name('perangkat.destroy');
});
