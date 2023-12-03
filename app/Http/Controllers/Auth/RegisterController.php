<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    function Fails(){
        return redirect()->back()->withErrors(['error_msg' => 'Something went wrong. Please check you inputted data!']);
    }
    function Error1(){
        return redirect()->back()->withErrors(['save_msg' => 'Successfully save data!']);
    }
    function Error2(){
        return redirect()->back()->withErrors(['updated_msg' => 'Successfully updated data!']);
    }
    function Error3(){
        return redirect()->back()->withErrors(['delete_msg' => 'Successfully deleted data!']);
    }

    function Error4(){
        return redirect()->back()->withErrors(['error_msg' => 'Ooops!..Password is invalid!']);
    }

    function Error5(){
        return redirect()->back()->withErrors(['error_msg' => 'Ooops!.. Something went wrong. Data is already in use!']);
    }

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {

         return Validator::make($data, [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'password_confirmation' => ['required'],
            'gender' => ['required'],
            'mobile_no' => ['required'],
            'secquestion' => ['required'],
            'seckey' => ['required']
        ]);


    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function create(array $data)
    {


        $fullname = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $password_confirmation = $data['password'];
        $gender = $data['gender'];
        $mobile_no = $data['mobile_no'];
        $secquestion = $data['secquestion'];
        $answer = $data['seckey'];

        $checkiuserid = User::where('email',$email)->where('saStatus',1)->pluck('id')->first();
        if($checkiuserid == NULL){
            $status = 1;
        }else{
            $status = 0;
        }
        return User::create([
            'name' => $fullname,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make($password),
            'cpassword' => Hash::make($password_confirmation),
            'gender' => $gender,
            'mobile_no' => $mobile_no,
            'secquestion' => $secquestion,
            'answer' => $answer,
            'saStatus' => $status,
            'islogin' => 0,
            'loginattemp' => 0,
            'acountlock' => 0,

        ]);
    }

}
