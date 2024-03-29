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
                            <li><a href="{{ route('Frontend') }}">Home</a></li>
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
                                            <img src="{{ asset('Images/' . $cart->product->created_at->format('Y/m/') . $cart->product->id . '/' . $cart->product->thumbnail) }}"
                                            alt="">
                                        </td>

                                        <td class="product">
                                            <a href="{{ route('ShopPage') }}">{{ $cart->product->title }}</a>
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
                                    <style>
                                        .cupon-wrap span {width: 150px; height: 45px; position: absolute;background: #ef4836; color: #fff; text-transform: uppercase;
                                        padding: 10px;}
                                    </style>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    @if (session('Invalid'))
                                        <div class="alert alert-danger invalid">
                                            {{ session('Invalid') }}
                                        </div>
                                    @endif
                                    <div class="cupon-wrap">
                                        <input class="cupon col-6" value="{{ $cupon ?? '' }}" name="cupon" type="text" placeholder="Cupon Code">
                                        <span id="cupon">Apply Cupon</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal </span><span class="sub_total">${{ $total }}</span></li>
                                        @isset($discount_type)
                                        <li>
                                            <span class="pull-left">Discount({{ $discount_type==1 ? '%':'$' }})</span>
                                            <span class="sub_total">({{ $discount_amount ?? '' }})</span>
                                        </li>
                                        @endisset
                                        <li>
                                            <span class="pull-left">Total</span>
                                            <span class="sub_total">
                                                @if ($discount_type==1)
                                                    @if ($min_amount<=$total)
                                                        ${{ $total - $total*($discount_amount/100) }}
                                                    @else
                                                        ${{ $total }}
                                                    @endif
                                                @else
                                                    @if ($min_amount<=$total)
                                                    ${{ $total - $discount_amount }}
                                                    @else
                                                        ${{ $total }}
                                                    @endif
                                                @endif
                                            </span>
                                        </li>
                                    </ul>
                                    <a href="{{ route('Checkout') }}">Proceed to Checkout</a>
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

            //ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{ url('ajaxcartupdate') }}",
                method:'POST',
                data:{
                    id:'{{ $cart->id }}',
                    qty:quantity,
                }
            });

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

            //ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{ url('ajaxcartupdate') }}",
                method:'POST',
                data:{
                    id:'{{ $cart->id }}',
                    qty:quantity,
                }
            });

        })
        @endforeach

        //cupon
        $('#cupon').click(function(){
            var cupon=$('.cupon').val();
            window.location.href="{{ url('cart-product') }}/"+cupon;
        })
        $('.invalid').fadeOut(5000);
    </script>
@endsection

