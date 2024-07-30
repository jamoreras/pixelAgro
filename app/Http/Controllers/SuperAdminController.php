<?php

namespace App\Http\Controllers;

use App\Models\User;

class SuperadminController extends Controller
{
    public function dashboard()
    {
        return view('roles.superadmin.dashboard');
    }
    
    // Other methods like dashboard, etc.
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
