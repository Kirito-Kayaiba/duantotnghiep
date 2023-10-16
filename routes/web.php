<?php

use App\Http\Controllers\DanhMucTinTucController;
use App\Http\Controllers\DanhSachTinTucController;
use App\Http\Controllers\LoaiController;
use App\Http\Controllers\SanPhamController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});


 Route::get('admin-danhsachmuctin', [DanhMucTinTucController::class, 'danhSach']);
 Route::get('/admin-suadanhmuctin/{id}', [DanhMucTinTucController::class, 'sua']);
 Route::post('/admin-suadanhmuctin/{id}', [DanhMucTinTucController::class, 'sua_']);
 Route::get('/admin-themdanhmuctin', [DanhMucTinTucController::class, 'them']);
 Route::post('/admin-themdanhmuctin', [DanhMucTinTucController::class, 'them_']);
 Route::get('/xoadm/{id}', [DanhMucTinTucController::class, 'xoa'])->name('xoatl');


 Route::get('admin-danhsachtintuc', [DanhSachTinTucController::class, 'danhSach']);
 Route::get('/admin-suadanhsachtin/{id}', [DanhSachTinTucController::class, 'sua']);
 Route::post('/admin-suadanhsachtin/{id}', [DanhSachTinTucController::class, 'sua_']);
 Route::get('/admin-themdanhsachtin', [DanhSachTinTucController::class, 'them']);
 Route::post('/admin-themdanhsachtin', [DanhSachTinTucController::class, 'them_']);
 Route::get('/xoatt/{id}',[DanhSachTinTucController::class, 'xoa'])->name('xoatt');



 Route::get('admin-danhsachloai', [LoaiController::class, 'danhSach']);
 Route::get('/admin-sualoai/{id}', [LoaiController::class, 'sua']);
 Route::post('/admin-sualoai/{id}', [LoaiController::class, 'sua_']);
 Route::get('/admin-themloai', [LoaiController::class, 'them']);
 Route::post('/admin-themloai', [LoaiController::class, 'them_']);
 Route::get('/xoaloai/{id}',[LoaiController::class, 'xoa'])->name('xoaloai');

 Route::get('admin-danhsachsanpham', [SanPhamController::class, 'danhSach']);
 Route::get('/admin-suasanpham/{id}', [SanPhamController::class, 'sua']);
 Route::post('/admin-suasanpham/{id}', [SanPhamController::class, 'sua_']);
 Route::get('/admin-themsanpham', [SanPhamController::class, 'them']);
 Route::post('/admin-themsanpham', [SanPhamController::class, 'them_']);
 Route::get('/xoasanpham/{id}',[SanPhamController::class, 'xoa'])->name('xoasanpham');