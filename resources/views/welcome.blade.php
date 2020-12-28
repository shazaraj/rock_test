@extends('layout.admin')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h6  style="text-align:right;direction: rtl;"   >

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                <li><a href="#">الصفحة الرئيسية </a></li>

            </ol>
            </h6>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>

                </div>
                <div class="box-body">


                    <div class="row">
                        <div class="col-md-3 pull-right">
                            <div class="info-box">
                                <!-- Apply any bg-* class to to the icon to color it -->
                                <span class="info-box-icon bg-red-gradient"><i class="fa fa-male"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Users</span>
                                    <span class="info-box-number"> 653</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div>
                        <div class="col-md-3 pull-right">
                            <div class="info-box">
                                <!-- Apply any bg-* class to to the icon to color it -->
                                <span class="info-box-icon bg-green-gradient"><i class="fa fa-bell"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">notifications</span>
                                    <span class="info-box-number">74</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
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
    <!-- /.content-wrapper -->

    @endsection
