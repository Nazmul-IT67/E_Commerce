<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
class FrontendController extends Controller
{
    function Frontend(){
        return view('Frontend.main',[
            'products'=>Product::all(),
        ]);
    }

    function SingleProduct($slug){
        return view('Frontend.Product.single',[
            'product'=>Product::where('slug', $slug)->first(),
        ]);
    }
}
