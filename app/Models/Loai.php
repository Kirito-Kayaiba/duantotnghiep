<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loai extends Model
{
    protected $primaryKey = 'id_loai';
    public $timestamps = false;

    protected $table = "Loai";
    public function sanpham()
    {
        return $this->hasMany('App\Models\SanPham', 'id_loai','id_loai');
    }
}
