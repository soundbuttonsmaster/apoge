<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use Illuminate\Http\Request;
use PDO;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DealersImport;

class AdminDealerController extends Controller
{
    public function create(Request $request)
    {
        $query = Dealer::query();
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        $dealerList = $query->latest()->get();
        return view('admin.dealer.index', compact('dealerList'));
    }


 public function importExcel(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xls,xlsx',
    ]);

    Excel::import(new DealersImport, $request->file('file'));

    return redirect()->route('admin.dealer.create')->with(['status' => true, 'message' => 'Excel Imported Successfully', 'alert-type' => 'success']);
}

    public function store(Request $req)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'state' => 'required',
            'district' => 'required',
            'location' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())
                ->withErrors($validator->errors())
                ->withInput($req->all());
        }

        $dealerObj = new Dealer();
        $dealerObj->name = $req->name;
        $dealerObj->email = $req->email;
        $dealerObj->phone = $req->phone;
        $dealerObj->state = $req->state;
        $dealerObj->district = $req->district;
        $dealerObj->location = $req->location;
        $dealerObj->status = $req->status ?? 0;
        $dealerObj->save();

        return redirect()->route('admin.dealer.create')->with(['status' => true, 'message' => 'Created Successfuly', 'alert-type' => 'success']);
    }


    public function edit($id)
    {
        $data = Dealer::find($id);
        return view('admin.dealer.update', compact('data'));
    }


    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'state' => 'required',
            'district' => 'required',
            'location' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())
                ->withErrors($validator->errors())
                ->withInput($req->all());
        }

        $dealerObj = Dealer::find($id);
        $dealerObj->name = $req->name;
        $dealerObj->email = $req->email;
        $dealerObj->phone = $req->phone;
        $dealerObj->state = $req->state;
        $dealerObj->district = $req->district;
        $dealerObj->location = $req->location;
        $dealerObj->status = $req->status ?? 0;
        $dealerObj->save();

        return redirect()->route('admin.dealer.create')->with(['status' => true, 'message' => 'Updated Successfuly', 'alert-type' => 'success']);
    }


    public function delete($id)
    {
        $dealerObj = Dealer::find($id);
        $dealerObj->delete();


        return redirect()->route('admin.dealer.create')->with(['status' => true, 'message' => 'Delete Successfuly', 'alert-type' => 'success']);
    }
}
