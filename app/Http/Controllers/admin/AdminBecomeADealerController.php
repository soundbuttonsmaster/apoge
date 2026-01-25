<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BecomeADealer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdminBecomDealerDataExport;

class AdminBecomeADealerController extends Controller
{
    public function index()
    {
        $becomeaDelearList = BecomeADealer::latest()->get();
        return view('admin.become-a-dealer', compact('becomeaDelearList'));
    }
    
     public function BecomeDealerDataexport()
    {
        // dd('sdf');
        return Excel::download(new AdminBecomDealerDataExport, 'becom_a_dealer.xlsx');
    }

    public function DeleteBecomeDealer($id)
    {
        $becomeaDelearObj = BecomeADealer::find($id);
        $becomeaDelearObj->delete();
        return redirect()->route('admin.become_a_dealer')->with(['status' => true, 'message' => 'Deleted Successfuly !', 'alert-type' => 'success']);
    }
}
