<?php

namespace App\Http\Controllers;


use App\Car;
use App\CarRent;
use App\Client;
use App\ClientBill;
use App\ClientBillFactoriedMaterial;
use App\ClientBillRawMaterial;
use App\ClientType;
use App\ImporterInvoices;
use App\MainAccount;
use App\RawMaterial;
use App\TypeOfPeice;
use Illuminate\Http\Request;
use DataTables;

class ImporterController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if ($request->ajax()) {

            $data = Client::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('main_account'  ,function($row){
                    return MainAccount::find($row->main_account_id)->name;
                })

                ->addColumn('action', function($row){



                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">تعديل</a>';



                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">حذف</a>';



                    return $btn;

                })

                ->rawColumns(['action'])

                ->make(true);

            return;
        }

        $clients = Client::where('client_type','=',1)->get();
        $main_account = MainAccount::all();
        return view("admin.importers.importer", compact(["main_account" ,"clients"]));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Client::updateOrCreate(['id' => $request->_id],
            [
                'name' => $request->name,
                'client_type' => $request->client_type_id,
                'phone' => $request->phone,
                'mobile' => $request->mobile,
                'main_account_id' => $request->account_id,
            ]);
        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImporterInvoices  $importer
     * @return \Illuminate\Http\Response
     */
    public function show(ImporterInvoices $importer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImporterInvoices  $importer
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $item = Client::find($id);

        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Client::updateOrCreate(['id' => $id],

            [

                'name' => $request->get("name"),
                'phone' => $request->get("phone"),
                'client_type' => $request->get("client_type_id"),
                'mobile' => $request->get("mobile"),
                'main_account_id' => $request->get("account_id"),

            ]);


        return response()->json(['success' => 'تم التعديل بنجاج']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

        Client::find($id)->delete();

        return response()->json(['success'=>' تم الحذف بنجاح']);
    }

//importer sale
//create form for importer sales
    public function   importer_new_sale_form(){
        $client_types =  Client::where('client_type','=',1)->get();
        $main_accounts = MainAccount::all();
        $clients = Client::where('client_type','=',1)->get();
        $cars = Car::all();
        $raw_materials = RawMaterial::all();
        $factoried_materials = TypeOfPeice::all();
        return view("admin.importers.importer_sale",
            compact(["client_types","main_accounts" ,"clients","cars","raw_materials","factoried_materials"]));

    }

    public  function add_new_sale(Request $request){

        $bill_id = ClientBill::create([
            "client_id"=>$request->client_id,
            "all_price"=>$request->money,
            "paid"=>$request->money_paid,
            "remain"=> ( $request->money - $request->money_paid ),
        ])->id;
        for($i =0 ;$i<count($request->raws_id) ;$i++) {
            ClientBillRawMaterial::create([
                "bill_id"=>$bill_id, "raw_id"=>$request->raws_id[$i],"single_price"=>$request->raws_price[$i]/$request->raws_qua[$i],
                "amount"=>$request->raws_qua[$i],"full_price"=>$request->raws_price[$i],"notes"=>"No"
            ]);
        }

        for($i =0 ;$i<count($request->fs_id) ;$i++) {
            ClientBillFactoriedMaterial::create([
                "bill_id"=>$bill_id, "raw_id"=>$request->fs_id[$i],"single_price"=>$request->fs_price[$i]/$request->fs_qua[$i],
                "amount"=>$request->fs_qua[$i],"full_price"=>$request->fs_price[$i],"notes"=>"No"
            ]);
        }
        if(!empty($request->deliver_coast) && intval($request->deliver_coast) > 0){
            CarRent::create([
                "car_id"=>$request->car_id,
                "coast"=>$request->deliver_coast,
                "paid"=>$request->deliver_paid,
                "client_id"=>$request->client_id,
            ]);
        }

        return response()->json(["success"=>"تم الحفظ بنجاح"]);

    }

    public function importer_sale_bills(Request $request){
        //
        if ($request->ajax()) {

            $data = ClientBill::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()

                ->addColumn('action', function ($row) {


                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="edit btn btn-primary btn-sm editProduct"> <i class="fa fa-eye"></i></a> &nbsp;';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash-o"></i></a>';


                    return $btn;

                })
                ->addColumn('bills',function ($row){

                    return ClientBill::find($row->id)->remain;
                })
                ->addColumn('client',function ($raw){
//                    $client = Client::all();
                    return Client::find($raw->client_id)->name;
                })
                ->rawColumns(['action','bills','client'])
                ->make(true);

            return;
        }

      //  $bills = ImporterInvoices::get();

//        $client = Client::where('client_type','=',1)->get('name');
//        return view("admin.bills.importer_sale_bills", compact(["client","bills"]));
        return view("admin.bills.importer_sale_bills");
    }

}
