<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillsController extends Controller
{
    //
    public function getImporter(Request $request)
    {
        //

        return view("admin.importers.importer_bills" );

    }
   public function printInvoice($data){

       $output = '<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
      <link rel="stylesheet" href="css/jquery.datepick.css">
  <link rel="stylesheet" href="css/humanity.datepick.css">
      <link rel="stylesheet" href="css/humanity.calendars.picker.css">
</head>
<body class="deep-purple-skin">'.
           '<div class="row text-center" dir="rtl">
<hr>
    <div class="col-md-4 pull-right">
        <p>معمل الحجار || rock</p>
        <p>فاتورة زبون </p>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
<hr>
<br>

<div class="col-md-7 pull-right text-right">
							</div>
							<div class="col-md-7" dir="rtl">
								<p>
								اسم الزبون : '.$data->bill->client_name.'
								</p>
							</div>
							<div class="col-md-12" dir="rtl">
								<p>
									اسم المادة :'.$data->bill->material_name.'
								</p>
								<p>

                                </p>
                            </div>
							<div class="col-md-12" dir="rtl">
							<p>
							الكمية :'.$data->bill->amount.'
							</p>
							</div>
							<div class="col-md-12" dir="rtl">
								<p>
								 السعر المتبقي : '.$data->bill->remain.'
								</p>
							</div>
							<div class="col-md-12" dir="rtl">
								<p>
									السعر الكلي : '.$data->bill->all_pr.'
								</p>
								<p>

								</p>
							</div>
							<div class="col-md-12" dir="rtl">
								<p>
									السعر المدفوع :'.$data->bill->paid.'
								</p>
								<p>

								</p>
							</div>
							<div class="col-md-12" dir="rtl">
								<p>
									التاريخ : '.$data->bill->bill_date.'
								</p>
								<p>

								</p>
							</div>
							<hr>
    <center>
     </center>
</div>
<hr>';
       return $output;
//       return view('client_sale_bils');

   }
}
