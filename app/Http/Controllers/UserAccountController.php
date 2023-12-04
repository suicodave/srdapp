<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\SalaryGrade;
use App\Models\SRDBranch;
use App\Models\UserAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
use Exception;

class UserAccountController extends Controller
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

    public function showSalaries(){
        $getsalary = SalaryGrade::select('sgid','sgcode','description','period','amount')->get();
        return view('adminPanel.salarygrade')->with('salaries',$getsalary);
    }

    public function showUserAccounts(){
        $getAccount = DB::table('useraccount')
                    ->leftJoin('users', 'users.id','useraccount.employeeid')
                    ->leftJoin('designation', 'designation.id','useraccount.designationid')
                    ->leftJoin('srdbranch', 'srdbranch.id','useraccount.branchid')
                    ->leftJoin('salaraygrade','salaraygrade.sgid','useraccount.salarygrade')
                    ->select('useraccount.id','useraccount.employeeid','useraccount.designationid','useraccount.branchid','useraccount.salarygrade','users.name','srdbranch.branch_name','designation.position','salaraygrade.amount','useraccount.status')
                    ->get();

        //$getEmployee = User::where('status','Active')->where('saStatus','>',1)->select('id','name')->get();
        $getEmployee = DB::table('users')
                            ->leftJoin('useraccount','useraccount.employeeid','users.id')
                            ->whereNull('useraccount.employeeid')
                            ->where('users.status','Active')->where('users.saStatus','>',1)
                            ->select('users.id','users.name')->get();

        $getBranch = SRDBranch::where('status','Available')->select('id','branch_name')->get();
        $getSalary = SalaryGrade::select('sgid','sgcode','description','period','amount')->get();
        $getDesignation = Designation::select('id','position')->get();

        return view('adminPanel.useraccount')->with('accounts',$getAccount)->with('branches',$getBranch)
                ->with('designations',$getDesignation)->with('users',$getEmployee)->with('salaries',$getSalary);
    }

    public function addUserAccounts(Request $request){
        $checkdata = Validator::make($request->all(),[
            'employeeid' => 'required',
            'branchid' => 'required',
            'designationid' => 'required',
            'salaryid' => 'required',
        ]);

        if($checkdata->fails()){
            return $this->Fails();
        }

        $employeeid = $request->employeeid;
        $branchid = $request->branchid;
        $designationid = $request->designationid;
        $salaryid = $request->salaryid;
        //Checking for existing account

        $exist = UserAccount::where([['employeeid',$employeeid], ['branchid',$branchid], ['designationid',$designationid], ['status','Active']])->first();

        if($exist){
            session()->flash('success', 'The operation was successful.');
            return redirect()->back()->withErrors(['error_msg' => 'Oops! Something went wrong. The data is already in use.']);
        }else{
           $getb = UserAccount::where('employeeid',$employeeid)->where('designationid',$designationid)->select('id')->count();
           //dd($getb);

            if($getb==1){
                $getb1 = UserAccount::where('employeeid',$employeeid)->where('designationid',$designationid)->where('branchid','!=',$branchid)->where('status','Active')->select('id')->count();
                $getb2 = UserAccount::where('employeeid',$employeeid)->where('designationid','!=',$designationid)->where('branchid',$branchid)->where('status','Active')->select('id')->count();
                if($getb1==1 || $getb2==1){
                    return redirect()->back()->withErrors(['error_msg' => 'Oops! Something went wrong. The user can not have the same designation in different branches or different designation in the same branches.']);
                }
                //dd($getb2);
                try {
                    DB::beginTransaction();
                    $addAccnt = new UserAccount();
                    $addAccnt->employeeid = $employeeid;
                    $addAccnt->branchid = $branchid;
                    $addAccnt->designationid = $designationid;
                    $addAccnt->salarygrade = $salaryid;
                    $addAccnt->status = 'Active';
                    $addAccnt->save();
                    DB::commit();
                    return $this->Error1();
                    } catch (Exception $exc) {
                        DB::rollBack();
                        echo $exc->getMessage();
                        die();
                    }
            }
            $getb1 = UserAccount::where('employeeid',$employeeid)->where('designationid',$designationid)->where('branchid','!=',$branchid)->where('status','Active')->select('id')->count();
            $getb2 = UserAccount::where('employeeid',$employeeid)->where('designationid','!=',$designationid)->where('branchid',$branchid)->where('status','Active')->select('id')->count();
            $getb3 = UserAccount::where('employeeid','!=',$employeeid)->where('designationid',$designationid)->where('branchid',$branchid)->where('status','Active')->select('id')->count();

            if($getb1==1 || $getb2==1 || $getb3==1){
                return redirect()->back()->withErrors(['error_msg' => 'Oops! Something went wrong. The user can not have the same designation in different branches or different designation in the same branches.']);
            }
            try {
                DB::beginTransaction();
                $addAccnt = new UserAccount();
                $addAccnt->employeeid = $employeeid;
                $addAccnt->branchid = $branchid;
                $addAccnt->designationid = $designationid;
                $addAccnt->salarygrade = $salaryid;
                $addAccnt->status = 'Active';
                $addAccnt->save();
                DB::commit();
                return $this->Error1();
                } catch (Exception $exc) {
                    DB::rollBack();
                    echo $exc->getMessage();
                    die();
                }
        }
    }

    public function editUserAccounts(Request $request){

        $checkdata = Validator::make($request->all(),[
            'employeeid' => 'required',
            'branchid' => 'required',
            'designationid' => 'required',
            'salaryid' => 'required',
            'status' => 'required',
            'rid' => 'required',
        ]);

        if($checkdata->fails()){
            return $this->Fails();
        }

        $employeeid = $request->employeeid;
        $branchid = $request->branchid;
        $designationid = $request->designationid;
        $salaryid = $request->salaryid;
        $status = $request->status;
        $rid = $request->rid;

        //Checking for existing account
        $checkemp = User::find($employeeid);
        if(empty($checkemp)){
            return $this->Error5();
        }

        $checkbid = SRDBranch::find($branchid);
        if(empty($checkbid)){
            return $this->Error5();
        }

        $checkdid = Designation::find($designationid);
        if(empty($checkdid)){
            return $this->Error5();
        }

        $checkdid = SalaryGrade::find($salaryid);
        if(empty($checkdid)){
            return $this->Error5();
        }
        $exist = UserAccount::where([['employeeid',$employeeid], ['branchid',$branchid], ['designationid',$designationid], ['status','Active']])->first();
        if($exist){
            return redirect()->back()->withErrors(['error_msg' => 'Oops! Something went wrong. The data is already in use.']);
        }else{

        }

    }

    public function deleteUserAccounts(Request $request){
        $checkid = Validator::make($request->all(),[
            'rowid' => 'required'
        ]);
        if($checkid->fails()){
            return $this->Fails();
        }

        $uid = $request->rowid;

        $checkbook = Booking::where('employeeid',$uid)->count();
        if(!empty($checkbook) > 0){
            return $this->Error4();
            }else{
                UserAccount::where('id',$uid)->delete();
                return $this->Error3();
            }
    }
}
