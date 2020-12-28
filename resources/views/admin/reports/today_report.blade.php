@extends('layout.admin')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class=phonecontent-header">

            <h6 style="text-align:right;direction: rtl;">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                    <li><a href="#"> التقارير اليومية    </a></li>

                </ol>
            </h6>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="" method="get" id="repo_today">
            <div class="row">
                <div class="col-md-12 form-group pull-right">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">المقبوضات </a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"> المدفوعات </a></li>
                            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false"> مصاريف سيارة </a></li>
                            <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false"> أجور سيارة </a></li>
                            <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false"> الديون </a></li>
                            <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false"> الإجمالي </a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="row">
                                    <label style="margin-right:15px;"> المقبوضات </label>
                                    <table class="table table-bordered table-striped " dir="rtl" id="sales_tab">
                                            <thead>
                                            <tr>

                                                <th width="5%"> #</th>
                                                <th width="20%">المادة</th>
                                                <th width="20%">الكمية </th>
                                                <th width="20%">السعر الاجمالي</th>
                                                <th width="20%">العمليات</th>
                                            </tr>
                                            </thead>
                                        </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <div class="row">
                                    <label style="margin-right:15px;"> المدفوعات </label>
                                    <table class="table table-bordered table-striped " dir="rtl" id="purchase_tab">
                                        <thead>
                                        <tr>
                                            <th width="10%"> # </th>
                                            <th width="20%">المادة</th>
                                            <th width="20%">الكمية </th>
                                            <th width="20%">السعر الاجمالي</th>
                                            <th width="20%">العمليات</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                <div class="row">
                                    <label style="margin-right:15px;"> مصاريف سيارة </label>
                                    <table class="table table-bordered table-striped " dir="rtl" id="car_tab">
                                        <thead>
                                        <tr>
                                            <th width="10%"> # </th>
                                            <th width="20%"> نوع السيارة </th>
                                            <th width="20%"> اسم السائق </th>
                                            <th width="20%">المبلغ الاجمالي</th>
                                            <th width="20%">العمليات</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_4">
                                <div class="row">
                                    <label style="margin-right:15px;"> أجور سيارة </label>
                                    <table class="table table-bordered table-striped " dir="rtl" id="car_sales_tab">
                                        <thead>
                                        <tr>
                                            <th width="10%"> # </th>
                                            <th width="20%"> نوع السيارة </th>
                                            <th width="20%"> اسم العميل </th>
                                            <th width="20%"> المبلغ الاجمالي </th>
                                            <th width="20%">العمليات</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="tab_5">
                                <div class="row">
                                    <label style="margin-right:15px;"> الديون </label>
                                    <table class="table table-bordered table-striped " dir="rtl" id="money_tab">
                                        <thead>
                                        <tr>
                                            <th width="10%"> # </th>
                                            <th width="20%"> من العميل </th>
                                            <th width="20%"> المبلغ الإجمالي </th>
                                            <th width="20%"> التاريخ </th>
                                            <th width="20%">العمليات</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_6">
                                <div class="row">
                                    <label style="margin-right:15px;"> الإجمالي </label>
                                    <table class="table table-bordered table-striped " dir="rtl" id="totals_tab">
                                        <thead>
                                        <tr>
                                            <th width="10%"> # </th>
                                            <th width="20%"> الربح </th>
                                            <th width="20%"> الخسارة </th>
                                            <th width="20%"> الصافي </th>
                                            <th width="20%">العمليات</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>


                </div>
            </div>
            </form>
        </section>
        <!-- /.content -->
    </div>


@endsection
@push('pageJs')
    <script type="text/javascript">

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });


        var table = $('#sales_tab').DataTable({
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

            ajax: "{{ route('getsale.today') }}",

            columns: [

                {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                {data: 'name', name: 'name'},
                {data: 'amount', name: 'amount'},
                {data: 'full_price', name: 'full_price'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });
        var table = $('#purchase_tab').DataTable({
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

            ajax: "{{ route('reports.today_report') }}",

            columns: [

                {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                {data: 'name', name: 'name'},
                {data: 'amount', name: 'amount'},
                {data: 'total', name: 'total'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });
        var table = $('#car_tab').DataTable({
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

            ajax: "{{ route('reports.today_report') }}",

            columns: [

                {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                {data: 'name', name: 'name'},
                {data: 'amount', name: 'amount'},
                {data: 'total', name: 'total'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });
        var table = $('#car_sales_tab').DataTable({
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

            ajax: "{{ route('reports.today_report') }}",

            columns: [

                {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                {data: 'name', name: 'name'},
                {data: 'amount', name: 'amount'},
                {data: 'total', name: 'total'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });
        var table = $('#money_tab').DataTable({
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

            ajax: "{{ route('reports.today_report') }}",

            columns: [

                {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                {data: 'name', name: 'name'},
                {data: 'amount', name: 'amount'},
                {data: 'total', name: 'total'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });
        var table = $('#totals_tab').DataTable({
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

            ajax: "{{ route('reports.today_report') }}",

            columns: [

                {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                {data: 'name', name: 'name'},
                {data: 'amount', name: 'amount'},
                {data: 'total', name: 'total'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });
    </script>

@endpush
