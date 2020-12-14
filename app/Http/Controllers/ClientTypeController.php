<?php

namespace App\Http\Controllers;

use App\ClientType;
use Illuminate\Http\Request;
use DataTables;
class ClientTypeController extends Controller
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

            $data = ClientType::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()


                ->addColumn('action', function($row){



                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">تعديل</a>';



                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">حذف</a>';



                    return $btn;

                })

                ->rawColumns(['action'])

                ->make(true);

        }
        return view("admin.client_types.index");
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
        ClientType::updateOrCreate(['id' => $request->_id],

            [
                'name' => $request->name,


            ]);


        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function show(ClientType $clientType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $item = ClientType::find($id);

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
        ClientType::updateOrCreate(['id' => $id],

            [

                'name' => $request->get("name"),

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

        ClientType::find($id)->delete();


        return response()->json(['success'=>' تم الحذف بنجاح']);
    }
}
