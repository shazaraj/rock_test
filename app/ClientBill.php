<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientBill extends Model
{
    //
    protected $fillable =["client_id","all_price","paid","remain","created_at"];

}
