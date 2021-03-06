@extends('layouts.front_layout.front_layout')

@section('title', $title)

@section('content')
<div class="container mb-4">
    <div class="row gutter-10">
        @foreach ($getImageSection as $imageSection)
        <div class="col-sm-6 col-md-3">
            <div class="flat-image-box style-1 data-effect div-h22 clearfix">
                <div class="item data-effect-item">
                    <div class="inner">
                        <div class="thumb">
                            <?php
                                $section_image_path = 'images/section_images/' .$imageSection['section_image'];
                            ?>
                            @if (!empty($imageSection['section_image']) && file_exists($section_image_path))
                                <img src="{{ $section_image_path }}" alt="image" class="img-fluid mb-4" style="height: 160px">
                            @else
                                <img src="{{asset('images/product_images/no-image.png')}}" alt="image">
                            @endif
                            <div class="elm-btn" style="margin-top: -10px">
                                <a href="#" class="themesflat-button bg-white width-150">{{$imageSection['name']}}</a>
                            </div>
                            <div class="overlay-effect bg-color-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<section class="flat-row row-product-new">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (count($featuredItemsChunk) > 0)
                <div class="title-section margin-bottom-52">
                    <h2 class="title">
                        Featured
                    </h2>
                    <p class="pull-right">{{$featuredItemsCount}} Featured Items</p>
                </div>
                @foreach ($featuredItemsChunk as $key =>  $featuredItem)
                @if (count($featuredItem) > 0)
                <div class="product-content product-fourcolumn clearfix @if($key==1) active @endif">
                    <ul class="product style2 clearfix">
                        @foreach ($featuredItem as $item)
                        <li class="product-item">
                            <div class="product-thumb clearfix">
                                <a href="{{ url('product/'  .$item['id']) }}" class="product-thumb">
                                    <?php
                                        $product_image_path = 'images/product_images/medium/' . $item['main_image'];
                                    ?>
                                    @if (!empty($item['main_image']) && file_exists($product_image_path))
                                        <img src="{{asset('images/product_images/medium/' . $item['main_image'])}}" alt="image" style="width: 250px; height: 250px;" class="mb-2">
                                    @else
                                        <img src="{{asset('images/product_images/no-image.png')}}" alt="image"  style="width: 250px; height: 250px;" class="mb-2">
                                    @endif
                                </a>
                                <span class="new">New</span>
                            </div>
                            <div class="product-info text-center clearfix">
                                <span class="product-title">{{$item['product_name']}}</span>
                                <div class="price">
                                    <ins>
                                        <span class="amount">Rp. {{$item['product_price']}}</span>
                                    </ins>
                                </div>
                            </div>
                            <div class="add-to-cart text-center">
                                <a href="{{ url('product/' .$item['id']) }}">VIEW</a> &nbsp;
                                <a title="add to cart" href=""  style="color: white;"><i class="fas fa-shopping-cart"></i> </a>
                            </div>
                            <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @endforeach
                @endif
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

<section class="flat-row row-animation-box bg-section row-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="flat-animation-block" >
                    <div class="title-section width-before-17 bg-before-white margin-bottom-14">
                        <div class="sup-title"><span>NEW TREND 2018</span></div>
                        <h2 class="title font-size-52 line-height-76">Women???s Collection</h2>
                        <div class="sub-title"><span>Big Sale of this Week</span></div>
                    </div>
                    <div class="elm-btn text-center">
                        <a href="#" class="themesflat-button bg-accent has-padding-36">Shop Now</a>
                    </div>
                </div><!-- /.flat-animation-block -->
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

