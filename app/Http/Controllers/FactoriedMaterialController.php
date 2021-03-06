<?php

namespace App\Http\Controllers;

use App\FactoriedMaterial;
use App\TypeOfPeice;
use App\Emp;
use App\StoreFacoriedMaterail;
use Illuminate\Http\Request;
use DataTables;

class FactoriedMaterialController extends Controller
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

            $data = FactoriedMaterial::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('type',function($row){
                    return TypeOfPeice::find($row->type_of_peice_id)->name;
                })
                ->addColumn('worker'  ,function($row){
                    return Emp::find($row->worker_id)->name;
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

        $materials = TypeOfPeice::all();
        $emps = Emp::all();
        return view("admin.factoried_materials.index", compact(["materials","emps" ]));

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
        FactoriedMaterial::updateOrCreate(['id' => $request->_id],

            [
                'type_of_peice_id' => $request->type_of_peice_id,
                'worker_id' => $request->worker_id,
                'quantity' => $request->quantity,
            ]);

            StoreFacoriedMaterail::updateOrCreate(['type_of_peice_id' => $request->type_of_peice_id],

            [
                'type_of_peice_id' => $request->type_of_peice_id,
                'quantity' => $request->quantity,


            ]);

        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FactoriedMaterial  $client
     * @return \Illuminate\Http\Response
     */
    public function show(FactoriedMaterial $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FactoriedMaterial  $client
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $item = FactoriedMaterial::find($id);

        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FactoriedMaterialType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        FactoriedMaterial::updateOrCreate(['id' => $id],

            [

                'name' => $request->get("name"),

            ]);


        return response()->json(['success' => 'تم التعديل بنجاج']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FactoriedMaterialType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

        FactoriedMaterial::find($id)->delete();


        return response()->json(['success'=>' تم الحذف بنجاح']);
    }
}
