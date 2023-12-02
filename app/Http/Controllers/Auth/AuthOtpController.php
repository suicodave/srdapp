<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

use App\Models\User;
use App\Models\UserOtp;

class AuthOtpController extends Controller
{
    public function login()
    {
        return view('auth.otpLogin');
    }

    public function generate(Request $request)
    {
        /* Validate Data */
        $request->validate([
            'mobile_no' => 'required|exists:users,mobile_no'
        ]);
        $receiverNumber = $request->mobile_no;
        //$checknum = User::where('mobile_no',$request->mobile_no)->where('saStatus',1)->select('id')->count();
        //if($checknum == 0){
            //return redirect()->route('otp.login')->with('error', 'Not an admin!'); // redirect to other user like tech or cashier
       // }
        /* Generate An OTP */
        $userOtp = $this->generateOtp($receiverNumber);

        //dd($userOtp);
        //$accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        //$authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
       //$twilio_number = config('app.twilio')['TWILIO_FROM'];
        //$client = new Client($accountSid, $authToken);


        $userOtp->sendSMS($receiverNumber);

        return redirect()->route('otp.verification', ['user_id' => $userOtp->user_id])
                         ->with('success',  "OTP has been sent on Your Mobile Number.");
    }

    public function generateOtp($mobile_no)
    {
        $user = User::where('mobile_no', $mobile_no)->first();

        /* User Does not Have Any Existing OTP */
        $userOtp = UserOtp::where('user_id', $user->id)->latest()->first();

        $now = now();

        if($userOtp && $now->isBefore($userOtp->expire_at)){
            return $userOtp;
        }

        /* Create a New OTP */
        return UserOtp::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_at' => $now->addMinutes(10)
        ]);
    }

    public function verification($user_id)
    {
        return view('auth.otpVerification')->with([
            'user_id' => $user_id
        ]);
    }

    public function loginWithOtp(Request $request)
    {
        /* Validation */
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp' => 'required'
        ]);

        /* Validation Logic */
        $userOtp   = UserOtp::where('user_id', $request->user_id)->where('otp', $request->otp)->first();

        $now = now();
        if (!$userOtp) {
            return redirect()->back()->with('error', 'Your OTP is not correct');
        }else if($userOtp && $now->isAfter($userOtp->expire_at)){
            return redirect()->route('otp.login')->with('error', 'Your OTP has been expired');
        }

        $user = User::whereId($request->user_id)->first();
        if($user->saStatus == 1){
            if($user->saStatus == 1){
                User::where('id',$request->user_id)->update([
                    'islogin' =>  1,

                ]);
                if($user){

                    $userOtp->update([
                        'expire_at' => now()
                    ]);

                    Auth::login($user);

                    return redirect('/home');
                }
            }else{
                if($user->loginattemp > 3){
                    User::where('id',$request->user_id)->update([
                        'acountlock' =>  1,

                    ]);
                }
                User::where('id',$request->user_id)->update([
                    'loginattemp' => $user->loginattemp + 1,

                ]);

            }
            return redirect()->route('otp.login')->with('error', 'Your Otp is not correct');
        }
        return redirect()->route('otp.login')->with('error', 'Not allowed number!');
    }
}
