<?php
    use App\Models\Section;
    use App\Models\Brand;
    $sections = Section::sections();
    $brands = Brand::brands();
?>
<div id="site-header-wrap">
    <header id="header" class="header header-container clearfix">
        <div class="container clearfix" id="site-header-inner">
            <div id="logo" class="logo float-left">
                <a href="index.html" title="logo">
                    <a href="{{ url('/') }}"><h3>YUKSHOP</h3></a>
                </a>
            </div>
            <div class="mobile-button"><span></span></div>
            <ul class="menu-extra">
                <li class="box-search">
                    <a class="icon_search header-search-icon" href="#"><i class="fas fa-search"></i></a>
                    <form role="search" method="get" class="header-search-form" action="#">
                        <input type="text" value="" name="s" class="header-search-field" placeholder="Search...">
                        <button type="submit" class="header-search-submit" title="Search">Search</button>
                    </form>
                </li>
                    <li class="box-cart nav-top-cart-wrapper">
                        <a class=" nav-cart-trigger active" href="{{ url('/cart') }}"><i class="fas fa-shopping-cart"></i></a>
                    </li>
            </ul>
            <div class="nav-wrap">
                <nav id="mainnav" class="mainnav">
                    <ul class="menu">
                        <li class="">
                            <a href="{{url('/')}}">HOME</a>
                        </li>
                        @foreach ($sections as $section)
                            @if (count($section['categories'])>0)
                            <li>
                                <a href="" style="text-transform: uppercase">{{$section['name']}}</a>
                                <ul class="submenu">
                                    @foreach ($section['categories'] as $category)
                                            <li><a href="{{ url($category['url']) }}" style="font-weight: bold">{{$category['category_name']}}</a></li>
                                        @foreach ($category['subcategories'] as $subcategory)
                                        <li><a href="{{ url($subcategory['url']) }}"> &nbsp;&raquo;&nbsp; {{$subcategory['category_name']}}</a></li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </li>
                            @endif
                        @endforeach

                        @if (count($brands)>0)
                        <li>
                            <a href="shop-3col.html" style="text-transform: uppercase">BRAND</a>
                            <ul class="submenu">
                                @foreach ($brands as $brand)
                                    <li><a href="" style="font-weight: bold">{{$brand['name']}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        <li>
                            <a href="contact.html">CONTACT</a>
                        </li>
                        &nbsp;&nbsp;
                        <li>
                            <li class="box-login">
                                <a title="login" class="" href="#">LOGIN</a>
                            </li>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
</div>
