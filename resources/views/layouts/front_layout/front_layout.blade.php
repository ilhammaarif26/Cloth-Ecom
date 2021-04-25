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

    <link rel="stylesheet" href="{{asset('css/front_css/stylesheets/main.css')}}">

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

    @include('front.banners.home_page_banners')

    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.front_layout.front_sidebar')
            </div>
            <div class="col-sm-9">
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
    <script src="{{asset('js/front_js/front_script.js')}}"> </script>
</body>
</html>
