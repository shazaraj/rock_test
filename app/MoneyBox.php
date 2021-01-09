<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoneyBox extends Model
{
    //
    protected $table="money_boxes";
    protected $fillable = ["id","money","type","details","created_at"];

}
