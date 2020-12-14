<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //
      protected $fillable =["raw_id","amount_type_id","amount","single_price"];
      protected $table="store";
}
