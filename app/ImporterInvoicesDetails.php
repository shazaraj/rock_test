<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImporterInvoicesDetails extends Model
{
//     بالتفصيل //بطاقة مادة == فاتورة مادة
    protected $table="importer_invoices_details";

    protected $fillable = ["client_id","material_id","paid","remain","amount","price","date"];

}

