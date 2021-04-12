<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    public function brands()
    {
        Session::put('page', 'brands');
        $brands = Brand::get();
        $title = "Brands";
        return view('admin.brands.brands', compact('brands', 'title'));
    }

    // brand status
    public function updateBrandStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Brand::where('id', $data['brand_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }

    public function addEditBrand(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Brand";
            $brand = new Brand;
            $brandData = array();
            $message = "Brand added successfully";
        } else {
            $title = "Edit Brand";
            $brandData = Brand::find($id);
            $brandData = json_decode(json_encode($brandData), true);
            $brand = Brand::find($id);
            $message = "Brand updated successfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'name' => 'required',
            ];
            $customMessage = [
                'name.required' => 'Brand name is required',
                'name.regex' => 'Valid name is required'
            ];
            $this->validate($request, $rules, $customMessage);

            $brand->name = $data['name'];
            $brand->status = 1;
            $brand->save();
            Session::flash('success_message', $message);
            return redirect('admin/brands');
        }

        return view('admin.brands.add_edit_brand', compact('brandData', 'title'));
    }

    public function deleteBrand($id)
    {
        // delete category
        Brand::where('id', $id)->delete();
        $message = "Brand has been deleted";
        Session::flash('success_message', $message);
        return redirect()->back();
    }
}