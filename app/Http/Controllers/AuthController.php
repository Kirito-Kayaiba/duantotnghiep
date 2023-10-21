<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;


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
        session(['email' => $email]);
        session(['password' => $password]);
        return redirect()->intended(route('home'));
    }
    else{return redirect(route('login'))->with('error','Email hoặc password sai');}  
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

public function forgetPassword(){
return view('forget-password');
}

public function forgetPasswordPost(Request $request){
    $request->validate([
        'email'=>'required|email|exists:users',
    ]);
    $token = Str::random(64);
    \DB::table('password_resets')->insert([
        'email'->$request->email,
        'token'=>$token,
        'created_at'=>Carbon::now()
    ]);
    Mail::send('emails.forget-password',['token'=>$token],function($message)use ($request){
        $mesage->to($request->email);
        $mesage->subject("Đặt lại mật khẩu");
    });
return redirect()->to(route("forget.password"))->with("success","Chúng tôi đã gửi email để đặt lại mật khẩu");
}

function resetPassword($token){
    return view('new-password',compact('token'));
}
function resetPasswordPost(Request $request){
    $request->validate([
        'email'=>'require|email|exists:users',
        'password'=>'require|string|min:6|confirmed',
        'password_confirmation'=>'require',
    ]);
    $updatePassword = \DB::table('password_resets')->where([
        'email'=>$request->email,
        'token'=>$request->token,
    ])->first();
    if(!$updatePassword)
    return redirect()->to(route('reset.password'))->with('error',"Invalid");
 User::where('email',$request->email)->update(["password"=>Hash::make($request->password)]);
\DB::table('password_resets')->where(["email"=>$request->email])->delete();
return redirect()->to(route("login"))->with("success","Dặt lại mật khẩu thành công");
}
}