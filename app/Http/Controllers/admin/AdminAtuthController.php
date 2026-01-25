<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class AdminAtuthController extends Controller
{
    public function Index(Request $req)
    {
        $data = array();

        if ($req->isMethod('post')) {
            // dd($req->all());
            $validator = Validator::make($req->all(), [
                'email' => 'required|email',
                'password' => 'required',

            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput($req->input())
                    ->withErrors($validator->errors());
            }

            $admin = Admin::where(['email' => $req->email])->first();
            // dd($admin);
            if ($admin) {
                if (!Hash::check($req->password, $admin->password)) {
                    $data['error'] = "Password does not match";
                } else {
                    $req->session()->put('admin', $admin);
                    return  redirect('admin/dashboard');
                }
            } else {
                $data['error'] = "Username and Password is not matched";
            }
        }

        if (session()->has('admin')) {
            return  redirect('admin/dashboard');
        } else {
            return view('admin.auth.login', ['data' => $data]);
        }
    }

    public function logout(Request $request)
    {
        Session::forget('admin');
        return redirect('/admin-login');
    }
}
