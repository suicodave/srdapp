<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    use HasFactory;

    protected $table = 'schedules_tables';

    protected $primaryKey = 'id';

    protected $fillable = ['prioritynumber','description','startdate','enddate'];
}
