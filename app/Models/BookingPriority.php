<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingPriority extends Model
{
    use HasFactory;

    protected $table = 'bookingpriority';

    protected $primaryKey = 'pid';

    protected $fillable = ['bookingId','prioritynumber','dateprocess','maker','status'];
}
