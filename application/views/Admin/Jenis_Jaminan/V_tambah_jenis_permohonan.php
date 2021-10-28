  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Jenis Permohonan
        <!-- <small>Rekanan</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Data Jenis Permohonan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">FORM DATA JENIS PERMOHONAN</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">

                <form method="POST" action="<?php echo base_url('Admin/proses_tambah_jenis_permohonan') ?>" enctype="multipart/form-data">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Jenis Permohonan</label>
                      <input type="text" class="form-control" name="jenis" placeholder="Jenis Permohonan" required=" " autofocus autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jenis</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="jns" required>
                        <option selected=""> Pilih Jenis Permohonan</option>
                        <option value="1">Surety Bond</option>
                        <option value="2">Garansi Bank</option>
                      </select>
                    </div>

                  </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Submit</button>
              <a href="<?php echo base_url('Admin/lihat_jenis_permohonan') ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
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