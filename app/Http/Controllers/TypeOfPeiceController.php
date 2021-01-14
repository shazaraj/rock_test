<?php

namespace App\Http\Controllers;

use App\RawMaterial;
use App\TypeMaterial;
use App\TypeOfPeice;

use Illuminate\Http\Request;
use DataTables;

class TypeOfPeiceController extends Controller
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

            $data = TypeOfPeice::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {


//                    $btn = '<a href="' . route('peices_type.get_materials', $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="edit btn btn-primary btn-sm viewProduct"> <i class="fa fa-eye"></i></a> &nbsp;';
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"> <i class="fa fa-edit"></i></a>';


                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash-o"></i></a>';


                    return $btn;

                })
                ->rawColumns(['action', 'type', 'refactoring'])
                ->make(true);

            return;
        }


        return view("admin.peices_types.index");

    }

    public function get_materials(Request $request, $id)
    {
        if ($request->ajax()) {


            $data = TypeMaterial::with('material')->where('type_of_peice_id', '=', $request->id)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    if ($row->material)
                        return $row->material->name;
                    return "name test";
                })
                ->addColumn('action', function ($row) {


                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"> <i class="fa fa-edit"></i></a>';


                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash-o"></i></a>';


                    return $btn;

                })
                ->rawColumns(['action', 'name'])
                ->make(true);

            return;
        }
        $type = TypeOfPeice::find($id);
        $raws = RawMaterial::all();
        return view('admin.peices_types.raws', compact(["type", "raws"]));


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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TypeOfPeice::updateOrCreate(['id' => $request->_id],

            [
                'name' => $request->name,
                'coast' => $request->coast,


            ]);


        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);

    }

    public function store_material(Request $request, $id)
    {
        TypeMaterial::updateOrCreate(['id' => $request->_id],

            [
                'type_of_peice_id' => $id,
                'raw_material_id' => $request->raw_id,
                'unit' => $request->unit,
                'amount' => $request->amount,
                'price' => $request->price,
                'details' => $request->details,

            ]);


        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(TypeOfPeice $ofPeice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = TypeOfPeice::find($id);

        return response()->json($item);
    }

    public function edit_material($id, $raw_id)
    {
        $item = TypeMaterial::find($raw_id);

        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\ClientType $clientType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        TypeOfPeice::updateOrCreate(['id' => $id],

            [

                'name' => $request->name,
                'coast' => $request->coast,


            ]);


        return response()->json(['success' => 'تم التعديل بنجاج']);
    }

    public function update_material(Request $request , $id, $raw_id)

    {
        TypeMaterial::updateOrCreate(['id' => $raw_id],

            [

                'raw_material_id' => $request->raw_id,
                'details' => $request->details,


            ]);


        return response()->json(['success' => 'تم التعديل بنجاج']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientType $clientType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        TypeOfPeice::find($id)->delete();


        return response()->json(['success' => ' تم الحذف بنجاح']);
    }

    public function destroy_material($id, $raw_id)
    {

        TypeMaterial::find($raw_id)->delete();


        return response()->json(['success' => ' تم الحذف بنجاح']);
    }
}
