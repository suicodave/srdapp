<?php

namespace App\Http\Controllers;

use App\Models\SalaryGrade;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalaryGradeController extends Controller
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

    public function addSalaries(Request $request){
        $checkdata = Validator::make($request->all(),[
            'scode' => 'required',
            'description' => 'required',
            'period' => 'required',
            'amount' => 'required',
        ]);

        if($checkdata->fails()){
            return $this->Fails();
        }
        $code = $request->scode;
        $desc = $request->description;
        $periode = $request->period;
        $amt = $request->amount;
        $datains = new SalaryGrade();
        $datains -> sgcode = $code;
        $datains -> description = $desc;
        $datains -> period = $periode;
        $datains -> amount = $amt;
        if ($datains -> save()) {
            return $this->Error1();
        }else{
            return $this->Error4();
        }
    }

    public function editSalaries( Request $request){

        $check = UserAccount::find('salarygrade',$request->rid);
        if (!$check) {
            return $this->Error5();
        }

        $branch = SalaryGrade::find($request->rid);
        if (!$branch) {
            return $this->Error5();
        }

        $checkdata = Validator::make($request->all(),[
            'scode' => 'required',
            'description' => 'required',
            'period' => 'required',
            'amount' => 'required',
            'rid' => 'required',
        ]);
        if($checkdata->fails()){
            return $this->Error2();
        }

        $code = $request->scode;
        $desc = $request->description;
        $periode = $request->period;
        $amt = $request->amount;
        $sgid = $request->rid;

        SalaryGrade::where('sgid',$sgid)->update([
            'sgcode' => $code,
            'description' => $desc,
            'period' => $periode,
            'amount' => $amt,
        ]);
        return $this->Error2();
    }

    public function dropSalaries($cid){
        $deletebranch = SalaryGrade::find($cid);
        if (!$deletebranch) {
            return $this->Error5();
        }
        $deletebranch->delete();
        return $this->Error3();
    }
}
