@extends('layouts.front_layout.front_layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <section class="flat-row main-shop shop-detail">
                <div class="container">
                    @foreach ($viewProducts as $product)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="wrap-flexslider">
                                <div class="inner">
                                    <div class="flexslider style-1 has-relative">
                                        <ul class="slides">
                                            <li data-thumb="images/product_images/small/ .$product['main_image']">
                                                <img src="{{ asset('images/product_images/small/' .$product['main_image']) }}" alt="Image">
                                                <div class="flat-icon style-1">
                                                    <a href="images/product_images/small/ .$product['main_image']" class="zoom-popup"><span class="fa fa-search-plus"></span></a>
                                                </div>
                                            </li>
                                            <li data-thumb="images/shop/sh-detail/thumb-detail-02.jpg">
                                                <img src="images/shop/sh-detail/detail-01.jpg" alt="Image">
                                                <div class="flat-icon style-1">
                                                    <a href="images/shop/sh-detail/detail-01.jpg" class="zoom-popup"><span class="fa fa-search-plus"></span></a>
                                                </div>
                                            </li>
                                            <li data-thumb="images/shop/sh-detail/thumb-detail-03.jpg">
                                                <img src="images/shop/sh-detail/detail-01.jpg" alt="Image">
                                                <div class="flat-icon style-1">
                                                    <a href="images/shop/sh-detail/detail-01.jpg" class="zoom-popup"><span class="fa fa-search-plus"></span></a>
                                                </div>
                                            </li>
                                            <li data-thumb="images/shop/sh-detail/thumb-detail-04.jpg">
                                                <img src="images/shop/sh-detail/detail-01.jpg" alt="Image">
                                                <div class="flat-icon style-1">
                                                    <a href="images/shop/sh-detail/detail-01.jpg" class="zoom-popup"><span class="fa fa-search-plus"></span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="product-detail">
                                <div class="inner">
                                    <div class="content-detail">
                                        <h2 class="product-title">{{ $product['product_name'] }}</h2>
                                        <div class="flat-star style-1">
                                            <p></p>
                                        </div>
                                        <p> {{ $product['description'] }}</p>
                                        <div class="price">
                                            {{-- <del><span class="regular">$90.00</span></del> --}}
                                            <ins><span class="amount">Rp. {{ $product['product_price'] }}</span></ins>
                                        </div>
                                        <div class="size">
                                            <span>Size:</span>
                                            <ul>
                                                <li><a href="#">L</a></li>
                                                <li><a href="#">M</a></li>
                                                <li><a href="#">S</a></li>
                                                <li><a href="#">XL</a></li>
                                                <li><a href="#">XXL</a></li>
                                                <li><a href="#">Over Size</a></li>
                                            </ul>
                                        </div>
                                        <div class="product-color">
                                            <span>Colors:</span>
                                            <ul class="flat-color-list">
                                                <li><a href="#" class="yellow"></a></li>
                                                <li><a href="#" class="pink"> </a></li>
                                                <li><a href="#" class="red"></a></li>
                                                <li><a href="#" class="black"></a></li>
                                                <li><a href="#" class="blue"></a></li>
                                                <li><a href="#" class="khaki"></a></li>
                                            </ul>
                                        </div>
                                        <ul class="product-infor style-1">
                                            <li><span>100% cotton</span></li>
                                            <li><span>6 months warranty</span></li>
                                            <li><span>High Quality</span></li>
                                        </ul>
                                        <div class="product-quantity">
                                            <div class="quantity">
                                                <input type="text" value="1" name="quantity-number" class="quantity-number">
                                                <span class="inc quantity-button">+</span>
                                                <span class="dec quantity-button">-</span>
                                            </div>
                                            <div class="add-to-cart">
                                                <a href="#">ADD TO CART</a>
                                            </div>
                                            <div class="box-like">
                                                <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-categories">
                                            <span>Categories: </span><a href="#">Men,</a> <a href="#">Shoes</a>
                                        </div>
                                        <div class="product-tags">
                                            <span>Tags: </span><a href="#">Dress,</a> <a href="#">Fashion,</a> <a href="#">Furniture,</a> <a href="#">Lookbok</a>
                                        </div>
                                        <ul class="flat-socials">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- /.product-detail -->
                        </div>
                    </div><!-- /.row -->
                    @endforeach
                </div><!-- /.container -->
            </section>
        </div>
    </div>
</div>

@endsection
