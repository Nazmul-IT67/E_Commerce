@extends('Frontend.master')
@section('shop')
    active
@endsection
@section('content')
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shop Page</h2>
                        <ul>
                            <li><a href="{{ route('Frontend') }}">Home</a></li>
                            <li><span>Shop</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured-product-area start -->
    <div class="product-area pt-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="product-menu">
                        <ul class="nav justify-content-center">
                            <li>
                                <a class="active" data-toggle="tab" href="#all">All product</a>
                            </li>
                            @foreach ($categorys as $category)
                                <li>
                                    <a data-toggle="tab" href="#chair{{ $category->id }}">{{ $category->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <ul class="row">
                        @foreach ($products as $product)
                            <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                <div class="product-wrap">
                                    <div class="product-img">
                                        <span>Sale</span>
                                        <img src="{{ asset('Images/' . $product->created_at->format('Y/m/') . $product->id . '/' . $product->thumbnail) }}"
                                            style="height: 240px" alt="">
                                        <div class="product-icon flex-style">
                                            <ul>
                                                <li><a data-toggle="modal"
                                                        data-target="#exampleModalCenter{{ $product->id }}"
                                                        href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="{{ route('SingleCart', $product->slug) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{ route('SingleProduct', $product->slug) }}">{{ $product->title }}</a>
                                        </h3>
                                        <p class="pull-left">${{ $product->price }}</p>
                                        <ul class="pull-right d-flex">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-half-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- Modal area start -->
                            <div class="modal fade" id="exampleModalCenter{{ $product->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="modal-body d-flex">
                                            <div class="product-single-img w-50">
                                                <img src="{{ asset('Images/' . $product->created_at->format('Y/m/') . $product->id . '/' . $product->thumbnail) }}"
                                                alt="">
                                            </div>
                                            <div class="product-single-content w-50">
                                                <h3>{{ $product->title }}</h3>
                                                <div class="rating-wrap fix">
                                                    <span class="pull-left">${{ $product->price }}</span>
                                                    <ul class="rating pull-right">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li>(05 Customar Review)</li>
                                                    </ul>
                                                </div>
                                                <p>{{ $product->description }}</p>
                                                <ul class="input-style">
                                                    <li class="quantity cart-plus-minus">
                                                        <input type="text" value="1" />
                                                    </li>
                                                    <li><a href="{{ route('SingleCart', $product->slug) }}">Add to Cart</a></li>
                                                </ul>
                                                <ul class="cetagory">
                                                    <li>Category: </li>
                                                    <li><a href="#">{{ $product->category->category_name }}</a>
                                                    </li>
                                                </ul>
                                                <ul class="socil-icon">
                                                    <li>Share :</li>
                                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal area end -->
                        @endforeach
                    </ul>
                </div>

                @foreach ($categorys as $category)
                    <div class="tab-pane" id="chair{{ $category->id }}">
                        <ul class="row">
                            @foreach ($category->product as $item)
                                <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <div class="product-wrap">
                                        <div class="product-img">
                                            <span>Sale</span>
                                            <img src="{{ asset('Images/' . $item->created_at->format('Y/m/') . $item->id . '/' . $item->thumbnail) }}"
                                                style="height: 240px" alt="">
                                            <div class="product-icon flex-style">
                                                <ul>
                                                    <li><a data-toggle="modal"
                                                            data-target="#exampleModalCenter{{ $item->id }}"
                                                            href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                    <li><a href="{{ route('SingleCart', $item->slug) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3><a
                                                    href="#">{{ $item->title }}
                                                </a>
                                            </h3>
                                            <p class="pull-left">${{ $item->price }}

                                            </p>
                                            <ul class="pull-right d-flex">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-half-o"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- Modal area start -->
                                    <div class="modal fade" id="exampleModalCenter{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <div class="modal-body d-flex">
                                                    <div class="product-single-img w-50">
                                                        <img src="{{ asset('Images/' . $item->created_at->format('Y/m/') . $item->id . '/' . $item->thumbnail) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="product-single-content w-50">
                                                        <h3>{{ $item->title }}</h3>
                                                        <div class="rating-wrap fix">
                                                            <span class="pull-left">${{ $item->price }}</span>
                                                            <ul class="rating pull-right">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li>(05 Customar Review)</li>
                                                            </ul>
                                                        </div>
                                                        <p>{{ $item->description }}</p>
                                                        <ul class="input-style">
                                                            <li class="quantity cart-plus-minus">
                                                                <input type="text" value="1" />
                                                            </li>
                                                            <li><a href="cart.html">Add to Cart</a></li>
                                                        </ul>
                                                        <ul class="cetagory">
                                                            <li>Category: </li>
                                                            <li><a
                                                                    href="#">{{ $item->category->category_name }}</a>
                                                            </li>
                                                        </ul>
                                                        <ul class="socil-icon">
                                                            <li>Share :</li>
                                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-google-plus"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- Modal area start -->
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
