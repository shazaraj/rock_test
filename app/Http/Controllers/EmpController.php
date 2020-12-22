<?php

namespace App\Http\Controllers;

use App\Client;
use App\Emp;
use App\EmpPrePaid;
use App\EmpSalary;
use App\MainAccount;
use Illuminate\Http\Request;
use DataTables;

class EmpController extends Controller
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

            $data = Emp::latest()->where('is_deleted','=',0)->get();

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

        return view("admin.emps.index" );

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
        Emp::updateOrCreate(['id' => $request->_id],

            [
                'name' => $request->name,
                'mobile' => $request->phone,
                'start_date' => $request->start_date,
                'month_salary' => $request->month_salary,
                'hour_salary' => $request->hour_salary,
                'item_salary' => $request->item_salary,
                'is_deleted' => "0"

            ]);


        return response()->json(['success' => ' تمت الإضافة بنجاح    .']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Emp $emp)
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
        $item = Emp::find($id);

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
        Emp::updateOrCreate(['id' => $id],

            [

                'name' => $request->get("name"),
                'mobile' => $request->get("phone"),
                'start_date' => $request->get("start_date"),
                'month_salary' => $request->get("month_salary"),
                'hour_salary' => $request->get("hour_salary"),
                'item_salary' => $request->get("item_salary"),
                'is_deleted' => "0"

            ]);


        return response()->json(['success' => 'تم التعديل بنجاج']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientType  $clientType
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        // important note
        // add is_deleted=[0-> not delete,1 -> delete]
        // select emp where is_deleted != 1 to avoid problem with old report

        $is_deleted = 1;
        Emp::where('id','=',$id)->update(["is_deleted"=>$is_deleted]);


        return response()->json(['success'=>' تم الحذف بنجاح']);
    }

     public function paid_salary_form()
    {
        $emps = Emp::latest()->where('is_deleted','=',0)->get();

        return view('admin.emps.salary', compact('emps'));
    }
    public function get_emp_salaries_history(Request $request, $emp_id){
        if ($request->ajax()) {
            // get latest driver.

            $data = EmpSalary::where('emp_id','=',$emp_id)->latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()

//
//                ->addColumn('action', function($row){
//
//
//
//
//                    //                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">تعديل</a>';
//
//
//
//                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">حذف</a>';
//
//
//
//                    return $btn;
//
//                })
                ->addColumn('name', function ($row){
                    return Emp::find($row->emp_id)->name;

                })


//                ->rawColumns(['action'])

                ->make(true);

            return;
        }
    }
    public function paid_salary(Request $request)
    {
        // return $request->all();
        EmpSalary::create(
        [
            'emp_id' => $request->emp_id,
            'salary' => $request->salary,
            'salary_date' => $request->salary_date,

        ]);


    return response()->json(['success' => ' تمت الإضافة بنجاح    .']);

    }

    public function pre_paid_form()
    {
        $emps = Emp::latest()->where('is_deleted','=',0)->get();

        return view('admin.emps.pre_paid', compact('emps'));
    }
    public function get_emp_pre_paid_history(Request $request, $emp_id){
        if ($request->ajax()) {
            // get latest driver.

            $data = EmpPrePaid::with('client')->where('emp_id','=',$emp_id)->latest()->get();

            return Datatables::of($data)

                ->addIndexColumn()


                ->addColumn('action', function($row){




                    //                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">تعديل</a>';



                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">حذف</a>';



                    return $btn;

                })
                ->addColumn("name",function ($row){
                    return Emp::find($row->emp_id)->name;
                })


                ->rawColumns(['action','name'])

                ->make(true);

            return;
        }
    }
    public function pre_paid(Request $request)
    {
        // return $request->all();
        EmpPrePaid::create(
        [
            'emp_id' => $request->emp_id,
            'pre_paid' => $request->paid,
            'paid_date' => $request->salary_date,

        ]);


    return response()->json(['success' => ' تمت الإضافة بنجاح    .']);

    }



}
