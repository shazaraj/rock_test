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
                                <table id="tableData" class="table table-striped table-dark" dir="rtl">
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

    <div class="modal fade" id="billsModel" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content message-modal">

                <div class="modal-header">
                    <h4 class="model-title">تفاصيل الفاتورة</h4>
                    <button type="button" class="close" data-dismiss="model">&times;</button>
                </div>
                <div class="modal-body" ></div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-default" data-toggle="modal"> إغلاق </button>
                </div>
            </div>
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

                    {data: 'name', name: 'name'},
                    {data: 'remain', name: 'remain'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });

            // start model bills info
            {{--$(document).on('click', '#billsModel', function(e){--}}
            {{--    e.preventDefault();--}}
            {{--    var url = $(this).data('url');--}}
            {{--    $('.message-modal').html('');--}}
            {{--    $('#modal-loader').show();--}}
            {{--    $.ajax({--}}
            {{--        url: {{route('getbills')}},--}}
            {{--        type: 'GET',--}}
            {{--        dataType: 'html'--}}
            {{--    })--}}
            {{--        .done(function(data){--}}
            {{--            $('.message-modal').html('');--}}
            {{--            $('.message-modal').html(data); // load response--}}
            {{--            $('#modal-loader').hide();        // hide ajax loader--}}
            {{--        })--}}
            {{--        .fail(function(){--}}
            {{--            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');--}}
            {{--            $('#modal-loader').hide();--}}
            {{--        });--}}
            {{--});--}}

            /// end model
            $('body').on('click', '.editProduct', function () {

                var product_id = $(this).data('id');

                $.get("{{ route('client.sale') }}" + '/' + product_id + '/edit', function (data) {

                    $('#modelheading').html("عرض بيانات الفاتورة");

                    $("#action").html("تعديل");
                    $("#action").val("تعديل");
                    $('#advertModal').modal('show');
                    //
                    // columns: [
                    //
                    //     {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    //     {data: 'name', name: 'name'},
                    //     {data: 'type', name: 'type'},
                    //     {data: 'phone', name: 'phone'},
                    //     {data: 'mobile', name: 'mobile'},
                    //     {data: 'main_account', name: 'main_account'},
                    //     {data: 'action', name: 'action', orderable: false, searchable: false},
                    //
                    // ]


                })

            });

            $('body').on('click', '.deleteProduct', function () {


                var product_id = $(this).data("id");

                var co = confirm("  هل أنت متأكد من الحذف  !");
                if (!co) {
                    return;
                }


                $.ajax({

                    type: "DELETE",

                    url: "{{ route('peices_type.store') }}" + '/' + product_id,

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
