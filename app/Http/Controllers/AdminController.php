<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Ramsey\Uuid\v1;

class AdminController extends Controller
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
        $valdata = Validator::make($request->all(),[
            'rowid' => 'required',
       ]);
       if($valdata->fails()){
            return $this->Fails();
       }
       $ids = $request->rowid;
       Classification::where('id',$ids)->delete();
       return $this->Error3();
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
        $valdata = Validator::make($request->all(),[
            'rowid' => 'required',
       ]);
       if($valdata->fails()){
            return $this->Fails();
       }
       $ids = $request->rowid;

       Services::where('sid',$ids)->delete();
       return $this->Error3();
    }


    public function ShowEmployees(){
            $getUsers = User::where('saStatus',0)
                        ->select('name','email','gender','mobile_no','status','loginattemp')->get();

            return view('adminPanel.employee')->with('usersdetails',$getUsers);
    }

    public function createEmployee(Request $request){

        $valdata = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'gender' => 'required',
            'mobile_no' => 'required',
            'secquestion' => 'required',
            'seckey' => 'required',
       ]);
       if($valdata->fails()){
            return $this->Fails();
       }

       $fullname = $request->name;
       $email = $request->email;
       $password = $request->password;
       $password_confirmation = $request->password_confirmation;
       $mobile_no = $request->mobile_no;
       $gender = $request->gender;
       $secquestion = $request->secquestion;
       $seckey = $request->seckey;

       $insertData = new User();
       $insertData->name = $fullname;
       $insertData->email = $email;
       $insertData->email_verified_at = now();
       $insertData->password = Hash::make($password);
       $insertData->cpassword = Hash::make($password_confirmation);
       $insertData->gender = $gender;
       $insertData->mobile_no = $mobile_no;
       $insertData->secquestion = $secquestion;
       $insertData->answer = $seckey;
       $insertData->saStatus = 0;
       $insertData->islogin = 0;
       $insertData->loginattemp = 0;
       $insertData->acountlock = 0;
       $insertData->save();
       return $this->Error1();
    }
}
