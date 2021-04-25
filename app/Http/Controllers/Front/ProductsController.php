<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\Section;
use Attribute;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function  listing($url, Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            $url = $data['url'];
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::catDetails($url);
                $categoryProducts = Product::with('brand')->with('section')->whereIn('category_id', $categoryDetails['catIds'])
                    ->where('status', 1);

                // if fabric filter is selected
                if(isset($data['fabric']) && !empty($data['fabric'])){
                    $categoryProducts->whereIn('products.fabric', $data['fabric']);
                }

                // if sleeve filter is selected
                if(isset($data['sleeve']) && !empty($data['sleeve'])){
                    $categoryProducts->whereIn('products.sleeve', $data['sleeve']);
                }

                // if pattern  filter is selected
                if(isset($data['pattern']) && !empty($data['pattern'])){
                    $categoryProducts->whereIn('products.pattern', $data['pattern']);
                }

                // if fit filter is selected
                if(isset($data['fit']) && !empty($data['fit'])){
                    $categoryProducts->whereIn('products.fit', $data['fit']);
                }

                // if occassion filter is selected
                if(isset($data['occassion']) && !empty($data['occassion'])){
                    $categoryProducts->whereIn('products.occassion', $data['occassion']);
                }

                // if sort option selected by user
                if(isset($data['sort']) && !empty($data['sort']))
                {
                    if($data['sort'] == "product_latest"){
                        $categoryProducts->orderBy('id', 'Desc');
                    } else if($data['sort'] == "product_name_a_z"){
                        $categoryProducts->orderBy('product_name', 'Asc');
                    }else if($data['sort'] == "product_name_z_a"){
                        $categoryProducts->orderBy('product_name', 'Desc');
                    }else if($data['sort'] == "price_lowest"){
                        $categoryProducts->orderBy('product_price', 'Asc');
                    }else if($data['sort'] == "price_highest"){
                        $categoryProducts->orderBy('product_price', 'Desc');
                    }else if($data['sort'] == "product_stoke"){

                    }else{
                        $categoryProducts->orderBy('id', 'Desc');
                    }
                }

                $categoryProducts = $categoryProducts->simplePaginate(8);

                return view('front.products.ajax_products_listing', compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        }else {
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::catDetails($url);
                $categoryProducts = Product::with('brand')->with('section')->whereIn('category_id', $categoryDetails['catIds'])
                    ->where('status', 1);

                $categoryProducts = $categoryProducts->simplePaginate(8);

                // product filter
                $productFilters = Product::productFilters();
                $fabricArray = $productFilters['fabricArray'];
                $sleeveArray = $productFilters['sleeveArray'];
                $patternArray = $productFilters['patternArray'];
                $fitArray = $productFilters['fitArray'];
                $occassionArray = $productFilters['occassionArray'];


                $page_name = 'listing';
                return view('front.products.listing', compact(
                    'categoryDetails',
                    'categoryProducts',
                    'url',
                    'fabricArray',
                    'sleeveArray',
                    'patternArray',
                    'fitArray',
                    'occassionArray',
                    'page_name'
                    ));
            } else {
                abort(404);
            }
        }

    }

}
