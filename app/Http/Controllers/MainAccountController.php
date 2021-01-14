<?php

namespace App\Http\Controllers;

use App\MainAccount;
use Illuminate\Http\Request;
use DataTables;

class MainAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = MainAccount::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()


                ->addColumn('action', function($row){



                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"> <i class="fa fa-edit"></i></a>';



                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash-o"></i></a>';



                    return $btn;

                })

                ->rawColumns(['action'])

                ->make(true);

        }
        return view("admin.main_account.index");
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

       MainAccount::updateOrCreate(['id' => $request->_id],

            [
                'name' => $request->name,


            ]);


        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MainAccount  $mainAccount
     * @return \Illuminate\Http\Response
     */
    public function show(MainAccount $mainAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MainAccount  $mainAccount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $item = MainAccount::find($id);

        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MainAccount  $mainAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //
        MainAccount::updateOrCreate(['id' => $id],

            [

                'name' => $request->get("name"),

            ]);


        return response()->json(['success' => 'تم التعديل بنجاج']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MainAccount  $mainAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        MainAccount::find($id)->delete();


        return response()->json(['success'=>' تم الحذف بنجاح']);

    }
}
