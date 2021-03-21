<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        return view('admin.admin_dashboard', compact('users'));
    }

    public function settings()
    {
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

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

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
}