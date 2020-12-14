<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverSalary extends Model
{

        protected $fillable =["car_id","money_paid", "date_selected"];

    public function car(){
        return $this->belongsTo('App\Car', 'car_id', 'id');
    }
}
