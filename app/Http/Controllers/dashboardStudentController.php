<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardStudentController extends Controller
{
    
    public function index()
    {
        return view('studentDashboard.index');
    }
}
