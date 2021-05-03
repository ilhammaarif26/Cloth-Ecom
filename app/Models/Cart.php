<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    public static function userCartItems(){
        // if(Auth::check()){
        //     $userCartItems = Cart::with(['product' => function($query){
        //         $query->select('id', 'product_name', 'product_code', 'main_image');
        //     }])->where('user_id', Auth::user()->id)->orderBy('id', 'Desc')->get()->toArray();
        // } else {
        //     $userCartItems = Cart::with(['product' => function($query){
        //         $query->select('id', 'product_name', 'product_code', 'main_image');
        //     }])->where('session_id', Session::get('session_id'))->orderBy('id', 'Desc')->get()->toArray();
        // }

        $userCartItems = Cart::with(['product' => function($query){
            $query->select('id', 'product_name', 'product_code', 'main_image', 'product_color', 'product_discount');
        }])->get()->toArray();
        return $userCartItems;
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public static function getProductAttrPrice($product_id, $size)
    {
        $attrPrize = ProductsAttribute::select('price')->where(['product_id' => $product_id, 'size' => $size])->first()->toArray();
        return $attrPrize['price'];
    }


    public static function getDiscountedPrice($product_id, $size)
    {
        $proDetails = Product::select('product_price', 'product_discount', 'category_id')->where('id', $product_id)->first()->toArray();
        $catDetails = Category::select('category_discount')->where('id' , $proDetails['category_id'])->first()->toArray();

        if($proDetails['product_discount']>0){
            // if product discount added in admin panel
            $discounted_price = $proDetails['product_price'] - ($proDetails['product_price'] * $proDetails['product_discount']/100);
            // sistematic discount
            // sale price = cost price - (cost price * discount price)
            // 450 = 500 - (500 * 10/100 = 50);
        } else if($catDetails['category_discount']>0){
            // if product disount is not added and caetgory discount added from admin panel
            $discounted_price = $proDetails['product_price'] - ($proDetails['product_price'] * $catDetails['category_discount']/100);
        }else{
            $discounted_price = 0;
        }

        return $discounted_price;
    }

}
