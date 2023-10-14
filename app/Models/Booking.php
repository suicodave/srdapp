<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';

    protected $primaryKey = 'id';

    protected $fillable = ['employeeid','classid','servicesid','branchcode','bookingnumber','fullName','mobileNumber','washDate','washTime','message','bookingstatus','paymentMode','txnNumber','postingDate','employeeidremarks'];
}
