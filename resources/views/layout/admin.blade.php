
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>الإدارة  | لوحة التحكم </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{URL::asset('mais/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('mais/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{URL::asset('mais/bower_components/Ionicons/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('mais/bower_components/select2/dist/css/select2.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('mais/dist/css/AdminLTE.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{URL::asset('mais/dist/css/skins/_all-skins.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.css"/>
    <link rel="stylesheet" href="{{URL::asset('mais/plugins/toastr/toastr.min.css')}}">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">--}}
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <style>
            td,th{
              text-align: center;
            }
          </style>
</head>
<body class="hold-transition skin-blue sidebar-mini" >
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo" style="float:right;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="images/logo_min.jpg" class="user-image img-rounded"   alt=""></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Rock</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="margin-left:0;">
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
              <!-- <img src="images/logo.jpg" class="user-image" alt="User Image"> -->
              <span class="hidden-xs">  المدير</span>
            </a>
            <ul class="dropdown-menu" style="right:unset">
              <!-- User image -->
              <li class="user-header">
                <img src="images/logo.jpg" class="img-circle" alt="User Image">

                <p>

                  <small>لوحة تحكم </small>
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
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>

  </header>
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar"  >
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="main/dist/img/user1-128x128.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">

          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">العمليات الرئيسية</li>

        <li class="treeview">
                    <a href="{{url('/clients')}}">
                        <i class="fa fa-user-circle"></i> <span> الزبائن    </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('/clients')}}"><i class="fa fa-user-circle"></i>  بطاقة زبون</a></li>
{{--                        <li><a href="notifications.php"><i class="fa fa-eye"></i>  كشف حساب مورد</a></li>--}}
                        <li><a href="{{url('client/sale/new')}}"><i class="fa fa-empire"></i>     مبيعات الزبون  </a></li>
                    </ul>

                </li>

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-user-o"></i> <span> الموردين   </span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
                       </span>
              </a>

              <ul class="treeview-menu" >
                  <li><a href="{{url('/importer')}}"><i class="fa fa-user-o"></i> بطاقة مورد  </a></li>
                  <li><a href="{{url('/materials')}}"><i class="fa fa-empire"></i> بطاقة مادة موردة   </a></li>
{{--                  <li><a href="{{url('/importer_sale')}}"><i class="fa fa-eye"></i>     مبيعات المورد  </a></li>--}}
              </ul>


          </li>
                <li class="treeview">
                    <a href="{{url('/employees')}}">
                        <i class="fa fa-user"></i> <span> الموظفين   </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
                  </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('employee/index')}}"><i class="fa fa-user"></i> بطاقة موظف   </a></li>
                        <li><a href="{{url('employee/paid_salary')}}"><i class="fa fa-paypal"></i>  دفع راتب    </a></li>
                        <li><a href="{{url('employee/pre_paid')}}"><i class="fa fa-low-vision"></i>   سلفة      </a></li>

                    </ul>
                </li>

        <li class="treeview">
                    <a href="#">
                        <i class="fa fa-building"></i> <span>  المستودع    </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('store/raw_materials')}}"><i class="fa fa-slack"></i>  المواد الأولية  </a></li>
                        <li><a href="{{url('store/factoried_materials')}}"><i class="fa fa-puzzle-piece"></i>   المواد المصنعة    </a></li>

                    </ul>

                </li>

                <li class="">
                    <a href="{{url('/raw_materials')}}">
                        <i class="fa fa-slack"></i> <span> المواد الأولية   </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
              <li class="">
                  <a href="{{url('/factoried_materials')}}">
                      <i class="fa fa-puzzle-piece"></i> <span>     بطاقة مادة مصنعة          </span>
                      <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                  </a>

              </li>
                <li class="treeview">
                    <a href="{{url('/cars')}}">
                        <i class="fa fa-truck"></i> <span> بطاقة سيارة     </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>

                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('/cars')}}"><i class="fa fa-bus"></i>  بطاقة  سيارة</a></li>
                        <li><a href="{{route('car.paid.add')}}">
                                <i class="fa fa-address-card"></i>  كشف حساب  سائق</a></li>
                        <li><a href="{{url('/cars_maintainances')}}">
                                <i class="fa fa-steam"></i>   مصاريف صيانة    </a></li>
                        <li><a href="{{url('/car/history')}}">
                                <i class="fa fa-file-archive-o"></i>   سجل الأجور للسيارة      </a></li>
                    </ul>

                </li>
{{--                <li class="">--}}
{{--                    <a href="{{url('/cars_maintainances')}}">--}}
{{--                        <i class="fa fa-car"></i> <span> بطاقة مصاريف سيارة     </span>--}}
{{--                        <span class="pull-right-container">--}}
{{--              <i class="fa fa-angle-left pull-right"></i>--}}
{{--            </span>--}}
{{--                    </a>--}}


          <li class="treeview">
              <a href="#">
                  <i class="fa fa-bank"></i> <span> فواتير   </span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="{{url('client_sale_bills')}}"><i class="fa fa-user-circle"></i> فواتير الزبون   </a></li>
                  <li><a href="{{url('importer_sale_bills')}}"><i class="fa fa-user-o"></i>  فواتير المورد    </a></li>
                  <li><a href="{{url('other_payments')}}"><i class="fa fa-eye"></i>     فواتير أخرى       </a></li>

              </ul>
          </li>


                <li class="">
                    <a href="{{url('/production_cards')}}">
                        <i class="fa fa-get-pocket"></i> <span>     بطاقة إنتاج            </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
                <li class="">
                    <a href="{{url('/purchases')}}">
                        <i class="fa fa-shopping-bag"></i> <span>     بطاقة مشتريات            </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
                <li class="">
                    <a href="{{url('/sales')}}">
                        <i class="fa fa-table"></i> <span>     بطاقة مبيعات            </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>

                <li class="">
                    <a href="{{url('/peices_type')}}">
                        <i class="fa fa-chain"></i> <span>  بطاقة نوع القطعة        </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
          <li class="">
                    <a href="{{url('/money_box')}}">
                        <i class="fa fa-dropbox"></i> <span>  الصندوق المالي        </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>

                </li>
          <li class="treeview">
              <a href="#">
                  <i class="fa fa-btc"></i> <span>  وصل حساب    </span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="{{route('receipt.index')}}"><i class="fa fa-empire"></i>  وصل العميل   </a></li>
                  <li><a href="#"><i class="fa fa-empire"></i>  كشف حساب المورد  </a></li>
{{--                  <li><a href="{{route('importer.bills')}}"> <i class="fa fa-empire"></i>   كشف حسابات الموردين    </a></li>--}}

              </ul>

          </li>
          <li class="treeview">
              <a href="#">
                  <i class="fa fa-line-chart"></i> <span>  التقارير    </span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="{{url('/today/report')}}"><i class="fa fa-paste"></i>  تقرير اليوم  </a></li>
                  <li><a href="{{url('/today/report')}}"> <i class="fa fa-paste"></i>    تقرير هذا الشهر    </a></li>

              </ul>

          </li>




      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  @yield('content')


  <footer class="main-footer">
    <div class="pull-right hidden-xs">

    </div>
    <strong>Copyright &copy; 2019 <a href="#">Rock</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <!-- <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li> -->

      <!-- <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li> -->
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">





      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
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
<script src="{{URL::asset('mais/bower_components/datatables.net/js/jquery.datatables.min.js')}}"></script>
<script src="{{URL::asset('mais/bower_components/select2/dist/js/select2.js')}}"></script>
{{--<script src="{{URL::asset('mais/plugins/plugins/toastr/toastr.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.js"></script>--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();
    $('.select2').select2();

  })
</script>
</body>
</html>
@stack('pageJs')
