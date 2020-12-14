<?php

namespace App\Http\Controllers;

use App\Client;
use App\ImporterInvoiceDetails;
use App\ImporterInvoices;
use App\RawMaterial;
use Illuminate\Http\Request;

class ImporterDetailsController extends Controller
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


            $data = ImporterInvoiceDetails::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()

                ->addColumn('action', function($row){



                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">تعديل</a>';



                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">حذف</a>';



                    return $btn;

                })

                ->make(true);

            return;
        }
        $import_raw = Client::where('client_type','=',1)->get();
        $raw_material = RawMaterial::all();;

        return view("admin.importers.importer_bills" , compact(["import_raw","raw_material"]));

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
        ImporterInvoiceDetails::updateOrCreate(['id' => $request->_id],

            [
//                'importer_id' => $request->importer_id,
                'material_id' => $request->material_id,
                'amount' => $request->amount,
                'price' => $request->price,
//                'item_price' => $request->item_price,
//                'price_sale' => $request->price_sale,
//                'total_sale' => $request->total_sale,
                'date' => $request->date,

            ]);


        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImporterInvoiceDetails  $ivd
     * @return \Illuminate\Http\Response
     */
    public function show(ImporterInvoiceDetails $ivd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImporterInvoiceDetails  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $item = ImporterInvoiceDetails::find($id);

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
        ImporterInvoiceDetails::updateOrCreate(['id' => $id],

            [
//                'importer_id' => $request->get("importer_id"),
                'material_id' => $request->get("material_id"),
                'amount' => $request->get("amount"),
                'price' => $request->get("price"),
//                'price_sale' => $request->get("price_sale"),
//                'total_sale' => $request->get("total_sale"),
                'date' => $request->get("date"),

            ]);


        return response()->json(['success' => 'تم التعديل بنجاج']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImporterInvoiceDetails $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

        Emp::find($id)->delete();

        return response()->json(['success'=>' تم الحذف بنجاح']);
    }

}
