<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\ProductsImage;
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
            $rules = [
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_name' => 'required',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_price' => 'required|numeric',
                'product_color' =>  'required|regex:/^[\pL\s\-]+$/u'
            ];
            $customMessages = [
                'category_id.required' => ' category is required',
                'brand_id' => 'brand is required',
                'product_name.required' => 'product name is required',
                'product_code.required' => 'product code is required',
                'product_code.regex' => 'valid product code is required',
                'product_price.required' => 'product price is required',
                'product_price.numeric' => 'valid product price is required',
                'product_color.required' => 'product color is required',
                'product_color.regex' => 'valid product color is required',
            ];
            $this->validate($request, $rules, $customMessages);

            // default fill to product table
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
                    Image::make($image_temp)->resize(500, 500)->save($medium_image_path);
                    // save to small folder
                    Image::make($image_temp)->resize(250, 250)->save($small_image_path);
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
                    $video_tmp->move($video_path, $videoName);
                    // save video in product table
                    $product->product_video = $videoName;
                }
            }

            // save product in product table
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
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
            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            } else {
                $product->is_featured = "no";
            }
            $product->status = 1;
            $product->save();
            session::flash('success_message', $message);
            return redirect('admin/products');
        }

        // product filter
        $productFilters = Product::productFilters();
        $fabricArray = $productFilters['fabricArray'];
        $sleeveArray = $productFilters['sleeveArray'];
        $patternArray = $productFilters['patternArray'];
        $fitArray = $productFilters['fitArray'];
        $occassionArray = $productFilters['occassionArray'];

        // section with categories adn sub categories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);

        // get all brands
        $brands = Brand::where('status', 1)->get();
        $brands = json_decode(json_encode($brands), true);


        return view('admin.products.add-edit-product', compact(
            'title',
            'fabricArray',
            'sleeveArray',
            'patternArray',
            'fitArray',
            'occassionArray',
            'categories',
            'productData',
            'brands'
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
        // delete product image from product table
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

        // delete product_video from product table
        Product::where('id', $id)->update(['product_video' => '']);

        $message = "Product video has been deleted";
        Session::flash('success_message', $message);
        return redirect()->back();
    }

    // function add attrubute
    public function addAttributes(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // for input many product attrubute
            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {

                    // SKU already exist check
                    $attrCountSKU = ProductsAttribute::where('sku', $value)->count();
                    if ($attrCountSKU > 0) {
                        $message = 'SKU already exists, please add another SKU';
                        Session::flash('error_message', $message);
                        return redirect()->back();
                    }

                    // size already exist check
                    $attrCountSKU = ProductsAttribute::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if ($attrCountSKU > 0) {
                        $message = 'Size already exists, please add another size';
                        Session::flash('error_message', $message);
                        return redirect()->back();
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }

            // success alert
            $success_message = 'Product attributes has been added successfully';
            Session::flash('success_message', $success_message);
            return redirect()->back();
        }

        $productData = Product::with('brand')->select(
            'id',
            'product_name',
            'product_code',
            'product_color',
            'main_image',
            'brand_id'
        )->with('attributes')->find($id);
        $productData = json_decode(json_encode($productData), true);
        $title = "Product Attributes";
        return view('admin.products.add_attributes', compact('productData', 'title'));
    }

    // update attribute
    public function editAttributes(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['attrId'] as $key => $attr) {
                if (!empty($attr)) {
                    ProductsAttribute::where(['id' => $data['attrId'][$key]])->update([
                        'price' => $data['price'][$key],
                        'stock' => $data['stock'][$key]
                    ]);
                }
            }
            $success_message = 'Product attributes has been updated';
            Session::flash('update_message', $success_message);
            return redirect()->back();
        }
    }

    // update attribute status
    public function updateAttributeStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            ProductsAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }

    // delete Attribute
    public function deleteAttribute($id)
    {
        ProductsAttribute::where('id', $id)->delete();
        $message = "Attribute has been deleted";
        Session::flash('success_message', $message);
        return redirect()->back();
    }

    // add product images for display
    public function addImages(Request $request, $id)
    {
        // upload image
        if ($request->isMethod('post')) {
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $key => $image) {
                    $productImage = new ProductsImage;
                    $image_temp = Image::make($image);
                    $extension = $image->getClientOriginalExtension();
                    $imageName = rand(111, 999999) . time() . "." . $extension;

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
                    $productImage->image = $imageName;
                    $productImage->product_id = $id;
                    $productImage->status = 1;
                    $productImage->save();
                }
                $message = "Product images has been added successfully";
                Session::flash('success_message', $message);
                return redirect()->back();
            }
        }

        // for display images
        $imageData = Product::with('images')->select(
            'id',
            'product_name',
            'product_code',
            'product_color',
            'main_image'
        )->find($id);
        $imageData = json_decode(json_encode($imageData), true);
        $title = "product Images";
        return view('admin.products.add_images', compact('title', 'imageData'));
    }

    // update image status
    public function updateImageStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            ProductsImage::where('id', $data['image_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'image_id' => $data['image_id']]);
        }
    }

    // delete image
    public function deleteImage($id)
    {
        // get product image
        $productImage = ProductsImage::select('image')->where('id', $id)->first();

        // get main_image path
        $small_image_path = 'images/product_images/small/';
        $medium_image_path = 'images/product_images/medium/';
        $large_image_path = 'images/product_images/large/';

        // Delete category image from main_image folder if exist (folder : small, medium, large)
        if (file_exists($small_image_path . $productImage->image)) {
            unlink($small_image_path . $productImage->image);
        }
        if (file_exists($medium_image_path . $productImage->image)) {
            unlink($medium_image_path . $productImage->image);
        }
        if (file_exists($large_image_path . $productImage->image)) {
            unlink($large_image_path . $productImage->image);
        }
        // delete product image from product table
        ProductsImage::where('id', $id)->delete();

        $message = "Product images has been deleted";
        Session::flash('success_message', $message);
        return redirect()->back();
    }
}
