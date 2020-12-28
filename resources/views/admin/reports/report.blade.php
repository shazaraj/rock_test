@extends('layout.admin')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class=phonecontent-header">

            <h6 style="text-align:right;direction: rtl;">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                    <li><a href="#"> التقارير </a></li>

                </ol>
            </h6>
        </section>
        <div class="row date" style="margin-top: 30px; margin-right: 10px;">
            <div class="col-md-5 pull-right text-right">
                <div class="card pd-20 pd-sm-40 white">
                    <h3> التقارير اليومية </h3>
                    <form action="" method="POST" id="date_form">
                        <br>
                        <h4 style="margin-right:15px;" > قم بتحديد اليوم</h4>
                        <br>
                        <br>
                        <br>
                        <input type="date" class="form-control" id="day_repo" name="day_repo">
                        <br>
                        <br>
                        <a href="{{url('getSale.today')}}" id="date_btn" type="submit" class="btn btn-primary form-control "> عرض النتيجة</a>
                    </form>
                </div>
            </div>


            <div class="col-md-5 pull-right text-right">
                <div class="card pd-20 pd-sm-40">
                    <h3> التقارير الشهرية </h3>

                        <br>
                        <br>
                        <h4 style="margin-right:15px;" > قم بتحديد الفترة الزمنية</h4>
                        <div class="row input-daterange">
                            <br>
                            <br>
                            <div class="col-md-4">
                                <input type="date" name="from_date" id="from_date" class="form-control" />
                            </div>
                            <div class="col-md-4">
                                <input type="date" name="to_date" id="to_date" class="form-control" />
                        </div>
                        </div>
                        <br>
                        <br>
                    <a href="{{url('/today/report')}}" type="submit" class="btn btn-primary form-control"> عرض النتيجة</a>

                </div>
            </div>
        </div>

    </div>


@endsection
@push('pageJs')
    <script type="text/javascript">
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        $('#date_btn').click(function (e) {
            var day_repo_url = "{{ route('getSale.today') }}"+'/'+day_repo;
            e.preventDefault();

            $(this).html('searching..');


            $.ajax({

                data: $('#date_form').serialize(),

                url: day_repo_url,

                type: "POST",

                dataType: 'json',

                success: function (data) {
                    $('#action').html('إضافة');


                    toastr.success('get date');
                    table.draw();


                },

                error: function (data) {

                    console.log('Error:', data);

                    $('#post_btn').html('إضافة');

                }

            });

        });
    </script>
@endpush
