@extends('layout.admin')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <h6 style="text-align:right;direction: rtl;">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                    <li><a href="#"> بطاقة فاتورة مادة</a></li>

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
{{--                                        <th width="10%"> اسم المورد </th>--}}
                                        <th width="20%"> اسم المادة </th>
                                        <th width="20%">  الكمية  </th>
                                        <th width="20%"> سعر الشراء </th>
{{--                                        <th width="15%">السعر الإجمالي</th>--}}
                                        <th width="20%">  التاريخ</th>

                                        <th width="15%">العمليات</th>
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
{{--                        <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                        <h4 class="modal-title">إضافة مادة جديدة</h4>
                    </div>
                    <div class="modal-body">

{{--                        <label> تحديد مورد </label>--}}
{{--                        <select name="importer_name" id="importer_name" class="form-control select2">--}}
{{--                            @if(count($import_raw) >0 )--}}
{{--                                @foreach ($import_raw as $type)--}}
{{--                                    <option value="{{$type->id}}">{{$type->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                        </select>--}}
                        <label> اسم المادة </label>
                        <select name="material_name" id="material_name" class="form-control select2">
                            @if(count($raw_material) >0 )
                                @foreach ($raw_material as $raw)
                                    <option value="{{$raw->id}}">{{$raw->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <br/>
                        <label> الكمية </label>
                        <input type="text" name="amount" id="amount" class="form-control">
                        <br/>
                        <label> سعر الشراء </label>
                        <input type="text" name="price" id="price" class="form-control">
                        <br/>
{{--                        <label> سعر المبيع </label>--}}
{{--                        <input type="text" name="price_sale" id="price_sale" class="form-control">--}}
{{--                        <br/>--}}
{{--                        <label> السعر الاجمالي </label>--}}
{{--                        <input type="text" name="total_bills" id="total_bills" class="form-control">--}}
{{--                        <br/>--}}
{{--                        <label> اجمالي الفاتورة </label>--}}
{{--                        <input type="text" name="total_sale" id="total_sale" class="form-control">--}}
{{--                        <br/>--}}
                        <label> التاريخ </label>
                        <input type="date" name="date" id="date" class="form-control">
                        <br/>


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

                ajax: "{{ route('materials.index') }}",

                columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                    {data: 'material_name', name: 'material_name'},
                    {data: 'amount', name: 'amount'},
                    {data: 'price', name: 'price'},
                    {data: 'date', name: 'date'},
                    {data: 'action', name: 'action', orderable: true, searchable: true},

                ]

            });


            $('#createNewProduct').click(function () {

                $('#action').val("إضافة");

                $('#_id').val('');

                $('#productForm').trigger("reset");

                $('#modelHeading').html("  إضافة مادة جديدة  ");


            });


            $('body').on('click', '.editProduct', function () {

                var product_id = $(this).data('id');

                $.get("{{ route('materials.index') }}" + '/' + product_id + '/edit', function (data) {

                    $('#modelheading').html("تعديل بيانات المواد ");

                    $("#action").html("تعديل");
                    $("#action").val("تعديل");
                    $('#advertModal').modal('show');

                    $('#_id').val(data.id);

                    // $('#importer_name').val(data.importer_name);
                    $('#material_name').val(data.material_name);
                    $('#amount').val(data.amount);
                    // $('#item_price').val(data.item_price);
                    // $('#price_sale').val(data.price_sale);
                    $('#price').val(data.price);
                    $('#date').val(data.date);


                })

            });


            $('#action').click(function (e) {

                e.preventDefault();

                $(this).html('Sending..');


                $.ajax({

                    data: $('#productForm').serialize(),

                    url: "{{ route('materials.store') }}",

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

                    url: "{{ route('materials.store') }}",

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

                    url: "{{ route('materials.store') }}" + '/' + product_id,

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
