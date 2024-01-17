<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Notifications\SendSmsNotification;


class BookingController extends Controller
{
    function Fails(){
        return redirect()->back()->withErrors(['error_msg' => 'Something went wrong. Please check you inputted data!']);
    }

    function Error1(){
        return redirect()->back()->withErrors(['save_msg' => 'Successfully save booking!']);
    }

    function Error5(){
        return redirect()->back()->withErrors(['error_msg' => 'Ooops!.. Something went wrong. Date and time is not available. Please click on Schedule Menu for the date and time availability. Thank you!']);
    }



    public function bookservices(Request $request){

       $getvalidated = Validator::make($request->all(),[
            'fullname'=>'required',
            'mobilenumber'=>'required',
            'numvehicle' => 'required',
            'pdate'=>'required',
            'ptime'=>'required',
            'message'=>'required',
            'email' => 'required',
            'rid'=>'required',
            'sid'=>'required',
            'branchcode' => 'required',
       ]);
       if($getvalidated->fails()){
            return $this->Fails();
       }
        // Send an SMS notification before saving to the database
        //$user = auth()->user(); // Assuming you have user authentication
        //$user->notify(new SendSmsNotification());
        //dd($request->all());
       $bcode = $request->branchcode;
        $fullname = $request->fullname;
        $mobilenumber = $request->mobilenumber;
        $numbervehicle = $request->numvehicle;
        $pdate = $request->pdate;
        $ptime = $request->ptime;
        $message = $request->message;
        $email = $request->email;
        $classid = $request->rid;
        $servicesid = $request->sid;
        $bno=mt_rand(100000000, 999999999);

        $checkdatetime = Booking::where('washDate',$pdate)->where('washTime',$ptime)->count();

        if ($checkdatetime > 0) {
            return $this->Error5();
            }else{

            $insertbooking = new Booking();
            $insertbooking->classid = $classid;
            $insertbooking->servicesid = $servicesid;
            $insertbooking->branchcode = $bcode;
            $insertbooking->bookingnumber = $bno;
            $insertbooking->fullName = $fullname;
            $insertbooking->mobileNumber = $mobilenumber;
            $insertbooking->washDate = $pdate;
            $insertbooking->washTime = $ptime;
            $insertbooking->message = $message;
            $insertbooking->email = $email;
            $insertbooking->bookingstatus = 1;
            $insertbooking->numbervehicle = $numbervehicle;
            $insertbooking->save();
            return $this->Error1();
            }
    }
}
