<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Accounting System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/')}}assets/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('/')}}assets/css/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/')}}assets/css/adminlte.min.css">
  <!-- jQuery -->
  <script src="{{asset('/')}}assets/js/jquery.min.js"></script>
</head>
{{-- <body class="hold-transition login-page" oncontextmenu="return false" onselectstart="return false" oncut="return false" oncopy="return false" onpaste="return false"  ondrag="return false" ondrop="return false"> --}}
<body class="hold-transition login-page" >
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h4><a href="{{route('home')}}"><b>Accounting System</b></a></h4>
      @if(Session::get('error'))
          <div class="alert alert-danger">
          {{Session::get('error')}}
          </div>
      @endif
    </div>
    <div class="card-body">
        <form action="{{route('login.submit')}}" method="post" id="login_form">
            @csrf
            <div class="input-group">
              <input type="email" class="form-control" name="email" placeholder="Enter your email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <small class="error_email text-danger"></small>
            <div class="input-group mt-3">
              <input type="password" class="form-control" name="password" placeholder="Enter your password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <small class="error_password text-danger"></small>
            <div class="row mt-3">
              <div class="col-12">
                <button type="submit" id="submit_btn" class="btn btn-primary btn-block">Sign In</button>
              </div>
            </div>
          </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->


<!-- Bootstrap 4 -->
<script src="{{asset('/')}}assets/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('/')}}assets/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
  $("#login_form").on('submit', function(e) {
      e.preventDefault();
      $('#submit_btn').html("Prcessing..");
      $('#submit_btn').prop('disabled', true);
      $("#login_form small").html('');
      $.ajax({
          method: "POST",
          url: $(this).prop('action'),
          data: new FormData(this),
          dataType: 'JSON',
          contentType: false,
          cache: false,
          processData: false,
          success: function(data)
          {
              $('#submit_btn').html("Sign In");
              $("#login_form small").html('');
              if (data.error == true) {
                  if(data.check ==  true)
                  {
                      $.each(data.message, function( key, value ) {
                          $(".error_"+key).html(value);
                      });
                  }else{
                      swal({
                          text: data.message,
                          icon: "error",
                      });
                  }
              }else{
                  swal({
                      text: data.message,
                      icon: "success",
                  });
                  window.location = data.url;
              }
              $('#submit_btn').prop('disabled', false);
          }
      });
  });
    // $('body').bind('cut copy paste', function(event) {
    //    event.preventDefault();
    // });
    // document.addEventListener('contextmenu',(e)=>{
    //     e.preventDefault();
    //   }
    //   );
    //   document.onkeydown = function(e) {
    //   if(e.keyCode == 123) {
    //      return false;
    //   }
    //   if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
    //      return false;
    //   }
    //   if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
    //      return false;
    //   }
    //   if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
    //      return false;
    //   }
    //   if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
    //      return false;
    //   }
    // }
    // if (!$('body').hasClass('debug_mode')) {
    //     var _z = console;
    //     Object.defineProperty(window, "console", {
    //         get: function () {
    //             if ((window && window._z && window._z._commandLineAPI) || {}) {
    //                 throw "Nice trick! but not permitted!";
    //             }
    //             return _z;
    //         },
    //         set: function (val) {
    //             _z = val;
    //         }
    //     });
    // }
</script>
</body>
</html>
