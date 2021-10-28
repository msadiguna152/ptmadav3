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

              <form method="POST" action="<?php echo base_url('Admin/proses_edit_akun') ?>" enctype="multipart/form-data">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nama Akun</label>
                    <input type="text" name="nama" class="form-control" required placeholder="Nama Akun" value="<?php echo $dt['nama'] ?>"  autocomplete="off" autofocus>
                    <input type="hidden" name="id_akun" class="form-control" placeholder="id_akun" value="<?php echo $dt['id_akun'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" name="username" required placeholder="Username" value="<?php echo $dt['username'] ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $dt['password'] ?>" autocomplete="off">
                  </div>
                  <div  class="form-group">
                  <label for="exampleInputEmail1">Level</label>
                  <select name="level" id="" class="form-control">
                  <option value="">-Pilih Level-</option>
                  <option value="admin" <?php echo ($dt['level']=='admin' ? 'Selected' : '') ?>>Admin</option>
                  <option value="finansial" <?php echo ($dt['level']=='finansial' ? 'Selected' : '') ?>>FInansial</option>
                  </select>
                  </div>
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