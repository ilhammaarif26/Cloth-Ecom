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
            {{count([$categoryProducts])}} products are available
        </p>
        <ul class="flat-filter-search">
            <li>
                <div class="widget widget-sort-by">
                    <form action="" name="sortProducts" id="sortProducts" class="">
                        <input type="hidden" name="url" id="url" value="{{ $url }}">
                        <select name="sort" id="sort" class="form-select"  >
                            <option>Filter by</option>
                            <option value="product_latest" @if (isset($_GET['sort']) && $_GET['sort']=="product_latest")
                                selected=""
                            @endif>Product Latest</option>
                            <option value="product_name_a_z"@if (isset($_GET['sort']) && $_GET['sort']=="product_name_a_z")
                            selected=""
                            @endif>Product Name A - Z</option>
                            <option value="product_name_z_a"@if (isset($_GET['sort']) && $_GET['sort']=="product_name_z_a")
                            selected=""
                            @endif>Product Name Z - A</option>
                            <option value="price_lowest"@if (isset($_GET['sort']) && $_GET['sort']=="price_lowest")
                            selected=""
                            @endif>Lowest Price</option>
                            <option value="price_highest"@if (isset($_GET['sort']) && $_GET['sort']=="price_highest")
                            selected=""
                            @endif>Highest Price</option>
                        </select>
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <div class="filter_products">
        @include('front.products.ajax_products_listing')
    </div>
</div>

<div class="product-pagination text-center clearfix mt-2">
    @if (isset($_GET['sort']) && !empty($_GET['sort']))
        {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}
    @else
        {{ $categoryProducts->links() }}
    @endif
</div>
@endsection
