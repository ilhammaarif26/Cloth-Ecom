<?php
    use App\Models\Section;
    use App\Models\Brand;
    $sections = Section::sections();
    $brands = Brand::brands();
?>

<section class="flat-row main-shop shop-slidebar">
    <div class="container">
        
            <a href="" class="d-flex">
                <img src="{{asset('images/front_images/images/cart_image.png')}}" alt="" style="width: 25px" class="mb-5"><span>&nbsp;&nbsp;no items in your cart</span>
            </a>
        
        
        <div class="row">
            <div class="col-md-12">
                <div class="sidebar slidebar-shop">
                    <div class="widget widget-search">
                        <form role="search" method="get" class="search-form" action="#">
                            <label>                                    
                                <input type="search" class="search-field" placeholder="Search …" value="" name="s">
                            </label>
                            <input type="submit" class="search-submit" value="Search">
                        </form>                            
                    </div>
                    <div class="widget widget-sort-by">
                        <h5 class="widget-title text-uppercase">
                            Catalogues
                        </h5>
                        <ul>
                            @foreach ($sections as $section)
                            @if (count($section['categories']) > 0)
                                <li class="font-weight-bold text-uppercase pt-2" style="font-size: 1rem">{{$section['name']}}</li>
                                    @foreach ($section['categories'] as $category)
                                    <ul>
                                        <li><i class="fas fa-angle-right"></i>&nbsp;<a href="" class="font-weight-bold"><strong>{{$category['category_name']}}</strong></a></li>
                                        @foreach ($category['subcategories'] as $subcategory)
                                        <li>&nbsp;&raquo;&nbsp;<a href="" >{{$subcategory['category_name']}}</a></li>
                                        @endforeach
                                    </ul>
                                    @endforeach 
                            @endif
                            @endforeach
                        </ul>
                    </div><!-- /.widget-sort-by -->
                    <div class="widget widget-color">
                        <h5 class="widget-title text-uppercase">
                           Brands
                        </h5>
                        <ul class="flat-color-list icon-left">
                            @foreach ($brands as $brand)
                            @if (count($brand) > 0)
                                <li class="font-weight-bold text-uppercase ">{{$brand['name']}}</li>
                            @endif
                            @endforeach
                        </ul>
                    </div><!-- /.widget-color -->
                    <div class="widget widget-size">
                        <h5 class="widget-title">
                            Size
                        </h5>
                        <ul>
                            <li class="checkbox">
                                <input type="checkbox" name="checkbok1" id="checkbox1">
                                <label for="checkbox1">
                                    <a href="#">L</a>
                                </label>
                            </li>
                            <li class="checkbox">
                                <input type="checkbox" name="checkbok2" id="checkbox2">
                                <label for="checkbox2">
                                    <a href="#">M</a>
                                </label>
                            </li>
                            <li class="checkbox">
                                <input type="checkbox" name="checkbok3" id="checkbox3">
                                <label for="checkbox3">
                                    <a href="#">S</a>
                                </label>
                            </li>
                            <li class="checkbox">
                                <input type="checkbox" name="checkbok4" id="checkbox4">
                                <label for="checkbox4">
                                    <a href="#">X</a>
                                </label>
                            </li>
                            <li class="checkbox">
                                <input type="checkbox" name="checkbok5" id="checkbox5">
                                <label for="checkbox5">
                                    <a href="#">XL</a>
                                </label>
                            </li>
                            <li class="checkbox">
                                <input type="checkbox" name="checkbok6" id="checkbox6">
                                <label for="checkbox6">
                                    <a href="#">XXL</a>
                                </label>
                            </li>
                        </ul>
                    </div><!-- /.widget-size -->
                    <div class="widget widget-price">
                        <h5 class="widget-title">Filter by price</h5>
                        <div class="price-filter">
                            <div id="slide-range"></div>
                            <p class="amount">
                              Price: <input type="text" id="amount" disabled="">
                            </p>
                        </div>
                    </div>
                    <div class="widget widget_tag">
                        <h5 class="widget-title">
                            Tags
                        </h5>
                        <div class="tag-list">
                            <a href="#">All products</a>
                            <a href="#" class="active">Bags</a>
                            <a href="#">Chair</a>
                            <a href="#">Decoration</a>
                            <a href="#">Fashion</a> 
                            <a href="#">Tie</a>
                            <a href="#">Furniture</a>
                            <a href="#">Accesories</a> 
                        </div>
                    </div><!-- /.widget -->
                </div><!-- /.sidebar -->
            </div><!-- /.col-md-3 --
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>
