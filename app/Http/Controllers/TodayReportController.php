<?php

namespace App\Http\Controllers;

use App\Car;
use App\CarRent;
use App\Client;
use App\ClientBill;
use App\ClientBillFactoriedMaterial;
use App\ClientBillRawMaterial;
use App\FactoriedMaterial;
use App\Purchase;
use App\RawMaterial;
use App\TypeOfPeice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class TodayReportController extends Controller
{
    //
    public function getRepo(){
        return view("admin.reports.report");
    }
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
    public function getSale(Request $request ,$day_repo){

        if ($request->ajax()){

            $data = ClientBillRawMaterial ::whereDate('created_at', '=',$day_repo)->get();
            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('raw_material',function($raw){
                    return RawMaterial::where('id','=',$raw->raw_id)->first()->name;
                })
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="fa fa-eye"></i></a>';

                    return $btn;

                })
                ->rawColumns(['raw_material','action'])

                ->make(true);

            return;
            }

  return view("admin.reports.today_report");
    }
}
