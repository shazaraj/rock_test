@extends('layout.admin')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <h6 style="text-align:right;direction: rtl;">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                    <li><a href="#"> بطاقة مبيعات الزبون </a></li>

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


                                <form action="" method="post" id="client_sale_form">
                                    @csrf

<div class="col-md-12" style="text-align:right;direction: rtl;">
    <div class="col-md-6 pull-right form-group">

        <label> اسم الزبون </label>
{{--        <select name="client_id" id="client_id" class="form-control select2">--}}
        <select name="client_id" id="client_id" class="js-data select2">
            @if(count($clients) >0 )
            @foreach ($clients as $client_type)
            <option value="{{$client_type->id}}">{{$client_type->name}}</option>
            @endforeach
            @endif
        </select>
        <div align="right">
            <button type="button" id="createNewProduct"
                    data-toggle="modal" data-target="#advertModal" class="btn btn-info btn-lg">
                غير موجود/إضافة
            </button>
        </div>

    </div>

    <div class="col-md-6 form-group">
            <br>
        <label>  إجمالي الفاتورة    </label>
        <input type="text" name="money" id="money">
        <br>
        <label> واصل :</label>

        <input type="text" name="money_paid" id="money_paid">

        &nbsp;

    </div>

</div>
<div class="row">
    <div class="col-md-12 form-group pull-right">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="true"> المواد الأولية</a></li>
                <li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">المواد المصنعة</a></li>
                <li class=""><a href="#tab_2-3" data-toggle="tab" aria-expanded="false">تكاليف توصيل </a></li>



            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                    <div class="row">
                        <div class="col-md-3 pull-right">
                            <label for="">تحديد مادة</label>
                            <select name="raw_id" id="raw_id" class="form-control select2">
                                @if(count($raw_materials) >0 )
                                    @foreach ($raw_materials as $client_type)
                                        <option value="{{$client_type->id}}">{{$client_type->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3 pull-right">
                            <label for="">الكمية</label>
                            <input type="number" class="form-control" name="count" id="count" value="1">

                        </div>

                        <div class="col-md-3 pull-right">
                            <div class="form-group">
                                <label for="">السعر</label>
                                <input type="text" class="form-control" name="price" value="0" id="price">
                            </div>
                        </div>
                        <div class="col-md-3" style="padding:15px;">
                            <label for=""></label>
                            <button  type="button" class="btn btn-success" id="add_raw_material">إضافة</button>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table tab-info" id="raw_materials_table">
                            <tr>
                                <th>المادة</th>
                                <th>الكمية </th>
{{--                                <th>السعر الافرادي</th>--}}
                                <th>السعر الاجمالي</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2-2">
                    <div class="row">
                        <div class="col-md-3 pull-right">
                            <label for="">تحديد مادة مصنعة</label>

                            <select name="factoried_id" id="factoried_id" class="form-control select2">
                                @if(count($factoried_materials) >0 )
                                    @foreach ($factoried_materials as $client_type)
                                        <option value="{{$client_type->id}}">{{$client_type->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3 pull-right">
                            <label for="">الكمية</label>
                            <input type="number" class="form-control" name="f_count" id="f_count" value="1">

                        </div>

                        <div class="col-md-3 pull-right">
                            <div class="form-group">
                                <label for="">السعر</label>
                                <input type="text" class="form-control" name="f_price" value="0" id="f_price">
                            </div>
                        </div>
                        <div class="col-md-3" style="padding:15px;">
                            <label for=""></label>
                            <button  type="button" class="btn btn-success" id="add_factoried_material">إضافة</button>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table tab-info" id="factoried_materials_table">
                            <tr>
                                <th>المادة</th>
                                <th>الكمية </th>
                                <th>السعر الاجمالي</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2-3">
                    <div class="row">
                        <div class="col-md-3 pull-right">
                            <label for="">تحديد سيارة</label>

                            <select name="car_id" id="car_id" class="form-control select2">
                                @if(count($cars) >0 )
                                    @foreach ($cars as $client_type)
                                        <option value="{{$client_type->id}}">{{$client_type->car_type}} - {{$client_type->driver_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3 pull-right">
                            <label for=""> الكلفة</label>
                            <input type="number" class="form-control"  name="deliver_coast" id="deliver_coast" value="0">

                        </div>
                        <div class="col-md-3 pull-right">
                            <label for=""> المدفوع</label>
                            <input type="number" class="form-control"  name="deliver_paid" id="deliver_paid" value="0">

                        </div>


                    </div>

                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>


        <button type="submit" id="save_paid" class="btn btn-info"> حفظ  </button>

    </div>
</div>
                                </form>



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
                        <label> اسم الزبون </label>
                       <input type="text" name="name" id="name" class="form-control"  />
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

                        {{--                        <div>--}}
                        {{--                            <input type="checkbox" name="transportRentCh" value="transCh" >--}}
                        {{--                            يوجد مصاريف نقل--}}
                        {{--                            <br>--}}
                        {{--                            <label> السيارة    </label>--}}
                        {{--                            <select name="car_id" id="car_id" class="form-control" >--}}
                        {{--                                @if(count($cars)> 0)--}}
                        {{--                                    @foreach($cars as $main_account)--}}
                        {{--                                        <option value="{{$main_account->id}}">{{$main_account->car_num}}</option>--}}
                        {{--                                    @endforeach--}}
                        {{--                                @endif--}}

                        {{--                            </select>--}}
                        {{--                            <br>--}}
                        {{--                            <input type="radio"  name="transPaidType"> نقدي--}}
                        {{--                            <input type="radio" name="transPaidType"> دين--}}
                        {{--                            <br>--}}
                        {{--                            <input type="text" name="rentCoast">--}}
                        {{--                        </div>--}}
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


        $('.js-data').select2({
            ajax: {
                url: '{{route('clients.index')}}',
                dataType: 'json'
            }
        });

        $(function () {

            $("#add_raw_material").click(function (e) {
                e.preventDefault();
                var raw_name = $("#raw_id option:selected").text();
                var raw_id = $("#raw_id").val();
                var raw_qua = $("#count").val();
                var raw_price = $("#price").val();
                var money = Number( $("#money").val() );
                money += Number( raw_price );
                $("#money").val(money);
                $("#money_paid").val(money);
                $("#raw_materials_table").append("<tr>" +
                    "<td><input type='hidden' name='raws_id[]' value='"+raw_id+"'>"+raw_name+"</td>" +
                    "<td><input type='hidden' name='raws_qua[]' value='"+raw_qua+"'> "+raw_qua+"</td>" +
                    "<td><input type='hidden' name='raws_price[]' value='"+raw_price+"'> "+raw_price+"</td>" +

                    "</tr>")

            })
            $("#add_factoried_material").click(function (e) {
                e.preventDefault();
                var raw_name = $("#factoried_id option:selected").text();
                var raw_id = $("#raw_id").val();
                var raw_qua = $("#f_count").val();
                var raw_price = $("#f_price").val();
                var money = Number( $("#money").val() );
                money += Number( raw_price );
                $("#money").val(money);
                $("#money_paid").val(money);
                $("#factoried_materials_table").append("<tr>" +
                    "<td><input type='hidden' name='fs_id[]' value='"+raw_id+"'>"+raw_name+"</td>" +
                    "<td><input type='hidden' name='fs_qua[]' value='"+raw_qua+"'> "+raw_qua+"</td>" +
                    "<td><input type='hidden' name='fs_price[]' value='"+raw_price+"'> "+raw_price+"</td>" +

                    "</tr>")

            })

            $("#raw_id").on('change', function(){
                var product_id =this.value;

            $.get("{{ route('raw_materials.index') }}" + '/' + product_id + '/edit', function (data) {

            var price = data.item_price;
            var count = $("#count").val();
            $("#price").val(count*price);

            });


            });
            $("#factoried_id").on('change', function(){
                var product_id =this.value;

            $.get("{{ route('peices_type.index') }}" + '/' + product_id + '/edit', function (data) {

            var fprice = data.coast;
            var fcount = $("#f_count").val();
            $("#f_price").val(fcount*fprice);

            });


            });


            $('input[type=radio][name=client_selection]').change(function() {
                if (this.value == 'oldRadio') {
                    $("#client_id").show();
                    $("#name").hide();

                }

                else if (this.value == 'newRadio') {
                    $("#name").show();
                    $("#client_id").hide();
                }
            });

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

            $('#save_paid').click(function (e) {

                e.preventDefault();

                // $(this).html('Sending..');


                $.ajax({

                    data: $('#client_sale_form').serialize(),

                    url: "{{ route('client.store.sale') }}",

                    type: "POST",

                    dataType: 'json',

                    success: function (data) {


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
