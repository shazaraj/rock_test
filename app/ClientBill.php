<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientBill extends Model
{
    //فاتورة زبون
    protected $fillable =["client_id","all_price","paid","remain","created_at"];

}
