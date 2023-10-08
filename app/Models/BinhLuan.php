<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    use HasFactory;
    
    protected $table = "BinhLuan";
    protected $primaryKey = 'id_binh_luan';

   

    public function sanpham(){
        return $this->belongsTo('App\Models\SanPham','id_san_pham','id_san_pham');
    }   

    public function nguoidung(){
        return $this->belongsTo('App\Models\NguoiDung','id_nguoi_dung','id_nguoi_dung');
    }   
}
