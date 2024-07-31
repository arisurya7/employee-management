<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLoginLog extends Model
{
    use HasFactory;

    protected $table = 'employee_login_log';
    protected $fillable = ['employee_id', 'created_at'];
    public $timestamps = false;

}
