<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientBillRawMaterial extends Model
{
    //
    protected $fillable = ["bill_id", "raw_id","single_price","amount","full_price","notes"];
}
