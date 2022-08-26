<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductAttrebuit;

class FrontendController extends Controller
{
    function Frontend(){
        return view('Frontend.main',[
            'products'=>Product::all(),
            'count'=>$count=Cart::count(),
        ]);
    }

    function SingleProduct($slug){
        $product=Product::where('slug', $slug)->first();
        // $attribute=ProductAttrebuit::where('product_id', $product->id)->get();
        // $collect=collect($attribute);
        // $groupby=$collect->groupBy('color_id');
        return view('Frontend.Product.single',[
            'products'=>$product,
            // 'groupby'=>$groupby,
            'count'=>$count=Cart::count(),
        ]);
    }

    function ShopPage(){
        return view('Frontend.Page.shop',[
            'categorys'=>Category::orderBy('category_name','asc')->get(),
            'products'=>Product::latest()->get(),
            'count'=>$count=Cart::count(),
        ]);
    }
}
