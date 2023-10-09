<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $table = 'classification_services';

    protected $primaryKey = 'id';

    protected $fillable = ['servicesname','maker','status'];
}

