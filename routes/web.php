<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/',function (){
    return view('home');
});

Route::get('/layout',function(){
    return view('layout');
});
Route::get('/shop',function(){
    return view('shop');
});
Route::get('/tintuc',function(){
    return view('tintuc');
});
Route::get('/khuyenmai',function(){
    return view('khuyenmai');
});
Route::get('/lienhe',function(){
    return view('lienhe');
});
Route::get('/dangnhap',function(){
    return view('dangnhap');
});
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