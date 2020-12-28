@extends('layout.admin')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class=phonecontent-header">

            <h6 style="text-align:right;direction: rtl;">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                    <li><a href="#"> التقارير الشهرية    </a></li>

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
                                        <th width="25%"> رمز العملية</th>
                                        <th width="25%"> المادة  </th>
                                        <th width="10%">  من حساب</th>
                                        <th width="10%"> إلى حساب </th>
                                        <th width="10%">  البيان    </th>
                                        <th width="10%">  المبلغ    </th>
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


@endsection
@push('pageJs')
    <script type="text/javascript">

        $(function () {


            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $('.input-daterange').datepicker({
                todayBtn:'linked',
                format:'yyyy-mm-dd',
                autoclose:true
            });

            load_data();

            function load_data(from_date = '', to_date = '')
            {
                var table = $('#tableData').DataTable({
                    "language": {
                        "processing": " جاري المعالجة",
                        "paginate": {
                            "first": "الأولى",
                            "last": "الأخيرة",
                            "next": "التالية",
                            "previous": "السابقة"
                        },
                        "search": "البحث :",
                        "loadingRecords": "جاري التحميل...",
                        "emptyTable": " لا توجد بيانات",
                        "info": "من إظهار _START_ إلى _END_ من _TOTAL_ النتائج",
                        "infoEmpty": "Showing 0 إلى 0 من 0 entries",
                        "lengthMenu": "إظهار _MENU_ البيانات",
                    },
                    processing: true,

                    serverSide: true,

                    ajax: "{{ route('reports.month_report') }}",

                    columns: [

                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                        {data: 'name', name: 'name'},
                        {data: 'amount', name: 'amount'},
                        {data: 'all_price', name: 'all_price'},



                    ]

                });
            }




        });

    </script>


@endpush
