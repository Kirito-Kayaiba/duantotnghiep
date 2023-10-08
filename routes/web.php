<?php


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


use App\Models\Loai;

Route::get('/thu', function () {
    $loai = Loai::find(1);

    if ($loai) {
        foreach ($loai->sanpham as $sp) {
            echo $sp->ten_san_pham . "<br>";
        }
    } else {
        echo "Không tìm thấy loại có id_loai = 1";
    }
});



