<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BinhLuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if (Auth::check()) {
            $iduser = session('iduser');
        } else {
            $iduser = 0;
        }
        $rating = $request->input('rating');


        BinhLuan::create([
            'ho_ten' => $request->name,
            'email' => $request->email,
            'noi_dung' => $request->content,
            'sao' => $rating,
            'thoi_diem' => now(), // Thêm dấu phẩy thay cho dấu chấm phẩy
            'id_san_pham' => $request->idsp, // Thêm dấu phẩy thay cho dấu chấm phẩy
            'id_nguoi_dung' => $iduser, // Thêm dấu phẩy thay cho dấu chấm phẩy
        ]);

        return back()->with('success', 'Bình luận của bạn đã được gửi.');
    }
}
