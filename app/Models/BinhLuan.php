<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    use HasFactory;

    protected $table = "binhluan";
    protected $primaryKey = 'id_binh_luan';

    protected $fillable = [
        'id_nguoi_dung',
        'id_san_pham',
        'noi_dung',
        'thoi_diem',
        'sao',
        'an_hien',
        'ho_ten',
        'email'
    ];


    public function sanpham(){
        return $this->belongsTo('App\Models\SanPham','id_san_pham','id_san_pham');
    }

    public function nguoidung(){
        return $this->belongsTo('App\Models\NguoiDung','id_nguoi_dung','id_nguoi_dung');
    }


    public function user()
{
    return $this->belongsTo(User::class, 'id_nguoi_dung'); // 'id_nguoi_dung' là khóa ngoại trong bảng BinhLuan
}


}


