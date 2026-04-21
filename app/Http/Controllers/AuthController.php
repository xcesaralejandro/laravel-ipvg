<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function LoginPage(){
        return view('auth.login');
    }

    public function RegisterPage(){
        return view('auth.register');
    }
}
