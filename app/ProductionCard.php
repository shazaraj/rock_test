<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionCard extends Model
{
    protected $fillable =["type_of_peice_id","count", "emp_id"];

}
