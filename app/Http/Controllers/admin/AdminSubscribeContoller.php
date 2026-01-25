<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscribe;

class AdminSubscribeContoller extends Controller
{
    public function index(){
        $subscribe=Subscribe::latest()->get();
        return view('admin.subscribe.index', compact('subscribe'));
    }

    public function deleteSubscribe($id){
        $delete_subscribe = Subscribe::find($id);
        $delete_subscribe->delete();
        return redirect()->back()->with(['message' => 'Subscribe Deleted successfully !','alert-type'=>'success']);

    }
}
