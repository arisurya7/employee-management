<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    use HasFactory;

    protected $table = 'employee_position';
    protected $fillable = ['employee_id', 'position_id'];
    public $timestamps = false;
}
