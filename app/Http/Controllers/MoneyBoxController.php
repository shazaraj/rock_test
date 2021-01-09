<?php

namespace App\Http\Controllers;

use App\Car;
use App\MoneyBox;
use App\TypeOfMoneyBox;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MoneyBoxController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = MoneyBox::latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()
//
                ->addColumn('money_type',function($row){
                    return TypeOfMoneyBox::find($row->type)->first()->name;
                })

                ->addColumn('action', function($row){



                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">تعديل</a>';



                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">حذف</a>';



                    return $btn;

                })

                ->rawColumns(['action','money_type'])

                ->make(true);

            return;
        }
        $money_types = TypeOfMoneyBox::all();

        return view("admin.money_box.index",compact('money_types'));

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
    //client store
    public function store(Request $request)
    {

        MoneyBox::updateOrCreate(['id' => $request->_id],
            [
                'money' => $request->money,
                'type' => $request->type,
                'details' => $request->details,
            ]);
        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);
    }

//    // importer store
//    public function store_importer(Request $request)
//    {
//        Client::updateOrCreate(['id' => $request->_id],
//            [
//                'name' => $request->name,
//                'client_type' => $request->client_type_id,
//                'phone' => $request->phone,
//                'mobile' => $request->mobile,
//                'main_account_id' => $request->account_id,
//            ]);
//        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);
//    }
    /**
     * Display the specified resource.
     *
     * @param  \App\MoneyBox  $moneyBox
     * @return \Illuminate\Http\Response
     */
    public function show(MoneyBox $moneyBox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MoneyBox  $moneyBox
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $item = MoneyBox::find($id);

        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MoneyBox  $moneyBox
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
       MoneyBox::updateOrCreate(['id' => $id],

            [

                'money' => $request->get("money"),
                'type' => $request->get("type"),
                'details' => $request->get("details"),

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

        MoneyBox::find($id)->delete();


        return response()->json(['success'=>' تم الحذف بنجاح']);
    }




}
