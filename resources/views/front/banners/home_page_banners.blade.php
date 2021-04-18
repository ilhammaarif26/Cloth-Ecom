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
                    <span class="text-line left"></span><p class="text-white">{{$banner['link']}}</p><span class="text-line right"></span>
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
                    <p class="text-white">{{$banner['title']}}</p>
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
                     {{$banner['alt']}}
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
