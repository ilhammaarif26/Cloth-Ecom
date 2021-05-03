<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\Section;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function  listing(Request $request)
    {
        Paginator::useBootstrap();
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

                // if pattern filter is selected
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

                $categoryProducts = $categoryProducts->simplePaginate(4);

                return view('front.products.ajax_products_listing', compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        }else {
            $url = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::catDetails($url);
                $categoryProducts = Product::with('brand')->with('section')->whereIn('category_id', $categoryDetails['catIds'])
                    ->where('status', 1);

                $categoryProducts = $categoryProducts->paginate(12);

                // product filter
                $productFilters = Product::productFilters();
                $fabricArray = $productFilters['fabricArray'];
                $sleeveArray = $productFilters['sleeveArray'];
                $pattrenArray = $productFilters['pattrenArray'];
                $fitArray = $productFilters['fitArray'];
                $occassionArray = $productFilters['occassionArray'];

                $page_name = 'listing';
                return view('front.products.listing', compact(
                    'categoryDetails',
                    'categoryProducts',
                    'url',
                    'fabricArray',
                    'sleeveArray',
                    'pattrenArray',
                    'fitArray',
                    'occassionArray',
                    'page_name',
                    'url'
                    ));
            } else {
                abort(404);
            }
        }

    }

    public function detail($id)
    {
        $productDetails = Product::with(['category','brand', 'attributes' => function($query){
            $query->where('status', 1);
        }, 'images', 'section' ])->find($id)->toArray();
        // dd($productDetails); die;
        $total_stock = ProductsAttribute::where('product_id', $id)->sum('stock');
        $relatedProducts = Product::with('brand')->where('category_id', $productDetails['category']['id'])
        ->where('id', '!=', $id)->inRandomOrder()->get()->toArray();
        return view('front.products.detail',compact('productDetails', 'total_stock', 'relatedProducts' ));
    }

    public function getAttributePrice(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();

            // get discounted price when size is changed
            $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($data['product_id'], $data['size']);

            return $getDiscountedAttrPrice;
        }
    }

    // add tocart function
    public function addToCart(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();

            $getproductStock = ProductsAttribute::where(['product_id' => $data['product_id'], 'size' => $data['size']])
            ->first()->toArray();

            if($getproductStock['stock']<$data['quantity']){
                $message = "Quantity exceeds stock";
                session::flash('error_message', $message);
                return redirect()->back();
            }

            // generate session id if not exist
            $session_id = Session::get('session_id');
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_d', $session_id);
            }

            if($data['quantity'] <= 0){
                $message = "Invalid quantity";
                session::flash('error_message', $message);
                return redirect()->back();
            }

            // check product if already exist ini ser cart
            if(Auth::check()){
                // User logged in
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'],
                'user_id' =>  Auth::user()->id])->count();
            }else {
                // User not logged in
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'],
                'session_id' => Session::get('session_id')])->count();
            }

            if($countProducts>0){
                $message = "Product already exist in cart";
                session::flash('error_message', $message);
                return redirect()->back();
            }

            // save product in cart
            $cart = new Cart;
            $cart->session_id = $session_id;
            $cart->product_id = $data['product_id'];
            $cart->size = $data['size'];
            $cart->quantity = $data['quantity'];
            $cart->save();

            $message = "Product added to cart";
            session::flash('success_message', $message);
            return redirect()->back();


        }
    }

    public function cart(){
        $userCartItems = Cart::userCartItems();
        $cartCount = Cart::all()->count();
        $page_name = 'cart';
        return view('front.products.cart', compact('page_name', 'userCartItems', 'cartCount'));
    }
}
