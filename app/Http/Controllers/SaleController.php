<?php

namespace App\Http\Controllers;


use App\Sale;
use App\QuntityType;
use App\RawMaterial;
use App\Store;
use Illuminate\Http\Request;
use DataTables;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = Sale::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('type',function($row){
                    if(QuntityType::find($row->amount_type_id))
                    return QuntityType::find($row->amount_type_id)->name;
                    else
                        return "غير محدد";
                })
                ->addColumn('raw'  ,function($row){
                    if(RawMaterial::find($row->raw_id))
                    return RawMaterial::find($row->raw_id)->name;
                    else
                        return "غير محدد";
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

        $amount_types = QuntityType::all();
        $raws = RawMaterial::all();
        return view("admin.sales.index", compact(["amount_types" ,"raws"]));

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
        Sale::updateOrCreate(['id' => $request->_id],

            [
                'raw_id' => $request->raw_id,
                'amount_type_id' => $request->amount_type_id,
                'amount' => $request->amount,
                'single_price' => $request->single_price,
                'all_price' => $request->all_price,
                'details' => $request->details,
            ]);
        $store = Store::where('raw_id','=',$request->raw_id)->count();
        if($store > 0 ){

            $sale_store =Store::where('raw_id','=',$request->raw_id)->get()->first();
            $sale_store->amount-=$request->amount;
            $sale_store->save();
        }else{
            Store::updateOrCreate(['raw_id' => $request->raw_id],

                [
                    'raw_id' => $request->raw_id,
                    'amount' => $request->amount,


                ]);
        }


        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $client
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $item = Sale::find($id);

        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuntityType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Sale::updateOrCreate(['id' => $id],

            [

                'raw_id' => $request->raw_id,
                'amount_type_id' => $request->amount_type_id,
                'amount' => $request->amount,
                'single_price' => $request->single_price,
                'all_price' => $request->all_price,
                'details' => $request->details,

            ]);


        return response()->json(['success' => 'تم التعديل بنجاج']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuntityType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

        Sale::find($id)->delete();


        return response()->json(['success'=>' تم الحذف بنجاح']);
    }
}
