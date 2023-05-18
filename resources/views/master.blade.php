<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="GSCS Accounting Software">
    <meta name="keywords" content="GSCS Accounting Software">
    <meta name="author" content="gscs international limited">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <link rel="icon" href="{{asset('/')}}assets/images/favicon.png" sizes="32x32" type="image/png">
  <title>{{$title}}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/')}}assets/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('/')}}assets/css/daterangepicker.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('/')}}assets/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('/')}}assets/css/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="{{asset('/')}}assets/css/jqvmap.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/')}}assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('/')}}assets/css/OverlayScrollbars.min.css">
  
  <style>
    .select2-container .select2-selection--single {
      height:100% !important;
    }
    /* .pagination{
      justify-content: center;
    } */
    .container-fluid{
      padding-right: 15px !important;
      padding-left: 15px !important;
    }
    table.dataTable thead .sorting {
        background-image: none !important;
    }
    table.dataTable thead .sorting_asc {
      background-image: none !important;
    }
    table.dataTable thead .sorting_desc {
      background-image: none !important;
    }
    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: normal !important;
    }
    .select2-container--default .select2-selection--single{
      padding:5px !important;
    }
  </style>
  <!-- jQuery -->
<script src="{{asset('/')}}assets/js/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{asset('/')}}assets/images/logo.png" alt="logo">
    </div>

    <!-- Navbar -->
      @include('layouts.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-md-12">
              @if(Session::get('error'))
                  <div class="alert alert-danger text-center">
                  {{Session::get('error')}}
                  </div>
              @endif
              @if(Session::get('success'))
                  <div class="alert alert-success text-center">
                  {{Session::get('success')}}
                  </div>
              @endif
          </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          @yield('body')
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- @include('layouts.footer') -->

  </div>
<!-- ./wrapper -->
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/')}}assets/js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('/')}}assets/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('/')}}assets/js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('/')}}assets/js/sparkline.js"></script>
<!-- JQVMap -->
<!-- <script src="{{asset('/')}}assets/js/jquery.vmap.min.js"></script> -->
<!-- <script src="{{asset('/')}}assets/js/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="{{asset('/')}}assets/js/jquery.knob.min.js"></script>
<!-- daterangepicker -->

<!-- Tempusdominus Bootstrap 4 -->
<!-- <script src="{{asset('/')}}assets/js/tempusdominus-bootstrap-4.min.js"></script> -->
<!-- overlayScrollbars -->
<script src="{{asset('/')}}assets/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('/')}}assets/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/')}}assets/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('/')}}assets/js/dashboard.js"></script>
<script>
    function Logout()
      {
        if(confirm("Are you sure you want to logout?")){
          var url = '{{route('logout')}}';
          window.location = url;
        }
      }
</script>
@yield('js')
</body>
</html>
