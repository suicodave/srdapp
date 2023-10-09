<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

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

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile_no' => ['required', 'numeric', 'digits:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender' => ['required', 'string', 'min:12'],
            'secquestion' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:255'],
            'saStatus' => ['required', 'numeric', 'min:2'],
            'islogin' => ['required', 'numeric', 'min:2'],
            'loginattemp' => ['required', 'numeric', 'min:2'],
            'acountlock' => ['required', 'numeric', 'min:2'],
        ]);
    }

    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'mobile_no' => $data['mobile_no'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender'],
            'secquestion' => $data['secquestion'],
            'answer' => $data['answer'],
            'saStatus' => $data['saStatus'],
            'islogin' => $data['islogin'],
            'loginattemp' => $data['loginattemp'],
            'acountlock' => $data['acountlock'],
        ]);
    }


}
