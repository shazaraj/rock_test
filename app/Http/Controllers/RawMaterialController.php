<?php

namespace App\Http\Controllers;

use App\RefactorType;
use App\QuntityType;
use App\RawMaterial;
use Illuminate\Http\Request;
use DataTables;

class RawMaterialController extends Controller
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

            $data = RawMaterial::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('type',function($row){
                    return QuntityType::find($row->quantity_type)->name;
                })
                ->addColumn('refactoring'  ,function($row){
                    return RefactorType::find($row->refactoring_ability)->name;
                })

                ->addColumn('action', function($row){



                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">تعديل</a>';



                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">حذف</a>';



                    return $btn;

                })

                ->rawColumns(['action', 'type', 'refactoring'])

                ->make(true);

            return;
        }

        $types = QuntityType::all();
        $refactoring= RefactorType::all();
        return view("admin.raw_materials.index", compact(["types","refactoring" ]));

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
        RawMaterial::updateOrCreate(['id' => $request->_id],

            [
                'name' => $request->name,
                'quantity' => $request->quantity,
                'quantity_type' => $request->quantity_type,
                'refactoring_ability' => $request->refactoring,
                'item_price' => $request->item_price,
                'item_price_sale' => $request->item_price_sale,

            ]);


        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);

    }

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
        $item = RawMaterial::find($id);

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
        RawMaterial::updateOrCreate(['id' => $id],

            [

                'name' => $request->name,
                'quantity' => $request->quantity,
                'quantity_type' => $request->quantity_type,
                'refactoring_ability' => $request->refactoring_ability,
                'item_price' => $request->item_price,
                'item_price_sale' => $request->item_price_sale,


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

        RawMaterial::find($id)->delete();


        return response()->json(['success'=>' تم الحذف بنجاح']);
    }
}
