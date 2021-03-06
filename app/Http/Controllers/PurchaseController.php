<?php

namespace App\Http\Controllers;


use App\Purchase;
use App\Store;
use App\QuntityType;
use App\RawMaterial;
use Illuminate\Http\Request;
use DataTables;

class PurchaseController extends Controller
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

            $data = Purchase::latest()->get();

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



                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"> <i class="fa fa-edit"></i></a>';



                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash-o"></i></a>';



                    return $btn;

                })

                ->rawColumns(['action'])

                ->make(true);

            return;
        }

        $amount_types = QuntityType::all();
        $raws = RawMaterial::all();
        return view("admin.purchases.index", compact(["amount_types" ,"raws"]));

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
        Purchase::updateOrCreate(['id' => $request->_id],

            [
                'raw_id' => $request->raw_id,
                'amount_type_id' => $request->amount_type_id,
                'amount' => $request->amount,
                'single_price' => $request->single_price,
                'all_price' => $request->all_price,
                'details' => $request->details,


            ]);

        Store::updateOrCreate(['raw_id' => $request->raw_id],

            [
                'raw_id' => $request->raw_id,
                'amount_type_id' => $request->amount_type_id,
                'amount' => $request->amount,
                'single_price' => $request->single_price,



            ]);



        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $client
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $item = Purchase::find($id);

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
        Purchase::updateOrCreate(['id' => $id],

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

        Purchase::find($id)->delete();


        return response()->json(['success'=>' تم الحذف بنجاح']);
    }
}
