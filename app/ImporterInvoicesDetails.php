<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImporterInvoicesDetails extends Model
{
//     بالتفصيل //بطاقة مادة == فاتورة مادة
    protected $table="importer_invoices_details";

    protected $fillable = ["material_id","amount","price","date"];

}

