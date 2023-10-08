<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;
    protected $table = "DonHang";
    protected $primaryKey = 'id_don_hang';

    public function nguoidung(){
        return $this->belongsTo('App\Models\NguoiDung','id_nguoi_dung','id_nguoi_dung');
    }
    
}
