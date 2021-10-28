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
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootsrap-datepicker4.17.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->

  <!-- favicon -->
  <link rel="icon" href="<?php echo base_url() ?>file/favicon.ico" type="image/gif">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

</head>
<body class="hold-transition skin-blue sidebar-mini">

  <div class="wrapper">

    <script type="text/javascript">
      function konformasi() {
        tanya = confirm("Anda Yakin Ingin Menghapus ?");
        if (tanya == true) return true;
        else return false;
      }

      function konfor() {
        tanya = confirm("Anda Yakin Ingin Melakukkan Perubahan ?");
        if (tanya == true) return true;
        else return false;
      }
    </script>