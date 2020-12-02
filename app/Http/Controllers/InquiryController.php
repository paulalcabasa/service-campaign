<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dealer;
use App\Models\Traviz;
use App\Models\Inquiry;
use Carbon\Carbon;

class InquiryController extends Controller
{

    public function index()
    {   
        $inquiry = new Inquiry;
        $customer_id = session('user')['customer_id'];
        $inquiries = [];
        if($customer_id != ""){
            $inquiries = $inquiry->getByDealer($customer_id);
        }
        else {
            $inquiries = $inquiry->get();
        }
        $data = [
            'inquiries' => $inquiries
        ];
        return view('inquiries', $data);
    }

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

    public function update(Request $request){
        $inquiry = Inquiry::findOrFail($request->inquiryId);
        $inquiry->receiving_manner = $request->mannerOfReceive;
        if($request->mannerOfReceive == "OTHERS"){
            $inquiry->others = $request->others;
        }
        $inquiry->completion_date = $request->completionDate;
        $inquiry->updated_at = Carbon::now();
        $inquiry->save();

        // $customer_id = session('user')['customer_id'];
        // $inquiries = [];
        // $inquiryData = new Inquiry;
        // if($customer_id != ""){
        //     $inquiries = $inquiryData->getByDealer($customer_id);
        // }
        // else {
        //    // $inquiries = $inquiry->get();
        // }

        return response()->json([
            'message' => 'Successfully updated.'
        ]);
    }
}
