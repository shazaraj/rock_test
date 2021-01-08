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
                    <div class="row ">
                    <form action="" method="POST" id="date_form">
                        <br>
                        <h4 style="margin-right:15px;" > قم بتحديد اليوم</h4>
                        <br>
                        <br>
                        <br>
                        <div class="col-md-8">
                            <input type="date" class="form-control" id="day_repo" name="day_repo">
                        </div>
                        <div class="col-md-4">
                            <a href="/today/report" id="date_btn" type="submit" class="btn btn-primary form-control "> عرض النتيجة</a>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5 pull-right text-right">
                <div class="card pd-20 pd-sm-40">
                    <h3> التقارير الشهرية </h3>

                    <br>
                    <h4 style="margin-right:15px;" > قم بتحديد الفترة الزمنية</h4>
                    <br>
                    <br>
                    <br>
                    <div class="row input-daterange">
                        <div class="col-md-4">
                            <input type="date" name="from_date" id="from_date" class="form-control" placeholder="من" />
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="to_date" id="to_date" class="form-control" placeholder="إلى" />
                        </div>
                        <div class="col-md-4">
                            <button type="button" name="filter" id="filter" class="btn btn-primary">عرض النتيجة</button>
                        </div>
                    </div>
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
            e.preventDefault();
            var day_repo = $('#day_repo').val();
            // alert(day_repo);
            var url ="{{ url('/getSale') }}" + '/' + day_repo;
            window.location.href = url;
            // return ;
            $(this).html('جاري توليد التقارير...');

            // var from_date = $('#from_date').val();
            // var to_date = $('#to_date').val();
            $.ajax({
                // var day_repo = $(this).data('day_repo');
                data: $('#date_form').serialize(),
                {{--url : "{{ route('getSale.today') }}" + '/' + day_repo,--}}
                // type :"POST",
                // url: day_repo_url,
                dataType: 'json',

                success: function (data) {
                    toastr.success('get date');
                    table.draw();


                },

                error: function (data) {

                    console.log('Error:', data);

                }

            });

        });
    </script>
@endpush
