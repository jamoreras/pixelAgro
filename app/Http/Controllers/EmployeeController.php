<?php

namespace App\Http\Controllers;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        return view('/roles/employee.dashboard');
    }
}
