<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PT MADA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/square/blue.css">
  <!-- favicon -->
  <link rel="icon" href="<?php echo base_url() ?>file/favicon.ico" type="image/gif">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div style="text-align:center">
      <img src="<?php echo base_url() ?>/assets/img/bms_logo.jpg" alt="logo">
    </div>
    <div class="login-logo">
      <a href="<?php echo  base_url('Login') ?>"><b>PT</b>MADA</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>
        <label hidden=""
        <?php if ($this->session->flashdata('hasil')=="gagallogin") { echo 'class="gagallogin"';}?>>
        </label>

      <form action="<?php echo base_url('Login/proses_login') ?>" method="post">
        <div class="form-group has-feedback">
          <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

  <!-- SweetAlert2 -->
  <script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>

  <script type="text/javascript">
    $(function () {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-mid',
        showConfirmButton: true,
      });

      $('.gagallogin').show(function () {
        Toast.fire({
          type: 'error',
          timer: 2000,
          onOpen: function () {
            swal.showLoading()
          },
          title: 'Username dan Password Salah..!'
        })
      });
    });

  </script>
</body>

</html>