<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Cart;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;

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

    function CheckoutPost(Request $request){
        $check=$request->checkbox ?? 1;
        $auth=Auth::id();
        if($request->payment=='bank'){
            $billing=new Billing;
            $billing->user_id=$auth;
            $billing->first_name=$request->name;
            $billing->company_name=$request->company_name;
            $billing->country_id=$request->country_id;
            $billing->city_id=$request->city_id;
            $billing->address=$request->address;
            $billing->zipcode=$request->zipcode;
            $billing->email=$request->email;
            $billing->phone=$request->phone;
            $billing->shipping_address=$check;
            $billing->save();

            if($check == 2){
                $shipping=new Shipping;
                $shipping->user_id=$auth;
                $shipping->biling_id=$billing->id;
                $shipping->first_name=$request->s_name;
                $shipping->company_name=$request->s_company_name;
                $shipping->country_id=$request->s_country_id;
                $shipping->city_id=$request->s_city;
                $shipping->address=$request->s_address;
                $shipping->zipcode=$request->s_zipcode;
                $shipping->email=$request->s_email;
                $shipping->phone=$request->s_phone;
                $shipping->note=$request->note;
                $shipping->save();

            }


        }elseif($request->payment=='paypal'){
            echo'Paypal';

        }elseif($request->payment=='card'){
            echo'Card';

        }elseif($request->payment=='cash'){
            echo'Cash';
        }

        else{
            return back();
        }
    }
}
