<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;
use App\Models\DanhMucTinTuc;
use App\Models\NguoiDung;

class DanhSachTinTucController extends Controller
{
   public function danhSach(){
    $tintuc = TinTuc::orderBy('id_tin','DESC')->get();
    return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);

   }
   public function them(){
      $theloai = DanhMucTinTuc::all();
      $nguoidung = NguoiDung::all();
      return view('admin/tintuc/them',[ 'theloai'=>$theloai,'nguoidung'=>$nguoidung]);
  }
  public function them_(Request $req){
      $this->validate($req,
      [
        'tieu_de'=>'required|unique:TinTuc,tieu_de|min:1|max:100',
        'DanhMucTinTuc'=>'required',
         'tom_tat'=>'required',
         'noi_dung'=>'required',
         'NguoiDung'=>'required|not_in:0',
         'DanhMucTinTuc'=>'required|not_in:0',



     ],
     [
        'tieu_de.required'=>'Bạn chưa nhập tên tiêu đê',
        'tieu_de.unique'=>'Tên tin tức đã tồn tại',
        'tieu_de.min'=>'Tên tin tức phải có độ dài từ 1 đến 100 kí tự',
        'tieu_de.max'=>'Tên tin tức phải có độ dài từ 1 đến 100 kí tự',
        'DanhMucTinTuc.required'=>'Bạn chưa chọn loại tin',
        'tom_tat.required'=>'Bạn chưa nhập tóm tắt',
        'noi_dung.required'=>'Bạn chưa nhập nội dung',
        'NguoiDung.required'=>'Bạn chưa chọn người dùng',
        'NguoiDung.not_in'=>'Bạn chưa chọn người dùng',
        'DanhMucTinTuc.required'=>'Bạn chưa chọn danh mục',
        'DanhMucTinTuc.not_in'=>'Bạn chưa chọn danh mục',

        
     ]);
      $tintuc = new TinTuc;
      
      $tintuc->tieu_de = $req->tieu_de;
      $tintuc->id_danh_muc_tin = $req->DanhMucTinTuc;
      $tintuc->tom_tat = $req->tom_tat;
      $tintuc->noi_dung = $req->noi_dung;
      $tintuc->id_nguoi_dung = $req->NguoiDung;
      if($req->hasFile('Hinh')){
          $file = $req->file('Hinh');
          $duoi = $file->getClientOriginalExtension();
          if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
              return redirect('admin-themdanhsachtin')->with('loi','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
          }
          $name = $file->getClientOriginalName();
          $Hinh = random_int(1,4)."_". $name; 
          while(file_exists("images/". $Hinh)){
              $Hinh = random_int(1,4)."_". $name;
          }
          $file->move("images/",$Hinh);
          $tintuc->Hinh = $Hinh;

      }else{
          $tintuc->Hinh = "";
      }
      $tintuc->save();
      return redirect('admin-danhsachtintuc')->with('thongbao','Thêm thành công');
  }

  function xoa($id){
      $tintuc = TinTuc::find($id);
      $tintuc->delete();
      return redirect('admin-danhsachtintuc')->with('thongbao','Bạn đã xóa thành công');
  }

  function sua($id){
      $theloai = DanhMucTinTuc::all();
      $nguoidung = NguoiDung::all();
      $tintuc = TinTuc::find($id);
      return view('admin/tintuc/sua',['theloai'=>$theloai,'tintuc'=>$tintuc,'nguoidung'=>$nguoidung]);
  }
  function sua_(Request $req, $id){
      $tintuc = TinTuc::find($id);
      $this->validate($req,
      [
        'tieu_de'=>'required|unique:TinTuc,tieu_de|min:1|max:100',
        'DanhMucTinTuc'=>'required',
         'tom_tat'=>'required',
         'noi_dung'=>'required',
         'NguoiDung'=>'required|not_in:0',
         'DanhMucTinTuc'=>'required|not_in:0',



     ],
     [
        'tieu_de.required'=>'Bạn chưa nhập tên tiêu đê',
        'tieu_de.unique'=>'Tên tin tức đã tồn tại',
        'tieu_de.min'=>'Tên tin tức phải có độ dài từ 1 đến 100 kí tự',
        'tieu_de.max'=>'Tên tin tức phải có độ dài từ 1 đến 100 kí tự',
        'DanhMucTinTuc.required'=>'Bạn chưa chọn loại tin',
        'tom_tat.required'=>'Bạn chưa nhập tóm tắt',
        'noi_dung.required'=>'Bạn chưa nhập nội dung',
        'NguoiDung.required'=>'Bạn chưa chọn người dùng',
        'NguoiDung.not_in'=>'Bạn chưa chọn người dùng',
        'DanhMucTinTuc.required'=>'Bạn chưa chọn danh mục',
        'DanhMucTinTuc.not_in'=>'Bạn chưa chọn danh mục',

        
     ]);

     $tintuc->tieu_de = $req->tieu_de;
     $tintuc->id_danh_muc_tin = $req->DanhMucTinTuc;
     $tintuc->tom_tat = $req->tom_tat;
     $tintuc->noi_dung = $req->noi_dung;
     $tintuc->id_nguoi_dung = $req->NguoiDung;
      if($req->hasFile('Hinh')){
          $file = $req->file('Hinh');
          $duoi = $file->getClientOriginalExtension();
          if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
              return redirect('admin-themdanhsachtin')->with('loi','Bạn chỉ được chọn file có đuôi là jpg, png, jpeg');
          }
          $name = $file->getClientOriginalName();
          $Hinh = random_int(1,4)."_". $name; 
          while(file_exists("images/". $Hinh)){
              $Hinh = random_int(1,4)."_". $name;
          }
         
          $file->move("images/",$Hinh);
          unlink("images/".$tintuc->Hinh);
          $tintuc->Hinh = $Hinh;

      }
      $tintuc->save();
      return redirect('admin-danhsachtintuc')->with('thongbao','Cập nhập thành công!');
  }
}


