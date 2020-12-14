@extends('layout.admin')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class=phonecontent-header">

            <h6 style="text-align:right;direction: rtl;">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                    <li><a href="#"> وصل العملاء </a></li>

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
                                        <th width="20%"> اسم العميل</th>
                                        <th width="20%"> المبلغ المدفوع</th>
                                        <th width="20%"> المبلغ المستحق</th>
                                        <th width="15%"> التاريخ </th>
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
                        <h4 class="modal-title">إضافة وصل عميل </h4>
                    </div>
                    <div class="modal-body">


                        <label> تحديد العميل </label>
                        <select name="importer_id" id="importer_id" class="form-control select2">
                            @if(count($get_receipt) >0 )
                                @foreach ($get_receipt as $name)
                                    <option value="{{$name->id}}">{{$name->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <br/>
                        <label> المبلغ المدفوع </label>
                        <input type="text" name="paid" id="paid" class="form-control">
                        <br/>
                        <label> المبلغ المستحق </label>
                        <input type="text" name="coast" id="coast" class="form-control">

                        <br/>
                        <label> التاريخ </label>
                        <input type="date" name="date" id="date" class="form-control">
                        <br/>

                    </div>
                    <div class="modal-footer">
                        <center>
                            <input type="hidden" name="new_id" id="new_id"/>
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

                ajax: "{{ route('receipt.index') }}",

                columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                    {data: 'importer_id', name: 'importer_id'},
                    {data: 'coast', name: 'coast'},
                    {data: 'paid', name: 'paid'},
                    {data: 'date', name: 'date'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });


            $('#createNewProduct').click(function () {

                $('#action').val("إضافة");

                $('#new_id').val('');

                $('#productForm').trigger("reset");

                $('#modelHeading').html("  إضافة وصل جديد  ");


            });


            $('body').on('click', '.editProduct', function () {

                var product_id = $(this).data('id');

                $.get("{{ route('receipt.index') }}" + '/' + product_id + '/edit', function (data) {

                    $('#modelheading').html("تعديل بيانات الوصل");

                    $("#action").html("تعديل");
                    $("#action").val("تعديل");
                    $('#advertModal').modal('show');

                    $('#new_id').val(data.id);

                    $('#importer_id').val(data.importer_id);
                    $('#coast').val(data.coast);
                    $('#paid').val(data.paid);
                    $('#date').val(data.date);


                })

            });


            $('#action').click(function (e) {

                e.preventDefault();

                $(this).html('Sending..');


                $.ajax({

                    data: $('#productForm').serialize(),

                    url: "{{ route('receipt.store') }}",

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

                    url: "{{ route('receipt.store') }}",

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

                    url: "{{ route('receipt.store') }}" + '/' + product_id,

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
