@extends('layout.admin')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <h6 style="text-align:right;direction: rtl;">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                    <li><a href="#"> فاتورة زبون </a></li>

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
                                        <th width="30%"> اسم الزبون </th>
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
                    <div class="modal-body">
                        <label> اسم العميل </label>
                        <input type="text" id="name" disabled>
                        <br/>

{{-- for each loop to fetch data bills for any material --}}
                        <div >
                            <table>
                               <thead>
                               <tr>
                                   <th> اسم المادة |  </th>
                                   <th>  الكمية </th>
                               </tr>
                               </thead>
                                <tbody id="raws"></tbody>
                            </table>
                        </div>
                        <br/>
{{-- end foreach loop --}}
                        <label> المبلغ المدفوع </label>
                        <input type="text" id="paid" disabled>
                        <br/>
                        <label>  المبلغ الإجمالي </label>
                        <input type="text" id="price" disabled>
                        <br/>
                        <label> المبلغ المتبقي </label>
                        <input type="text" id="remain" disabled>
                        <br/>
                        <label> تاريخ الفاتورة </label>
                        <input type="text" id="date" disabled>
                        <br/>

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

                ajax: "{{ route('client.sale') }}",

                columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                    {data: 'client', name: 'name'},
                    {data: 'remain', name: 'remain'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });


            $('body').on('click', '.editProduct', function () {

                var product_id = $(this).data('id');

                $.get("{{ route('client.sale') }}" + '/' + product_id + '/edit', function (data) {

                    $('#modelheading').html("عرض تفاصيل الفاتورة");

                    $("#action").html("طباعة");
                    $("#action").val("طباعة");
                    $('#advertModal').modal('show');

                    $('#_id').val(data.id);

                    $('#name').val(data.client);
                    $("#raws").html("");
                    if(data.raws){
                        var x = "";
                        for(var i =0; i< data.raws.length;i++){
                          //  alert(data.raws[i].name);
                            x +="<tr > " +
                                "<td> " + data.raws[i].name +" </td>" +
                                "<td> " + data.raws[i].amount +" </td>" +
                            "</tr>";
                        }
                        $("#raws").html( x);
                    }
                    $('#paid').val(data.bill.paid);
                    $('#price').val(data.bill.all_price);
                    $('#remain').val(data.bill.remain);
                    $('#date').val(data.bill.created_at);


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
