<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Cart;

class CheckoutController extends Controller
{
    function __construct(){
        $this->middleware('auth');
        return redirect('checkout');
    }

    function Checkout(){
        return view('Frontend.Checkout.checkout',[
            'count'=>$count=Cart::count(),
        ]);
    }
}
