<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emp extends Model
{

    protected $fillable = ["name", "is_deleted", "mobile","start_date","month_salary","hour_salary","item_salary"];

}
