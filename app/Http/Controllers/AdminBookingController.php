<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;


class AdminBookingController extends Controller
{
    public function viewbooking(){


        $getbooking = DB::table('booking')
                        ->leftJoin('classification_services','classification_services.id','booking.classid')
                        ->leftJoin('srdservices','srdservices.sid','booking.servicesid')
                        ->select('booking.id','booking.bookingnumber','booking.fullName','classification_services.vehicletype as classid','booking.mobileNumber','srdservices.servicesname as servicesid','booking.branchcode','booking.washDate','booking.washTime','booking.message','booking.bookingstatus','booking.created_at')->get();

        return view('adminPanel.bookingdetails')->with('bookings',$getbooking);
    }

    public function viewbookingdetails($id){

        $getbooking = DB::table('booking')->where('booking.id',$id)
        ->leftJoin('classification_services','classification_services.id','booking.classid')
        ->leftJoin('srdservices','srdservices.sid','booking.servicesid')
        ->select('booking.id','booking.bookingnumber','booking.fullName','classification_services.vehicletype as classid','booking.mobileNumber','srdservices.servicesname as servicesid','srdservices.price','booking.branchcode','booking.washDate','booking.washTime','booking.message','booking.bookingstatus','booking.created_at','booking.email')->get();

        return view('adminPanel.viewbookingdetails')->with('bookings',$getbooking);

    }

    public function bookedschedule(){
        return view('adminPanel.scheduling');
    }
}
