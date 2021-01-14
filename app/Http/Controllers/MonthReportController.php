<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\RawMaterial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonthReportController extends Controller
{
    //
    public function index(Request $request, $from_date = null, $to_date = null)
    {


        if ($request->from_date != '' && $request->to_date != '') {
            $from = $request->from_date;
            $to = $request->to_date;
            $sales = DB::table('client_bills')
                ->whereBetween('created_at', array($request->from_date, $request->to_date))
                ->sum('paid');
            $payments = DB::table('importer_invoices_details')
                ->whereBetween('date', array($request->from_date, $request->to_date))
                ->sum('paid');
            $car = DB::table('car_rents')
                ->whereBetween('created_at', array($request->from_date, $request->to_date))
                ->sum('paid');
            $car_maintainance = DB::table('car_maintainances')
                ->whereBetween('created_at', array($request->from_date, $request->to_date))
                ->sum('money');
            $remain_client= DB::table('client_bills')
                ->whereBetween('created_at', array($request->from_date, $request->to_date))
                ->sum('remain');
            $remain_importer= DB::table('importer_invoices_details')
                ->whereBetween('date', array($request->from_date, $request->to_date))
                ->sum('remain');
            $other_payments= DB::table('other_payments')
                ->whereBetween('created_at', array($request->from_date, $request->to_date))
                ->sum('money');
            $remain = $remain_client - $remain_importer ;
            $totals = ( $sales + $car ) - ($payments + $car_maintainance +$other_payments);
            $loss = $payments + $car_maintainance +$other_payments;

        }

        return view("admin.reports.month_report", compact(["from","to","sales","payments" ,"car","remain" ,"totals","loss"]));
    }

    public function month_report(Request $request)
    {
        return view("admin.reports.month_report");

    }
}
