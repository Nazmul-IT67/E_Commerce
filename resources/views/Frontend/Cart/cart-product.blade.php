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
                                        <td class="ptice">${{ $cart->product->price }}</td>
                                        <td class="quantity cart-plus-minus">
                                            <input type="text" name="quantity[]" value="{{ $cart->quantity }}">
                                        </td>
                                        @php
                                            $total+= ($cart->product->price * $cart->quantity)
                                        @endphp
                                        <td class="total">${{ $cart->product->price * $cart->quantity }}</td>
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
                                        <li><span class="pull-left">Subtotal </span>$</li>
                                        <li><span class="pull-left"> Total </span> ${{ $total }}</li>
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

