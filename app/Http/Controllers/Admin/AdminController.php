<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.admin_dashboard');
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
        $user = Auth::guard('admin')->user();
        echo "<pre>";
        print_r($data);
        die;
        echo "<pre>";
        print_r($user);
        die;
    }
}