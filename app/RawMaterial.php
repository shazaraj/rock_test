<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    //
    protected $fillable = ["name", "quantity","quantity_type","refactoring_ability","item_price","item_price_sale"];

}
