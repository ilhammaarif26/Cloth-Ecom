<ul class="product style2" style="margin-top: -50px">
    @foreach ($categoryProducts as $product)
    <ul class="product style2">
        <li class="product-item">
            <div class="product-thumb clearfix mb-2">
                <a href="#">
                @if (isset($product['main_image']))
                    <?php $product_image_path = 'images/product_images/small/' .$product['main_image']; ?>
                @else
                    <?php $product_image_path = '' ?>
                @endif
                <?php
                        $product_image_path = 'images/product_images/small/' .$product['main_image'];
                ?>
                @if (!empty($product['main_image']) && file_exists($product_image_path))
                    <img src="{{asset($product_image_path)}}" alt="image" style="width: 150px; height: 150px;" >
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
                    <p>{{ $product['fabric'] }}</p>
                </div>
                <div class="price">
                    <ins>
                        <span class="amount">Rp. {{$product['product_price']}}</span>
                    </ins>
                </div>
            </div>
            <div class="add-to-cart text-center" style="margin-top: -30px">
                <a href="{{ url('product-details/' .$product['id']) }}">VIEW</a>
            </div>
        </li>
    </ul>
    @endforeach
</ul>
