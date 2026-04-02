<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use DB;
use Validator;
use Session;
use \Hash;
use \Crypt;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EnquiryExport;

class AdminDashboardController extends Controller
{
    public function Index()
    {



        return view('admin.dashboard.dashboard');
    }

    public function adminChangePassword(Request $req)
    {
        // dd('sdf');
        return view('admin.auth.changepassword');
    }

    public function PsswordChange(Request $req)
    {
        $user = Session::get('admin');
        $validator = Validator::make($req->all(), [
            'old_password' => 'required|min:6|max:50|',
            'new_password' => 'required|min:6|max:255|',
            'confirm_password' => 'required|min:6|max:255|',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($req->input())->withErrors($validator->errors());
        } else if ($req->new_password != $req->confirm_password) {
            return redirect()
                ->back()
                ->with(['message' => 'New Password and Confirm Password does not match', 'alert-type' => 'error']);
        } else  if (!Hash::check($req->old_password, $user->password)) {
            // The passwords matches
            return redirect()
                ->back()
                ->with(['message' => 'Your current password does not matches with the password you provided. Please try again.', 'alert-type' => 'error']);
        } else   if ($req->old_password == $req->new_password) {
            //Current password and new password are same
            // return redirect()
            //     ->back()
            //     ->with('error', 'New Password cannot be same as your current password. Please choose a different password.');
            return redirect()
                ->back()
                ->with(['message' => 'New Password cannot be same as your current password. Please choose a different password.', 'alert-type' => 'error']);
        } else {
            $arrayParam = [
                'password' =>  Hash::make($req->new_password),
            ];

            DB::table('admins')
                ->where('id', $user->id)
                ->update($arrayParam);
            return redirect('/admin/dashboard')->with(['message' => 'Password Updated Successfully', 'alert-type' => 'success']);
        }
    }


    public function CustomerList()
    {

        $userList =  User::paginate(50);

        return view('admin.user.index', compact('userList'));
    }


    public function EnquryList()
    {
        $enquryList = Enquiry::latest()->get();
        return view('admin.enquiry.index', compact('enquryList'));
    }
    
    
    public function EnquiryDataexport(){
        return Excel::download(new EnquiryExport, 'enquiry.xlsx');
    }

    public function DeleteEnquiry($id)
    {
        $enqury = Enquiry::find($id);
        $enqury->delete();
        return redirect()->back()->with(['message' => 'Enquiry Deleted Successfully', 'alert-type' => 'success']);
    }

    public function sitemap()
    {
        $sitemapPath = public_path('sitemap.xml');
        $sitemapExists = file_exists($sitemapPath);
        $sitemapLastModified = $sitemapExists ? Carbon::createFromTimestamp(filemtime($sitemapPath)) : null;
        $sitemapUrl = url('sitemap.xml');

        return view('admin.sitemap.index', compact('sitemapExists', 'sitemapLastModified', 'sitemapUrl'));
    }

    public function generateSitemap()
    {
        try {
            Artisan::call('sitemap:generate');
            return redirect()->back()->with(['message' => 'Sitemap generated successfully', 'alert-type' => 'success']);
        } catch (\Throwable $e) {
            report($e);
            return redirect()->back()->with(['message' => 'Sitemap generation failed. Please check logs.', 'alert-type' => 'error']);
        }
    }
}
