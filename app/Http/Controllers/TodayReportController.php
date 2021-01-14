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
        if ($request->day_repo != '') {
            $date = $request->day_repo;
            $sales = DB::table('client_bills')
                ->where('created_at','=',$day_repo)
                ->sum('paid');
            $payments = DB::table('importer_invoices_details')
                ->where('date','=',$day_repo)
                ->sum('paid');
            $car = DB::table('car_rents')
                ->where('created_at','=',$day_repo)
                ->sum('paid');
            $car_maintainance = DB::table('car_maintainances')
                ->where('created_at','=',$day_repo)
                ->sum('money');
            $remain_client= DB::table('client_bills')
                ->where('created_at','=',$day_repo)
                ->sum('remain');
            $remain_importer= DB::table('importer_invoices_details')
                ->where('date','=',$day_repo)
                ->sum('remain');
            $other_payments= DB::table('other_payments')
                ->where('created_at','=',$day_repo)
                ->sum('money');
            $remain = $remain_client - $remain_importer ;
            $totals = ( $sales + $car ) - ($payments + $car_maintainance +$other_payments);
            $loss = $payments + $car_maintainance +$other_payments;

        }

        return view("admin.reports.today_report",compact(["date","sales","payments" ,"car","remain" ,"totals","loss"]));
    }
    public function sale_report(Request $request){
        return view("admin.reports.today_report");
    }
}
