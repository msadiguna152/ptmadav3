  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pembayaran Proyek
        <!-- <small>Rekanan</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Ptmada/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Data Pembayaran Proyek</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">FORM DATA PEMBAYARAN</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">

                <form method="POST" action="<?php echo base_url('Ptmada/proses_edit_pembayaran_jamkrida') ?>" enctype="multipart/form-data">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Pembayaran</label>
                      <input type="date" class="form-control" name="tgl" value="<?php echo $dt['tgl_pembayaran'] ?>" required="" autofocus>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Jumlah Pembayaran</label>
                      <input type="number" name="jml" class="form-control" value="<?php echo $dt['jml_pembayaran'] ?>" placeholder="Jumlah Pembayaran" required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Bukti Pembayaran</label>
                      <input type="hidden" name="bukti_lama" class="form-control" value="<?php echo $dt['bukti_pembayaran'] ?>" required="">
                      <input type="hidden" name="id_pembayaran" class="form-control" value="<?php echo $dt['id_pembayaran'] ?>" required="">
                      <input type="file" name="bukti" class="form-control">
                    </div>
                    <div class="form-group">
                      <input type="hidden" class="form-control" name="id_permohonan" value="<?php echo $dt['id_permohonan'] ?>" placeholder="Email" required="">
                    </div>
                  </div>
                  <!-- /.row -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Submit</button>
                <a href="<?php echo base_url('Ptmada/detail_permohonan/' . $dt['id_permohonan']) ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
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