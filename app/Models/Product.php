<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // relation many to one category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // relation many to one section
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    // relations to brand table
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    // realtion one to many attributes
    public function attributes()
    {
        return $this->hasMany(ProductsAttribute::class);
    }

    // relation to many images
    public function images()
    {
        return $this->hasMany(ProductsImage::class);
    }

    public static function productFilters()
    {
        // Product Filter
        $productFilters['fabricArray'] = array('Cotton', 'Polyester', 'Woll');
        $productFilters['sleeveArray'] = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveles');
        $productFilters['pattrenArray'] = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $productFilters['fitArray'] = array('Regular', 'Slim');
        $productFilters['occassionArray'] = array('Casual', 'Formal');

        return $productFilters;
    }

    public static function getDiscountedPrice($product_id)
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

    public static function getDiscountedAttrPrice($product_id, $size)
    {
        $proAttrPrice = ProductsAttribute::where(['product_id' => $product_id, 'size' => $size])->first()->toArray();
        $proDetails = Product::select('product_discount', 'category_id')->where('id', $product_id)->first()->toArray();
        $catDetails = Category::select('category_discount')->where('id' , $proDetails['category_id'])->first()->toArray();

        if($proDetails['product_discount']>0){
            // if product discount added in admin panel
            $discounted_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $proDetails['product_discount']/100);
            // sistematic discount
            // sale price = cost price - (cost price * discount price)
            // 450 = 500 - (500 * 10/100 = 50);
        } else if($catDetails['category_discount']>0){
            // if product disount is not added and caetgory discount added from admin panel
            $discounted_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $catDetails['category_discount']/100);

        }else{
            $discounted_price = 0;
        }

        return array('product_price' => $proAttrPrice['price'], 'discounted_price' =>  $discounted_price);
    }

}

