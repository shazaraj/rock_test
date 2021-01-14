<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/machines','MachineController');
Route::resource('/main_account','MainAccountController');
Route::resource('/client_type','ClientTypeController');
Route::resource('/clients','ClientController');
Route::resource('/raw_materials','RawMaterialController');
Route::resource('/cars','CarController');
Route::resource('/cars_maintainances','CarMaintainanceController');
Route::resource('/peices_type','TypeOfPeiceController');
Route::resource('/factoried_materials','FactoriedMaterialController');
Route::resource('/production_cards','ProductionCardController');
Route::resource('/purchases','PurchaseController');
Route::resource('/sales','SaleController');
Route::resource('/importer','ImporterController');
Route::resource('/materials','ImporterDetailsController');
Route::resource('/money_box','MoneyBoxController');
Route::resource('/importer/bills','ImporterController@bills');
Route::resource('/employees','EmpController');
Route::resource('/receipt','ReceiptController');



Route::post('printInvoice', 'BillsController@printInvoice') ->name('print.invoice');

/// get started to be continued////
///
//Route::resource('/client_bills','ClientsBillsController');
//Route::resource('/importer_bills','ImporterBillsController');
Route::resource('/other_payments','OtherPaymentController');

//// end of bills ////

Route::post('client/sale/new', 'ClientController@add_new_sale')->name("client.store.sale");
Route::post('importer/sale/new', 'ImporterController@add_new_sale')->name("importer.store.sale");
Route::get('client/bills', 'ClientController@client_bills');

Route::get('bills/{id}','ClientController@getbills');
Route::get('client_sale_bills', 'ClientController@client_sale_bills')->name("client.sale");
Route::get('client_sale_bills/{id}/edit', 'ClientController@getbills')->name("client.sale1");
Route::get('importer_sale_bills', 'ImporterController@importer_sale_bills')->name("importer.sale");
Route::get('importer_sale_bills/{id}/details', 'ImporterController@importer_sale_bills_details')->name("importer.sale1");

///report sale

Route::get('/report', 'TodayReportController@getRepo');
Route::get('importer_bill', 'ImporterController@importer_bill');


// importer bills ticket
//get
Route::get('client/sale/new', 'ClientController@client_new_sale_form');
Route::get('importer_sale', 'ImporterController@importer_new_sale_form');
//add new importer sale - client sale
//Route::post('client/sale/new', 'ClientController@add_new_sale')->name("client.store.sale");

///

Route::get('receipt/index','ReceiptController@index');

Route::get('importer_bills','ImporterDetailsController@index');

Route::get('employee/paid_salary','EmpController@paid_salary_form');
Route::get('employee/index','EmpController@index');
Route::post('employee/paid_salary','EmpController@paid_salary')->name('employee.paid_salary');
Route::get('employee/get_salaries','EmpController@get_emp_salaries_history')->name('employee.get_salaries_view');
Route::get('employee/get_salaries/{emp_id}','EmpController@get_emp_salaries_history')->name('employee.get_salaries');

Route::get('employee/pre_paid','EmpController@pre_paid_form');
Route::post('employee/pre_paid','EmpController@pre_paid')->name('employee.pre_paid_salary');
Route::get('employee/get_pre_paids','EmpController@get_emp_pre_paid_history')->name('employee.get_pre_paid_view');
Route::get('employee/get_pre_paids/{emp_id}','EmpController@get_emp_pre_paid_history')->name('employee.get_pre_paid');


Route::get('/car/paid','CarController@show_paid_form')->name("car.paid.add");
Route::post('/car/paid','CarController@store_paid')->name("car.paid.store");
Route::delete('/car/paid/{id}','CarController@destroy_paid')->name("car.paid.delete");

Route::get('/peices_type_materials/{id}','TypeOfPeiceController@get_materials')->name("peices_type.get_materials");
Route::post('/peices_type_materials/{id}','TypeOfPeipeices_type.get_materialsceController@store_material')->name("peices_type.raws.store");
Route::get('/peices_type_materials/{id}/{raw_id}/raw','TypeOfPeiceController@edit_material')->name("peices_type.raws.edit");
Route::delete('/peices_type_materials/{id}/{raw_id}','TypeOfPeiceController@destroy_material')->name("peices_type.raws.destory");


Route::get('store/raw_materials', 'StoreController@raw_materials')->name('store.raw_materials.index');
Route::get('store/factoried_materials', 'StoreController@factoried_materials')->name('store.factoried_materials.index');

//money box route
Route::get('money_box', 'MoneyBoxController@index')->name('money.box.index');

Route::get('car/history', 'CarController@show_car_history')->name('car.history.index');
//Route::get('money_box', 'MoneyBoxController@getMoney')->name('money.box.index');
//Route::get('/today/report', 'TodayReportController@getSale')->name('reports.today_report');
Route::get('/getSale/{day_repo}', 'TodayReportController@getSale')->name('reports.today_report');
Route::get('/getSale', 'TodayReportController@sale_report')->name('sales.report');
Route::get('/month/report/{from_date}/{to_date}', 'MonthReportController@index')->name('reports.month_report');
Route::get('/month/report', 'MonthReportController@month_report')->name('reports.month');
