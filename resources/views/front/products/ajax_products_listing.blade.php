<?php
    use App\Models\Product;
?>

<ul class="product style2" style="margin-top: -50px">
    @foreach ($categoryProducts as $product)
    <ul class="product style2">
        <li class="product-item">
            <div class="product-thumb clearfix mb-2">
                <a href="{{ url('product/' . $product['id']) }}">
                @if (isset($product['main_image']))
                    <?php $product_image_path = 'images/product_images/large/' .$product['main_image']; ?>
                @else
                    <?php $product_image_path = '' ?>
                @endif
                <?php
                        $product_image_path = 'images/product_images/large/' .$product['main_image'];
                ?>
                @if (!empty($product['main_image']) && file_exists($product_image_path))
                    <img src="{{asset($product_image_path)}}" alt="image" style="width: 180px; height: 180px" >
                @else
                    <img src="{{asset('images/category_images/no-image.png')}}" class=""
                    style="width: 180px; height: 180px"/>
                @endif
                </a>
            </div>
            <div class="product-info clearfix">
                <div>
                    <span class="product-title"><p>{{$product['product_name']}}</p></span>
                    <p class="small">{{$product['brand']['name']}}</p>
                    <p class="small">{{ $product['fabric'] }}</p>
                    <?php $discounted_price = Product::getDiscountedPrice($product['id']) ?>
                    @if ($discounted_price > 0)
                        <p class="small"><del>{{number_format($product['product_price'])}}</del> -
                            @if (!empty($product['product_discount']))
                                Disc({{ $product['product_discount'] }}%)
                            @else
                                Disc({{ $product['category']['category_discount'] }}%)
                            @endif
                        </p>
                    @else
                        <p class="small">Normal Price</p>
                    @endif
                </div>
                    <div class="price">
                        <?php $discounted_price = Product::getDiscountedPrice($product['id']) ?>
                        @if ($discounted_price >0)
                            <ins>
                                <p class="amount">Rp. {{number_format($discounted_price)}}</p>
                            </ins>
                        @else
                            <ins>
                                <p class="amount"> Rp. {{number_format($product['product_price'])}}</p>
                            </ins>
                        @endif
                    </div>
                </ins>
            </div>
            <div class="add-to-cart text-center" style="margin-top: -30px">
                <a href="{{ url('product/' .$product['id']) }}">VIEW</a>&nbsp; &nbsp;
                <a href="{{ url('add-to-cart/' .$product['id']) }}"><i class="fas fa-cart-plus"></i></a>
            </div>
            <a href="#" class="like"><i class="fas fa-heart"></i></a>
        </li>
    </ul>
    @endforeach
</ul>
