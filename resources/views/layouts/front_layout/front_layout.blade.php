<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>@yield('title')</title>

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Bootstrap  -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/front_css/stylesheets/bootstrap.css')}}" >

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/front_css/stylesheets/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/front_css/stylesheets/responsive.css')}}">

    <!-- Colors -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/front_css/stylesheets/colors/color1.css')}}" id="colors">

    <!-- Animation Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/front_css/stylesheets/animate.css')}}">

    <link rel="stylesheet" href="{{asset('css/front_css/stylesheets/font-awesome.css')}}">

    {{-- font --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <!-- Favicon and touch icons  -->
    <link href="icon/favicon.png" rel="shortcut icon">

</head> 
<body class="header_sticky header-style-1 has-menu-extra">
	<!-- Preloader -->
    {{-- <div id="loading-overlay">
        <div class="loader"></div>
    </div> --}} 

    @include('layouts.front_layout.front_header')

    <?php
        use App\Models\Banner;
        $banners = Banner::Banners();
    ?>
    @if (isset($page_name) && $page_name == 'index')
        <div class="rev_slider_wrapper fullwidthbanner-container mb-5">
            <div id="rev-slider1" class="rev_slider fullwidthabanner">
                @foreach ($banners as $banner)
                <ul>                   
                    <li data-transition="random">
                        <img src="{{asset('images/banner_images/' .$banner['image'])}}" alt="" class="img-fluid" data-bgposition="center center" data-no-retina>
                    <div class="tp-caption tp-resizeme text-333 font-weight-400 text-right"
                        data-x="['right','right','right','center']" data-hoffset="['33','33','33','0']"
                        data-y="['middle','middle','middle','middle']" data-voffset="['-115','-115','-115','-115']"
                        data-fontsize="['22','22','22','22']"
                        data-lineheight="['60','60','60','60']"
                        data-width="full"
                        data-height="none"
                        data-whitespace="normal"
                        data-transform_idle="o:1;"
                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                        data-mask_in="x:0px;y:[100%];" 
                        data-mask_out="x:inherit;y:inherit;" 
                        data-start="700" 
                        data-splitin="none" 
                        data-splitout="none" 
                        data-responsive_offset="on">
                        <span class="text-line left"></span><p class="text-white">Summer Fashion</p><span class="text-line right"></span>
                    </div>

                    <div class="tp-caption tp-resizeme text-333 font-weight-500 letter-spacing-10 text-right text-white"
                        data-x="['right','right','right','center']" data-hoffset="['13','13','13','0']"
                        data-y="['middle','middle','middle','middle']" data-voffset="['-39','-39','-39','-59']"
                        data-fontsize="['130','130','130','60']"
                        data-lineheight="['130','130','130','60']"
                        data-width="full"
                        data-height="none"
                        data-whitespace="normal"
                        data-transform_idle="o:1;"
                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                        data-mask_in="x:0px;y:[100%];" 
                        data-mask_out="x:inherit;y:inherit;" 
                        data-start="1000" 
                        data-splitin="none" 
                        data-splitout="none" 
                        data-responsive_offset="on">
                        <p class="text-white">SALE</p>
                    </div>

                    <div class="tp-caption tp-resizeme text-333 font-weight-400 text-right"
                        data-x="['right','right','right','center']" data-hoffset="['13','13','13','0']"
                        data-y="['middle','middle','middle','middle']" data-voffset="['50','50','50','5']"
                        data-fontsize="['48','48','48','28']"
                        data-lineheight="['60','60','60','40']"
                        data-width="full"
                        data-height="none"
                        data-whitespace="normal"
                        data-transform_idle="o:1;"
                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                        data-mask_in="x:0px;y:[100%];" 
                        data-mask_out="x:inherit;y:inherit;" 
                        data-start="1000" 
                        data-splitin="none" 
                        data-splitout="none" 
                        data-responsive_offset="on">
                        UP TO <span class=" text-white">30%</span> OFF
                    </div>

                    <div class="tp-caption text-right"
                        data-x="['right','right','right','center']" data-hoffset="['105','105','105','0']"
                        data-y="['middle','middle','middle','middle']" data-voffset="['138','138','138','80']"
                        data-width="full"
                        data-height="none"
                        data-whitespace="normal"
                        data-transform_idle="o:1;"
                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                        data-mask_in="x:0px;y:[100%];" 
                        data-mask_out="x:inherit;y:inherit;" 
                        data-start="1000" 
                        data-splitin="none" 
                        data-splitout="none" 
                        data-responsive_offset="on">
                        <a href="#" class="themesflat-button bg-accent has-shadow"><span>BY NOW</span></a>
                    </div>
                    </li>
                </ul>      
                @endforeach
            </div> 
        </div>
    @endif 
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                @include('layouts.front_layout.front_sidebar')
            </div>
            <div class="col-sm-10">
                 @yield('content')
            </div>
        </div>
    </div>

    @include('layouts.front_layout.front_footer')


	<!-- Javascript -->
    <script src="{{asset('js/front_js/javascript/jquery.min.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/tether.min.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/bootstrap.min.js')}}"></script> 
    <script src="{{asset('js/front_js/javascript/jquery.easing.js')}}"></script>    
    <script src="{{asset('js/front_js/javascript/parallax.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/jquery-waypoints.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/jquery-countTo.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/jquery.countdown.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/jquery.flexslider-min.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/images-loaded.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/jquery.isotope.min.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/magnific.popup.min.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/jquery.hoverdir.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/equalize.min.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/gmap3.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIEU6OT3xqCksCetQeNLIPps6-AYrhq-s&region=GB"></script>
    <script src="{{asset('js/front_js/javascript/jquery-ui.js')}}"></script>
    
    <script src="{{asset('js/front_js/javascript/jquery.cookie.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/main.js')}}"></script>

    <!-- Revolution Slider -->
    <script src="{{asset('slider/front_slider/rev-slider/js/jquery.themepunch.tools.min.js')}}"></script>
    <script src="{{asset('slider/front_slider/rev-slider/js/jquery.themepunch.revolution.min.js')}}"></script>
    <script src="{{asset('js/front_js/javascript/rev-slider.js')}}""></script>
    <!-- Load Extensions only on Local File Systems ! The following part can be removed on Server for On Demand Loading -->  
    <script src="{{asset('slider/front_slider/rev-slider/js/extensions/revolution.extension.actions.min.js')}}"></script>
    <script src="{{asset('slider/front_slider/rev-slider/js/extensions/revolution.extension.carousel.min.js')}}"></script>
    <script src="{{asset('slider/front_slider/rev-slider/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
    <script src="{{asset('slider/front_slider/rev-slider/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
    <script src="{{asset('slider/front_slider/rev-slider/js/extensions/revolution.extension.migration.min.js')}}"></script>
    <script src="{{asset('slider/front_slider/rev-slider/js/extensions/revolution.extension.navigation.min.js')}}"></script>
    <script src="{{asset('slider/front_slider/rev-slider/js/extensions/revolution.extension.parallax.min.js')}}"></script>
    <script src="{{asset('slider/front_slider/rev-slider/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
    <script src="{{asset('slider/front_slider/rev-slider/js/extensions/revolution.extension.video.min.js')}}"></script>

    {{-- main js --}}
    <script src="{{asset('js/front_js/main/main.js')}}"> </script>
</body> 
</html>                               