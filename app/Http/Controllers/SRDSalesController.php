<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingPriority;
use App\Models\SRDSales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PendingForPaymentTemp;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SRDSalesController extends Controller
{
    function Fails(){
        return redirect()->back()->withErrors(['error_msg' => 'Something went wrong. Please check you inputted data!']);
    }

    function Error1(){
        return redirect()->back()->withErrors(['save_msg' => 'Successfully save data!']);
    }

    function Error2(){
        return redirect()->back()->withErrors(['updated_msg' => 'Successfully updated!']);
    }

    function Error3(){
        return redirect()->back()->withErrors(['delete_msg' => 'Successfully deleted!']);
    }

    function Error4(){
        return redirect()->back()->withErrors(['error_msg' => 'Oops! Something went wrong. The data is already in use.']);
    }

    function Error5(){
        return redirect()->back()->withErrors(['error_msg' => 'Oops! User not found.']);
    }

    public function viewForPayment(){

        $getforpaymemt = DB::table('viewpendingforpayment')
                ->select('salesid','bookingnumber','clients','vehicletype','servicesname','branch_name','washDate','washTime','postingdate','status')->get();

        return view('adminPanel.pos')->with('clientsbooking',$getforpaymemt);
    }

    public function storePayment(Request $request){


        if($request->req == 'Cancel'){
            PendingForPaymentTemp::query()->delete();
            return redirect('/show-for-payment');
        }

        $checkdata = Validator::make($request->all(),[
            'salesid' => 'required',
        ]);
        if($checkdata->fails()){
            return $this->Fails();
        }
        foreach($request->salesid as $itemid){
            $insid = new PendingForPaymentTemp();
            $insid->salesid = $itemid;
            $insid->maker = Auth::user()->name;
            $insid->save();
        }

        $getdata = DB::table('viewpendingforpayment_tmp')->select('salesid','bookingid','bookingnumber','vehicletype','servicesname','price','clients','postingdate','performedby')->get();

        return view('adminPanel.createPOS')->with('salesid',$getdata);
    }

    public function postPayment(Request $request){

            if($request->req == 'CancelPayment'){
              PendingForPaymentTemp::where('maker',Auth::user()->name)->delete();
              return redirect('/show-for-payment');
            }

            if($request->req == 'SavePayment'){

                $validatedata = Validator::make($request->all(),[
                    'amtchange' => 'required',
                    'initialamount' => 'required',
                    'amountdue' => 'required',
                    'salesid' => 'required',
                    'invoice' => 'required',
                    'bookingid' => 'required',
                ]);

                if($validatedata->fails()){
                    return redirect('/show-for-payment');
                }

                $amountdue = $request->amountdue;
                $initialamount = $request->initialamount;
                $amtchange = $request->amtchange;
                $invoice = $request->invoice;
                $paymentmode = $request->paymentmode;

                foreach($request->salesid as $salesitem){
                       SRDSales::where('salesid',$salesitem)->update([
                            'salesdate' => date('m-d-y'),
                            'status'=> 4,//completed
                            'amountdue' => $amountdue,
                            'initialamount' => $initialamount,
                            'amtchange' => $amtchange,
                            'invoicenumber' => $invoice,
                            'ispaid' => 1,
                            'cashier'=> Auth::user()->name,
                            'tnxtype' => $paymentmode,
                       ]);
                }
                foreach($request->bookingid as $bookingiditem){
                    Booking::where('id',$bookingiditem)->update([
                        'bookingstatus' => 4, //completed
                        'paymentMode' => $paymentmode,
                        'postingDate' => now(),
                        'amount' => $amountdue,
                    ]);

                    BookingPriority::where('bookingId',$bookingiditem)->update([
                        'status' => 4,//completed
                    ]);
                }
                PendingForPaymentTemp::where('maker',Auth::user()->name)->delete();
                return redirect('/show-for-payment');
            }
    }
}
