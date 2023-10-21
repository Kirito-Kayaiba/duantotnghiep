<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NguoiDung extends Model
{
    use HasFactory;
    protected $table = "NguoiDung";
    protected $primaryKey = 'id_nguoi_dung';
    public function donhang(){
        return $this->hasMany('App\Models\DonHang','id_nguoi_dung','id_nguoi_dung');
    }

    public function tintuc(){
        return $this->hasMany('App\Models\TinTuc','id_nguoi_dung','id_nguoi_dung');
    }


    public function binhLuans()
{
    return $this->hasMany(BinhLuan::class, 'id_nguoi_dung'); // 'id_nguoi_dung' là khóa ngoại trong bảng BinhLuan
}
}
