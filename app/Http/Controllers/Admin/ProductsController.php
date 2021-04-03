<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    // view product page
    public function products()
    {
        Session::put('page', 'products');
        $products = Product::with(['category' => function ($query) {
            $query->select('id', 'category_name');
        }, 'section' => function ($query) {
            $query->select('id', 'name');
        }])->get();
        return view('admin.products.products', compact('products'));
    }

    // update product status
    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    // delete product
    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();
        $message = "Product has been deleted";
        Session::flash('success_message', $message);
        return redirect()->back();
    }

    // add and edit product
    public function addEditProduct(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Product";
            $product = new Product;
            $productData = array();
            $message = "Product added successfully";
        } else {
            $title = "Edit Product";
            $productData = Product::find($id);
            $productData = json_decode(json_encode($productData), true);
            $product = Product::find($id);
            $message = "Product updated successfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            // product validation
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_price' => 'required|numeric',
                'product_color' =>  'required|regex:/^[\pL\s\-]+$/u'
            ];
            $customMessages = [
                'category_id.required' => ' category is required',
                'product_name.required' => 'product name is required',
                'product_name.regex' => 'valid product name is required',
                'product_code.required' => 'product code is required',
                'product_code.regex' => 'valid product code is required',
                'product_price.required' => 'product price is required',
                'product_price.numeric' => 'valid product price is required',
                'product_color.required' => 'product color is required',
                'product_color.regex' => 'valid product color is required',
            ];
            $this->validate($request, $rules, $customMessages);

            // default fill to product table
            if (empty($data['is_featured'])) {
                $is_featured = "no";
            } else {
                $is_featured = "yes";
            }
            if (empty($data['fabric'])) {
                $data['fabric'] = "";
            }
            if (empty($data['pattren'])) {
                $data['pattren'] = "";
            }
            if (empty($data['sleeve'])) {
                $data['sleeve'] = "";
            }
            if (empty($data['fit'])) {
                $data['fit'] = "";
            }
            if (empty($data['occassion'])) {
                $data['occassion'] = "";
            }
            if (empty($data['product_discount'])) {
                $data['product_discount'] = 0;
            }
            if (empty($data['product_weight'])) {
                $data['product_weight'] = 0;
            }
            if (empty($data['description'])) {
                $data['description'] = "";
            }

            // upload image
            if ($request->hasFile('main_image')) {
                $image_temp = $request->file('main_image');
                if ($image_temp->isValid()) {
                    // upload image after resize
                    $image_name = $image_temp->getClientOriginalName();
                    // get image extension
                    $extension = $image_temp->getClientOriginalExtension();
                    // get image name
                    $imageName = $image_name . '-' . rand(111, 999999) . '.' . $extension;
                    // path file image to large folder
                    $large_image_path = 'images/product_images/large/' . $imageName;
                    // path file image to medium folder
                    $medium_image_path = 'images/product_images/medium/' . $imageName;
                    // path file image to small folder 
                    $small_image_path = 'images/product_images/small/' . $imageName;
                    // save to large folder
                    Image::make($image_temp)->save($large_image_path); // width; 1040 height; 1200
                    // save to medium folder
                    Image::make($image_temp)->resize(520, 600)->save($medium_image_path);
                    // save to small folder
                    Image::make($image_temp)->resize(260, 300)->save($small_image_path);
                    $product->main_image = $imageName;
                }
            }

            // upload product video
            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {
                    // upload video
                    $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = $video_name . '-' . rand() . '.' . $extension;
                    $video_path = 'videos/product_videos/';
                    $video_tmp->move($video_path, $video_name);
                    // save video in product table
                    $product->product_video = $videoName;
                }
            }

            // save product in product table
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->wash_care = $data['wash_care'];
            $product->fabric = $data['fabric'];
            $product->pattren = $data['pattren'];
            $product->sleeve = $data['sleeve'];
            $product->fit = $data['fit'];
            $product->occassion = $data['occassion'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->is_featured = $is_featured;
            $product->status = 1;
            $product->save();
            session::flash('success_message', $message);
            return redirect('admin/products');
        }
        // filter array for fabric, sleeve, fit, pattern, occassion column
        $fabricArray = ['Cotton', 'Polyester', 'Woll'];
        $sleeveArray = ['Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveles'];
        $patternArray = ['Checker', 'Plain', 'Printed', 'Self', 'Solid'];
        $fitArray = ['Reguler', 'Slim'];
        $occassionArray = ['Casual', 'Formal'];

        // section with categories adn sub categories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);

        return view('admin.products.add-edit-product', compact(
            'title',
            'fabricArray',
            'sleeveArray',
            'patternArray',
            'fitArray',
            'occassionArray',
            'categories',
            'productData'
        ));
    }

    // delete product image
    public function deleteProductImage($id)
    {
        // get product image
        $productImage = Product::select('main_image')->where('id', $id)->first();

        // get main_image path 
        $small_image_path = 'images/product_images/small/';
        $medium_image_path = 'images/product_images/medium/';
        $large_image_path = 'images/product_images/large/';

        // Delete category image from main_image folder if exist (folder : small, medium, large)
        if (file_exists($small_image_path . $productImage->main_image)) {
            unlink($small_image_path . $productImage->main_image);
        }
        if (file_exists($medium_image_path . $productImage->main_image)) {
            unlink($medium_image_path . $productImage->main_image);
        }
        if (file_exists($large_image_path . $productImage->main_image)) {
            unlink($large_image_path . $productImage->main_image);
        }
        // delete category_image from product table 
        Product::where('id', $id)->update(['main_image' => ""]);

        $message = "Product image has been deleted";
        Session::flash('success_message', $message);
        return redirect()->back();
    }

    // delete product video
    public function deleteProductVideo($id)
    {
        // get product video
        $productVideo = Product::select('product_video')->where('id', $id)->first();

        // get product video path 
        $product_video_path = 'videos/product_videos/';

        // Delete product video from main_image folder if exist
        if (file_exists($product_video_path . $productVideo->product_video)) {
            unlink($product_video_path . $productVideo->product_video);
        }

        // delete category_image from product table 
        Product::where('id', $id)->update(['product_video' => '']);

        $message = "Product video has been deleted";
        Session::flash('success_message', $message);
        return redirect()->back();
    }
}