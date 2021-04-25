<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function banner()
    {
        Session::put('page', 'banner');
        $title = "Banner";
        $banners = Banner::get()->toArray();
        return view('admin.banners.banner', compact('banners', 'title'));
    }

    public function addEditBanner(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Banner";
            // function add banner
            $banner = new Banner;
            $bannerData = array();
            $message = "Banner added successfully";
        } else {
            // function edit banner
            $title = "Edit Banner";
            $bannerData = Banner::where('id', $id)->first();
            $bannerData = json_decode(json_encode($bannerData), true);

            $banner = Banner::find($id);
            $message = "Banner updated successfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            // banner validation
            $rules = [
                'link' => 'required',
                'title' => 'required',
                'alt' => 'required',
                'image' => 'mimes:jpeg,jpg,png,gif,svg|max:2048'
            ];
            $customMessages = [
                'link.required' => ' link is required',
                'title.required' => 'title is required',
                'alt.required' => 'alt is required',
                'image.image' => 'valid image is required'
            ];
            $this->validate($request, $rules, $customMessages);

            // upload banner image
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // get image extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'images/banner_images/' . $imageName;
                    // upload image
                    Image::make($image_tmp)->save($imagePath);
                    // save banner image
                    $banner->image = $imageName;
                }
            }

            // upload banner
            $banner->link = $data['link'];
            $banner->title = $data['title'];
            $banner->alt = $data['alt'];
            $banner->status = 1;
            $banner->save();

            session()->flash('success_message', $message);
            return redirect('admin/banner');
        }

        return view('admin.banners.add_edit_banner', compact('title', 'bannerData'));
    }

    public function deleteBannerImage($id)
    {
        // get banner image
        $bannerImage = Banner::select('image')->where('id', $id)->first();

        // get category image path
        $banner_image_path = 'images/banner_images/';

        // Delete category image from category_image folder if exist
        if (file_exists($banner_image_path . $bannerImage->image)) {
            unlink($banner_image_path . $bannerImage->image);
        }

        // delete category_image from categories table
        Banner::where('id', $id)->update(['image' => ""]);

        $message = "Banner image has been deleted";
        Session::flash('success_message', $message);
        return redirect()->back();
    }

    public function deleteBanner($id)
    {
        // delete banner
        Banner::where('id', $id)->delete();
        $message = "Banner has been deleted";
        Session::flash('success_message', $message);
        return redirect()->back();
    }

    public function updateBannerStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Banner::where('id', $data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'id' => $data['banner_id']]);
        }
    }
}
