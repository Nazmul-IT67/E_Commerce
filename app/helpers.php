<?php
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

    function CartProduct(){
        $old_id=Cookie::get('cookie_id');
        return $cart=Cart::where('cookie_id', $old_id)->get();
    }
?>
