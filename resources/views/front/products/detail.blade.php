
@extends('layouts.front_layout.front_layout')

@section('title', $productDetails['product_name'])


@section('content')
<?php
    use App\Models\Product;
?>
<div class="mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Details</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/' . $productDetails['category']['url']) }}">{{ $productDetails['category']['category_name'] }}</a></li>
          <li class="breadcrumb-item active" aria-current="page"> {{ $productDetails['product_name'] }} </li>
        </ol>
      </nav>
</div>
<section class="flat-row main-shop shop-detail" style="margin-top: -500px">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="wrap-flexslider">
                    <div class="inner">
                        <div class="flexslider style-1 has-relative">
                            <ul class="slides">
                                <li data-thumb="{{asset('images/product_images/small/'. $productDetails['main_image'])}}">
                                    @if (!empty($productDetails['main_image']))
                                        <img src="{{asset('images/product_images/large/'. $productDetails['main_image'])}}" alt="image"  style="height: 460px">
                                    @else
                                        <img src="{{asset('images/product_images/no-image.png')}}" style="height: 460px"/>
                                    @endif
                                    <div class="flat-icon style-1">
                                        <a href="{{asset('images/product_images/large/'. $productDetails['main_image'])}}" class="zoom-popup"><span><i class="fas fa-search-plus"></i></span></a>
                                    </div>
                                </li>
                                @foreach ($productDetails['images'] as $image)
                                @if ($image['status'] == 1)
                                <li data-thumb="{{asset('images/product_images/small/'. $image['image'])}}">
                                    @if (!empty($image['image']))
                                        <img src="{{asset('images/product_images/large/'. $image['image'])}}" alt="image"  style="height: 460px">
                                    @else
                                        <img src="{{asset('images/product_images/no-image.png')}}" style="height: 460px"/>
                                    @endif
                                    <div class="flat-icon style-1">
                                        <a href="{{asset('images/product_images/large/'. $image['image'])}}" class="zoom-popup"><span><i class="fas fa-search-plus"></i></span></a>
                                    </div>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="product-detail">
                    <div class="inner">
                        @if (Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissable fade show" style="margin-top: 10px;">
                            {{Session::get('error_message')}}
                            <button type="buttob" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif
                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissable fade show" style="margin-top: 10px;">
                            {{Session::get('success_message')}}
                            <button type="buttob" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif
                        <div class="content-detail">
                            <h2 class="product-title">{{ $productDetails['product_name'] }}</h2>
                            <span>{{ $productDetails['brand']['name'] }}</span> &nbsp;&raquo;&raquo;&nbsp; <span>{{ $productDetails['product_code'] }}</span>
                            <div class="flat-star style-1">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <i class="fa fa-star-half-o"></i>
                                <span>(1)</span>
                            </div>
                            <form action="{{ url('add-to-cart') }}" method="post" >
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                                <div class="price">
                                    <small>{{ $total_stock }} items in stock</small> <br>
                                    @if (!empty($productDetails['product_discount']))
                                        <small class="text-danger font-weight-bold">Discount : {{ $productDetails['product_discount'] }}%</small>
                                    @else
                                        @if (!empty($productDetails['category']['category_discount']))
                                        <small class="text-danger font-weight-bold">Discount : {{ $productDetails['category']['category_discount'] }}%</small>
                                        @else
                                        <small class="text-danger font-weight-bold">Normal Price</small>
                                        @endif
                                    @endif
                                    <?php $discounted_price = Product::getDiscountedPrice($productDetails['id']) ?>
                                    @if ($discounted_price > 0)
                                        <span class="amount"><h3 class="getAttrPrice"><del>Rp. {{ number_format($productDetails['product_price'])}}</del> Rp. {{ number_format($discounted_price)}}</h3> </span>
                                    @else
                                    <span class="amount"><h3 class="getAttrPrice">Rp. {{ number_format($productDetails['product_price'])}}</h3> </span>
                                    @endif
                                </div>
                                <div class="size">
                                    <select name="size" id="getPrice" product-id="{{ $productDetails['id'] }}" required>
                                        <option value="">Select Size</option>
                                        @foreach ($productDetails['attributes'] as $attr)
                                        <option value="{{ $attr['size'] }}">{{ $attr['size'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="product-color">
                                    <span>Colors:</span>
                                    <ul class="flat-color-list">
                                        <li>
                                           @if ($productDetails['product_color'] !== "yellow" && $productDetails['product_color'] !== "pink"
                                                && $productDetails['product_color'] !== "red" && $productDetails['product_color'] !== "black"
                                                && $productDetails['product_color'] !== "blue" && $productDetails['product_color'] !== "khaki" )
                                                <a href="#">{{ $productDetails['product_color'] }}</a>
                                           @else
                                                <a href="#" class="{{ $productDetails['product_color']}}"></a>
                                           @endif
                                        </li>
                                    </ul>
                                </div>
                                <ul class="product-infor style-1">
                                    <li style="list-style: none">
                                        <span>Washcare</span>
                                        <span>:&nbsp;
                                        @if (!empty($productDetails['wash_care']))
                                            {{ $productDetails['wash_care'] }}
                                        @else
                                            No washing care
                                        @endif
                                        </span>
                                    </li>
                                </ul>
                                <div class="product-quantity">
                                    <div class="quantity">
                                        <input type="number" value="1" name="quantity" class="quantity-number" required=""  style="width: 80px">
                                    </div>
                                    <div class="add-to-cart">
                                        <button type="submit">ADD TO CART</button>
                                    </div>
                                    <div class="box-like">
                                        <a href="#" class="like"><i class="fas fa-heart"></i></a>
                                    </div>
                                </div>
                            </form>
                            <div class="product-categories">
                                <span>Categories: </span><a href="#">{{ $productDetails['section']['name'] }}</a>, &nbsp;<a href="#" name="category_id">{{ $productDetails['category']['category_name'] }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="flat-row shop-detail-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="flat-tabs style-1 has-border">
                    <div class="inner">
                        <ul class="menu-tab">
                            <li>Additional information</li>
                            <li>Description</li>
                        </ul>
                        <div class="content-tab">

                            <div class="content-inner">
                                <div class="inner max-width-40">
                                    <table>
                                        <tr>
                                            <td>Weight</td>
                                            <td>:&nbsp;{{ $productDetails['product_weight'] }} gr</td>
                                        </tr>
                                        <tr>
                                            <td>Dimensions</td>
                                            <td>:&nbsp;
                                                @if (isset($productDetails['dimension']) && !empty($productDetails['dimension']))
                                                    {{ $productDetails['dimension'] }}
                                                @else
                                                    No Dimension
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            @if (!empty($productDetails['fabric']))
                                            <td>Fabric</td>
                                            <td>:&nbsp;{{ $productDetails['fabric'] }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if (!empty($productDetails['sleeve']))
                                            <td>Sleeve</td>
                                            <td>:&nbsp;{{ $productDetails['sleeve'] }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if (!empty($productDetails['pattren']))
                                            <td>Pattern</td>
                                            <td>:&nbsp;{{ $productDetails['pattren'] }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if (!empty($productDetails['fit']))
                                            <td>Fit</td>
                                            <td>:&nbsp;{{ $productDetails['fit'] }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if (!empty($productDetails['occassion']))
                                            <td>Occasion</td>
                                            <td>:&nbsp;{{ $productDetails['occassion'] }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Size</td>
                                            <td>One Size, XL, L, M, S</td>
                                        </tr>
                                    </table>
                                </div>
                            </div><!-- /.content-inner -->
                            <div class="content-inner">
                                <div class="inner max-width-83 padding-top-33">
                                    <ol class="review-list">
                                        <li class="review">
                                            <div class="text-wrap">
                                                <div class="review-text">
                                                    @if (isset( $productDetails['description']) && !empty( $productDetails['description']))
                                                    <p> {{ $productDetails['description'] }}</p>
                                                    @else
                                                    <p>No description for this item</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    </ol><!-- /.review-list -->
                                </div>
                            </div><!-- /.content-inner -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- reltaed product --}}
<section class="flat-row shop-related">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-section margin-bottom-55">
                    <h2 class="title">Related Products</h2>
                </div>
                <div class="product-content product-fourcolumn clearfix">
                    <ul class="product style2">
                        @foreach ($relatedProducts as $related)
                        <li class="product-item">
                            <div class="product-thumb clearfix">
                                <a href="{{ url('product/' . $related['id']) }}">
                                    @if (isset($related['main_image']))
                                        <?php $related_image_path = 'images/product_images/medium/' .$related['main_image']; ?>
                                    @else
                                        <?php $related_image_path = " "; ?>
                                    @endif
                                    <?php $related_image_path = 'images/product_images/medium/' .$related['main_image']; ?>
                                    @if (!empty($related['main_image']) && file_exists($related_image_path))
                                            <img src="{{ asset($related_image_path) }}" alt="image" style="width: 150px; height: 150px;">
                                    @else
                                            <img src="{{ asset('images/product_images/no-image.png') }}" alt="image" style="width: 150px; height: 150px;">
                                    @endif
                                </a>
                            </div>
                            <div class="product-info clearfix mt-2">
                                <span class="product-title">{{ $related['product_name'] }}</span>
                                <div class="price">
                                    <ins>
                                        <span class="amount">Rp. {{ number_format($related['product_price']) }}</span>
                                    </ins>
                                </div>
                                <ul class="flat-color-list">
                                    <li>
                                        @if ($related['product_color'] !== "yellow" && $related['product_color'] !== "pink"
                                        && $related['product_color'] !== "red" && $related['product_color'] !== "black"
                                        && $related['product_color'] !== "blue" && $related['product_color'] !== "khaki" )
                                                <a href="#">{{ $related['product_color'] }}</a>
                                        @else
                                                <a href="#" class="{{ $related['product_color']}}"></a>
                                        @endif
                                    </li>
                                </ul>
                                <p>{{ $related['brand']['name']}}</p>
                            </div>
                            <div class="add-to-cart text-center">
                                <a href="{{ url('product/' . $related['id']) }}">VIEW</a>
                            </div>
                            <a href="#" class="like"><i class="fas fa-heart"></i></a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
