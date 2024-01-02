<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BookingPriority;
use App\Models\SRDSales;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class AdminBookingController extends Controller
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
        return redirect()->back()->withErrors(['error_msg4' => 'Oops! Something went wrong. The data is already in use.']);
    }
    function Error6(){
        return redirect()->back()->withErrors(['error_msg5' => 'Oops! Something went wrong. Duplicate entry!.']);
    }
    public function viewbooking(){
        $getbooking = DB::table('booking')
                        ->leftJoin('classification_services','classification_services.id','booking.classid')
                        ->leftJoin('srdservices','srdservices.sid','booking.servicesid')
                        ->leftJoin('srdbranch','srdbranch.id','booking.branchcode')
                        ->leftJoin('status','status.statusid','booking.bookingstatus')
                        ->select('booking.id','status.statusname','booking.bookingnumber','srdbranch.branch_name','booking.fullName','booking.txnNumber','classification_services.vehicletype as classid','booking.mobileNumber','srdservices.servicesname as servicesid','booking.branchcode','booking.washDate','booking.washTime','booking.message','booking.bookingstatus','booking.created_at')->get();

        return view('adminPanel.bookingdetails')->with('bookings',$getbooking);
    }

    public function viewClientBookings(){ //this is for client booking
        $getclientbooking = DB::table('booking')->where('booking.txnNumber', '!=', '')
                        ->leftJoin('classification_services','classification_services.id','booking.classid')
                        ->leftJoin('srdservices','srdservices.sid','booking.servicesid')
                        ->leftJoin('bookingpriority','bookingpriority.bookingId','booking.id')
                        ->leftJoin('status','status.statusid','booking.bookingstatus')
                        ->leftJoin('srdbranch','srdbranch.id','booking.branchcode')

                        ->select('booking.id','status.statusname','bookingpriority.prioritynumber','srdbranch.branch_name','bookingpriority.dateprocess','bookingpriority.updated_at','booking.bookingnumber','booking.fullName','booking.txnNumber','classification_services.vehicletype as classid','booking.mobileNumber','srdservices.servicesname as servicesid','booking.branchcode','booking.washDate','booking.washTime','booking.message','booking.bookingstatus','booking.created_at')->get();

        return view('adminPanel.clientbooking')->with('clientbookings',$getclientbooking);
    }

    public function showClientBookings($cid){
        $getbooking = DB::table('booking')->where('booking.id',$cid)
        ->leftJoin('classification_services','classification_services.id','booking.classid')
        ->leftJoin('srdservices','srdservices.sid','booking.servicesid')
        ->leftJoin('bookingpriority','bookingpriority.bookingId','booking.id')
        ->leftJoin('status','status.statusid','booking.bookingstatus')
        ->leftJoin('srdbranch','srdbranch.id','booking.branchcode')
        ->select('booking.id','booking.bookingnumber','booking.numbervehicle','srdbranch.branch_name','status.statusname','bookingpriority.pid','bookingpriority.prioritynumber','bookingpriority.dateprocess','booking.txnNumber','booking.fullName','classification_services.vehicletype as classid','booking.mobileNumber','srdservices.servicesname as servicesid','srdservices.price','booking.branchcode','booking.washDate','booking.washTime','booking.message','booking.bookingstatus','booking.created_at','booking.email')->get();

        return view('adminPanel.showclientbookingdetails')->with('bookings',$getbooking);
    }

    public function proceedclientbookings(Request $request){

            $checkdata = Validator::make($request->all(),[
                'maxnumtime'=>'required|numeric',
                'browid'=>'required|numeric',
                'prowid'=>'required|numeric',
            ]);

            if($checkdata->fails()){
                return $this->Fails();
            }

            $maxtime = $request->maxnumtime;
            $bid = $request->browid;
            $pid = $request->prowid;
            $status = 3;

            BookingPriority::where('pid',$pid)->update([
                'maxtimeprocess' => $maxtime,
                'status' => $status,
            ]);

            Booking::where('id',$bid)->update([
                'bookingStatus' => $status,
            ]);
            return redirect('/show-client-booking');


    }

    public function finishedClientsBooking($bid, $pid){
            $check = SRDSales::where('bookingid',$bid)->select('salesid')->count();
            if($check >0){
                return $this->Error6();
            }

           Booking::where('id',$bid)->update([
            'bookingstatus' => '4',
            'employeeid' => Auth::user()->name,
           ]);

           BookingPriority::where('pid',$pid)->update([
                'status' => '4',
           ]);

           $inssales = new SRDSales();
           $inssales->bookingid = $bid;
           $inssales->bpid = $pid;
           $inssales->status = 'Pending for Payment';
           $inssales->actiontakenby = Auth::user()->name;
           $inssales->save();
           return redirect('/show-client-booking');


    }

    public function showbookingdetails($bid){

        $getbooking = DB::table('booking')->where('booking.id',$bid)
        ->leftJoin('classification_services','classification_services.id','booking.classid')
        ->leftJoin('srdservices','srdservices.sid','booking.servicesid')
        ->leftJoin('srdbranch','srdbranch.id','booking.branchcode')
        ->leftJoin('status','status.statusid','booking.bookingstatus')
        ->select('booking.id','booking.bookingnumber','booking.numbervehicle','status.statusname','booking.txnNumber','srdbranch.branch_name','booking.fullName','classification_services.vehicletype as classid','booking.mobileNumber','srdservices.servicesname as servicesid','srdservices.price','booking.branchcode','booking.washDate','booking.washTime','booking.message','booking.bookingstatus','booking.created_at','booking.email')->get();

        return view('adminPanel.viewbookingdetails')->with('bookings',$getbooking);

    }


    public function updateBooking(Request $request){

        $valdate = Validator::make($request->all(),[
            'txnno' => 'required',
            'bookingid' => 'required',
            'pn' => 'required',
        ]);
        if($valdate->fails()){
            return $this->Fails();
        }

        $tnxno = $request->txnno;
        $bookingid = $request->bookingid;
        $dateprocess = date('myd');
        $pn = $request->pn;

        Booking::where('id',$bookingid)->update([
                'txnNumber' => $tnxno,
                'bookingstatus' => 2,
        ]);

        $insbookingpn = new BookingPriority();
        $insbookingpn->bookingId = $bookingid;
        $insbookingpn->prioritynumber = $pn;
        $insbookingpn->dateprocess = $dateprocess;
        $insbookingpn->maker = Auth::user()->name;
        $insbookingpn->status = 2;
        $insbookingpn->save();

        return redirect()->route('showbooking')->withErrors('updated_msg', 'Successfully updated!');
    }

    public function bookedschedule(){

        $getbooking = DB::table('booking')->where('bookingstatus',1)
                                ->leftJoin('classification_services','classification_services.id','booking.classid')
                                ->leftJoin('srdservices','srdservices.sid','booking.servicesid')
                                ->select('booking.id','booking.bookingnumber','booking.fullName','classification_services.vehicletype as classid','booking.mobileNumber','srdservices.servicesname as servicesid','srdservices.price','booking.branchcode','booking.washDate','booking.washTime','booking.message','booking.bookingstatus','booking.created_at','booking.email')->get();

                                return view('adminPanel.scheduling')->with('events',$getbooking);
    }



    public function ShowBookingUsers(){
        return 'userview';
    }

    public function ShowBookingTech(){
        return 'techview';
    }
}
