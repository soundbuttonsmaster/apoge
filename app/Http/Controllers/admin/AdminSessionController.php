<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Group;
use App\Models\Session;
use Illuminate\Http\Request;
use Validator;

class AdminSessionController extends Controller
{
    public function create()
    {
        $sessionList = Session::orderBy('id', 'DESC')->get();
        return view('admin.session.index', compact('sessionList'));
    }

    public function store(Request $req)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'session' => 'required|unique:sessions',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())
                ->withErrors($validator->errors())
                ->withInput($req->all());
        }

        $sessionObj = new Session();
        $sessionObj->session =  $req->session;
        $sessionObj->status =  $req->status ?? 0;
        $sessionObj->save();

        return redirect('admin/session/create')->with(['message' => 'Added successfully !', 'alert-type' => 'success']);
    }

    public function edit($id)
    {
        $data = Session::find($id);
        return view('admin/session.update', compact('data'));
    }



    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'session' => 'required|unique:sessions,session,' . $id,
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())
                ->withErrors($validator->errors())
                ->withInput($req->all());
        }

        $sessionObj = Session::findOrFail($id);
        $sessionObj->session =  $req->session;
        $sessionObj->status =  $req->status ?? 0;
        $sessionObj->save();
        return redirect('admin/session/create')->with(['message' => 'Updated successfully !', 'alert-type' => 'success']);
    }



    public function delete($id)
    {
        $check = Group::where('session_id', $id)->count();
        if ($check > 0) {
            return redirect()->back()->with(['message' => 'Session has Group !', 'alert-type' => 'error']);
        }
        $checkGallery = Gallery::where('session_id', $id)->count();
        if ($checkGallery > 0) {
            return redirect()->back()->with(['message' => 'Session has Gallery !', 'alert-type' => 'error']);
        }
        Session::whereId($id)->delete();
        return redirect('admin/session/create')->with(['message' => 'deleted successfully !', 'alert-type' => 'success']);
    }
}
