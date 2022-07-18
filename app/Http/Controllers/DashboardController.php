<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;

class DashboardController extends Controller
{
    function __construct(){
        $this->middleware('verified');
    }

    function Dashboard(){
        return view('Dashboard.dashboard');
    }
}
