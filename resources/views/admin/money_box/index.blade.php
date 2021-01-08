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
                                        <th width="20"> سجل أجور السيارة </th>
                                        <th width="20%"> سجل رواتب الموظفين </th>
                                        <th width="20%"> المقبوضات من الزبائن  </th>
                                        <th width="20%">  المدفوعات إلى الموردين  </th>
                                        <th width="15">   سجل أجور السائقين  </th>

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

                ajax: "{{ route('money.box.index') }}",

                columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                    {data: 'car', name: 'data.paid'},
                    {data: 'emp', name: 'emp.salary'},
                    {data: 'bill', name: 'bill.paid'},
                    {data: 'importer', name: 'importer.paid'},
                    {data: 'salary', name: 'salary.money_paid'},

                    // {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });

        });

    </script>>

@endpush
