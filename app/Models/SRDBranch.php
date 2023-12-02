<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRDBranch extends Model
{
    use HasFactory;

    protected $table = 'srdbranch';

    protected $primaryKey = 'id';

    protected $fillable = ['id','branch_name','status'];

    public function employees() {
        return $this->hasMany(Employee::class);
    }

}
