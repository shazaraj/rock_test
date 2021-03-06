<?php

namespace App\Http\Controllers;

use App\Car;
use App\CarRent;
use App\Client;
use App\ClientBill;
use App\ClientBillFactoriedMaterial;
use App\ClientBillRawMaterial;
use App\ClientType;
use App\FactoriedMaterial;
use App\MainAccount;
use App\RawMaterial;
use App\TypeOfPeice;
use Illuminate\Http\Request;
use DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *importer
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = Client::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('type',function($row){
                    return ClientType::find($row->client_type)->name;
                })
                ->addColumn('main_account'  ,function($row){
                    return MainAccount::find($row->main_account_id)->name;
                })

                ->addColumn('action', function($row){



                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"> <i class="fa fa-edit"></i></a>';


                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash-o"></i></a>';



                    return $btn;

                })

                ->rawColumns(['action'])

                ->make(true);

            return;
        }

        $client_types = ClientType::all();
        $main_accounts = MainAccount::all();
        $clients = Client::all();
        $cars = Car::all();
        return view("admin.clients.index", compact(["client_types","main_accounts" ,"clients","cars"]));

    }
        //importer index
    public function index_type(Request $request){
        if ($request->ajax()) {

            $data = Client::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('main_account'  ,function($row){
                    return MainAccount::find($row->main_account_id)->name;
                })

                ->addColumn('action', function($row){



                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"> <i class="fa fa-edit"></i></a>';



                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="class- fa fa-trash-o"></i></a>';



                    return $btn;

                })

                ->rawColumns(['action'])

                ->make(true);

            return;
        }


        $main_accounts = MainAccount::all();
        $clients = Client::where('client_type','=',1)->get();
        return view("admin.importers.importer", compact(["main_accounts" ,"clients"]));

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
    //client store
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

//    // importer store
//    public function store_importer(Request $request)
//    {
//        Client::updateOrCreate(['id' => $request->_id],
//            [
//                'name' => $request->name,
//                'client_type' => $request->client_type_id,
//                'phone' => $request->phone,
//                'mobile' => $request->mobile,
//                'main_account_id' => $request->account_id,
//            ]);
//        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);
//    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
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

    public function   client_new_sale_form(){
        $client_types = ClientType::all();
        $main_accounts = MainAccount::all();
        $clients = Client::all();
        $cars = Car::all();
        $raw_materials = RawMaterial::all();
        $factoried_materials = TypeOfPeice::all();
        return view("admin.clients.new_sale",
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
            "bill_id"=>$bill_id,
            "raw_id"=>$request->raws_id[$i],
            "single_price"=>$request->raws_price[$i]/$request->raws_qua[$i],
            "amount"=>$request->raws_qua[$i],
            "full_price"=>$request->raws_price[$i],
            "notes"=>"No"
        ]);
        }

        for($i =0 ;$i<count($request->fs_id) ;$i++) {
        ClientBillFactoriedMaterial::create([
            "bill_id"=>$bill_id,
            "raw_id"=>$request->fs_id[$i],
            "single_price"=>$request->fs_price[$i]/$request->fs_qua[$i],
            "amount"=>$request->fs_qua[$i],
            "full_price"=>$request->fs_price[$i],
            "notes"=>"No"
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




    public function getbills($id){
            $bill = ClientBill::with('raw_materials')->with('factoried_materials')->find($id);
            $client = Client::find($bill->client_id)->name;
            $row_m = [];
        if(!empty($bill->raw_materials) && count($bill->raw_materials) > 0)

            foreach ($bill->raw_materials as $item){
                $raw =   RawMaterial::find($item->raw_id);
                $item2 = [
                    "name"=>$raw->name,
                    "amount"=>$item->amount,
                ];
                $row_m[] = $item2;
            }

            $fac_n = [];
            if(!empty($bill->factoried_materials) && count($bill->factoried_materials) > 0)
            foreach ($bill->factoried_materials as $item){
                $raw1 = FactoriedMaterial::find($item->raw_id);
                $raw = TypeOfPeice::find($raw1->type_of_peice_id);
                $item2 = [
                    "name"=>$raw->name,
                    "amount"=>$item->amount,
                ];
                $fac_n[] = $item2;
            }
return  response()->json(["bill"=>$bill , "r_m"=>$row_m, "f_m"=>$fac_n,"client"=>$client]);
//        return view('admin.bills.client_sale_bills',compact(["name","date","raw","amount_raw","factor","amount_factor"]));

    }

    public function client_sale_bills(Request $request){
        //
        if ($request->ajax()) {

//            = Client::all();
            $data = ClientBill::get();

//            $data = ClientBill::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()

                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="fa fa-eye"></i></a>';

//                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash-o"></i></a>';


                    return $btn;

                })
                ->addColumn('client',function ($raw){
//                    $client = Client::all();
                    return Client::find($raw->client_id)->name;
                })
//               ->addColumn('client',function($client){
//                    return Client::where('id','=',$client->client_id)->first()->name;
//                })
                ->rawColumns(['action','client'])
                ->make(true);

            return;
        }

//        $bills = ClientBill::get()->remain;
//        $client = Client::get()->name;

        return view("admin.bills.client_sale_bills");
    }
}
