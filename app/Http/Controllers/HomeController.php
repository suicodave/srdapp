<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\SRDSales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ViewSalesChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $getServices = DB::table('classification_services')->where('status',1)->select('id')->count();
        $getBooking = DB::table('viewbookiing')->where('bookingstatus',4)->select('branchcode')->count();
        $getEmp = User::where('status','Active')->select('id')->count();
        $getEmpUser = User::where('islogin',1)->select('id')->count();

        $salesByMonth = Booking::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount) as total_sales')
        )
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();

        $totalSales = Booking::where('bookingstatus',4)->select(DB::raw('SUM(amount) as total_sales'))->get();

        return view('adminPanel.home',compact('salesByMonth'))->with('numEmp',$getEmp)->with('numUser',$getEmpUser)
                ->with('TotalSales',$totalSales)
                ->with('numbooking',$getBooking)->with('numservices',$getServices);
    }

}
