<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeMaterial extends Model
{
    protected $fillable = ["type_of_peice_id", "raw_material_id" ,"unit","amount","price","details"];
    public  function material(){
        return $this->belongsTo('App\RawMaterial', 'raw_material_id', 'id');

    }
}
