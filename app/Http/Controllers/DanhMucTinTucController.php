<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMucTinTuc;

class DanhMucTinTucController extends Controller
{
    //
    public function danhSach(){
        $theloai = DanhMucTinTuc::all();
        return view('admin.danhmuctin.danhsach',['theloai'=>$theloai]);
    }
    public function them(){
        return view('admin/danhmuctin/them');
    }
    public function them_(Request $req){
        $this->validate($req,
        [
           'mo_ta'=>'required|min:3|max:100'
        ],
        [
           
           'mo_ta.required'=>'Bạn chưa nhập tên danh mục',
           'mo_ta.min'=>'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
           'mo_ta.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
        ]);
        $theloai = new DanhMucTinTuc;
        $theloai->ten_danh_muc = $req->ten_danh_muc;
        $theloai->mo_ta = $req->mo_ta;
        $theloai->save();
        return redirect('admin-themdanhmuctin')->with('thongbao','Thêm thành công');
    }

    function xoa($id){
        $theloai = DanhMucTinTuc::find($id);
        $theloai->delete();
        return redirect('admin-danhsachmuctin')->with('thongbao','Bạn đã xóa thành công');
    }

    function sua($id){
        $theloai = DanhMucTinTuc::find($id);
        return view('admin/danhmuctin/sua',['theloai'=>$theloai]);
    }
    function sua_(Request $req, $id){
        $theloai = DanhMucTinTuc::find($id);
        $this->validate($req,
        [
            'mo_ta'=>'min:3|max:100'
         ],
         [
            
            'mo_ta.min'=>'Mô tả phải có độ dài từ 3 đến 100 kí tự',
            'mo_ta.max'=>'Mô tả phải có độ dài từ 3 đến 100 kí tự',
         ]);

        $theloai->ten_danh_muc = $req->ten_danh_muc;
        $theloai->mo_ta = $req->mo_ta;
        $theloai->save();
        return redirect('admin-danhsachmuctin')->with('thongbao','Cập nhập thành công!');
    }
}
