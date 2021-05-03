<?php
    use App\Models\Section;
    use App\Models\Brand;
    $sections = Section::sections();
    $brands = Brand::brands();
?>

<section class="flat-row main-shop shop-slidebar">
    <div class="container">
        <a href="{{ url('cart') }}" class="d-flex">
            <img src="{{asset('images/front_images/images/cart_image.png')}}" alt="" style="width: 25px" class="mb-5"><span>&nbsp;&nbsp;no items in your cart</span>
        </a>
        <div class="widget widget-search" style="margin-top: -20px;">
            <form role="search" method="get" class="search-form" action="#">
                <label>
                    <input type="search" class="search-field" placeholder="Search …" value="" name="s">
                </label>
                <input type="submit" class="search-submit" value="Search">
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="sidebar slidebar-shop">
                    @if (isset($page_name) && $page_name != 'cart')
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
                                        <li><i class="fas fa-angle-right"></i>&nbsp;<a class="font-weight-bold" href="{{ url($category['url']) }}" ><strong>{{$category['category_name']}}</strong></a></li>
                                        @foreach ($category['subcategories'] as $subcategory)
                                        <li>&nbsp;&raquo;&nbsp;<a href="{{ url($subcategory['url']) }}" >{{$subcategory['category_name']}}</a></li>
                                        @endforeach
                                    </ul>
                                    @endforeach
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(isset($page_name) && $page_name == 'listing')
                    <div class="widget widget-sort-by" style="margin-top:-50px ">
                        <h5 class="mb-2">fabric</h5>
                        @foreach ($fabricArray as $fabric)
                            <div class="d-flex">
                                <input class="fabric" type="checkbox" name="fabric[]" id="{{ $fabric }}" value="{{ $fabric }}">
                                &nbsp;<p style="margin-top: -5px;">{{ $fabric }}</p><br>
                            </div>
                        @endforeach
                        <br>
                       <h5 class="mb-2">Slevee</h5>
                       @foreach ($sleeveArray as $sleeve)
                            <div class="d-flex">
                                <input class="sleeve" type="checkbox" name="sleeve[]" id="{{ $sleeve }}" value="{{ $sleeve }}">
                                &nbsp;<p style="margin-top: -5px;">{{ $sleeve }}</p> <br>
                            </div>
                       @endforeach
                       <br>
                       <h5 class="mb-2">Pattern</h5>
                       @foreach ($pattrenArray as $pattren)
                            <div class="d-flex">
                                <input class="pattren" type="checkbox" name="pattren[]" id="{{ $pattren }}" value="{{ $pattren }}">
                                &nbsp;<p style="margin-top: -5px;">{{ $pattren }}</p><br>
                            </div>
                       @endforeach
                       <br>
                       <h5 class="mb-2">Fit</h5>
                       @foreach ($fitArray as $fit)
                            <div class="d-flex">
                                <input class="fit" type="checkbox" name="fit[]" id="{{ $fit }}" value="{{ $fit }}">
                                &nbsp;<p style="margin-top: -5px;">{{ $fit }}</p> <br>
                            </div>
                       @endforeach
                       <br>
                       <h5 class="mb-2">Occassion</h5>
                       @foreach ($occassionArray as $occassion)
                            <div class="d-flex">
                                <input class="occassion" type="checkbox" name="ocassion[]" id="{{ $occassion }}" value="{{ $occassion }}">
                                &nbsp;<p style="margin-top: -5px;">{{ $occassion }}</p> <br>
                            </div>
                       @endforeach
                    </div>
                    @endif
                    <div class="widget widget-color" style="margin-top:">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
