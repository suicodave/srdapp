<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session;

class ResetPasswordController extends Controller
{
    function Fails(){
        return redirect()->back()->withErrors(['error' => 'Something went wrong. Please check you inputted data!']);
    }

    function Error1(){
      
        return redirect()->route('login')->withErrors(['save_msg' => 'Your password has been successfully updated! You will be logged out after changing your password.']);

    }

    function Error2(){
        return redirect()->back()->withErrors(['updated_msg' => 'Successfully updated!']);
    }

    function Error5(){
        return redirect()->back()->withErrors(['error_msg' => 'Oops! It seems there was an issue. The current password or security key you provided is incorrect. Please double-check and try again.']);
    }
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    public function editpassword(Request $request){
            dd($request->all());
    }  
    
    public function editUserPassword(Request $request){
        $getpasskey = User::where('id',Auth::user()->id)->pluck('cpassword')->first();
        $getSeckey = User::where('id',Auth::user()->id)->pluck('answer')->first();

        $checkdata = Validator::make($request->all(),[
            'currpass'=>'required',
            'newpass'=>'required',
            'confirmpass'=>'required',
            'seckey'=>'required',
        ]);

        if($checkdata->fails()){
            return $this->Fails();
        }

        $currentPass = $request->currpass;
        $newPass = $request->newpass;
        $confirmPass = $request->confirmpass;
        $secretKey = $request->seckey;

        $hashpass =  Hash::make($currentPass);

        if(Hash::check($currentPass, $getpasskey) && $secretKey == $getSeckey){
           User::where('id',Auth::user()->id)->update([
                'password' =>  Hash::make($newPass),
                'cpassword' => Hash::make($confirmPass),
                'islogin' => 0,
           ]);
            Auth::logout();
            return $this->Error1();
        }else{
            return $this->Error5();
        }

    }
    //use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
