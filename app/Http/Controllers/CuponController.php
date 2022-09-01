<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cupon;
use Illuminate\Support\Str;

class CuponController extends Controller
{
    function Cupon(){
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','');
        return view('Backend.Cupon.cupon',[
            'last'=>$last,
            'cupons'=>Cupon::all(),
        ]);
    }

    function CuponPost(Request $request){
        $request->validate([
            'name'=>['required'],
            'code'=>['required','unique:cupons'],
            'start_date'=>['required'],
            'end_date'=>['required'],
            'discount_type'=>['required'],
            'discount_amount'=>['required'],
            'min_amount'=>['required'],
        ]);
        $cupon=new Cupon();
        $cupon->name=$request->name;
        $cupon->code=$request->code;
        $cupon->start_date=$request->start_date;
        $cupon->end_date=$request->end_date;
        $cupon->discount_type=$request->discount_type;
        $cupon->discount_amount=$request->discount_amount;
        $cupon->min_amount=$request->min_amount;
        $cupon->save();
        return back();
    }
}
