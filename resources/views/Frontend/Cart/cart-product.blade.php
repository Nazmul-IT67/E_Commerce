@extends('Frontend.master')
@section('cart')
    active
@endsection
@section('content')
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('CartUpdate') }}" method="POST">
                        @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    {{-- <th class="product">Color</th>
                                    <th class="product">Size</th> --}}
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total=0;
                                @endphp
                                @foreach ($carts as $cart)
                                <input type="hidden" name="cart_id[]" value="{{ $cart->id }}">
                                    <tr>
                                        <td class="images">
                                            <img src="{{ asset('Images/' . $cart->created_at->format('Y/m/') . $cart->product_id . '/' . $cart->product->thumbnail) }}" alt="">
                                        </td>
                                        <td class="product">
                                            <a href="single-product.html">{{ $cart->product->title }}</a>
                                        </td>
                                        <td class="price{{ $cart->id }}" data-unit{{ $cart->id }}="{{ $cart->product->price }}">${{ $cart->product->price }}</td>
                                        <td class="quantity cart-plus-minus">
                                            <input type="text" class="quantity{{ $cart->id }}" name="quantity[]" value="{{ $cart->quantity }}">
                                            <div class="inc qtybutton plus{{ $cart->id }}">+</div>
                                            <div class="dec qtybutton mainus{{ $cart->id }}">-</div>
                                        </td>
                                        @php
                                            $total+= ($cart->product->price * $cart->quantity)
                                        @endphp
                                        <td >$<span class="selectAll totalprice{{ $cart->id }}">{{ $cart->product->price * $cart->quantity }}</span></td>
                                        <td class="remove"><i class="fa fa-times"></i></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button>Update Cart</button>
                                        </li>
                                        <li><a href="{{ route('ShopPage') }}">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input type="text" placeholder="Cupon Code">
                                        <button>Apply Cupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal </span><span class="sub_total">${{ $total }}</span></li>
                                        <li><span class="pull-left"> Total </span><span class="sub_total">${{ $total }}</span></li>
                                    </ul>
                                    <a href="checkout.html">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_js')
    <script>

        $(".qtybutton").on("click", function() {
            var $button = $(this);
            var oldValue = $button.parent().find("input").val();
            if ($button.text() == "+") {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            $button.parent().find("input").val(newVal);
        });


        //Cart Price
        @foreach ($carts as $cart)
        $('.plus{{ $cart->id }}').click(function(){
            let quantity=$('.quantity{{ $cart->id }}').val();
            let price=$('.price{{ $cart->id }}').attr('data-unit{{ $cart->id }}');
            $('.totalprice{{ $cart->id }}').html(quantity*price);

            let c=document.querySelectorAll('.selectAll');
            let arr=Array.from(c);
            let sum=0;
            arr.map(item=>{
                sum +=parseInt(item.innerHTML);
                $('.sub_total').html('$'+sum);
            })
        })

        $('.mainus{{ $cart->id }}').click(function(){
            let quantity=$('.quantity{{ $cart->id }}').val();
            let price=$('.price{{ $cart->id }}').attr('data-unit{{ $cart->id }}');
            $('.totalprice{{ $cart->id }}').html(quantity*price)

            // let cart_sub_total=(quantity*price);
            let c=document.querySelectorAll('.selectAll');
            let arr=Array.from(c);
            let sum=0;
            arr.map(item=>{
                sum +=parseInt(item.innerHTML);
                $('.sub_total').html('$'+sum);
            })
        })
        @endforeach
    </script>
    <script>

    </script>
@endsection

