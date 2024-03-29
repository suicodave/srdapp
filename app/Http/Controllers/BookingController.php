<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Vonage\Client;
use Vonage\SMS\Message\SMS;


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

        $checkdatetime = Booking::where('branchcode',$bcode)->where('washDate',$pdate)->where('washTime',$ptime)->count();

        if ($checkdatetime > 0) {
            // echo "The date and time is already
            $timeString = "20:25";
            $timestamp = strtotime($timeString);
            $newTimestamp = $timestamp + 60;
            $newpTime = date("H:i", $newTimestamp);

            $newPhoneNumber = "63" . substr($mobilenumber, 1);
            $message = "Hi!" .$fullname. " We have booking priority as of this time, but don't worry, we'll set a time for you. Your booking number is ".$bno. " dated ".$pdate. " at time".$newpTime;

            $basic = new \Vonage\Client\Credentials\Basic(env('VONAGE_KEY',null), env('VONAGE_SECRET',null));
            $client = new Client($basic);
            $response = $client->sms()
            ->send(new SMS("$newPhoneNumber",env('VONAGE_SMS_FROM',null),"$message"));

            $insertbooking = new Booking();
            $insertbooking->classid = $classid;
            $insertbooking->servicesid = $servicesid;
            $insertbooking->branchcode = $bcode;
            $insertbooking->bookingnumber = $bno;
            $insertbooking->fullName = $fullname;
            $insertbooking->mobileNumber = $mobilenumber;
            $insertbooking->washDate = $pdate;
            $insertbooking->washTime = $newpTime;
            $insertbooking->message = $message;
            $insertbooking->email = $email;
            $insertbooking->bookingstatus = 1;
            $insertbooking->numbervehicle = $numbervehicle;
            $insertbooking->save();

            return $this->Error1();


            }else{

            $newPhoneNumber = "63" . substr($mobilenumber, 1);
            $message = "Hi!" .$fullname. " Your booking number is ".$bno;

            $basic = new \Vonage\Client\Credentials\Basic(env('VONAGE_KEY',null), env('VONAGE_SECRET',null));
            $client = new Client($basic);
            $response = $client->sms()
            ->send(new SMS("$newPhoneNumber",env('VONAGE_SMS_FROM',null),"$message"));

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
