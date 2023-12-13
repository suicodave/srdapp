<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ViewDataController extends Controller
{
    public function viewEmployees(){
        $getempdata = DB::table('viewemployee')->select('name','email','mobile_no','status','position','description','branch_name')->get();
        return view('adminPanel.viewuseraccount')->with('empdata',$getempdata);
    }

    public function viewBookings(){

        $getstatus = DB::table('status')->select('statusid','statusname')->get();
        $getvehicletype = DB::table('classification_services')->select('id','vehicletype')->get();
        return view('adminPanel.viewbooking')->with('status',$getstatus)->with('vehicletype',$getvehicletype);
    }
}
