<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\RawMaterial;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonthReportController extends Controller
{
    //
    public function index(Request $request){
        if ($request->ajax()) {

            $purchases = Purchase::whereMonth('created_at', Carbon::now()->subMonth()->month)->get();

            return Datatables::of($purchases)

                ->addIndexColumn()
                ->addColumn('raw_material',function($car){
                    return RawMaterial::where('id','=',$car->raw_id)->first()->name;
                }) ->addColumn('from_account',function($car){
                    return "الصندوق";
                })->addColumn('to_account',function($car){
                    return "المشتريات";
                })->addColumn('extra',function($car){
                    return "تفاصيل البيان";
                })

                ->rawColumns(['raw_material','from_account','to_account','extra'])

                ->make(true);

            return;
        }


        return view("admin.reports.month_report");
    }
}
