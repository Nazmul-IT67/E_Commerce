<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Color;
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
            $times=5;
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
            'count'=>$count=Cart::count(),
        ]);
    }

    // function CartUpdate(Request $request){
    //     foreach($request->cart_id as $key=> $cart){
    //         Cart::findOrFail($cart)->update([
    //             'quantity'=>$request->quantity[$key],
    //         ]);
    //     }
    //     return back();
    // }

    function AjaxCartUpdate(Request $request){
        Cart::findOrFail($request->id)->update([
            'quantity'=>$request->qty,
        ]);
    }

    function ProductCurt(Request $request){

        $old_id=$request->cookie('cookie_id');
        if($old_id){
            $generate=$old_id;
        }else{
            $times=5;
            $generate=Str::random(10);
            Cookie::queue('cookie_id', $generate, $times);
        }

        $product_id=Product::findOrfail($request->product_id)->id;
        $cart=Cart::where('product_id', $product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->where('cookie_id', $generate);

        if($cart->exists()){
            $cart->increment('quantity');
        }else{
            $cart=new Cart;
            $cart->cookie_id=$generate;
            $cart->product_id=$product_id;
            $cart->color_id=$request->color_id;
            $cart->size_id=$request->size_id;
            $cart->quantity=$request->quantity;
            $cart->save();
        }
        return back();
    }

}
