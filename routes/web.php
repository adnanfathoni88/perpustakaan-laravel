<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UploadImageController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
//dashboard
Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard')->middleware('auth');

//buku
Route::get('/buku', [BukuController::class, 'index'])->middleware('auth');
Route::get('/add-buku', [BukuController::class, 'create'])->middleware('auth');
Route::post('/add-buku', [BukuController::class, 'store'])->middleware('auth');
Route::get('/edit-buku/{id}', [BukuController::class, 'edit'])->middleware('auth');
Route::post('/edit-buku/{id}', [BukuController::class, 'update'])->middleware('auth');
Route::get('/hapus-buku/{id}', [BukuController::class, 'destroy'])->middleware('auth');
Route::post('/cari-buku/{id}', [BukuController::class, 'cari'])->middleware('auth');

//kategori
Route::get('/kategori', [KategoriController::class, 'index'])->middleware('auth');
Route::get('/add-kategori', [KategoriController::class, 'create'])->middleware('auth');
Route::post('/add-kategori', [KategoriController::class, 'store'])->middleware('auth');
Route::get('/edit-kategori/{id}', [KategoriController::class, 'edit'])->middleware('auth');
Route::post('/edit-kategori/{id}', [KategoriController::class, 'update'])->middleware('auth');
Route::get('/hapus-kategori/{id}', [KategoriController::class, 'destroy'])->middleware('auth');
Route::post('/cari', [KategoriController::class, 'cari'])->middleware('auth');


//pdf
Route::get('/show-pdf/{id}', [BukuController::class, 'pdf'])->middleware('auth');

// image
Route::get('/img/{img}', [UploadImageController::class, 'index'])->middleware('auth');

//login
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('auth');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

// user
Route::get('/user', [UserController::class, 'index'])->middleware('auth');
Route::get('/register', [UserController::class, 'index'])->middleware('auth');
Route::get('/add-user', [UserController::class, 'create'])->middleware('auth');
Route::post('/add-user', [UserController::class, 'store'])->middleware('auth');
Route::get('/edit-user/{id}', [UserController::class, 'edit'])->middleware('auth');
Route::post('/edit-user/{id}', [UserController::class, 'update'])->middleware('auth');
Route::get('/hapus-user/{id}', [UserController::class, 'destroy'])->middleware('auth');
