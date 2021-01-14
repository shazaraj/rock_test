<?php

namespace App\Http\Controllers;

use App\Car;

use App\CarMaintainance;
use Illuminate\Http\Request;
use DataTables;

class CarMaintainanceController extends Controller
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

            $data = CarMaintainance::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('car',function($row){
                    return Car::find($row->car_id)->car_type;
                })

                ->addColumn('action', function($row){



                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"> <i class="fa fa-edit"></i></a>';



                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash-o"></i></a>';



                    return $btn;

                })
                ->addColumn('name',function($row){
                    return Car::find($row->car_id)->car_num;
                })

                ->rawColumns(['action', 'car','name'])

                ->make(true);

            return;
        }

        $cars = Car::all();
        return view("admin.cars_maintainances.index", compact("cars"));

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
        CarMaintainance::updateOrCreate(['id' => $request->_id],

            [
                'car_id' => $request->car_id,
                'money' => $request->money,
                'details' => $request->details,



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
        $item = CarMaintainance::find($id);

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
        CarMaintainance::updateOrCreate(['id' => $id],

            [

                'car_id' => $request->car_id,
                'money' => $request->money,
                'details' => $request->details,




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

        CarMaintainance::find($id)->delete();


        return response()->json(['success'=>' تم الحذف بنجاح']);
    }
}
