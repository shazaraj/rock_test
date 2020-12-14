<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ImporterInvoices extends Model
{
    //
    protected $table="importer_invoices";
    protected $fillable = ["id","importer_id","coast","paid","remain","invoice_date"];

//    public  function importerRel(){
//        return $this->belongsTo('App\Client', 'importer_id', 'id');
//
//    }
//    public function client()
//    {
//        return $this->hasOne('App\Client','importer_id');
//    }
}
