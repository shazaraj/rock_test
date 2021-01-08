<?php

namespace App\Http\Controllers;

use App\Car;

use App\CarRent;
use App\Client;
use App\DriverSalary;
use Illuminate\Http\Request;
use DataTables;

class CarController extends Controller
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

            $data = Car::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()


                ->addColumn('action', function($row){



                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">تعديل</a>';



                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">حذف</a>';



                    return $btn;

                })
                ->rawColumns(['action'])

                ->make(true);

            return;
        }


        return view("admin.cars.index");

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
        Car::updateOrCreate(['id' => $request->_id],

            [
                'car_num' => $request->car_num,
                'car_type' => $request->car_type,
                'driver_salary' => $request->driver_salary,
                'driver_name' => $request->driver_name,


            ]);


        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);

    }
    public function store_paid(Request $request)
    {


        DriverSalary::updateOrCreate(['id' => $request->_id],

            [
                'car_id' => $request->car_id,
                'money_paid' => $request->type_id==1? $request->driver_salary:-1*doubleval($request->driver_salary),
                'date_selected' => $request->date_selected,

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
    public function  show_paid_form(Request $request){
        if ($request->ajax()) {
            // get latest driver.
            $data = DriverSalary::all();
            $car= Car::latest()->first();
//            $data = DriverSalary::where('car_id','=',$car->id)->latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()


//                ->addColumn('action', function($row){
//
//
//
////                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">تعديل</a>';
//
//
//
////                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">حذف</a>';
//
//
//
//                    return $btn;
//
//                })
                ->addColumn('driver_name',function($car){
                    return Car::where('id','=',$car->car_id)->first()->driver_name;
                })
                ->addColumn('driver_salary',function($car){
                    return Car::where('id','=',$car->car_id)->first()->driver_salary;
                })

                ->rawColumns(['driver_name','driver_salary'])

                ->make(true);

            return;
        }



        $cars =Car::all();

        return view("admin.cars.add_paid", compact(["cars"]));
    }

    public function  show_car_history(Request $request){
        if ($request->ajax()) {

            $car= Car::latest()->first();
            $data = CarRent::where('car_id','=',$car->id)->latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('driver_name',function($car){
                    return Car::where('id','=',$car->car_id)->first()->driver_name;
                }) ->addColumn('client',function($car){
                    return Client::where('id','=',$car->client_id)->first()->name;
                })->addColumn('car_type',function($car){
                    return Car::where('id','=',$car->car_id)->first()->car_type;
                })->addColumn('car_num',function($car){
                    return Car::where('id','=',$car->car_id)->first()->car_num;
                })

                ->rawColumns(['driver_name','client','car_num','car_type'])

                ->make(true);

            return;
        }



        return view("admin.cars.paids_history");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $item = Car::find($id);

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
        Car::updateOrCreate(['id' => $id],

            [

                'car_num' => $request->car_num,
                'car_type' => $request->car_type,
                'driver_salary' => $request->driver_salary,
                'driver_name' => $request->driver_name,



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

        Car::find($id)->delete();


        return response()->json(['success'=>' تم الحذف بنجاح']);
    }
    public function destroy_paid( $id)
    {

        DriverSalary::find($id)->delete();


        return response()->json(['success'=>' تم الحذف بنجاح']);
    }
}
