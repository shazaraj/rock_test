<?php

namespace App\Http\Controllers;

use App\Car;
use App\CarRent;
use App\Client;
use App\Purchase;
use App\RawMaterial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class TodayReportController extends Controller
{
    //
    public function index(Request $request){
        if ($request->ajax()) {

            $purchases = Purchase::whereDate('created_at', Carbon::today())->get();

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


        return view("admin.reports.today_report");
    }
}
