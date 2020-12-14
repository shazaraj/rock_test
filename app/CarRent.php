<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarRent extends Model
{
    //
    protected $fillable =[
        "car_id","coast","paid","client_id",
    ];
}
