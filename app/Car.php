<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
 protected $fillable =["car_num","car_type","driver_salary", "driver_name"];

}
