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
        return view('adminPanel.viewbooking');
    }
}
