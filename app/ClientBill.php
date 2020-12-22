<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientBill extends Model
{
    //فاتورة زبون
    protected $fillable =["client_id","all_price","paid","remain","created_at"];
        public function raw_materials(){
            return $this->hasMany("App\ClientBillRawMaterial",'bill_id','id');
        }

        public function factoried_materials(){
            return $this->hasMany("App\ClientBillFactoriedMaterial",'bill_id','id');
        }
}
