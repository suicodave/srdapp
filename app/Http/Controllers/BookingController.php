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
        return redirect()->back()->withErrors(['save_msg' => 'Successfully save data!']);
    }

    function Error2(){
        return redirect()->back()->withErrors(['updated_msg' => 'Successfully updated!']);
    }

    function Error3(){
        return redirect()->back()->withErrors(['delete_msg' => 'Successfully deleted!']);
    }

    function Error4(){
        return redirect()->back()->withErrors(['error_msg' => 'Ooops!.. Something went wrong. Data id is already in use!']);
    }



    public function bookservices(Request $request){

       $getvalidated = Validator::make($request->all(),[
            'fullname'=>'required',
            'mobilenumber'=>'required',
            'pdate'=>'required',
            'ptime'=>'required',
            'message'=>'required',
            'email' => 'required',
            'rid'=>'required',
            'sid'=>'required',
       ]);

       if($getvalidated->fails()){
            return $this->Fails();
       }

        // Send an SMS notification before saving to the database
        //$user = auth()->user(); // Assuming you have user authentication
        //$user->notify(new SendSmsNotification());
        //dd($request->all());
        $fullname = $request->fullname;
        $mobilenumber = $request->mobilenumber;
        $pdate = $request->pdate;
        $ptime = $request->ptime;
        $message = $request->message;
        $email = $request->email;
        $classid = $request->rid;
        $servicesid = $request->sid;
        $bno=mt_rand(100000000, 999999999);

        $insertbooking = new Booking();
        $insertbooking->classid = $classid;
        $insertbooking->servicesid = $servicesid;
        $insertbooking->branchcode = 'Maranding';
        $insertbooking->bookingnumber = $bno;
        $insertbooking->fullName = $fullname;
        $insertbooking->mobileNumber = $mobilenumber;
        $insertbooking->washDate = $pdate;
        $insertbooking->washTime = $ptime;
        $insertbooking->message = $message;
        $insertbooking->email = $email;
        $insertbooking->bookingstatus = 'New';
        $insertbooking->save();

        return $this->Error1();

    }
}
