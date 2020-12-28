<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>الإدارة | لوحة التحكم </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{URL::asset('mais/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{URL::asset('mais/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{URL::asset('mais/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('mais/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{URL::asset('mais/dist/css/skins/_all-skins.min.css')}}">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.css"/>
    <link rel="stylesheet" href="{{URL::asset('mais/plugins/toastr/toastr.min.css')}}">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">--}}
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo" style="float:right;">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="images/user1-128x128.jpg" class="user-image img-rounded" alt=""></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Rock</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" style="margin-left:0;margin-right:230px;">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="float:right;">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu" style="float:left;">
                <ul class="nav navbar-nav">


                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{--<img src="" class="user-image" alt="User Image">--}}
                           <span class="fa fa-user"></span>
                            <span class="hidden-xs">   Rock</span>
                        </a>
                        <ul class="dropdown-menu" style="right:unset;left:0;">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="images/logo.jpg" class="img-circle" alt="User Image">

                                <p>
                                    Rock Manager
                                    <small>لوحة تحكم  </small>
                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="logout.php" class="btn btn-default btn-flat">تسجيل الخروج</a>
                                </div>
                                <div class="pull-right">
                                    <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar" style="right:0;">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>مدير  </p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">العمليات الرئيسية</li>
                <li class="">
                    <a href="{{url('/machines')}}">
                        <i class="fa fa-dashboard"></i> <span>الألات</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
                {{--<li class="">--}}
                    {{--<a href="{{url('/main_account')}}">--}}
                        {{--<i class="fa fa-dashboard"></i> <span>الحسابات الرئيسية</span>--}}
                        {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                    {{--</a>--}}

                {{--</li>--}}
                <li class="treeview">
                    <a href="{{url('/clients')}}">
                        <i class="fa fa-user"></i> <span> الزبائن    </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('/clients')}}"><i class="fa fa-circle-o"></i>  بطاقة زبون</a></li>
                        <li><a href="notifications.php">
                                <i class="fa fa-eye"></i>  كشف حساب مورد</a></li>
                        <li><a href="notifications.php">
                                <i class="fa fa-eye"></i>  كشف حساب زبون</a></li>
                    </ul>

                </li>
                <li class="">
                    <a href="{{url('/employees')}}">
                        <i class="fa fa-user"></i> <span> الموظفين   </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
                <li class="">
                    <a href="{{url('/raw_materials')}}">
                        <i class="fa fa-user"></i> <span> المواد الأولية   </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
                <li class="treeview">
                    <a href="{{url('/cars')}}">
                        <i class="fa fa-car"></i> <span> بطاقة سيارة     </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>

                    </a>
                    <ul class="treeview-menu">
                        <li><a href="add_notification.php"><i class="fa fa-circle-o"></i>  بطاقة  سيارة</a></li>
                        <li><a href="{{route('car.paid.add')}}">
                                <i class="fa fa-eye"></i>  كشف حساب  سائق</a></li>
                        <li><a href="{{url('/cars_maintainances')}}">
                                <i class="fa fa-eye"></i>   مصاريف صيانة    </a></li>
                    </ul>

                </li>
                <li class="">
                    <a href="{{url('/cars_maintainances')}}">
                        <i class="fa fa-car"></i> <span> بطاقة مصاريف سيارة     </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
                {{--<li class="">--}}
                    {{--<a href="{{url('/client_type')}}">--}}
                        {{--<i class="fa fa-user"></i> <span> أنواع الزبائن    </span>--}}
                        {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                    {{--</a>--}}

                {{--</li>--}}
                <li class="">
                    <a href="{{url('/factoried_materials')}}">
                        <i class="fa fa-map-signs"></i> <span>     بطاقة مادة مصنعة          </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
                <li class="">
                    <a href="{{url('/production_cards')}}">
                        <i class="fa fa-map-signs"></i> <span>     بطاقة إنتاج            </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
                <li class="">
                    <a href="{{url('/purchases')}}">
                        <i class="fa fa-map-signs"></i> <span>     بطاقة مشتريات            </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
                <li class="">
                    <a href="{{url('/sales')}}">
                        <i class="fa fa-map-signs"></i> <span>     بطاقة مبيعات            </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
                <li class="">
                    <a href="{{url('/other_payments')}}">
                        <i class="fa fa-map-signs"></i> <span>     بطاقة مصاريف أخرى            </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
                <li class="">
                    <a href="{{url('/peices_type')}}">
                        <i class="fa fa-map-signs"></i> <span>  بطاقة نوع مادة       </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>



            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    </header>

    @yield('content')


    <footer class="main-footer">
        <div class="pull-right hidden-xs">

        </div>
        <strong>Copyright &copy; 2020 <a href="#">Rock</a>.</strong> All rights
        reserved
    </footer>
</div>


<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{URL::asset('mais/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{URL::asset('mais/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{URL::asset('mais/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{URL::asset('mais/bower_components/fastclick/lib/fastclick.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{URL::asset('mais/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{URL::asset('mais/dist/js/demo.js')}}"></script>
<script src="{{URL::asset('mais/bower_components/datatables.net/js/datatables.min.js')}}"></script>
{{--<script src="{{URL::asset('mais/plugins/plugins/toastr/toastr.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.js"></script>--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
</script>
</body>
</html>
@stack('pageJs')
