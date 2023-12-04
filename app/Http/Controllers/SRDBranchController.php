<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\SRDBranch;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SRDBranchController extends Controller
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

    public function showBranches(){
        $getBranch = SRDBranch::select('id','branch_name','status')->get();
        return view('adminPanel.branches')->with('databranches',$getBranch);
    }

    public function postBranches(Request $request){
       $checkdata = Validator::make($request->all(),[
            'branch' => 'required',
       ]);

       if($checkdata->fails()){
            return $this->Fails();
       }
       $branchname = $request->branch;

       $insertdata = new SRDBranch();
       $insertdata->branch_name = $branchname;
       $insertdata->status = 'Available';
       $insertdata->save();

       return $this->Error1();
    }

    public function editBranches( Request $request){

        $branch = SRDBranch::find($request->rid);
        if (!$branch) {
            return $this->Error5();
        }

        $checkdata = Validator::make($request->all(),[
            'branch' => 'required',
            'availability' => 'required',
            'rid' => 'required',
        ]);
        if($checkdata->fails()){
            return $this->Error2();
        }
        $branch = $request->branch;
        $availability = $request->availability;
        $rid = $request->rid;

        SRDBranch::where('id',$rid)->update([
            'branch_name' => $branch,
            'status' => $availability,
        ]);

        return $this->Error2();
    }

    public function dropBranches(Request $request){
        $checkid = Validator::make($request->all(),[
            'rowid' => 'required'
        ]);
        if($checkid->fails()){
            return $this->Fails();
        }

        $branchid = $request->rowid;

        $checkifexist = Booking::where('branchcode',$branchid)->select()->count();
        if ($checkifexist > 0 ) {
            return $this->Error5();
            }else{
            $deletebranch = SRDBranch::find($branchid);
            $deletebranch->delete();
            return $this->Error3();
            }
    }

}
