<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function login(){
    return view('dangnhap');
   }
   public function loginPost(Request $request){
    $request->validate([
        'email'=> 'required',
        'password'=> 'required'
    ]);

    $email = $request->email;
    $password = $request->password;

    if (Auth::attempt(['email' => $email, 'password' => $password])){
        $user = Auth()->user();
        $userInfo = [
            'ho' => $user->ho,
            'ten' => $user->ten,
            'email' => $user->email,
            'dia_chi' => $user->dia_chi,
            'so_dien_thoai' => $user->so_dien_thoai,
            'hinh' => $user->hinh,
            'vai_tro' => $user->vai_tro,
        ];
        session(['userInfo' => $userInfo]);
        // nếu vai trò là 0 thì là user
        //nếu vai trò lớn hơn 1 thì là admin
        if($user->vai_tro > 0){
            return redirect()->intended(route('admin-danhsachsanpham'));
        }else{
            return redirect()->intended(route('home'));
        }
    }

    return redirect(route('login'))->with('error','Email hoặc password sai');  
}

public function register(){
    return view('dangky');
   }

   public function registerPost(Request $request){
    $request->validate([
        'hoten' =>'required',
        'diachi' => 'required',
        'sdt'=> 'required',
        'email'=> 'required',
        'password'=> 'required'
    ]);
    $data['ten']= $request->hoten; 
    $data['dia_chi']= $request->diachi; 
    $data['so_dien_thoai']= $request->sdt; 
    $data['email']= $request->email; 
    $data['password']= Hash::make($request->password); 
    $user = \DB::table('nguoidung')->insert($data);
    if(!$user){
    return redirect(route('register'))->with('error','Email hoặc password sai'); 
}
return redirect(route('login'))->with('success','Đăng ký thành công'); 

}

public function logout()
{
    Auth::logout(); // Đăng xuất người dùng
    session()->forget('userInfo'); // Xóa thông tin người dùng khỏi session
    return redirect('/'); // Chuyển hướng đến trang chính hoặc trang đăng nhập
}
}