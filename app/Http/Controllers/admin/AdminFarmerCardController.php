<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FarmerRegistration;
use Carbon\Carbon; // Upar use karna hoga agar nahi kiya


class AdminFarmerCardController extends Controller
{

   public function FarmerRegistrationList(Request $request)
{
    $query = FarmerRegistration::query();

    if ($request->filled('customer_id')) {
        $query->where('customer_id', $request->input('customer_id'));
    }
    if ($request->filled('phone')) {
        $query->where('phone', $request->input('phone'));
    }
    if ($request->filled('state')) {
        $query->where('state', 'like', '%' . $request->input('state') . '%');
    }
    if ($request->filled('district')) {
        $query->where('district', 'like', '%' . $request->input('district') . '%');
    }
    if ($request->filled('city')) {
        $query->where('city', 'like', '%' . $request->input('city') . '%');
    }

    // 👇 Pagination: 10 records per page
    $farmerRegistrationList = $query->orderBy('created_at', 'desc')->paginate(50);

    return view('admin.farmer-register.index', compact('farmerRegistrationList'));
}


    // public function ganrateFarmerCard($id){
    //     // dd($id);
    //     $farmerCardObj = FarmerRegistration::find($id);
    //     dd($farmerCardObj);
    // }


    public function ganrateFarmerCard($id)
    {
        // Farmer record find karo
        $farmerCardObj = FarmerRegistration::find($id);

        if (!$farmerCardObj) {
            // return response()->json(['message' => 'Farmer not found'], 404);
            return redirect()->back()->with(['status' => true, 'message' => 'Farmer Not Found', 'alert-type' => 'error']);
        }

        // 16 digit ka unique card number generate karo
        do {
            $cardNumber = '';
            for ($i = 0; $i < 16; $i++) {
                $cardNumber .= mt_rand(0, 9);
            }
        } while (FarmerRegistration::where('card_number', $cardNumber)->exists());

        // Expiry date calculate karo (current month + 3 months)
        $expiryDate = Carbon::now()->addMonths(3)->endOfMonth(); // Example: April me generate kiya to July ka last date

        // Card details save karo
        $farmerCardObj->card_number = $cardNumber;
        $farmerCardObj->expiry_date = $expiryDate;
        $farmerCardObj->card_ganrate_status = 1;
        $farmerCardObj->save();


        return redirect()->back()->with(['status' => true, 'message' => 'Farmer card generated successfully', 'alert-type' => 'success']);

    }


    public function ViewFarmerCard($id){
        // dd($id);
        $farmerCard = FarmerRegistration::find($id);
        return view('admin.farmer-register.view-card', compact('farmerCard'));
    }
}
