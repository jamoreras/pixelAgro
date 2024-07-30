<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
class AuthManager extends Controller
{
    function login(){
      if(Auth::check()){
          return redirect(route('home'));
      }
        return view('login');
    }
    function register(){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('register');
    }
    function loginPost(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $role = $user->role;
            if($role == 'superadmin'){
                return redirect()->intended(route('superadmin.index'))->with('role', $role);
            }
            return redirect()->intended(route('home'))->with('role', $role);
        }   
        return redirect(route('login') )->with('error', 'Invalid credentials');
    }
    function registerPost(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
     $data ['name'] = $request->name;
     $data ['email'] = $request->email;
     $data ['password'] = Hash::make($request->password);
     
    $user = User::create($data);

    if(!$user){
        return redirect(route('register'))->with('error', 'Registration failed.');
    }
    return redirect(route('login'))->with('success', 'Registration successful. Please login.');
    }
    
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }   
}
