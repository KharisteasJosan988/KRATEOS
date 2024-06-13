<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\TransaksiController;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

Route::get('/', [AuthController::class, 'formLogin'])->name('auth.index');
Route::post('/verify', [AuthController::class, 'verifyLogin'])->name('auth.verify');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin_dashboard'])->name('admin.dashboard');
});

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/user/dashboard', [DashboardController::class, 'user_dashboard'])->name('user.dashboard');
});


// Rute untuk memproses pendaftaran
Route::get('/register', [DaftarController::class, 'formDaftar'])->name('daftar');
Route::post('/register', [DaftarController::class, 'daftar']);
Route::get('/activate/{token}', [DaftarController::class, 'activate'])->name('activate');

//rute lupa password
Route::get('/forgot-password', [ForgotPasswordController::class, 'formLupaPassword'])->name('lupa.form');
Route::post('/forgot-password', [ForgotPasswordController::class, 'resetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');


Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/menu/form-tambah', [MenuController::class, 'formTambah'])->name('menu.formTambah');
    Route::post('/menu/tambah', [MenuController::class, 'prosesTambah'])->name('menu.prosesTambah');
    Route::get('/menu/{id}/ubah', [MenuController::class, 'formUbah'])->name('menu.formUbah');
    Route::post('/menu/ubah/{id}', [MenuController::class, 'prosesUbah'])->name('menu.prosesUbah');
    Route::delete('/menu/hapus/{id}', [MenuController::class, 'hapus'])->name('menu.hapus');

    Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/galeri/tambah', [GalleryController::class, 'formTambahGaleri'])->name('gallery.formTambah');
    Route::post('/galeri/proses-tambah', [GalleryController::class, 'prosesTambahGaleri'])->name('gallery.prosesTambah');
    Route::get('/galeri/edit/{id}', [GalleryController::class, 'ubahGaleri'])->name('gallery.formUbah');
    Route::put('/galeri/edit/{id}', [GalleryController::class, 'prosesUbahGaleri'])->name('gallery.prosesUbah');
    Route::delete('/galeri/delete/{id}', [GalleryController::class, 'hapus'])->name('gallery.hapus');

    Route::get('/app', [PesananController::class, 'index']);
    Route::post('/app/search-barcode', [PesananController::class, 'searchMenu']);
    Route::post('/app/insert', [PesananController::class, 'insert'])->name('insert.app');

    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::get('/transaksi/{id}/pdf', [TransaksiController::class, 'printPDF']);
    Route::get('/transaksi/{id}/detail', [TransaksiController::class, 'detail'])->name('transaksi.detail');
});

// Route::get('/export/excel', [TransaksiController::class, 'excel'])->name('tch.excel');
