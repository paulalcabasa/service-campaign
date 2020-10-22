<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dealer;
use App\Models\Traviz;
use App\Models\Inquiry;

class InquiryController extends Controller
{
   
    public function store(Request $request){
       
        $inquiry = new Inquiry;
        $inquiry->registered_owner = $request->inquiry['registered_owner'];
        $inquiry->contact_person = $request->inquiry['contact_person'];
        $inquiry->contact_number = $request->inquiry['contact_number'];
        $inquiry->email_address = $request->inquiry['email_address'];
        $inquiry->preferred_servicing_dealer = $request->inquiry['preferred_servicing_dealer'];
        $inquiry->cs_no = $request->vehicle['cs_no'];
        $inquiry->save();
        return [
            'message' => 'Inquiry for this model has been sent.',
            'status' => 'success'
        ];
    }

    public function traviz2020()
    {   
        $dealers = Dealer::orderBy('account_name', 'ASC')
                ->selectRaw('id, initcap(lower(account_name)) account_name')
                ->whereNotIn('id', [3])
                ->get();
      
        $data = [
            'dealers' => $dealers
        ];
        return view('traviz_service_campaign_2020', $data);
    }

    public function findVehicle(Request $request)
    {
        $param = $request->searchParam;
        $traviz = new Traviz;
        $details = $traviz->getDetails($param);
        return response()->json($details);
    }
}
