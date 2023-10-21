<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;
    protected $table = "DonHang";
    protected $primaryKey = 'id_don_hang';
    protected $fillable = [
        'id_nguoi_dung',
        'thoi_diem_mua_hang',
        'ten_nguoi_nhan',
        'so_dien_thoai',
        'dia_chi',
        'trang_thai',
        'email',
        'pttt'
    ];
    

    public function nguoidung(){
        return $this->belongsTo('App\Models\NguoiDung','id_nguoi_dung','id_nguoi_dung');
    }

}
