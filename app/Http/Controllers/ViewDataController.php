<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccount;
class ViewDataController extends Controller
{
    public function viewEmployees(){
        $getempdata = DB::table('viewemployee')->select('name','email','mobile_no','status','position','description','branch_name')->get();
        return view('adminPanel.viewuseraccount')->with('empdata',$getempdata);
    }

    public function viewBookings(){

        $getstatus = DB::table('status')->select('statusid','statusname')->get();
        $getvehicletype = DB::table('classification_services')->select('id','vehicletype')->get();
        return view('adminPanel.viewbooking')->with('status',$getstatus)->with('vehicletype',$getvehicletype);
    }

    public function viewSalesData(){
        $getstatus = DB::table('status')->select('statusid','statusname')->get();
        $getvehicletype = DB::table('classification_services')->select('id','vehicletype')->get();
        $getSales = DB::table('viewsales')->select('bookingid','vehicletype','servicesname','bookingnumber','salesdate','tnxtype','actiontakenby','amountdue','cashier','invoicenumber','ispaid','statusname')->get();
        return view('adminPanel.viewsalesreport')->with('status',$getstatus)->with('vehicletype',$getvehicletype)->with('salesdata',$getSales);
    }

    public function downloadBooking(){
        $getauthid = Auth::user()->id;
        $getbranchauthid = UserAccount::where('employeeid',$getauthid)->pluck('branchid')->first();

        $dataB = DB::table('viewbookiing')->where('branchcode',$getbranchauthid)
        ->select('branch_name as Branch','bookingnumber as Booking Number','statusname as Status','fullname as Client Name','mobileNumber as Contact Number','washDate as Prefered Date','washTime as Prefered Time','email as Email','txnNumber as Transaction Number','vehicletype as Vehicle Type','servicesname as Services','detailer as Detailer')
        ->orderByDesc('postingDate')->get();
       

        $sheetsB = new SheetCollection([
            'Booking-Report' => $dataB,
        ]);
        $date = now()->format('Y-m-d-h-i-s');
        return (new FastExcel($sheetsB))->download('Booking-Report' . '-' . $date . '.xlsx');
    }

}
