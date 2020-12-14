<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImporterInvoiceDetails extends Model
{
    //
    protected $fillable = ["id","material_id","amount","price","date"];

}

