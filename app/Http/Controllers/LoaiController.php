<?php

namespace App\Http\Controllers;
use App\Models\Loai;
use Illuminate\Http\Request;

class LoaiController extends Controller
{
    public function danhSach(){
        $theloai = Loai::all();
        return view('admin.loai.danhsach',['theloai'=>$theloai]);
    }
    public function them(){
        return view('admin/loai/them');
    }
    public function them_(Request $req){
        $this->validate($req,
        [
           'ten_loai'=>'required|min:3|max:100',
           'an_hien'=>'required|in:0,1',
           'thu_tu'=>'required'
        ],
        [
           
           'ten_loai.required'=>'Bạn chưa nhập tên danh mục',
           'ten_loai.min'=>'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
           'ten_loai.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
           'an_hien.required'=>'Bạn chưa nhập ẩn hiện',
           'an_hien.in'=>'Bạn chỉ được nhập ẩn hiện 0 hoặc 1',
           'thu_tu.required'=>'Bạn chưa nhập thứ tự'


        ]);
        $theloai = new Loai;
        $theloai->ten_loai = $req->ten_loai;
        $theloai->thu_tu = $req->thu_tu;
        $theloai->an_hien = $req->an_hien;
        $theloai->save();
        return redirect('admin-themloai')->with('thongbao','Thêm thành công');
    }

    function xoa($id){
        $theloai = Loai::find($id);
        $theloai->delete();
        return redirect('admin-danhsachloai')->with('thongbao','Bạn đã xóa thành công');
    }

    function sua($id){
        $theloai = Loai::find($id);
        return view('admin/loai/sua',['theloai'=>$theloai]);
    }
    function sua_(Request $req, $id){
        $theloai = Loai::find($id);
        $this->validate($req,
        [
            'ten_loai'=>'required|min:3|max:100',
            'an_hien'=>'required|in:0,1'
         ],
         [
            
            'ten_loai.required'=>'Bạn chưa nhập tên danh mục',
            'ten_loai.min'=>'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
            'ten_loai.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
            'an_hien.required'=>'Bạn chưa nhập ẩn hiện',
            'an_hien.in'=>'Bạn chỉ được nhập ẩn hiện 0 hoặc 1',
 
         ]);

         $theloai->ten_loai = $req->ten_loai;
         $theloai->thu_tu = $req->thu_tu;
         $theloai->an_hien = $req->an_hien;
         $theloai->save();
         return redirect('admin-danhsachloai')->with('thongbao','Sửa thành công');
    }
}
