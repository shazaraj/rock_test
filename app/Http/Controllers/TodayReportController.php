<?php

namespace App\Http\Controllers;

use App\Car;
use App\CarRent;
use App\Client;
use App\ClientBill;
use App\ClientBillFactoriedMaterial;
use App\ClientBillRawMaterial;
use App\FactoriedMaterial;
use App\ImporterInvoicesDetails;
use App\Purchase;
use App\RawMaterial;
use App\TypeOfPeice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use function Matrix\add;
use function Matrix\directsum;

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
    public function getSale(Request $request ,$day_repo = null){
//        $day_repo = null;
//        $sales = DB::table('client_bills')
//            ->where('created_at', $day_repo)
//            ->sum(\DB::raw(
//                'client_bills.all_price'
//            ));
//        $sales = DB::table('client_bills')->sum('all_price')->where('created_at', '=', created_at);
//            $sale = ClientBill ::whereDate('created_at', '=',$day_repo)->get();
//            $sales = sum($sale->all_price);
        if (!empty($day_repo)) {
            $sales = DB::table('client_bills')
                ->where('created_at', $day_repo)
                ->sum('all_price');
//            $bay = ImporterInvoicesDetails::wherDate('date' ,'=',$day_repo)->get();
//            $car = CarRent::whereDate('created_at' , '=',$day_repo)->get();
        }
            return view("admin.reports.today_report",compact('sales'));

//        return  response()->json($sales);
//        return  response()->json(["sales"=>$sales , "bays"=>$bay, "car"=>$car]);
    }
    public function sale_report(Request $request){
        return view("admin.reports.today_report");
    }
}
