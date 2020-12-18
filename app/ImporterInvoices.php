<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ImporterInvoices extends Model
{
    //فاتورة مواد
    protected $table="importer_invoices";
    protected $fillable = ["client_id","coast","paid","remain","invoice_date"];
//    protected $fillable =["client_id","all_price","paid","remain","created_at"];

//    public  function importerRel(){
//        return $this->belongsTo('App\Client', 'importer_id', 'id');
//
//    }
//    public function client()
//    {
//        return $this->hasOne('App\Client','importer_id');
//    }
}
