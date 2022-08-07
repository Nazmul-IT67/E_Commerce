<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function Frontend(){
        return view('Frontend.main');
    }
}
