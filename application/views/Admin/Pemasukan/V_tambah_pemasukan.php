  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pemasukan
        <!-- <small>Rekanan</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Data Pemasukan </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Form Data Pemasukan</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <?php
                foreach ($dt as $data) {
                  $id = $data['id_permohonan'];
                }

                foreach ($detail_tarif as $dt) {
                  $jumlahtagihan = $dt['pemasukan'];
                }

                foreach ($jumlah as $dt2) {
                  $jumlahbayar = $dt2['jumlah'];
                  if ($jumlahbayar <= 0) {
                    $jumlahbayar = 0;
                  }
                }

                ?>
                <form method="POST" action="<?php echo base_url('Admin/proses_tambah_pemasukan/' . $id) ?>" enctype="multipart/form-data">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Pemasukan</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" name="tgl_pembayaran" class="form-control" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Uraian</label>
                      <input type="text" name="uraian" class="form-control" placeholder="Uraian" required="" autofocus>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Jumlah</label>
                      <input type="number" name="jml_pembayaran" id="jml_pembayaran" class="form-control" placeholder="Jumlah" required="">
                    </div>
                    <!-- <div class="form-group">
                      <label for="exampleInputPassword1">Bukti</label>
                      <input type="file" name="bukti_pembayaran" class="form-control">
                    </div> -->
                    <div class="form-group">
                      <input type="hidden" name="id_permohonan" class="form-control" value="<?php echo $id ?>" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Jumlah tagihan</label>
                      <input type="text" class="form-control" placeholder="Jumlahtagihan" required="" readonly value="<?php echo number_format($jumlahtagihan, 0, ',', '.'); ?>">
                      <input type="hidden" name="jumlah" id="jumlah_tagihan" class="form-control" placeholder="Jumlahtagihan" required="" readonly value="<?php echo $jumlahtagihan; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Jumlah Bayar</label>
                      <input type="text" class="form-control" readonly value="<?php echo number_format($jumlahbayar, 0, ',', '.'); ?>">
                      <input type="hidden" name="jumlahbyr" id="jumlah_bayar" class="form-control" readonly value="<?php echo $jumlahbayar; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Sisa Pembayaran</label>
                      <input type="text" id="sisa_bayar" class="form-control" placeholder="Sisa" readonly>
                      <input type="hidden" name="sisa" id="sisa_bayar_post" class="form-control" placeholder="Sisa" readonly>
                    </div>

                  </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" id="bttn" class="btn btn-primary" style="margin-right: 20px;">Submit</button>
              <a href="<?php echo base_url('Admin/detail_permohonan_f/' . $data['id_permohonan'].'/detail') ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
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