  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Lokasi Proyek
        <!-- <small>Rekanan</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Data Lokasi Proyek</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">FORM DATA LOKASI PROYEK</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">

                <form method="POST" action="<?php echo base_url('Admin/proses_edit_kabupaten') ?>" enctype="multipart/form-data">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Lokasi Proyek</label>
                      <input type="hidden" class="form-control" name="kd_kabupaten" value="<?php echo $dt['kd_kabupaten'] ?>" autofocus autocomplete="off">
                      <input type="text" class="form-control" name="lokasi" placeholder="Nama Lokasi Proyek" required=" " value="<?php echo $dt['kabupaten'] ?>" autofocus autocomplete="off">
                    </div>

                  </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Submit</button>
              <a href="<?php echo base_url('Admin/lihat_kabupaten') ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
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