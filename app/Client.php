<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = ["name", "client_type","phone","mobile","main_account_id",];
}
