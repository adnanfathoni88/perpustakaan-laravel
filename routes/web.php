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

//dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');

//buku
Route::get('/buku', [BukuController::class, 'index'])->middleware('auth');
Route::get('/add-buku', [BukuController::class, 'create']);
Route::post('/add-buku', [BukuController::class, 'store']);
Route::get('/edit-buku/{id}', [BukuController::class, 'edit']);
Route::post('/edit-buku/{id}', [BukuController::class, 'update']);
Route::get('/hapus-buku/{id}', [BukuController::class, 'destroy']);
Route::post('/cari-buku', [BukuController::class, 'cari']);

//kategori
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/add-kategori', [KategoriController::class, 'create']);
Route::post('/add-kategori', [KategoriController::class, 'store']);
Route::get('/edit-kategori/{id}', [KategoriController::class, 'edit']);
Route::post('/edit-kategori/{id}', [KategoriController::class, 'update']);
Route::get('/hapus-kategori/{id}', [KategoriController::class, 'destroy']);
Route::post('/cari', [KategoriController::class, 'cari']);


//pdf
Route::get('/show-pdf/{id}', [BukuController::class, 'pdf']);

// image
Route::get('/img/{img}', [UploadImageController::class, 'index']);

//login
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// user
Route::get('/register', [UserController::class, 'index']);
Route::get('/add-user', [UserController::class, 'create']);
Route::post('/add-user', [UserController::class, 'store']);
Route::get('/edit-user/{id}', [UserController::class, 'edit']);
Route::post('/edit-user/{id}', [UserController::class, 'update']);
Route::get('/hapus-user/{id}', [UserController::class, 'destroy']);
