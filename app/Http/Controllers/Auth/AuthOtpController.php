<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
    
        $receiverNumber = $request->mobile_no;
        $checknum = User::where('mobile_no',$request->mobile_no)->select('id')->count();
        if($checknum == 0){
            return redirect()->route('otp.login')->with('error', 'Not an admin!'); // redirect to other user like tech or cashier
        }
        /* Generate An OTP */
        $userOtp = $this->generateOtp($receiverNumber);

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

        $getotp = rand(123456, 999999);
        /* Create a New OTP */
        return UserOtp::create([
            'user_id' => $user->id,
            'otp' => $getotp,
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
        
            if($user->status == 'Active' || $user->status == 'SysAdmin'){
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
                return redirect()->back()->with('error','You are Banned by Admin! Please Contact the administrator');

            }
            return redirect()->route('otp.login')->with('error', 'Not allowes user!');
        
    }
    
}
