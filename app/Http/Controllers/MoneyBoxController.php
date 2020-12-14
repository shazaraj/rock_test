<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoneyBoxController extends Controller
{
    //
    public function index(){
        return view("admin.money_box.index");
    }

}