<section class="flat-row row-product-project style-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-section margin-bottom-41">
                    <h2 class="title">Best Sale</h2>
                </div>
                <ul class="flat-filter style-1 text-center max-width-682 clearfix">
                    <li class="active"><a href="#" data-filter="*">All Product</a></li>
                    <li><a href="#" data-filter=".kid">For Kid???s</a></li>
                    <li><a href="#" data-filter=".man">For Man???s</a></li>
                    <li><a href="#" data-filter=".woman">For Woman???s</a></li>
                    <li><a href="#" data-filter=".accessories">Accessories</a></li>
                </ul>
                <div class="divider h54"></div>
                <div class="product-content product-fourcolumn clearfix">
                    <ul class="product style2 isotope-product clearfix">
                        @foreach ($bestSale as $best)
                        <li class="product-item kid woman">
                            <div class="product-thumb clearfix">
                                <a href="{{ url('product/' . $best['id']) }}">
                                    @if (isset($best['main_image']))
                                    <?php $product_image_path = 'images/product_images/large/' .$best['main_image']; ?>
                                     @else
                                    <?php $best_image_path = '' ?>
                                    @endif
                                    <?php
                                            $product_image_path = 'images/product_images/large/' .$best['main_image'];
                                    ?>
                                    @if (!empty($best['main_image']) && file_exists($product_image_path))
                                        <img src="{{asset($product_image_path)}}" alt="image" style="width: 180px; height: 180px" >
                                    @else
                                        <img src="{{asset('images/category_images/no-image.png')}}" class=""
                                        style="width: 180px; height: 180px"/>
                                    @endif
                                </a>
                            </div>
                            <div class="product-info clearfix">
                                <span class="product-title">{{ $best['product_name'] }}</span>
                                <div class="price">
                                    <ins>
                                        <span class="amount"> <small>Rp. {{ number_format($best['product_price']) }}</small> </span>
                                    </ins>
                                </div>
                                <ul class="flat-color-list width-14">
                                    <li>
                                        {{ $best["product_color"] }}
                                    </li>
                                </ul>
                            </div>
                            <div class="add-to-cart text-center">
                                <a href="{{ url('product/' .$best['id']) }}">VIEW</i></a>
                            </div>
                            <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                        </li>
                        @endforeach
                        {{-- <li class="product-item man accessories">
                            <div class="product-thumb clearfix">
                                <a href="#">
                                    <img src="{{asset('images/front_images/images/shop/sh-4/2.jpg')}}" alt="image">
                                </a>
                                <span class="new">New</span>
                            </div>
                            <div class="product-info clearfix">
                                <span class="product-title">Cotton White Underweaer Block Out Edition</span>
                                <div class="price">
                                    <ins>
                                        <span class="amount">$100.00</span>
                                    </ins>
                                </div>
                            </div>
                            <div class="add-to-cart text-center">
                                <a href="#">ADD TO CART</a>
                            </div>
                            <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                        </li>
                        <li class="product-item kid woman">
                            <div class="product-thumb clearfix">
                                <a href="#" class="product-thumb">
                                    <img src="{{asset('images/front_images/images/shop/sh-4/3.jpg')}}" alt="image">
                                </a>
                            </div>
                            <div class="product-info clearfix">
                                <span class="product-title">Cotton White Underweaer Block Out Edition</span>
                                <div class="price">
                                    <ins>
                                        <span class="amount">$100.00</span>
                                    </ins>
                                </div>
                            </div>
                            <div class="add-to-cart text-center">
                                <a href="#">ADD TO CART</a>
                            </div>
                            <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                        </li>
                        <li class="product-item man accessories">
                            <div class="product-thumb clearfix">
                                <a href="#" class="product-thumb">
                                    <img src="{{asset('images/front_images/images/shop/sh-4/4.jpg')}}" alt="image">
                                </a>
                                <span class="new sale">Sale</span>
                            </div>
                            <div class="product-info clearfix">
                                <span class="product-title">Cotton White Underweaer Block Out Edition</span>
                                <div class="price">
                                    <del>
                                        <span class="regular">$120.00</span>
                                    </del>
                                    <ins>
                                        <span class="amount">$100.00</span>
                                    </ins>
                                </div>
                                <ul class="flat-color-list width-14">
                                    <li>
                                        <a href="#" class="red"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="blue"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="black"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="add-to-cart text-center">
                                <a href="#">ADD TO CART</a>
                            </div>
                            <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                        </li>
                        <li class="product-item kid woman">
                            <div class="product-thumb clearfix">
                                <a href="#" class="product-thumb">
                                    <img src="{{asset('images/front_images/images/shop/sh-4/5.jpg')}}" alt="image">
                                </a>
                                <span class="new">New</span>
                            </div>
                            <div class="product-info clearfix">
                                <span class="product-title">Cotton White Underweaer Block Out Edition</span>
                                <div class="price">
                                    <ins>
                                        <span class="amount">$100.00</span>
                                    </ins>
                                </div>
                            </div>
                            <div class="add-to-cart text-center">
                                <a href="#">ADD TO CART</a>
                            </div>
                            <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                        </li>
                        <li class="product-item man accessories">
                            <div class="product-thumb clearfix">
                                <a href="#" class="product-thumb">
                                    <img src="{{asset('images/front_images/images/shop/sh-4/6.jpg')}}" alt="image">
                                </a>
                                <span class="new sale">Sale</span>
                            </div>
                            <div class="product-info clearfix">
                                <span class="product-title">Cotton White Underweaer Block Out Edition</span>
                                <div class="price">
                                    <del>
                                        <span class="regular">$150.00</span>
                                    </del>
                                    <ins>
                                        <span class="amount">$100.00</span>
                                    </ins>
                                </div>
                                <ul class="flat-color-list width-14">
                                    <li>
                                        <a href="#" class="red"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="blue"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="black"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="add-to-cart text-center">
                                <a href="#">ADD TO CART</a>
                            </div>
                            <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                        </li>
                        <li class="product-item kid woman">
                            <div class="product-thumb clearfix">
                                <a href="#" class="product-thumb">
                                    <img src="{{asset('images/front_images/images/shop/sh-4/7.jpg')}}" alt="image">
                                </a>
                            </div>
                            <div class="product-info clearfix">
                                <span class="product-title">Cotton White Underweaer Block Out Edition</span>
                                <div class="price">
                                    <ins>
                                        <span class="amount">$100.00</span>
                                    </ins>
                                </div>
                            </div>
                            <div class="add-to-cart text-center">
                                <a href="#">ADD TO CART</a>
                            </div>
                            <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                        </li>
                        <li class="product-item man accessories">
                            <div class="product-thumb clearfix">
                                <a href="#" class="product-thumb">
                                    <img src="{{asset('images/front_images/images/shop/sh-4/8.jpg')}}" alt="image">
                                </a>
                                <span class="new">New</span>
                            </div>
                            <div class="product-info clearfix">
                                <span class="product-title">Cotton White Underweaer Block Out Edition</span>
                                <div class="price">
                                    <ins>
                                        <span class="amount">$100.00</span>
                                    </ins>
                                </div>
                            </div>
                            <div class="add-to-cart text-center">
                                <a href="#">ADD TO CART</a>
                            </div>
                            <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="flat-row row-icon-box bg-section bg-color-f5f">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="flat-icon-box icon-top style-1 clearfix text-center">
                    <div class="inner no-margin">
                        <div class="icon-wrap">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="text-wrap">
                            <h5 class="heading"><a href="#">Free Shipping</a></h5>
                            <p class="desc">Free Shipping on order over $99</p>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-md-3 -->
            <div class="col-md-3">
                <div class="flat-icon-box icon-top style-1 clearfix text-center">
                    <div class="inner">
                        <div class="icon-wrap">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="text-wrap">
                            <h5 class="heading"><a href="#">Cash On Delivery</a></h5>
                            <p class="desc">The Internet Trend To Repeat</p>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-md-3 -->
            <div class="col-md-3">
                <div class="flat-icon-box icon-top style-1 clearfix text-center">
                    <div class="inner">
                        <div class="icon-wrap">
                            <i class="fa fa-gift"></i>
                        </div>
                        <div class="text-wrap">
                            <h5 class="heading"><a href="#">Gift For All</a></h5>
                            <p class="desc">Receive Gift When Subscribe</p>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-md-3 -->
            <div class="col-md-3">
                <div class="flat-icon-box icon-top style-1 clearfix text-center">
                    <div class="inner">
                        <div class="icon-wrap">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <div class="text-wrap">
                            <h5 class="heading"><a href="#">Opening All Week</a></h5>
                            <p class="desc">6.00 am - 17.00pm</p>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-md-3 -->
        </div>
    </div>
</section>

<section class="flat-row row-new-latest">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-section margin-bottom-40">
                    <h2 class="title">New Latest</h2>
                </div>
                <div class="new-latest-wrap">
                    <div class="flat-new-latest flat-carousel-box post-wrap style3 data-effect clearfix" data-auto="false" data-column="3" data-column2="2" data-column3="1" data-gap="30" >
                        <div class="owl-carousel owl-theme">
                            @foreach ($newProducts as $product)
                            <article class="post clearfix">
                                <div class="featured-post data-effect-item">
                                    <a href="{{ url('product/' .$product['id']) }}">
                                        <?php
                                        $product_image_path = 'images/product_images/small/' . $product['main_image'];
                                        ?>
                                        @if (!empty($product['main_image']) && file_exists($product_image_path))
                                            <img class="img-fluid" src="{{asset('images/product_images/medium/' . $product['main_image'])}}" alt="image" >
                                        @else
                                            <img src="{{asset('images/product_images/no-image.png')}}" alt="image"  >
                                        @endif
                                    </a>
                                    <div class="content-post text-center">
                                        <div class="title-post">
                                            <h3><a href="blog-detail.html"><p>{{$product['product_name']}}</p></a></h3>
                                        </div>
                                        <ul class="meta-post">
                                            <li class="date">
                                                <p>
                                                    {{$product['product_code']}} ({{$product['product_color']}})
                                                </p>
                                            </li>
                                        </ul>
                                        <h4 style="text-align: center;">
                                            <p class="btn" style="color: white;">Rp. {{ number_format($product['product_price']) }}</p>
                                        </h4>
                                        <a title="view" href="{{ url('product/' .$product['id']) }}" class="btn btn-sm btn-danger"  style="color: white"><i class="far fa-eye"></i></a>
                                        <a title="add to cart" href="" class="btn btn-sm btn-danger" style="color: white;"><i class="fas fa-shopping-cart"></i> </a>
                                    </div>
                                    <div class="overlay-effect bg-overlay-black"></div>
                                </div>
                            </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="flat-row mail-chimp">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="text">
                    <h3>Sign up for Send Newsletter</h3>
                </div>
            </div>
            <div class="col-md-8">
                <div class="subscribe clearfix">
                    <form action="#" method="post" accept-charset="utf-8" id="subscribe-form">
                        <div class="subscribe-content">
                            <div class="input">
                                <input type="email" name="subscribe-email" placeholder="Your Email">
                            </div>
                            <div class="button">
                                <button type="button">SUBCRIBE</button>
                            </div>
                        </div>
                    </form>
                    <ul class="flat-social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
