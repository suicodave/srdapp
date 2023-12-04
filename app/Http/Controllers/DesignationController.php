<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesignationController extends Controller
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
        return redirect()->back()->withErrors(['error_msg' => 'Oops! Something went wrong. The data is already in use.']);
    }

    function Error5(){
        return redirect()->back()->withErrors(['error_msg' => 'Oops! User not found.']);
    }

    public function showDesignation(){
        $designation = Designation::select('id','position')->get();
        return view('adminPanel.designation')->with('designations',$designation);
    }

    public function postDesignation(Request $request){
        $checkdata = Validator::make($request->all(),[
            'designation' => 'required',
        ]);

        if($checkdata->fails()){
            return $this->Fails();
        }

        $designation = $request->designation;

        $datainsert = new Designation();
        $datainsert->position = $designation;
        $datainsert->save();

        return $this->Error1();
    }

    public function editDesigantions(Request $request){

        $designation = Designation::find($request->rid);
        if (!$designation) {
            return $this->Error5();
        }
        $checkdata = Validator::make($request->all(),[
            'designation' => 'required',
            'rid' => 'required',
        ]);
        if($checkdata->fails()){
            return $this->Fails();
        }
        $designation = $request->designation;
        $rid = $request->rid;

        Designation::where('id',$rid)->update([
            'position' => $designation,
        ]);

        return $this->Error2();
    }

    public function dropDesignation(Request $request){
        $checkid = Validator::make($request->all(),[
            'rowid' => 'required'
        ]);
        if($checkid->fails()){
            return $this->Fails();
        }

        $designid = $request->rowid;

        $checkua = UserAccount::where('designationid',$designid)->count();
        if ($checkua > 0 ) {
        return $this->Error4();
        }else{
        Designation::where('id',$designid)->delete();
        return $this->Error3();
        }
    }
}
