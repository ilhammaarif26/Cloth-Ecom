<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        Session::put('page', 'dashboard');
        return view('admin.admin_dashboard');
    }

    public function settings()
    {
        Session::put('page', 'settings');
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('admin.admin_settings', compact('adminDetails'));
    }

    // for login admin
    public function login(Request $request)
    {
        // code for login admin
        if ($request->isMethod('post')) {
            $data = $request->all();

            $validateData =  $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required'
            ]);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('admin/dashboard');
            } else {
                session()->flash('error_login', 'invalid email or password');
                return redirect()->back();
            }
        }
        return view('admin.admin_login');
    }

    // funtion for logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    // function for check current pwd
    public function checkCurrentPwd(Request $request)
    {
        $data = $request->all();
        $user = Auth::guard('admin')->user()->password;
        // echo "<pre>";
        // print_r($user);
        // die;
        if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    // function for update pwd
    public function updateCurrentPwd(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // check id current pwd i correct
            if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
                // check if new pwd and current pwd is matching
                if ($data['new_pwd'] == $data['confirm_pwd']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_pwd'])]);
                    session()->flash('success_message', 'Password has been updated');
                } else {
                    session()->flash('error_message', 'New password and confirm password not match');
                    return redirect()->back();
                }
            } else {
                session()->flash('error_message', 'your current password is inccorrect');
            }

            return redirect()->back();
        }
    }

    // function for update admin details
    public function updateAdminDetails(Request $request)
    {
        Session::put('page', 'update-admin-details');

        if ($request->isMethod('post')) {
            $data = $request->all();
            //dd($data);
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
                'admin_image' => 'mimes:jpeg,jpg,png,gif,svg|max:2048'
            ];
            $customMessages = [
                'admin_name.required' => 'name is required',
                'admin_name.alpha' => 'valid name is required',
                'admin_mobile.required' => 'mobile is required',
                'admin_image.image' => 'valid image is required'
            ];
            $this->validate($request, $rules, $customMessages);

            // upload image 
            if ($request->hasFile('admin_image')) {
                $image_temp = $request->file('admin_image');
                if ($image_temp->isValid()) {

                    // get image extension
                    $extension = $image_temp->getClientOriginalExtension();

                    // generate new image name 
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'images/admin_images/admin_photos/' . $imageName;

                    // upload image
                    Image::make($image_temp)->resize(400, 400)->save($imagePath);
                } else if (!empty($data['current_admin_image'])) {
                    $imageName = $data['current_admin_image'];
                } else {
                    $imageName = "";
                }
            }

            // update admin details 
            Admin::where('email', Auth::guard('admin')->user()->email)->update([
                'name' => $data['admin_name'], 'mobile' => $data['admin_mobile'], 'images' => $imageName
            ]);
            session()->flash('success_message', 'admin details updated successfully');
            return redirect()->back();
        }
        return view('admin.update_admin_details');
    }
}