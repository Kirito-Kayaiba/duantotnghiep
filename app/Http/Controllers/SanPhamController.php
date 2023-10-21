<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BinhLuan;
use App\Models\SanPham;

use DB;

class SanPhamController extends Controller
{
    public function index(){
        $sp= DB::table('sanpham')->limit(10)->get();
        $sp2= DB::table('sanpham')->where('id_san_pham','>=',100)->limit(20)->get();
        $sp3= DB::table('sanpham')->where('id_san_pham','>=',30)->limit(20)->get();
        $sp4= DB::table('sanpham')->where('id_san_pham','>=',130)->limit(20)->get();
        return view('home',['sp'=>$sp,'sp2'=>$sp2,'sp3'=>$sp3,'sp4'=>$sp4]);
    }
    public function dt(){
        $dt= DB::table('sanpham')->where('id_loai','1')->get();
        return view('shop',['dt'=>$dt]);
    }

    public function laptop(){
        $dt= DB::table('sanpham')->where('id_loai','2')->get();
        return view('shop',['dt'=>$dt]);
    }
    function chitietsp($id){
        $tin = DB::table('sanpham')->where('id_san_pham', $id)->first();

        $idsp = $tin->id_san_pham;
        $product = BinhLuan::where('id_san_pham', $idsp)->get();

        // Tạo một mảng để lưu trữ tất cả đánh giá
        $ratings = [];

        // Lặp qua danh sách đánh giá và lấy ra các giá trị sao
        foreach ($product as $item) {
            $ratings[] = $item->sao;
        }

        // Tính toán số sao trung bình
        if (count($ratings) > 0) {
            $totalRatings = array_sum($ratings);
            $averageRating = $totalRatings / count($ratings);
        } else {
            $averageRating = 0;
        }

        $data = ['id' => $id, 'tin' => $tin, 'averageRating' => $averageRating];
        return view('chitiet', $data);
    }

    function search(Request $request){
        $keyword = $request->input('keyword');
        $listtin = DB::table("sanpham")
        ->where('ten_san_pham','LIKE',"%$keyword%")
        ->get();
        $products = SanPham::orderBy('ngay_dang', 'desc')->limit(4)->get();
        $count = count($listtin);
        return view('shopsearch', ['listtin'=>$listtin,'keyword'=>$keyword,'count'=>$count,'product'=>$products]);

    }

}


