<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpPrePaid extends Model
{
    protected $fillable = ["emp_id", "pre_paid","paid_date"];
public function client(){
    return $this->belongsTo("App\Emp","emp_id","id");
}
}
