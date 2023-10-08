<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    use HasFactory;
    protected $table = "TinTuc";
    protected $primaryKey = 'id_tin';

    public function danhmuctintuc(){
        return $this->belongsTo('App\Models\DanhMucTinTuc','id_danh_muc_tin','id_danh_muc_tin');
    }
    public function nguoidung(){
        return $this->belongsTo('App\Models\NguoiDung','id_nguoi_dung','id_nguoi_dung');
    }
}

