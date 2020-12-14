<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpSalary extends Model
{
    protected $fillable = ["emp_id", "salary","salary_date"];

}
