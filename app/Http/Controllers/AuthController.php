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
    $email=$request->email;
    $password=$request->password;
    if (Auth::attempt(['email' => $email, 'password' => $password])){
        $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
        session(['iduser' => $user->id_nguoi_dung]);
        session(['ten' => $user->ten]);
        session(['email' => $user->email]);



        return redirect()->intended(route('home'));
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

function logout(){
    Session::flush();
    Auth::logout();
    return redirect(route('login'));
}
}
