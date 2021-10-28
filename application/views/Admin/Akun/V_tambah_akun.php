<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Akun
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Data Akun</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">FORM DATA AKUN</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">

              <form method="POST" action="<?php echo base_url('Admin/proses_tambah_akun') ?>" enctype="multipart/form-data">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Akun</label>
                    <input type="text" class="form-control" required="" name="nama" placeholder="Nama Akun" autocomplete="off">
                 </div>
                 <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" required="" name="username" placeholder="Username" autocomplete="off">
                 </div>
                 <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="text" class="form-control" required="" name="password" placeholder="Password" autocomplete="off">
                 </div>
                 <div class="form-group">
                    <label for="exampleInputEmail1">Level</label>
                   <select name="level" id="" class="form-control">
                   <option value="">-Pilih Level-</option>
                   <option value="admin">Admin</option>
                   <option value="finansial">Finansial</option>
                   </select>
                 </div>
                </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Submit</button>
            <a href="<?php echo base_url('Admin/lihat_akun/') ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
          </div>

          </form>
        </div>
      </div>
      <!-- /.box -->

      <!-- Form Element sizes -->

      <!-- /.box -->


      <!-- /.box -->


      <!-- /.box -->

    </div>
    <!--/.col (left) -->
    <!-- right column -->

    <!--/.col (right) -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->