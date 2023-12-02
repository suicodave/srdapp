<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingForPayment extends Model
{
    use HasFactory;

    protected $table = 'pendingforpayment_tmp';

    protected $primaryKey = 'statusid';
}
