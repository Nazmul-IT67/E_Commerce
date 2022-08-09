<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
            'products'=>Product::where('slug', $slug)->first(),
        ]);
    }

    function ShopPage(){
        return view('Frontend.Page.shop',[
            'categorys'=>Category::orderBy('category_name','asc')->get(),
            'products'=>Product::latest()->get(),
        ]);
    }
}
