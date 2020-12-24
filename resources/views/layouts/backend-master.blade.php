
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('general.application_name')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{adminAssets('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{adminAssets('css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{adminAssets('css/ionicons.min.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{adminAssets('css/jquery-jvectormap.css')}}">
    @yield('css_before')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{adminAssets('css/AdminLTE.min.css')}}">
<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
    page. However, you can choose any other skin. Make sure you
    apply the skin class to the body tag so the changes take effect. -->
    {{--   <link rel="stylesheet" href="{{adminAssets('css/skin-blue.min.css')}}">--}}
    {{--   <linsk rel="stylesheet" href="{{adminAssets('css/skin-green.min.css')}}"--}}
    <link rel="stylesheet" href="{{adminAssets('css/_all-skins.min.css')}}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    @yield('css_after')
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
@include('sweetalert::alert')
    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{route('dashboard')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>{{config('general.application_name_mini')}}</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>{{config('general.application_name')}}</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{uploadedAssets(auth()->user()->image)}} " class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs" style="text-transform: capitalize">  {{auth()->user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{uploadedAssets(auth()->user()->image)}}" class="img-circle" alt="User Image" style="width: 40px;height: 40px">

                                <p style="text-transform: capitalize">
                                    {{auth()->user()->name}} ( {{auth()->user()->role}} )
                                    <small>Member since   {{auth()->user()->created_at->format('M-Y')}} </small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
{{--                                <div class="pull-left">--}}
{{--                                    <a href="{{route('account.view')}}" class="btn btn-default btn-flat">Profile</a>--}}
{{--                                </div>--}}
                                <div class="pull-rights">
                                    <a href="{{ route('logout') }}" style="width: 100%"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                                <br>
                                <div class="pull-rights">
                                    <a href="{{ route('website') }}" class="btn btn-default btn-flat" style="width: 100%">Website</a>
                                </div>


                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{uploadedAssets(auth()->user()->image)}}" class="img-circle" alt="User Image" style="40px;height: 40px">
                </div>
                <div class="pull-left info">
                    <p style="text-transform: capitalize">{{auth()->user()->name}}</p>
                    <!-- Status -->
                    <a href="{{route('dashboard')}}"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Menu</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="{{inTheCurrentRoute('dashboard')}}"><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

                 @if(auth()->user()->role == ADMIN)
                    <li class="{{inTheCurrentRoute('owners/*')}}"><a href="{{route('owner.index')}}"><i class="fa fa-user-circle"></i> <span>Owners</span></a></li>
                    <li class="{{inTheCurrentRoute('customer.index')}}"><a href="{{route('customer.index')}}"><i class="fa fa-group"></i> <span>Customers</span></a></li>
                    <li class="{{inTheCurrentRoute('real-estate.all')}}"><a href="{{route('real-estate.all')}}"><i class="fa fa-building-o"></i> <span>Real Estates</span></a></li>
                    <li class="{{inTheCurrentRoute('plans.index')}}"><a href="{{route('plans.index')}}"><i class="fa fa-money"></i> <span>Plans</span></a></li>
                    <li class="{{inTheCurrentRoute('plan-orders/*')}}"><a href="{{route('planOrders.index')}}"><i class="fa fa-plus-circle"></i> <span>New Plan Requests</span></a></li>
                    <li class="{{inTheCurrentRoute('contacts/*')}}"><a href="{{route('contact.index')}}"><i class="fa fa-support"></i> <span>Contacts</span></a></li>
                @elseif(auth()->user()->role == OWNER)
                    <li class="{{inTheCurrentRoute('real-estate/index')}}"><a href="{{route('real-estate.index')}}"><i class="fa fa-building-o"></i> <span>Real Estates</span></a></li>
                    <li class="{{inTheCurrentRoute('real-estate/show-type/building')}}"><a href="{{route('real-estate.get','building')}}"><i class="fa fa-building"></i> <span>Building</span></a></li>
                    <li class="{{inTheCurrentRoute('real-estate/show-type/apartment')}}"><a href="{{route('real-estate.get','apartment')}}"><i class="fa fa-home"></i> <span>Apartment</span></a></li>
                    <li class="{{inTheCurrentRoute('real-estate/show-type/land')}}"><a href="{{route('real-estate.get','land')}}"><i class="fa fa-square-o"></i> <span>Land</span></a></li>
                    <li class="{{inTheCurrentRoute('orders.pending')}}"><a href="{{route('orders.pending')}}"><i class="fa fa-plus"></i> <span>New Customers Orders</span></a></li>
                    <li class="{{inTheCurrentRoute('orders.archive')}}"><a href="{{route('orders.archive')}}"><i class="fa fa-archive"></i> <span>All Archive</span></a></li>
                    <li class="{{inTheCurrentRoute('clients-messages/*')}}"><a href="{{route('order_contact.index')}}"><i class="fa fa-support"></i> <span>Contacts</span></a></li>
                @endif
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('bread')
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{date('Y')}} <a href="https://www.linkedin.com/in/hatem-mohamed-31b8901a2/">Hatem Mohamed</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:;">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

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

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{adminAssets('js/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{adminAssets('js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{adminAssets('js/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{adminAssets('js/adminlte.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{adminAssets('js/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap  -->
<script src="{{adminAssets('js/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{adminAssets('js/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll -->
<script src="{{adminAssets('js/jquery.slimscroll.min.js')}}"></script>
<!-- ChartJS -->
{{--<script src="{{adminAssets('js/Chart.js')}}"></script>--}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{adminAssets('js/dashboard2.js')}}"></script>--}}
<!-- AdminLTE for demo purposes -->
<script src="{{adminAssets('js/demo.js')}}"></script>
<script src="{{adminAssets('js/swal.js')}}"></script>
@yield('js')
<script>

    function RemoveItem(formId,msg='DO YOU SURE TO REMOVE THIS ITEM?'){
        Swal.fire({
            title: `<h4>${msg}</h4>`,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonColor: '#dd6b55',
            confirmButtonText: `Sure`,
            denyButtonText: `{{__('backend.dont_sure')}}`,
            cancelButtonText: `Cancel`,

        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $('#'+formId).submit();
            }
        })
    }

</script>
</body>
</html>
