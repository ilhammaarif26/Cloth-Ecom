<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class SectionController extends Controller
{
    public function sections()
    {
        Session::put('page', 'sections');
        $sections = Section::get();
        return view('admin.sections.sections', compact('sections'));
    }

    // add edit status
    public function addEditSection(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Section";
            $button = "Submit";
            // function add section
            $sectionData = array();
            $section = new Section;
            $message = "Section added successfully";
        } else {
            // function edit category
            $title = "Edit Section";
            $button = "Edit";
            $sectionData = Section::where('id', $id)->first();
            $sectionData = json_decode(json_encode($sectionData), true);
            $section = Section::find($id);
            $message = "Section updated successfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // section validation 
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'category_image' => 'mimes:jpeg,jpg,png,gif,svg|max:2048'
            ];
            $customMessages = [
                'name.required' => ' section name is required',
                'category_image.image' => 'valid category image is required'
            ];
            $this->validate($request, $rules, $customMessages);

            // upload section image 
            if ($request->hasFile('section_image')) {
                $image_tmp = $request->file('section_image');
                if ($image_tmp->isValid()) {
                    // get image extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // generate new image name 
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'images/section_images/' . $imageName;
                    // upload image
                    Image::make($image_tmp)->save($imagePath);
                    // save category image
                    $section->section_image = $imageName;
                }
            }

            // upload section
            $section->name = $data['name'];
            $section->status = 1;
            $section->save();

            Session::flash('success_message', $message);
            return redirect('admin/sections');
        }

        return view('admin.sections.add_edit_section', compact('sectionData', 'title', 'button'));
    }

    // delete section image
    public function deleteSectionImage($id)
    {
        // get category image
        $sectionImage = Section::select('section_image')->where('id', $id)->first();

        // get category image path 
        $section_image_path = 'images/section_images/';

        // Delete category image from section_image folder if exist
        if (file_exists($section_image_path . $sectionImage->section_image)) {
            unlink($section_image_path . $sectionImage->section_image);
        }

        // delete category_image from categories table 
        Section::where('id', $id)->update(['section_image' => ""]);

        $message = "Section image has been deleted";
        Session::flash('success_message', $message);
        return redirect()->back();
    }

    // update section status
    public function updateSectionStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Section::where('id', $data['section_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
        }
    }

    // delete section
    public function deleteSection($id)
    {
        // delete category
        Section::where('id', $id)->delete();
        $message = "Section has been deleted";
        Session::flash('success_message', $message);
        return redirect()->back();
    }
}