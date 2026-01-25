<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Group;
use App\Models\Session;
use Illuminate\Http\Request;
use Validator;

class AdminGroupController extends Controller
{
    public function create()
    {
        $groupList = Group::orderBy('id', 'DESC')->get();
        $Session = Session::where('status', 1)->latest()->get();
        return view('admin.group.index', compact('Session', 'groupList'));
    }

    public function store(Request $req)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'group' => 'required|unique:groups,group,NULL,id,session_id,' . $req->session_id,
            'session_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())
                ->withErrors($validator->errors())
                ->withInput($req->all());
        }

        $groupObj = new Group();
        $groupObj->group =  $req->group;
        $groupObj->session_id =  $req->session_id;
        $groupObj->status =  $req->status ?? 0;
        $groupObj->save();

        return redirect('admin/group/create')->with(['message' => 'Added successfully !', 'alert-type' => 'success']);
    }

    public function edit($id)
    {
        $data = Group::find($id);
        $Session = Session::where('status', 1)->latest()->get();
        return view('admin/group.update', compact('data', 'Session'));
    }



    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'group' => 'required|unique:groups,group,' . $id . ',id,session_id,' . $req->session_id,
            'session_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())
                ->withErrors($validator->errors())
                ->withInput($req->all());
        }

        $groupObj = Group::findOrFail($id);
        $groupObj->group =  $req->group;
        $groupObj->session_id =  $req->session_id;
        $groupObj->status =  $req->status ?? 0;
        $groupObj->save();
        return redirect('admin/group/create')->with(['message' => 'Updated successfully !', 'alert-type' => 'success']);
    }



    public function delete($id)
    {
        $check = Gallery::where('group_id', $id)->count();
        if ($check > 0) {
            return redirect()->back()->with(['message' => 'Group has Gallery !', 'alert-type' => 'error']);
        }
        Group::whereId($id)->delete();
        return redirect('admin/group/create')->with(['message' => 'deleted successfully !', 'alert-type' => 'success']);
    }
}
