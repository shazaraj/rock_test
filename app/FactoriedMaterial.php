<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FactoriedMaterial extends Model
{

    protected $fillable = ["type_of_peice_id","quantity","worker_id"];

}
