@extends('layout.admin')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class=phonecontent-header">

            <h6 style="text-align:right;direction: rtl;">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                    <li><a href="#"> الموظفين </a></li>

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
                                    <button type="button" id="createNewProduct"
                                            data-toggle="modal" data-target="#advertModal" class="btn btn-info btn-lg">
                                        إضافة
                                    </button>
                                </div>
                                <br/><br/>
                                <table id="tableData" class="table table-bordered table-striped" dir="rtl">
                                    <thead>
                                    <tr>

                                        <th width="5%"> #</th>
                                        <th width="15%"> اسم الموظف</th>
                                        <th width="10%"> الهاتف</th>
                                        <th width="10%"> تاريخ البدء</th>
                                        <th width="10%"> الراتب الشهري</th>
                                        <th width="10%"> أجر الساعة</th>
                                        <th width="10%"> أجر القطعة</th>
                                        <th width="20%">العمليات</th>
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
                        <h4 class="modal-title">إضافة موظف جديد</h4>
                    </div>
                    <div class="modal-body">


                        <label> اسم الموظف </label>
                        <input type="text" name="name" id="name" class="form-control"/>
                        <br/>
                        <label> الهاتف </label>
                        <input type="text" name="phone" id="phone" class="form-control">
                        <br/>
                        <label> تاريخ البدء </label>
                        <input type="date" name="start_date" id="start_date" class="form-control">

                        <br/>
                        <label> الراتب الشهري </label>
                        <input type="text" name="month_salary" id="month_salary" class="form-control">
                        <br/>
                        <label> أجر الساعة </label>
                        <input type="text" name="hour_salary" id="hour_salary" class="form-control">
                        <br>
                        <label>  الأجر على القطعة </label>
                        <input type="text" name="item_salary" id="item_salary" class="form-control">


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

                ajax: "{{ route('employees.index') }}",

                columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                    {data: 'name', name: 'name'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'month_salary', name: 'month_salary'},
                    {data: 'hour_salary', name: 'hour_salary'},
                    {data: 'item_salary', name: 'item_salary'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });


            $('#createNewProduct').click(function () {

                $('#action').val("إضافة");

                $('#_id').val('');

                $('#productForm').trigger("reset");

                $('#modelHeading').html("  إضافة جديد  ");


            });


            $('body').on('click', '.editProduct', function () {

                var product_id = $(this).data('id');

                $.get("{{ route('employees.index') }}" + '/' + product_id + '/edit', function (data) {

                    $('#modelheading').html("تعديل بيانات الموظف");

                    $("#action").html("تعديل");
                    $("#action").val("تعديل");
                    $('#advertModal').modal('show');

                    $('#_id').val(data.id);

                    $('#name').val(data.name);
                    $('#phone').val(data.mobile);
                    $('#start_date').val(data.start_date);
                    $('#month_salary').val(data.month_salary);
                    $('#item_salary').val(data.item_salary);
                    $('#hour_salary').val(data.hour_salary);


                })

            });


            $('#action').click(function (e) {

                e.preventDefault();

                $(this).html('Sending..');


                $.ajax({

                    data: $('#productForm').serialize(),

                    url: "{{ route('employees.store') }}",

                    type: "POST",

                    dataType: 'json',

                    success: function (data) {
                        $('#action').html('إضافة');


                        $('#productForm').trigger("reset");
                        $('#advertModal').modal("hide");

                        toastr.success('تم الحفظ بنجاح');
                        table.draw();


                    },

                    error: function (data) {

                        console.log('Error:', data);

                        $('#action').html('إضافة');

                    }

                });

            });
            $('#editBtn').click(function (e) {

                e.preventDefault();

                $(this).html('saving..');


                $.ajax({

                    data: $('#productEditForm').serialize(),

                    url: "{{ route('employees.store') }}",

                    type: "POST",

                    dataType: 'json',

                    success: function (data) {
                        $('#action').html('   حفظ التعديلات &nbsp; <i class="fa fa-save"></i> ');


                        $('#productEditForm').trigger("reset");
                        $('#ajaxModel').modal('hide');

                        table.draw();

                        toastr.success("تم التعديل بنجاح");

                    },

                    error: function (data) {

                        console.log('Error:', data);
                        $('#ajaxModel').modal('hide');

                        $('#editBtn').html('Save changes &nbsp; <i class="fa fa-save"></i> ');

                    }

                });

            });


            $('body').on('click', '.deleteProduct', function () {


                var product_id = $(this).data("id");

                var co = confirm("  هل أنت متأكد من الحذف  !");
                if (!co) {
                    return;
                }


                $.ajax({

                    type: "DELETE",

                    url: "{{ route('employees.store') }}" + '/' + product_id,

                    success: function (data) {

                        table.draw();

                    },

                    error: function (data) {

                        console.log('خطأ:', data);

                    }

                });

            });


        });

    </script>


@endpush
