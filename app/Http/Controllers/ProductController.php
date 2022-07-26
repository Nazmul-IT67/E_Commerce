<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

class ProductController extends Controller
{
    function ProductAdd(){
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','');
        return view('Backend.Product.product-add',[
            'last'=>$last,
            'categorys'=>Category::orderBy('category_name','asc')->get(),
        ]);
    }

    function ProductList(){
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','');
        return view('Backend.Product.product-list',[
            'last'=>$last,
        ]);
    }

    // Product Subcategoey
    function SubCat($id){
        $sub_cat=SubCategory::where('category_id', $id)->get();
        return response()->json($sub_cat);
    }
}
