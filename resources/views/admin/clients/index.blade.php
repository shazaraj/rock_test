@extends('layout.admin')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <h6 style="text-align:right;direction: rtl;">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                    <li><a href="#"> بطاقة زبون </a></li>

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
                                <table id="tableData" class="table table-bordered table-striped " dir="rtl">
                                    <thead>
                                    <tr>

                                        <th width="5%"> #</th>
                                        <th width="25%"> اسم الزبون</th>
                                        <th width="10%"> نوع الزبون</th>
                                        <th width="10%"> الهاتف</th>
                                        <th width="10%"> الموبايل</th>
                                        <th width="10%"> الحساب الرئيس</th>

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
        <div class="modal-dialog" style="width: 90%;">
            <form method="post" id="productForm" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">إضافة زبون جديد</h4>
                    </div>
                    <div class="modal-body">
{{--                        <input type="hidden" name="id" id="id"/>--}}
                        <label> اسم الزبون </label>
                        <input type="text" name="name" id="name" class="form-control"/>
                        <br/>
                        <label> نوع الزبون </label>
                        <select name="client_type_id" id="client_type_id" class="form-control select2">
                            @if(count($client_types) >0 )
                                @foreach ($client_types as $client_type)
                                    <option value="{{$client_type->id}}">{{$client_type->name}}</option>
                                @endforeach
                                    @endif
                        </select>
                        <br/>
                        <label> الهاتف </label>
                        <input type="text" name="phone" id="phone" class="form-control">
                        <br/>
                        <label> الموبايل </label>
                        <input type="text" name="mobile" id="mobile" class="form-control">
                        <br/>
                        <label> نوع الحساب الرئيس </label>
                        <select name="account_id" id="account_id" class="form-control" >
                            @if(count($main_accounts)> 0)
                                @foreach($main_accounts as $main_account)
                                    <option value="{{$main_account->id}}">{{$main_account->name}}</option>
                                @endforeach
                            @endif

                        </select>
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

            ajax: "{{ route('clients.index') }}",

            columns: [

                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'type', name: 'type'},
                {data: 'phone', name: 'phone'},
                {data: 'mobile', name: 'mobile'},
                {data: 'main_account', name: 'main_account'},
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

            $.get("{{ route('clients.index') }}" + '/' + product_id + '/edit', function (data) {

                $('#modelheading').html("تعديل بيانات الزبون");

                $("#action").html("تعديل");
                $("#action").val("تعديل");
                $('#advertModal').modal('show');

                $('#_id').val(data.id);

                $('#name').val(data.name);
                $('#client_type_id').val(data.client_type);
                $('#phone').val(data.phone);
                $('#mobile').val(data.mobile);
                $('#account_id').val(data.main_account_id);


            })

        });


        $('#action').click(function (e) {

            e.preventDefault();

            $(this).html('Sending..');


            $.ajax({

                data: $('#productForm').serialize(),

                url: "{{ route('clients.store') }}",

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

                url: "{{ route('clients.store') }}",

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

                url: "{{ route('clients.store') }}" + '/' + product_id,

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
