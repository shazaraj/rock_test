@extends('layout.admin')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <h6 style="text-align:right;direction: rtl;">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                    <li><a href="#"> التقارير الشهرية    </a></li>

                </ol>
            </h6>
        </section>
        <!-- /.content -->

        <section class="content">
            <h4>
                <b> تقرير الفترة الزمنية من تاريخ :_ {{$from??''}} إلى تاريخ :_ {{$to??''}}  </b>
            </h4>
            <br>
            <div class="row " dir="rtl">
                <div class="col-12">

                    <div class="row rtl" >
                        <div class="row">
                            <div class="col-lg-4 pull-right">
                                <div class="info-box">
                                    <span class="info-box-icon bg-blue-gradient"><i class="fa fa-dollar"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">المقبوضات</span>
                                        <h3 class="info-box-number"> {{$sales??''}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green-gradient"><i class="fa fa-btc"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">المدفوعات</span>
                                        <h3 class="info-box-number">{{$payments??''}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <div class="info-box">
                                    <span class="info-box-icon bg-yellow-gradient"><i class="fa fa-car"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">أجور سيارة</span>
                                        <h3 class="info-box-number">{{$car??''}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <br>
                        <div class="row">
                            <div class="col-lg-4 pull-right">
                                <div class="info-box">
                                    <span class="info-box-icon bg-black-gradient"><i class="fa fa-money"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">الديون</span>
                                        <h3 class="info-box-number">{{$remain??''}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <div class="info-box">
                                    <span class="info-box-icon bg-red-gradient"><i class="fa fa-thumbs-o-down"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">الخسارة</span>
                                        <h3 class="info-box-number">{{$loss??''}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <div class="info-box">
                                    <span class="info-box-icon bg-blue-active"><i class="fa fa-thumbs-o-up"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">صافي الارباح </span>
                                        <h3 class="info-box-number">{{$totals??''}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </section>
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


            $.get("{{ route('reports.month') }}" , function (data) {
                $('#sales').val(sales);
                $('#payments').val(payments);
                $('#car').val(car);
                $('#remain').val(remain);
                $('#totals').val(totals);
                $('#loss').val(loss);
                $('#from').val(from);
                $('#to').val(to);


            })


        });

    </script>


@endpush
