<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarMaintainance extends Model
{
    protected $fillable =["car_id","money","details"];
    protected $casts =[
        'created_at' =>'date',
    ];
}
