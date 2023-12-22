<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Classification;
use App\Models\Employee;
use App\Models\Services;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Ramsey\Uuid\v1;

class AdminController extends Controller
{
    function Fails(){
        return redirect()->back()->withErrors(['error' => 'Something went wrong. Please check you inputted data!']);
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

    public function showIndex(){
        return view('index');
    }

    public function showAbout(){
        return view('about');
    }

    public function showServices(){
        return view('services');
    }

    public function storeServicesClass(){
        $getdata = Classification::select('id','vehicletype','status')->get();
        return view('adminPanel.classification')->with('dataserclass',$getdata);
    }

    public function postClassification(Request $request){

        $dataval = Validator::make($request->all(),[
            'classification' => 'required'
        ]);
        if($dataval->fails()){
            return $this->Fails();
        }
        $dataclass = $request->classification;
        $datainsert = new Classification();
        $datainsert->vehicletype = $dataclass;
        $datainsert->status = 1;
        $datainsert->maker = Auth::user()->name;
        $datainsert->save();
        return $this->Error1();
    }

    public function editClassification(Request $request){
       $valdata = Validator::make($request->all(),[
            'classification' => 'required',
            'rid' => 'required',
       ]);
       if($valdata->fails()){
            return $this->Fails();
       }
       $valclass = $request->classification;
       $id = $request->rid;

       Classification::where('id',$id)->update([
            'vehicletype' => $valclass,
       ]);
       return $this->Error2();
    }

    public function dropClassification(Request $request){
        $checkid = Validator::make($request->all(),[
            'rowid' => 'required'
        ]);
        if($checkid->fails()){
            return $this->Fails();
        }

        $servicesid = $request->rowid;

        $checkservices = Services::where('classification',$servicesid)->count();
        if ($checkservices > 0) {
        return $this->Error4();
        }else{
        Classification::where('id',$servicesid)->delete();
        return $this->Error3();
        }
    }

    public function storeServices()
    {
        $getclassification = Classification::select('id','vehicletype')->get();
        $showServices = DB::table('srdservices')
                    ->select('srdservices.sid','srdservices.servicesname','srdservices.price','srdservices.status','classification_services.vehicletype','classification_services.id')

                    ->leftJoin('classification_services','classification_services.id','srdservices.classification')
                    ->get();
        return view('adminPanel.services')->with('classes',$getclassification)->with('services',$showServices);
    }

    public function postServices(Request $request){

        $valdata = Validator::make($request->all(),[
            'servicesname' => 'required',
            'classid' => 'required',
            'price' => 'required',
       ]);
       if($valdata->fails()){
            return $this->Fails();
       }

       $servicesname = $request->servicesname;
       $classificationid = $request->classid;
       $price = $request = $request->price;

       $insservices = new Services();
       $insservices->servicesname = $servicesname;
       $insservices->classification = $classificationid;
       $insservices->price =$price;
       $insservices->status = 'Available';
       $insservices->maker = Auth::user()->name;
       $insservices->save();
       return $this->Error1();
    }

    public function servicesUpdate(Request $request){

        $valdata = Validator::make($request->all(),[
            'rid' => 'required',
            'classid' => 'required',
            'price' => 'required',
            'servicesname' => 'required',
            'status' => 'required',
       ]);
       if($valdata->fails()){
            return $this->Fails();
       }

       $servicesname = $request->servicesname;
       $classificationid = $request->classid;
       $price  = $request->price;
       $status = $request->status;
       $id = $request->rid;

       Services::where('sid',$id)->update([
            'servicesname' => $servicesname,
            'classification' => $classificationid,
            'price' => $price,
            'status' =>  $status,
       ]);

       return $this->Error2();
    }

    public function dropservices(Request $request){
        $checkid = Validator::make($request->all(),[
            'rowid' => 'required'
        ]);
        if($checkid->fails()){
            return $this->Fails();
        }
        $sid = $request->rowid;

        $checkbooking = Booking::where('servicesid',$sid)->count();
        if ($checkbooking >0) {
        return $this->Error4();
        }else{
        Services::where('sid',$sid)->delete();
        return $this->Error3();
        }
    }

    public function ShowEmployees(){

            $getUsers = User::select('id','name','email','gender','mobile_no','status','loginattemp','password','cpassword','secquestion','answer')->get();

            return view('adminPanel.employee')->with('usersdetails',$getUsers);
    }

    public function createEmployee(Request $request){

        $valdata = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'gender' => 'required',
            'mobile_no' => 'required',
            'secquestion' => 'required',
            'seckey' => 'required',
       ]);

       if($valdata->fails()){
            return $this->Fails();
       }

       $check = DB::table('users')->select('id')->count();

       if(empty($check==0)){
            $saStatus = $check + 1;
       }
       $saStatus = $check + 1;

       $fullname = $request->name;
       $email = $request->email;
       $password = $request->password;
       $mobile_no = $request->mobile_no;
       $gender = $request->gender;
       $secquestion = $request->secquestion;
       $seckey = $request->seckey;

       $insertData = new User();
       $insertData->name = $fullname;
       $insertData->email = $email;
       $insertData->email_verified_at = now();
       $insertData->password = Hash::make($password);
       $insertData->cpassword = Hash::make($password);
       $insertData->gender = $gender;
       $insertData->mobile_no = $mobile_no;
       $insertData->secquestion = $secquestion;
       $insertData->answer = $seckey;
       $insertData->status = 'Active';
       $insertData->saStatus = $saStatus;
       $insertData->islogin = 0;
       $insertData->loginattemp = 0;
       $insertData->acountlock = 0;
       $insertData->save();
       return $this->Error1();
    }

    public function updateEmployee(Request $request){

        $user = User::find($request->rid);
        if (!$user) {
            return $this->Error5();
        }
        $checkdata = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->rid,
            'mobile_no' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'secquestion' => 'required',
            'seckey' => 'required',
            'rid' => 'required',
           ]);
        if($checkdata->fails()){
            return $this->Fails();
        }

        $fname = $request->name;
        $email = $request->email;
        $password = $request->password;
        $mobile_no = $request->mobile_no;
        $gender = $request->gender;
        $secquestion = $request->secquestion;
        $seckey = $request->seckey;
        $rowid = $request->rid;
        $status = $request->status;

        User::where('id',$rowid)->update([
            'name' => $fname,
            'email' => $email,
            'email_verified_at' => $email,
            'password' => Hash::make($password),
            'cpassword' => Hash::make($password),
            'mobile_no' => $mobile_no,
            'gender' => $gender,
            'status' => $status,
            'secquestion' => $secquestion,
            'answer' => $seckey,
        ]);
        return $this->Error2();
    }

    public function dropEmployee(Request $request){
        $checkid = Validator::make($request->all(),[
            'rowid' => 'required'
        ]);
        if($checkid->fails()){
            return $this->Fails();
        }

        $empid = $request->rowid;
        $checkua = UserAccount::where('employeeid',$empid)->count();
        $checkbook = Booking::where('employeeid',$empid)->count();
        if ($checkua > 0 || $checkbook > 0) {
            return $this->Error4();
            }else{
            User::where('id',$empid)->delete();
            return $this->Error3();
            }
    }

    public function availableschedule(){
        return view('availableschedule');
    }
}
