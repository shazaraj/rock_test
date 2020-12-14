<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $fillable =["raw_id","amount_type_id","amount","single_price","all_price","details"];
}
