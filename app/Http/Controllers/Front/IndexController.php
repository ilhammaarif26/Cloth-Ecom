<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {

        // Get featured item
        $featuredItemsCount = Product::where('is_featured', 'yes')->where('status', 1)->count();
        $featuredItems = Product::where('is_featured', 'yes')->where('status', 1)->get()->toArray();
        $featuredItemsChunk = array_chunk($featuredItems, 4);

        // get section image
        $getImageSection = Section::get()->toArray();

        // get new Product
        $newProducts = Product::orderBy('id', 'desc')->where('status', 1)->limit(3)->get()->toArray();
        $bestSale = Product::orderBy('id', 'asc')->where('status', 1)->limit(8)->get()->toArray();

        $page_name = "index";
        $title = "Home";
        return view('front.index', compact(
            'page_name',
            'title',
            'featuredItemsChunk',
            'featuredItemsCount',
            'getImageSection',
            'newProducts',
            'bestSale'
        ));
    }
}
