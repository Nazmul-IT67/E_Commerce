<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\ProductAttribute;
use App\Models\Shipping;
use App\Models\State;
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
            'countrys'=>Country::orderBy('name', 'asc')->get(),
        ]);
    }

    function CheckoutPost(Request $request){
        $check=$request->checkbox ?? 1;
        $auth=Auth::id();
        if($request->payment=='bank'){
            // $billing=new Billing;
            // $billing->user_id=$auth;
            // $billing->first_name=$request->name;
            // $billing->company_name=$request->company_name;
            // $billing->country_id=$request->country_id;
            // $billing->state_id=$request->state_id;
            // $billing->city_id=$request->city_id;
            // $billing->address=$request->address;
            // $billing->zipcode=$request->zipcode;
            // $billing->email=$request->email;
            // $billing->phone=$request->phone;
            // $billing->shipping_address=$check;
            // $billing->save();

            // if($check == 2){
            //     $shipping=new Shipping;
            //     $shipping->user_id=$auth;
            //     $shipping->biling_id=$billing->id;
            //     $shipping->first_name=$request->s_name;
            //     $shipping->company_name=$request->s_company_name;
            //     $shipping->country_id=$request->s_country;
            //     $shipping->state_id=$request->s_state;
            //     $shipping->city_id=$request->s_city;
            //     $shipping->address=$request->s_address;
            //     $shipping->zipcode=$request->s_zipcode;
            //     $shipping->email=$request->s_email;
            //     $shipping->phone=$request->s_phone;
            //     $shipping->note=$request->note;
            //     $shipping->save();

            // }

            $old_id=$request->cookie('cookie_id');
            $carts=Cart::where('cookie_id', $old_id)->get();
            foreach($carts as $cart){
                echo ProductAttribute::where('product_id', $cart->product_id)->first('price');
            }
        }
        elseif($request->payment=='paypal'){
            // $billing=new Billing;
            // $billing->user_id=$auth;
            // $billing->first_name=$request->name;
            // $billing->company_name=$request->company_name;
            // $billing->country_id=$request->country_id;
            // $billing->state_id=$request->state_id;
            // $billing->city_id=$request->city_id;
            // $billing->address=$request->address;
            // $billing->zipcode=$request->zipcode;
            // $billing->email=$request->email;
            // $billing->phone=$request->phone;
            // $billing->shipping_address=$check;
            // $billing->save();

            // if($check == 2){
            //     $shipping=new Shipping;
            //     $shipping->user_id=$auth;
            //     $shipping->biling_id=$billing->id;
            //     $shipping->first_name=$request->s_name;
            //     $shipping->company_name=$request->s_company_name;
            //     $shipping->country_id=$request->s_country;
            //     $shipping->state_id=$request->s_state;
            //     $shipping->city_id=$request->s_city;
            //     $shipping->address=$request->s_address;
            //     $shipping->zipcode=$request->s_zipcode;
            //     $shipping->email=$request->s_email;
            //     $shipping->phone=$request->s_phone;
            //     $shipping->note=$request->note;
            //     $shipping->save();

            // }

        }elseif($request->payment=='card'){
            // $billing=new Billing;
            // $billing->user_id=$auth;
            // $billing->first_name=$request->name;
            // $billing->company_name=$request->company_name;
            // $billing->country_id=$request->country_id;
            // $billing->state_id=$request->state_id;
            // $billing->city_id=$request->city_id;
            // $billing->address=$request->address;
            // $billing->zipcode=$request->zipcode;
            // $billing->email=$request->email;
            // $billing->phone=$request->phone;
            // $billing->shipping_address=$check;
            // $billing->save();

            // if($check == 2){
            //     $shipping=new Shipping;
            //     $shipping->user_id=$auth;
            //     $shipping->biling_id=$billing->id;
            //     $shipping->first_name=$request->s_name;
            //     $shipping->company_name=$request->s_company_name;
            //     $shipping->country_id=$request->s_country;
            //     $shipping->state_id=$request->s_state;
            //     $shipping->city_id=$request->s_city;
            //     $shipping->address=$request->s_address;
            //     $shipping->zipcode=$request->s_zipcode;
            //     $shipping->email=$request->s_email;
            //     $shipping->phone=$request->s_phone;
            //     $shipping->note=$request->note;
            //     $shipping->save();

            // }

        }elseif($request->payment=='cash'){
            // $billing=new Billing;
            // $billing->user_id=$auth;
            // $billing->first_name=$request->name;
            // $billing->company_name=$request->company_name;
            // $billing->country_id=$request->country_id;
            // $billing->state_id=$request->state_id;
            // $billing->city_id=$request->city_id;
            // $billing->address=$request->address;
            // $billing->zipcode=$request->zipcode;
            // $billing->email=$request->email;
            // $billing->phone=$request->phone;
            // $billing->shipping_address=$check;
            // $billing->save();

            // if($check == 2){
            //     $shipping=new Shipping;
            //     $shipping->user_id=$auth;
            //     $shipping->biling_id=$billing->id;
            //     $shipping->first_name=$request->s_name;
            //     $shipping->company_name=$request->s_company_name;
            //     $shipping->country_id=$request->s_country;
            //     $shipping->state_id=$request->s_state;
            //     $shipping->city_id=$request->s_city;
            //     $shipping->address=$request->s_address;
            //     $shipping->zipcode=$request->s_zipcode;
            //     $shipping->email=$request->s_email;
            //     $shipping->phone=$request->s_phone;
            //     $shipping->note=$request->note;
            //     $shipping->save();

            // }
        }

        else{
            return back();
        }
    }





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
