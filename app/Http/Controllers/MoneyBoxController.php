<?php

namespace App\Http\Controllers;

use App\CarRent;
use App\Client;
use App\ClientBill;
use App\DriverSalary;
use App\EmpSalary;
use App\ImporterInvoicesDetails;
use App\RawMaterial;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MoneyBoxController extends Controller
{
    //
    public function index(Request $request){
        if ($request->ajax()) {

            $data = CarRent::latest()->get();


            return Datatables::of($data)

                ->addIndexColumn()

                ->make(true);

            return;
        }
        $emp= EmpSalary::latest()->get();
        $bill= ClientBill::latest()->get();
        $car = CarRent::latest()->get();
        $importer= ImporterInvoicesDetails::latest()->get();
        $salary= DriverSalary::latest()->get();
        return view("admin.money_box.index",compact(['emp','bill','car','importer','salary']));
    }
//    public function getMoney(Request $request){
//
//            $emp= EmpSalary::latest()->get()->salary;
//            $bill= ClientBill::latest()->get()->paid;
//            $car = CarRent::latest()->get()->paid;
//            $importer= ImporterInvoicesDetails::latest()->get()->paid;
//            $salary= DriverSalary::latest()->get()->money_paid;
//        return  response()->json(["emp"=>$emp , "bill"=>$bill, "car"=>$car,"importer"=>$importer,"salary"=>$salary]);
//
//
//    }

}
