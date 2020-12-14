@extends('layout.admin')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class=phonecontent-header">

            <h6 style="text-align:right;direction: rtl;">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                    <li><a href="#"> دفع  سلفة  للموظف </a></li>

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
                                    <form action="" method="POST" id="form_post">


                                    <select name="emp_id" id="emp_id" class="select2">
                                        @if(count($emps) )
                                        @foreach ($emps as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>

                                    <label>  مقدار السلفة   </label>
                                    <input type="text" name="paid" id="paid" >

                                    <label> التاريخ    </label>
                                    <input type="date" name="salary_date" id="salary_date" >

                                    <button type="button" id="post_btn"
                                            class="btn btn-info btn-lg">
                                        إضافة
                                    </button>
                                    </form>
                                </div>
                                <br/><br/>
                                <table id="tableData" class="table table-bordered table-striped" dir="rtl">
                                    <thead>
                                    <tr>

                                        <th width="10%"> #</th>
                                        <th width="20%"> اسم الموظف</th>

                                        <th width="20%"> المبلغ  </th>
                                        <th width="30%">   بتاريخ  </th>

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

@endsection
@push('pageJs')
    <script type="text/javascript">
var table = null;
        $(function () {

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });
            $("#emp_id").on('change', function() {
            var emp_id = this.value;
            var emp_sal_url = "{{ route('employee.get_pre_paid_view') }}"+'/'+emp_id;
        // $("#emp_id").text();
        // $("#emp_id").val();
            // $('#tableData').clear();
              table = $('#tableData').DataTable({
            "bDestroy":true,
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

                ajax: emp_sal_url,

                columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},


                    {data: 'client.name', name: 'name'},
                    {data: 'pre_paid', name: 'pre_paid'},
                    {data: 'paid_date', name: 'paid_date'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });
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
            $('#post_btn').click(function (e) {

                e.preventDefault();

                $(this).html('Sending..');


                $.ajax({

                    data: $('#form_post').serialize(),

                    url: "{{ route('employee.pre_paid_salary') }}",

                    type: "POST",

                    dataType: 'json',

                    success: function (data) {
                        $('#post_btn').html('إضافة');


                        toastr.success('تم الحفظ بنجاح');
                        table.draw();


                    },

                    error: function (data) {

                        console.log('Error:', data);

                        $('#post_btn').html('إضافة');

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
