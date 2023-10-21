<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/'; // Chuyển hướng sau khi đặt lại mật khẩu thành công

    public function __construct()
    {
        $this->middleware('guest');
    }
}
