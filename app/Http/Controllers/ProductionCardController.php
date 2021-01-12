<?php

namespace App\Http\Controllers;

use App\ProductionCard;
use App\TypeOfPeice;
use App\Emp;
use App\StoreFacoriedMaterail;
use Illuminate\Http\Request;
use DataTables;

class ProductionCardController extends Controller
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

            $data = ProductionCard::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('type',function($row){
                    return TypeOfPeice::find($row->type_of_peice_id)->name;
                })
                ->addColumn('worker'  ,function($row){
                    return Emp::find($row->emp_id)->name;
                })

                ->addColumn('action', function($row){



                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">تعديل</a>';



                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">حذف</a>';



                    return $btn;

                })

                ->rawColumns(['action', 'type',"worker"])

                ->make(true);

            return;
        }

        $materials = TypeOfPeice::all();
        $emps = Emp::all();
        return view("admin.production_cards.index", compact(["materials","emps" ]));

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
        ProductionCard::updateOrCreate(['id' => $request->_id],

            [
                'type_of_peice_id' => $request->type_of_peice_id,
                'emp_id' => $request->emp_id,
                'count' => $request->count,



            ]);
        $store = StoreFacoriedMaterail::where('type_of_peice_id','=',$request->type_of_peice_id)->count();
        if($store > 0 ){

           $upStore =StoreFacoriedMaterail::where('type_of_peice_id','=',$request->type_of_peice_id)->get()->first();
            $upStore->quantity+=$request->count;
            $upStore->save();
        }else{
            StoreFacoriedMaterail::updateOrCreate(['type_of_peice_id' => $request->type_of_peice_id],

            [
                'type_of_peice_id' => $request->type_of_peice_id,
                'quantity' => $request->count,


            ]);
        }
        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductionCard  $client
     * @return \Illuminate\Http\Response
     */
    public function show(ProductionCard $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductionCard  $client
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $item = ProductionCard::find($id);

        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductionCardType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ProductionCard::updateOrCreate(['id' => $id],

            [

                'type_of_peice_id' => $request->type_of_peice_id,
                'emp_id' => $request->emp_id,
                'count' => $request->count,

            ]);


        return response()->json(['success' => 'تم التعديل بنجاج']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductionCardType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

        ProductionCard::find($id)->delete();


        return response()->json(['success'=>' تم الحذف بنجاح']);
    }
}
