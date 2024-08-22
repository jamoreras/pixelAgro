<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SuperadminController extends Controller
{
    
    public function dashboard()
    {
        $user=Auth::user();
        if($user && $user->role == 'superadmin'){
            return view('roles.superadmin.dashboard');
        }
        return redirect('login');

    }
    
    public function index()
    {
        return view('roles.superadmin.dashboard');
    }
    public function register()
    {
        $users  = User::all();
        return view('roles.superadmin.index', compact('users'));
    }
    
    
}
