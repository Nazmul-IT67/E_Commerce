<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Orter;
use App\Models\ProductAttribute;
use App\Models\Shipping;
use App\Models\State;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class CheckoutController extends Controller
{
    function __construct(){
        $this->middleware('auth');
        return redirect('checkout');

    }

    function Checkout(){
        return view('Frontend.Checkout.checkout',[
            'count'=>$count=Cart::count(),
            'countrys'=>Country::orderBy('name', 'asc')->get(),
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
            $billing->state_id=$request->state_id;
            $billing->city_id=$request->city_id ?? 1;
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
                $shipping->state_id=$request->s_state_id;
                $shipping->city_id=$request->s_city_id ?? 1;
                $shipping->address=$request->s_address;
                $shipping->zipcode=$request->s_zipcode;
                $shipping->email=$request->s_email;
                $shipping->phone=$request->s_phone;
                $shipping->note=$request->note;
                $shipping->save();
            }

            // $old_id=$request->cookie('cookie_id');
            // $carts=Cart::where('cookie_id', $old_id)->get();
            // $total=0;
            // foreach($carts as $cart){
            //     $price=ProductAttribute::where('product_id', $cart->product_id)->first('price');
            //     $order=new Order;
            //     $order->billing_id=$billing->id;
            //     $order->product_id=$cart->product_id;
            //     $order->color_id=$request->color_id;
            //     $order->size_id=$request->size_id;
            //     $order->product_price=$request->product_price;
            //     $order->product_quantity=$cart->quantity;
            //     $order->user_id=$auth;
            //     $order->save();

            //     $total +=$cart->quantity * $price;
            // }

            // $pay_status=Billing::findOrFail($billing->id);
            // $pay_status->total_amount=$total;
            // $pay_status->payment_status= 2 ;
            // $pay_status->save();
            // return "Payment Successfull";
        }
        elseif($request->payment=='paypal'){
            return'Paypal';
        }
        elseif($request->payment=='card'){
            return 'Card';
        }
        elseif($request->payment=='cash'){
            return 'Cash';
        }
        return back();

    }



    //////////////////////////////////////
    function GetState($id){
        $state = State::where('country_id', $id)->get();
        return response()->json($state);
    }
    function GetCitys($id){
        $city = City::where('state_id', $id)->get();
        return response()->json($city);
    }
    function ShipState($id){
        $state = State::where('country_id', $id)->get();
        return response()->json($state);
    }
    function GetShipCitysCitys($id){
        $city = City::where('state_id', $id)->get();
        return response()->json($city);
    }


}


