@extends('layouts.front_layout.front_layout')

@section('content')
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <h1 class="title">{{$categoryDetails['catDetails']['category_name']}}</h1>
                </div>
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href=""><?php echo $categoryDetails['breadcrumbs']; ?></a></li>
                    </ul>
                    <p>{{$categoryDetails['catDetails']['description']}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-content product-fourcolumn clearfix">
    <div class="filter-shop bottom_68 clearfix">
        <p class="showing-product">
            {{count($categoryProducts)}} products are available
        </p>
        <ul class="flat-filter-search">
            <li>
                <a href="#" class="show-filter">Filters</a>
            </li>
            <li class="search-product"><a href="#" >Search</a></li>
        </ul>
    </div>
    <ul class="product style2">
        @foreach ($categoryProducts as $product)
        <ul class="product style2">
            <li class="product-item">
                <div class="product-thumb clearfix mb-2">
                    <a href="#">
                        <?php 
                            $product_image_path = 'images/product_images/small/' .$product['main_image'];
                        ?>
                    @if (!empty($product['main_image']) && file_exists($product_image_path))   
                        <img src="{{asset($product_image_path)}}" alt="image" style="width: 250px; height: 250px;" >
                      @else
                        <img src="{{asset('images/category_images/no-image.png')}}" class=""
                        style="width: 250px; height: 250px;"/>
                      @endif
                    </a>
                </div>
                <div class="product-info clearfix">
                    <div>
                        <span class="product-title">{{$product['product_name']}}</span>
                        <a href=""><p>{{$product['brand']['name']}}</p></a>
                    </div>
                    <div class="price">
                        <ins>
                            <span class="amount">Rp. {{$product['product_price']}}</span>
                        </ins>
                    </div>
                </div>
                <div class="add-to-cart text-center">
                    <a href="#">ADD TO CART</a>
                </div>
            </li>
        </ul>
        @endforeach
    </ul>
</div>
@endsection