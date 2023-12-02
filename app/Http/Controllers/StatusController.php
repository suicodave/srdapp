<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingPriority;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\Presets\React;

class StatusController extends Controller
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

    public function showStatus(){

        $getStatusdata = Status::select('statusid','statusname','description','maker')->get();
        return view('adminPanel.status')->with('status',$getStatusdata);
    }

    public function postStatus(Request $request){
        $checkdata = Validator::make($request->all(),[
            'statusname' => 'required',
            'description' => 'required',
        ]);

        if($checkdata->fails()){
            return $this->Fails();
        }
        //insert into database
        $newStatus = new Status([
        'statusname'=>$request->input('statusname'),
        'description'=>$request->input('description'),
        'maker'=>Auth::user()->name,
        ]);
        $newStatus->save();
        return $this->Error1();

    }

    public function editStatus(Request $request){
        $checkdata = Validator::make($request->all(),[
            'statusname' => 'required',
            'description' => 'required',
            'rowstatusid' => 'required',
        ]);

        if($checkdata->fails()){
            return $this->Fails();
        }
        $updatestatus = Status::find($request->input('rowstatusid'));
        $updatestatus->statusname=$request->input('statusname');
        $updatestatus->description=$request->input('description');
        $updatestatus->maker=Auth::user()->name;
        $updatestatus->save();
        return $this->Error2();

    }

    public function dropStatus($statusid){

                $checkpid = BookingPriority::where('pid',$statusid)->select('pid')->count();
                $checkbid = Booking::where('bookingstatus',$statusid)->select('id')->count();
                if ($checkpid >0 && $checkbid>0) {
                return $this->Error4();
                }else{
                    try{
                        Status::where('statusid',$statusid)->delete();
                        return $this->Error3();
                        }catch(\Exception $e){
                        return response()->json(['error'=>false,'message'=>$e->getMessage()],405);
                        }
                }
    }
}
