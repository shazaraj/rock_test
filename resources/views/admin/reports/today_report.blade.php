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
                                <h3>
                                    <ul>
{{--                                        <li type="button" class="btn btn-primary">--}}
{{--                                            المقبوضات = <span class="badge bg-danger ms-2">{{$sales}}</span>--}}
{{--                                        </li>--}}
                                        <li> المقبوضات <span class="btn btn-primary">client {{$sales ?? '0'}}</span></li>
                                        <div class="link-black">ــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ</div>
                                        <li> المدفوعات    <span class="btn btn-info"> importer</span></li>
                                        <div class="link-black">ــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ</div>
                                        <li> اجور سيارة  <span class="btn btn-warning"> car </span> </li>
                                        <div class="link-black">ــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ</div>
                                        <li> الديون  <span class="btn btn-danger">remain</span></li>
                                        <div class="link-black">ــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ</div>
                                        <li> الارباح  <span class="btn btn-success"> totals</span></li>
                                    </ul>
                                </h3>
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
                    // $('#im_bey').val(im_bey);
                    // $('#car').val(car);


                })


        });

    </script>

@endpush
