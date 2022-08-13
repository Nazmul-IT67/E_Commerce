<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Models\Product;

class CartController extends Controller
{
    function SingleCart($slug, Request $request){
        $old_id=$request->cookie('cookie_id');
        if($old_id){
            $generate=$old_id;
        }else{
            $times=43200;
            $generate=Str::random(10);
            Cookie::queue('cookie_id', $generate, $times);
        }
        $product_id=Product::where('slug', $slug)->first()->id;
        $cart=Cart::where('product_id', $product_id)->where('cookie_id', $generate);
        if($cart->exists()){
            $cart->increment('quantity');
        }else{
            $cart=new Cart;
            $cart->cookie_id=$generate;
            $cart->product_id=$product_id;
            $cart->save();
        }
        return back();
    }

    function CartProduct(Request $request){
        $old_id=$request->cookie('cookie_id');
        $cart=Cart::where('cookie_id', $old_id)->get();
        return view('Frontend.Cart.cart-product',[
            'carts'=>$cart,
        ]);
    }

    function CartUpdate(Request $request){
        foreach($request->cart_id as $key=> $cart){
            Cart::findOrFail($cart)->update([
                'quantity'=>$request->quantity[$key],
            ]);
        }
        return back();
    }
}
