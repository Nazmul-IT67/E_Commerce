@extends('Frontend.master')
@section('header_css')
    <link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
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

                                <div class="col-sm-12 col-12">
                                    <p>Country</p>
                                    <select id="country_id" name="country_id">
                                        <option value="1">Select Your Country</option>
                                        @foreach ($countrys as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <p>State/Town</p>
                                    <select id="state_id" name="state_id">

                                    </select>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <p>Town/City *</p>
                                    <select id="city_id" name="city_id">

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

                                        <div class="col-sm-12 col-12">
                                            <p>Country</p>
                                            <select id="s_country_id" name="s_country">
                                                <option value="1">Select Your Country</option>
                                                @foreach ($countrys as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <p>State/Town</p>
                                            <select id="s_state_id" name="s_stste">

                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <p>Town/City *</p>
                                            <select id="s_city_id" name="s_city">

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
@section('footer_js')
    <script>
        $('#country_id').change(function() {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('api/get-state-list') }}/" + countryID,
                    success: function(res) {
                        if (res) {
                            $("#state_id").empty();
                            $("#state_id").append('<option>Select Your State</option>');
                            $.each(res, function(key, value) {
                                $("#state_id").append('<option value="' + value.id + '">' +
                                    value
                                    .name + '</option>');
                            });

                        } else {
                            $("#state_id").empty();
                        }
                    }
                });
            } else {
                $("#state_id").empty();
                $("#city_id").empty();
            }
        });

        $('#state_id').on('change', function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('api/get-city-list') }}/" + stateID,
                    success: function(res) {
                        if (res) {
                            $("#city_id").empty();
                            $("#city_id").append('<option>Select Your City</option>');
                            $.each(res, function(key, value) {
                                $("#city_id").append('<option value="' + value.id + '">' + value
                                    .name + '</option>');
                            });

                        } else {
                            $("#city_id").empty();
                        }
                    }
                });
            } else {
                $("#city_id").empty();
            }

        });

        $(document).ready(function() {
            $('#country_id, #state_id, #city_id').select2();
        });



        $('#s_country_id').change(function() {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('api/get-state-list') }}/" + countryID,
                    success: function(res) {
                        if (res) {
                            $("#s_state_id").empty();
                            $("#s_state_id").append('<option>Select Your State</option>');
                            $.each(res, function(key, value) {
                                $("#s_state_id").append('<option value="' + value.id + '">' +
                                    value
                                    .name + '</option>');
                            });

                        } else {
                            $("#s_state_id").empty();
                        }
                    }
                });
            } else {
                $("#s_state_id").empty();
                $("#s_city_id").empty();
            }
        });

        $('#s_state_id').on('change', function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('api/get-city-list') }}/" + stateID,
                    success: function(res) {
                        if (res) {
                            $("#s_city_id").empty();
                            $("#s_city_id").append('<option>Select Your City</option>');
                            $.each(res, function(key, value) {
                                $("#s_city_id").append('<option value="' + value.id + '">' +
                                    value
                                    .name + '</option>');
                            });

                        } else {
                            $("#s_city_id").empty();
                        }
                    }
                });
            } else {
                $("#s_city_id").empty();
            }

        });
    </script>
    {{-- Input Search Bar --}}
    <script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
