<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Models\Product;

class CartController extends Controller
{
    function SingleCart($slug){
        $times=43200;
        $cookie_id=Str::random(10);
        Cookie::queue('cookie_id', $cookie_id, $times);

        $product_id=Product::where('slug', $slug)->first()->id;
        $cart=new Cart;
        $cart->cookie_id=$cookie_id;
        $cart->product_id=$product_id;
        $cart->save();
        return back();
    }
}
