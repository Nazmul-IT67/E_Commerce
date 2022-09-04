@extends('Frontend.master')
@section('content')
    <!-- header-area end -->
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                        <form action="{{ route('CheckoutPost') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <p>Full Name *</p>
                                    <input type="text" name="name">
                                </div>

                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" name="email">
                                </div>

                                <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="text" name="phone">
                                </div>

                                <div class="col-sm-6 col-12">
                                    <p>Your Address *</p>
                                    <input type="text" name="address">
                                </div>

                                <div class="col-sm-6 col-12">
                                    <p>Country</p>
                                    <select id="s_country" name="country_id">
                                        <option value="1">Select Your Country</option>
                                        <option value="2">Bangladesh</option>
                                        <option value="3">Algeria</option>
                                        <option value="4">Afghanistan</option>
                                        <option value="5">Ghana</option>
                                        <option value="6">Albania</option>
                                        <option value="7">Bahrain</option>
                                        <option value="8">Colombia</option>
                                        <option value="9">Dominican Republic</option>
                                    </select>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <p>Town/City *</p>
                                    <select id="s_country" name="city_id">
                                        <option value="1">Select Your City</option>
                                        <option value="2">Bangladesh</option>
                                        <option value="3">Algeria</option>
                                        <option value="4">Afghanistan</option>
                                        <option value="5">Ghana</option>
                                        <option value="6">Albania</option>
                                        <option value="7">Bahrain</option>
                                        <option value="8">Colombia</option>
                                        <option value="9">Dominican Republic</option>
                                    </select>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <p>Postcode/ZIP</p>
                                    <input type="text" name="zipcode">
                                </div>

                                <div class="col-sm-6 col-12">
                                    <p>Compani Name</p>
                                    <input type="text" name="company_name">
                                </div>


                                <div class="col-12">
                                    <input value="1" id="toggle2" name="checkbox" type="checkbox">
                                    <label class="fontsize" for="toggle2">Ship to a different address?</label>
                                    <div class="row" id="open2">
                                        <div class="col-12">
                                            <p>Full Name *</p>
                                            <input type="text" name="s_name">
                                        </div>

                                        <div class="col-12">
                                            <p>Email Address *</p>
                                            <input type="email" name="s_email">
                                        </div>

                                        <div class="col-12">
                                            <p>Phone No. *</p>
                                            <input type="text" name="s_phone">
                                        </div>

                                        <div class="col-12">
                                            <p>Your Address *</p>
                                            <input type="text" name="s_address">
                                        </div>

                                        <div class="col-12">
                                            <p>Country</p>
                                            <select id="s_country" name="s_country_id">
                                                <option value="1">Select Your Country</option>
                                                <option value="2">Bangladesh</option>
                                                <option value="3">Algeria</option>
                                                <option value="4">Afghanistan</option>
                                                <option value="5">Ghana</option>
                                                <option value="6">Albania</option>
                                                <option value="7">Bahrain</option>
                                                <option value="8">Colombia</option>
                                                <option value="9">Dominican Republic</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <p>Town/City *</p>
                                            <select id="s_state" name="s_city">
                                                <option value="1">Select Your Country</option>
                                                <option value="2">Bangladesh</option>
                                                <option value="3">Algeria</option>
                                                <option value="4">Afghanistan</option>
                                                <option value="5">Ghana</option>
                                                <option value="6">Albania</option>
                                                <option value="7">Bahrain</option>
                                                <option value="8">Colombia</option>
                                                <option value="9">Dominican Republic</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <p>Postcode/ZIP</p>
                                            <input type="text" name="s_zipcode">
                                        </div>

                                        <div class="col-12">
                                            <p>Compani Name</p>
                                            <input type="text" name="s_company_name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="order-area">
                            <h3>Your Order</h3>
                            <ul class="total-cost">
                                <li>Pure Nature Honey <span class="pull-right">$139.00</span></li>
                                <li>Your Product Name <span class="pull-right">$100.00</span></li>
                                <li>Pure Nature Honey <span class="pull-right">$141.00</span></li>
                                <li>Subtotal <span class="pull-right"><strong>$380.00</strong></span></li>
                                <li>Shipping <span class="pull-right">Free</span></li>
                                <li>Total<span class="pull-right">$380.00</span></li>
                            </ul>
                            <ul class="payment-method">
                                <li class="form-check">
                                    <input type="radio" name="payment" value="bank" id="payment1">
                                    <label for="payment1">Direct Bank Transfer</label>
                                </li>
                                <li class="form-check">
                                    <input type="radio" name="payment" value="paypal" id="payment2">
                                    <label for="payment2">Paypal</label>
                                </li>
                                <li class="form-check">
                                    <input type="radio" name="payment" value="card" id="payment3">
                                    <label for="payment3">Credit Card</label>
                                </li>
                                <li class="form-check">
                                    <input type="radio" name="payment" value="cash" id="payment4">
                                    <label for="payment4">Cash on Delivery</label>
                                </li>
                            </ul>
                            <button>Place Order</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
@endsection
