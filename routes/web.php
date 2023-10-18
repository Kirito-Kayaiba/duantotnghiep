<?php

use App\Http\Controllers\DanhMucTinTucController;
use App\Http\Controllers\DanhSachTinTucController;
use App\Http\Controllers\LoaiController;
use App\Http\Controllers\SanPhamController;

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\SanphamController;
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
=======


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
// route admin
Route::group(['prefix'=>'admin'],function(){
    Route::get('custommer',function(){
        return view('admin/custommer');
    });  
    Route::get('login',function(){
        return view('admin/login');
    });  
    Route::get('forgot',function(){
        return view('admin/forgot');
    });  
    Route::get('trangchu',function(){
        return view('admin/home');
    });  
    Route::get('bangkeluong',function(){
        return view('admin/bangkeluong');
    });  
    Route::get('bcdoanhthu',function(){
        return view('admin/bcdoanhthu');
    });  
    Route::get('create-bangkeluong',function(){
        return view('admin/create-bangkeluong');
    });  
    Route::get('create-qldonhang',function(){
        return view('admin/create-qldonhang');
    });  
    Route::get('create-qlnhanvien',function(){
        return view('admin/create-qlnhanvien');
    });  
    Route::get('create-qlnoibo',function(){
        return view('admin/create-qlnoibo');
    });  
    Route::get('create-qlsanpham',function(){
        return view('admin/create-qlsanpham');
    });  
    Route::get('lichcongtac',function(){
        return view('admin/lichcongtac');
    });  
    Route::get('qldonhang',function(){
        return view('admin/qldonhang');
    });  
    Route::get('qlnhanvien',function(){
        return view('admin/qlnhanvien');
    });  
    Route::get('qlnoibo',function(){
        return view('admin/qlnoibo');
    });  
    Route::get('qlsanpham',function(){
        return view('admin/qlsanpham');
    });  
    Route::get('posbanhang',function(){
        return view('admin/posbanhang');
    });  
});

