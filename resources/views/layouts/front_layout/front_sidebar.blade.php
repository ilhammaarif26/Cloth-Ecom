<?php
    use App\Models\Section;
    $sections = Section::sections();
?>
<div id="sidebar" class="span3">
    <div><a href=""><img src="{{asset('images/front_images/images/cart_image.png')}}" alt="" style="width: 25px"> 3 item in your cart</a></div>
    {{-- <form action="" class="from-group">
        <input type="text" name="" id="" class="form-control" style="height: 25px; width: 10opx;">
        <span>        <button type="" class="btn btn-sm"><i class="fas fa-search"></i></button></span>

    </form> --}}
    <ul class="mt-4">
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
    <div  class="thumbnail mb-4">
        <img src="" alt="">
        <div class="caption">
            <h5 class="font-weight-bold">Payment Method</h5>
        </div>
    </div>
</div>