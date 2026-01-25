<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FindADealer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FindADealerExport;

class AdminFindADealerController extends Controller
{
    public function index()
    {
        $findDelaerList = FindADealer::latest()->get();
        return view('admin.find-a-dealer', compact('findDelaerList'));
    }
    
        public function FindDealerDataexport(){
        return Excel::download(new FindADealerExport, 'find_a_dealer.xlsx');
    }

    public function DeleteFindADealer($id){
        $findDelaerObj = FindADealer::find($id);
        $findDelaerObj->delete();
        return redirect()->route('admin.find_a_dealer')->with(['status' => true, 'message' => 'Deleted Successfuly', 'alert-type' => 'success']);
    }
}
