<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherPayment extends Model
{
    protected $fillable = ["name", "money"];
    protected $casts =[
        'created_at' =>'date',
    ];
}
