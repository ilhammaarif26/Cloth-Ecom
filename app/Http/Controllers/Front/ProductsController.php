<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function  listing($url)
    {
        $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
        if ($categoryCount > 0) {
            $categoryDetails = Category::catDetails($url);
            $categoryProducts = Product::with('brand')->with('section')->whereIn('category_id', $categoryDetails['catIds'])
                ->where('status', 1)->get()->toArray();
            return view('front.products.listing', compact('categoryDetails', 'categoryProducts', 'categoryCount'));
        } else {
            abort(404);
        }
    }
}