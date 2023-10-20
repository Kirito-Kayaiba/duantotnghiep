<?php

use App\Http\Controllers\DanhMucTinTucController;
use App\Http\Controllers\DanhSachTinTucController;
use App\Http\Controllers\LoaiController;
use App\Http\Controllers\SanPhamController;

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AuthController;


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



 Route::get('admin-danhsachmuctin', [DanhMucTinTucController::class, 'danhSach'])->name('admin-danhsachmuctin');
 Route::get('/admin-suadanhmuctin/{id}', [DanhMucTinTucController::class, 'sua']);
 Route::post('/admin-suadanhmuctin/{id}', [DanhMucTinTucController::class, 'sua_']);
 Route::get('/admin-themdanhmuctin', [DanhMucTinTucController::class, 'them']);
 Route::post('/admin-themdanhmuctin', [DanhMucTinTucController::class, 'them_']);
 Route::get('/xoadm/{id}', [DanhMucTinTucController::class, 'xoa'])->name('xoatl');


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


    // Các routes yêu cầu xác thực
    Route::get('/', [SanphamController::class, 'index'])->name('home');


Route::get('/layout',function(){
    return view('layout');
});
Route::get('/shop',[SanphamController::class, 'dt']);
Route::get('/tintuc',function(){
    return view('tintuc');
});
Route::get('/khuyenmai',function(){
    return view('khuyenmai');
});
Route::get('/lienhe',function(){
    return view('lienhe');
});
Route::get('/dangnhap',[AuthController::class,'login'])->name('login');
Route::post('/dangnhap',[AuthController::class,'loginPost'])->name('login.post');
Route::get('/dangky',[AuthController::class,'register'])->name('register');
Route::post('/dangky',[AuthController::class,'registerPost'])->name('register.post');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/chitiet',function(){
    return view('chitiet');
});
Route::get('/giohang',function(){
    return view('giohang');
});
Route::get('/thanhtoan',function(){
    return view('thanhtoan');
});


