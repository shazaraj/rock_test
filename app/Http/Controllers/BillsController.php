<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillsController extends Controller
{
    //
    public function getImporter(Request $request)
    {
        //

        return view("admin.importers.importer_bills" );

    }
}
