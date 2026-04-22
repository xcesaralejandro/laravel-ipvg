<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function LoginPage(){
        return view('auth.login');
    }

    public function RegisterPage(){
        return view('auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email'  => 'required',
            'password' => 'required|min:6',
            'gender' => 'required',
            'birth_date' => 'required'
        ]);
        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
        ]);
        return redirect()->route('register')->with('was_created', true);
    }
}
