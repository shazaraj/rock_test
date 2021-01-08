@extends('layout.admin')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <h6 style="text-align:right;direction: rtl;">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                    <li><a href="#">التقارير اليومية </a></li>

                </ol>
            </h6>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h4> التقارير اليومية</h4>
                </div>
                <div class="box-body">

                    <div class="row" style="margin-top: 30px;">
                        <div class="col-md-11 pull-right text-right">
                            <div class="table-responsive">
                                <br/>
                                <h4>
                                    <ul>
                                        <h1 id="sales"> المقبوضات <span class="badge bage-pill badge-info" >New</span></h1>
                                        <li> المدفوعات </li><span class="badge badge-pill badge-info">Info</span>
                                        <li> اجور سيارة </li><span class="badge badge-pill badge-warning">Warning</span>
                                        <li> الديون </li><span class="badge badge-pill badge-danger">Danger</span>
                                        <li> الارباح </li><span class="badge badge-pill badge-success">Success</span>
                                    </ul>
                                </h4>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->
                <div class="box-footer border-dark">
                    <div align="left">
                        <button type="button" id="details"
                                data-toggle="" data-target="" class="btn bg-light-blue">
                            details
                        </button>
                    </div>
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


                $.get("{{ route('sales.report') }}" , function (data) {

                    $('#sales').val(sales);
                    // $('#bays').val(bays);
                    // $('#car').val(car);


                })


        });

    </script>

@endpush
