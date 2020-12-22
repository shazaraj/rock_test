@extends('layout.admin')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class=phonecontent-header">

            <h6 style="text-align:right;direction: rtl;">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                    <li><a href="#">  الصندوق المالي     </a></li>

                </ol>
            </h6>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">


                </div>
                <div class="box-body">

                    <div class="row" style="margin-top: 30px;">
                        <div class="col-md-11 pull-right text-right">
                            <div class="table-responsive">
                                <br/>
                                <div align="right">

                                </div>
                                <br/><br/>
                                <table id="tableData" class="table table-bordered table-striped" dir="rtl">
                                    <thead>
                                    <tr>

                                        <th width="5%"> #</th>
                                        <th width="25%"> رقم السيارة</th>
                                        <th width="10%"> نوعها</th>
                                        <th width="10%"> الزبون  </th>
                                        <th width="10%">  الأجار    </th>
                                        <th width="10%">  المدفوع    </th>
                                        <th width="10%">  التاريخ    </th>

                                    </tr>
                                    </thead>
                                </table>

                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>

    <div id="advertModal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" id="productForm" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">إضافة سيارة  </h4>
                    </div>
                    <div class="modal-body">


                        <label> رقم السيارة </label>
                        <input type="text" name="car_num" id="car_num" class="form-control"/>
                        <br/>
                        <label> نوع السيارة </label>
                        <input type="text" name="car_type" id="car_type" class="form-control">
                        <br/>
                        <label> راتب السائق   </label>
                        <input type="text" name="driver_salary" id="driver_salary" class="form-control">

                        <br/>
                        <label>  إسم السائق   </label>
                        <input type="text" name="driver_name" id="driver_name" class="form-control">


                    </div>
                    <div class="modal-footer">
                        <center>
                            <input type="hidden" name="_id" id="_id"/>
                            <input type="hidden" name="operation" id="operation"/>
                            <input type="submit" name="action" id="action" class="btn btn-success" value="إضافة"/>
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">إغلاق</button>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
