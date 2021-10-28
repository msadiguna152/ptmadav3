  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Transaksi Umum
        <!-- <small>Rekanan</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Finansial/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Data Transaksi Umum</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Form Data Transaksi Umum</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">

                <form method="POST" action="<?php echo base_url('Finansial/proses_tambah_umum/') ?>" enctype="multipart/form-data">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Transaksi Umum</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" name="tanggal" class="form-control" required autocomplete="off">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Pejabat Penghubung</label>
                      <?php echo $form_pejabat; ?>

                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Keterangan</label>
                      <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" required="" autofocus autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Jumlah</label>
                      <input type="text" name="jumlah" id="tanpa-rupiah" class="form-control" placeholder="Jumlah" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jenis Transaksi</label>
                      <select class="form-control select2" id="exampleFormControlSelect1" name="jenis_transaksi" autocomplete="off">
                        <option value="Debit">Pengeluaran</option>
                        <option value="Kredit">Pemasukan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Bukti</label>
                      <input type="file" name="bukti" class="form-control">
                    </div>
                  </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Submit</button>
              <a href="<?php echo base_url('Finansial/lihat_umum/') ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
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
  <script type="text/javascript">

  </script>