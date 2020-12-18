@extends('layout.admin')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <h6 style="text-align:right;direction: rtl;">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                    <li><a href="#"> فاتورة مورد </a></li>

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
                                <table id="tableData"  class="table table-striped table-dark" dir="rtl">
                                    <thead>
                                    <tr>

                                        <th width="10%"> #</th>
                                        <th width="30%"> اسم المورد </th>
                                        <th width="30%">المبلغ المستحق </th>
                                        <th width="30%">العمليات</th>
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
                        <h4 class="modal-title"> تفاصيل الفاتورة || <b> rock </b></h4>
                    </div>
                    <input type="hidden" id="product_id">
{{--                    ["clients","bills","factory","raws"])--}}
                    @foreach($clients as $client)
                        <div class="modal-body">
                        <label> اسم العميل </label> {{$client->name}}
                        @endforeach
                        <br/>
                        @foreach($factory as $fact)
                            <label> اسم المادة المصنعة </label>{{$fact->raw_id}} <b> || </b>  <label> الكمية </label> {{$fact->amount}}
                            <br/>
                        @endforeach
                        @foreach($raws as $raw)
                            <label> اسم المادة الأولية </label>{{$raw->raw_id}} <b> || </b>  <label> الكمية </label> {{$raw->amount}}
                            <br/>
                        @endforeach
                        @foreach($bills as $bill)
                        <label> المبلغ المدفوع </label>  {{$bill->paid}}
                        <br/>
                        <label>  المبلغ الإجمالي </label> {{$bill->all_price}}
                        <br/>
                        <label> المبلغ المتبقي </label> {{$bill->remain}}
                        <br/>
                        <label> تاريخ الفاتورة </label> {{$bill->created_at}}
                        <br/>
                        @endforeach

                    </div>
                    <div class="modal-footer">
                        <center>
                            <input type="hidden" name="_id" id="_id"/>
                            <input type="hidden" name="operation" id="operation"/>
                            <input type="submit" name="action" id="action" class="btn btn-success" value="طباعة"/>
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

                ajax: "{{ route('importer.sale') }}",

                columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                    {data: 'name', name: 'name'},
                    {data: 'remain', name: 'remain'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });


            $('body').on('click', '.editProduct', function () {

                var product_id = $(this).data('id');

                $.get("{{ route('importer.sale') }}" + '/' + product_id + '/view', function (data) {

                    $('#modelheading').html("تفاصيل الفاتورة");

                    $("#action").html("طباعة");
                    $("#action").val("طباعة");
                    $('#advertModal').modal('show');
                    //
                    // $('#_id').val(data.id);
                    //
                    // $('#name').val(data.name);
                    // $('#client_type_id').val(data.client_type);
                    // $('#phone').val(data.phone);
                    // $('#mobile').val(data.mobile);
                    // $('#account_id').val(data.main_account_id);


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
                        $('#action').html('طباعة');


                        $('#productForm').trigger("reset");
                        $('#advertModal').modal("hide");

                        toastr.success('تم الحفظ بنجاح');
                        table.draw();


                    },

                    error: function (data) {

                        console.log('Error:', data);

                        $('#action').html('طباعة');

                    }

                });

            });
            $('#editBtn').click(function (e) {

                e.preventDefault();

                $(this).html('saving..');


                $.ajax({

                    data: $('#productEditForm').serialize(),

                    url: "{{ route('importer.sale') }}",

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

                    url: "{{ route('client.sale') }}" + '/' + product_id,

                    success: function (data) {

                        table.draw();

                    },

                    error: function (data) {

                        console.log('خطأ:', data);

                    }

                });

            });


        });

    </script>>

@endpush
