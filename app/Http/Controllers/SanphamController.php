<?php

namespace App\Http\Controllers;
use App\Models\SanPham;
use App\Models\Loai;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function index(){
        $sp= \DB::table('sanpham')->limit(10)->get();
        $sp2= \DB::table('sanpham')->where('id_san_pham','>=',100)->limit(20)->get();
        $sp3= \DB::table('sanpham')->where('id_san_pham','>=',30)->limit(20)->get();
        $sp4= \DB::table('sanpham')->where('id_san_pham','>=',130)->limit(20)->get();
        return view('home',['sp'=>$sp,'sp2'=>$sp2,'sp3'=>$sp3,'sp4'=>$sp4]);
    }
    public function dt(){
        $dt= \DB::table('sanpham')->where('id_loai','1')->get();
        return view('shop',['dt'=>$dt]);
    }
    public function danhSach(){
        $sanpham = SanPham::orderBy('id_san_pham','DESC')->get();
        return view('admin.sanpham.danhsach',['sanpham'=>$sanpham]);
    
       }
       public function them(){
          $theloai = Loai::all();
          return view('admin/sanpham/them',[ 'theloai'=>$theloai]);
      }
      public function them_(Request $req){
          $this->validate($req,
          [
             'ten_san_pham'=>'required|unique:SanPham,ten_san_pham|min:1|max:100',
             'Loai'=>'required',
              'gia'=>'required',
              'gia_khuyen_mai'=>'required',
              'mo_ta'=>'required',
              'an_hien'=>'required',
              'hot'=>'required'


          ],
          [
             'ten_san_pham.required'=>'Bạn chưa nhập tên sản phẩm',
             'ten_san_pham.unique'=>'Tên sản phẩm đã tồn tại',
             'ten_san_pham.min'=>'Tên sản phẩm phải có độ dài từ 1 đến 100 kí tự',
             'ten_san_pham.max'=>'Tên sản phẩm phải có độ dài từ 1 đến 100 kí tự',
             'Loai.required'=>'Bạn chưa chọn loại sản phẩm',
             'gia.required'=>'Bạn chưa nhập giá',
             'gia_khuyen_mai.required'=>'Bạn chưa nhập giá khuyến mãi',
             'mo_ta.required'=>'Bạn chưa nhập mô tả',
             'an_hien.required'=>'Bạn chưa chọn ẩn hiện',
             'hot.required'=>'Bạn chưa chọn hot or not hot'



          ]);
          $sanpham = new SanPham;
          
          $sanpham->ten_san_pham = $req->ten_san_pham;
          $sanpham->gia = $req->gia;
          $sanpham->gia_khuyen_mai = $req->gia_khuyen_mai;
          $sanpham->mo_ta = $req->mo_ta;
          $sanpham->hot = $req->hot;
          $sanpham->id_loai = $req->Loai;
          $sanpham->an_hien = $req->an_hien;

          if($req->hasFile('hinh')){
              $file = $req->file('hinh');
              $duoi = $file->getClientOriginalExtension();
              if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                  return redirect('admin-themdanhsachtin')->with('loi','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
              }
              $name = $file->getClientOriginalName();
              $hinh = random_int(1,4)."_". $name;   
              while(file_exists("images/". $hinh)){
                  $hinh = random_int(1,4)."_". $name;
              }
              $file->move("images/",$hinh);
              $sanpham->hinh = $hinh;
    
          }else{
              $sanpham->hinh = "";
          }
          $sanpham->save();
          return redirect('admin-danhsachsanpham')->with('thongbao','Thêm thành công');
      }
    
      function xoa($id){
          $sanpham = SanPham::find($id);
          $sanpham->delete();
          return redirect('admin-danhsachsanpham')->with('thongbao','Bạn đã xóa thành công');
      }
    
      function sua($id){
          $theloai = Loai::all();
          $sanpham = SanPham::find($id);
          return view('admin/sanpham/sua',['theloai'=>$theloai,'sanpham'=>$sanpham]);
      }
      function sua_(Request $req, $id){
          $sanpham = SanPham::find($id);
          $this->validate($req,
          [
            'ten_san_pham'=>'required|unique:SanPham,ten_san_pham|min:1|max:100',
            'Loai'=>'required',
             'gia'=>'required',
             'gia_khuyen_mai'=>'required',
             'mo_ta'=>'required',
             'an_hien'=>'required',
             'hot'=>'required'


         ],
         [
            'ten_san_pham.required'=>'Bạn chưa nhập tên sản phẩm',
            'ten_san_pham.unique'=>'Tên sản phẩm đã tồn tại',
            'ten_san_pham.min'=>'Tên sản phẩm phải có độ dài từ 1 đến 100 kí tự',
            'ten_san_pham.max'=>'Tên sản phẩm phải có độ dài từ 1 đến 100 kí tự',
            'Loai.required'=>'Bạn chưa chọn loại sản phẩm',
            'gia.required'=>'Bạn chưa nhập giá',
            'gia_khuyen_mai.required'=>'Bạn chưa nhập giá khuyến mãi',
            'mo_ta.required'=>'Bạn chưa nhập mô tả',
            'an_hien.required'=>'Bạn chưa chọn ẩn hiện',
            'hot.required'=>'Bạn chưa chọn hot or not hot'



         ]);
    
         $sanpham->ten_san_pham = $req->ten_san_pham;
          $sanpham->gia = $req->gia;
          $sanpham->gia_khuyen_mai = $req->gia_khuyen_mai;
          $sanpham->mo_ta = $req->mo_ta;
          $sanpham->hot = $req->hot;
          $sanpham->id_loai = $req->Loai;
          $sanpham->an_hien = $req->an_hien;

          if($req->hasFile('hinh')){
              $file = $req->file('hinh');
              $duoi = $file->getClientOriginalExtension();
              if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                  return redirect('admin-themdanhsachtin')->with('loi','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
              }
              $name = $file->getClientOriginalName();
              $hinh = random_int(1,4)."_". $name;   
              while(file_exists("images/". $hinh)){
                  $hinh = random_int(1,4)."_". $name;
              }
              $file->move("images/",$hinh);
              unlink("images/".$sanpham->hinh);
              $sanpham->hinh = $hinh;
    
          }else{
              $sanpham->hinh = "";
          }
          $sanpham->save();
          return redirect('admin-danhsachsanpham')->with('thongbao','Thêm thành công');
      }
}

