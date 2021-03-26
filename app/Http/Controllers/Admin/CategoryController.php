<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function categories()
    {
        Session::put('page', 'categories');
        $categories = Category::with('section', 'parentcategory')->get();
        return view('admin.categories.categories', compact('categories'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function addEditCategory(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "add category";
            // function add category
            $category = new Category;
        } else {
            $title = "edit category";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            // category validation
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required',
                'category_image' => 'mimes:jpeg,jpg,png,gif,svg|max:2048'
            ];
            $customMessages = [
                'category_name.required' => ' category name is required',
                'category_name.regex' => 'valid category name is required',
                'section_id.required' => 'section is required',
                'url.required' => 'category url is required',
                'category_image.image' => 'valid category image is required'
            ];
            $this->validate($request, $rules, $customMessages);

            // upload category image 
            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    // get image extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // generate new image name 
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'images/category_images/' . $imageName;
                    // upload image
                    Image::make($image_tmp)->save($imagePath);
                    // save category image
                    $category->category_image = $imageName;
                }
            }

            // upload category
            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keyword = $data['meta_keyword'];
            $category->status = 1;
            $category->save();

            session()->flash('success_message', 'category added succesfully');
            return redirect('admin/categories');
        }

        // get sections
        $getSections = Section::get();

        return view('admin.categories.add_edit_category', compact('title', 'getSections'));
    }

    // tambahkan tingkat kategori / append category level
    public function appendCategoryLevel(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getCategories = Category::with('subcategories')->where([
                'section_id' => $data['section_id'], 'parent_id' => 0, 'status' => 1
            ])->get();
            $getCategories = json_decode(json_encode($getCategories), true);
            // dd($getCategories);
            return view('admin.categories.append_categories_level', compact('getCategories'));
        }
    }
}