<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    //
    protected $table="receipt";
    protected $fillable = ["id","importer_id","coast","paid","date"];
}
