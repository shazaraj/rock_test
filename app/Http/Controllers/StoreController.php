<?php

namespace App\Http\Controllers;

use App\RefactorType;
use App\QuntityType;
use App\RawMaterial;
use App\TypeOfPeice;
use App\Store;
use App\StoreFacoriedMaterail;
use Illuminate\Http\Request;
use DataTables;

class StoreController extends Controller
{
    public  function factoried_materials(Request $request){
        if ($request->ajax()) {

            $data = StoreFacoriedMaterail::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('type',function($row){
                    return TypeOfPeice::find($row->type_of_peice_id)->name;
                })

                ->rawColumns([  'type'])

                ->make(true);

            return;
        }

        return view('admin.store.store_facoried_materails');
    }
    public  function raw_materials(Request $request){
        if ($request->ajax()) {

            $data = Store::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('type',function($row){
                    return QuntityType::find($row->amount_type_id)->name;
                })

                ->addColumn('raw_material'  ,function($row){
                    return RawMaterial::find($row->raw_id)->name;
                })


                ->rawColumns([  'refactoring', 'raw_material'])

                ->make(true);

            return;
        }

        return view('admin.store.raw_materials');
    }
}
