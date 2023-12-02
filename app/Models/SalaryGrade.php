<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryGrade extends Model
{
    use HasFactory;

    protected $table = 'salaraygrade';

    protected $primaryKey = 'sgid';

    protected $fillable = ['sgid','sgcode','description','period','amount'];
}

