<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRDSales extends Model
{
    use HasFactory;

    protected $table = 'srdsales';

    protected $primaryKey = 'salesid';


    protected $fillable = ['salesid','bookingid','bpid','status','salesdate','tnxtype', 'actiontakenby','initialamount','subtotal','amountdue','cashier'];
}
