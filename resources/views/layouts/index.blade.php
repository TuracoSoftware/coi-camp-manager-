<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    @if (Auth::user()->type == 'admin')
    <title>Camp Old Indian Admin</title>
    @elseif (Auth::user()->type == 'staff')
    <title>Camp Old Indian Staff</title>
    @elseif (Auth::user()->type == 'director')
    <title>Camp Old Indian Director</title>
    @endif
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset("../resources/assets/admin/bootstrap/css/bootstrap.min.css") }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset("../resources/assets/admin/plugins/datatables/dataTables.bootstrap.css") }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("../resources/assets/admin/dist/css/AdminLTE.min.css")}}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="{{ asset("../resources/assets/admin/dist/css/skins/skin-blue.min.css")}}">
    <link rel="stylesheet" href="{{ asset("../resources/assets/admin/dist/css/skins/skin-purple.min.css")}}">
    <link rel="stylesheet" href="{{ asset("../resources/assets/admin/dist/css/skins/skin-red.min.css")}}">
    <link rel="stylesheet" href="{{ asset("../resources/assets/admin/dist/css/skins/skin-green-light.min.css")}}">
    <link rel="stylesheet" href="{{ asset("../resources/assets/admin/dist/css/skins/_all-skins.min.css")}}">

    <link rel="stylesheet" href="{{ URL::asset('../resources/assets/css/admin_style.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
  @if(Auth::user()->type == 'admin')
  <body class="hold-transition skin-blue sidebar-mini">
  @elseif(Auth::user()->type == 'director')
  <body class="hold-transition skin-purple sidebar-mini">
  @elseif(Auth::user()->type == 'staff')
  <body class="hold-transition skin-red sidebar-mini">
  @else
  <body class="hold-transition skin-green-light layout-top-nav">
  @endif
    <div class="wrapper">
    @if(Auth::user()->type == 'admin' || Auth::user()->type == 'director' || Auth::user()->type == 'staff')
      @include('layouts.header')
      <!-- Left side column. contains the logo and sidebar -->
      @include('layouts.sidebar')
      <!-- Content Wrapper. Contains page content -->
      @yield('content')
      <!-- Model for opening a delete confirm window -->
      @include('layouts.modalyn')
      <!-- Main Footer -->
      @include('layouts.footer')
    @else
      @include('layouts.header')
      <!-- Left side column. contains the logo and sidebar -->
      @yield('content')
      <!-- Model for opening a delete confirm window -->
      @include('layouts.modalyn')
      <!-- Main Footer -->
      @include('layouts.footer')
    @endif

    </div>

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset ("../resources/assets/admin/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset ("../resources/assets/admin/bootstrap/js/bootstrap.min.js") }}"></script>
    <!-- DataTables -->
    <script src="{{ asset ("../resources/assets/admin/plugins/datatables/jquery.dataTables.min.js") }}"></script>
    <script src="{{  asset("../resources/assets/admin/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset ("../resources/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
    <!-- FastClick -->
    <script src="{{ asset ("../resources/assets/admin/plugins/fastclick/fastclick.js") }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ("../resources/assets/admin/dist/js/app.min.js") }}"></script>
    <!-- Custom JS -->
    <script src="{{ URL::asset('../resources/assets/js/script.js') }}"></script>

    @section('custom_scripts')
    @show

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
