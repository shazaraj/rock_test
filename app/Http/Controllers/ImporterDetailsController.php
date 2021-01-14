<?php

namespace App\Http\Controllers;

use App\Client;
use App\ImporterInvoicesDetails;
use App\ImporterInvoices;
use App\RawMaterial;
use Illuminate\Http\Request;
use DataTables;

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


            $data = ImporterInvoicesDetails::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('name'  ,function($row){
                    return RawMaterial::find($row->material_id)->name;
                })
                ->addColumn('importer'  ,function($row){
                    return Client::find($row->client_id)->name;
                })
                ->addColumn('action', function($row){



                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">تعديل</a>';



                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">حذف</a>';



                    return $btn;

                })
                ->rawColumns(['action', 'name','importer'])
                ->make(true);

            return;
        }
//        $import_raw = Client::where('client_type','=',1)->get();
        $raw_materials= RawMaterial::all();
        $importers = Client::where('client_type','=',1)->get();

        return view("admin.importers.importer_bills" , compact(["raw_materials","importers"]));

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
        ImporterInvoicesDetails::updateOrCreate(['id' => $request->_id],

            [
                'client_id' => $request->client_id,
                'material_id' => $request->material_id,
                'amount' => $request->amount,
                'paid' => $request->paid,
                'remain' => $request->remain,
                'date' => $request->date,

            ]);


        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImporterInvoicesDetails  $ivd
     * @return \Illuminate\Http\Response
     */
    public function show(ImporterInvoicesDetails $ivd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImporterInvoicesDetails  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $item = ImporterInvoicesDetails::find($id);

        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImporterInvoicesDetails  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ImporterInvoicesDetails::updateOrCreate(['id' => $id],

            [
                'client_id' => $request->get("client_id"),
                'material_id' => $request->get("material_id"),
                'amount' => $request->get("amount"),
                'price' => $request->get("price"),
                'paid' => $request->get("paid"),
                'remain' => $request->get("remain"),
                'date' => $request->get("date"),
            ]);


        return response()->json(['success' => 'تم التعديل بنجاج']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImporterInvoicesDetails $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

        ImporterInvoicesDetails::find($id)->delete();

        return response()->json(['success'=>' تم الحذف بنجاح']);
    }

}
