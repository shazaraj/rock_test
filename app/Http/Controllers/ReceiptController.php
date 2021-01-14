<?php

namespace App\Http\Controllers;

use App\Client;
use App\ImporterInvoices;
use App\Receipt;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReceiptController extends Controller
{

    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = Receipt::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('name'  ,function($row){
                    return Client::find($row->importer_id)->name;
                })

                ->addColumn('action', function($row){



                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"> <i class="fa fa-edit"></i></a>';



                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash-o"></i></a>';



                    return $btn;

                })

                ->make(true);

            return;
        }
        $get_receipt = Client::all();

        return view("admin.bills.importer_receipt" , compact('get_receipt') );

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
        Receipt::updateOrCreate(['id' => $request->_id],

            [
                'importer_id' => $request->importer_id,
                'coast' => $request->coast,
                'paid' => $request->paid,
                'date' => $request->date,

            ]);


        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $item = Receipt::find($id);

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
        Receipt::updateOrCreate(['id' => $id],

            [

                'importer_id' => $request->get("importer_id"),
                'coast' => $request->get("coast"),
                'paid' => $request->get("paid"),
                'date' => $request->get("date"),

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

        Receipt::find($id)->delete();

        return response()->json(['success'=>' تم الحذف بنجاح']);
    }
}
