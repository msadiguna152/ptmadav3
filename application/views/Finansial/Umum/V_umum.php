<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Transaksi Umum
      <!-- <small>Rekanan</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Finansial/') ?>"><i class="fa fa-dashboard"></i> PT Mada</a></li>
      <li class="active">Data Transaksi Umum</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Transaksi Umum </h3><br>
          </div>
          <div class="box-footer">
            <a href="<?php echo base_url('Finansial/tambah_umum/') ?>"><button type="button" class="btn btn-info" title="Tambah Data Transaksi Umum"><i class="fa fa-plus-square"></i> Tambah Transaksi Umum</button></a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Custom Filter : </h3>
                  </div>
                  <div class="panel-body">
                    <form id="form-filter" class="form-horizontal" method="POST" action="<?php echo base_url('Finansial/cetak_umum') ?>">
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Tanggal Awal</label>
                        <div class="col-sm-4">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Tanggal Akhir</label>
                        <div class="col-sm-4">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-4 control-label">Pejabat Penghubung</label>
                        <div class="col-sm-4">
                          <?php echo $form_pejabat; ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-10">
                          <button type="button" id="btn-filter" class="btn btn-info" title="filter"><i class="fa fa-search"></i> Filter</button>
                          <button type="button" id="btn-reset" class="btn btn-default" title="reset"><i class="fa fa-undo"></i> Reset</button>
                          <button type="submit" id="btn-print" class="btn btn-success" title="print"><i class="fa fa-print"></i> Cetak</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Total : </h3>
                  </div>
                  <div class="panel-body">
                    <form id="form-filter" class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-6    control-label">Jumlah Kredit</label>
                        <div class="col-sm-6">
                          <input type="text" name="pemasukan" id="pemasukan" class="form-control" readonly value="<?php echo "Rp." . number_format($kredit, 0, ',', '.'); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-6    control-label">Jumlah Debit</label>
                        <div class="col-sm-6">
                          <input type="text" name="pemasukan" id="pemasukan" class="form-control" readonly value="<?php echo "Rp." . number_format($debit, 0, ',', '.'); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-6    control-label">Saldo</label>
                        <div class="col-sm-6">
                          <input type="text" name="pemasukan" id="pemasukan" class="form-control" readonly value="<?php echo "Rp." . number_format($saldo, 0, ',', '.'); ?>">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <table id="data" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <!-- <th>No</th> -->
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Kredit</th>
                  <th>Debit</th>
                  <th>Bukti</th>
                  <th>Pejabat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tfoot id="total">
                <tr>
                  <!-- <th>No</th> -->
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Kredit</th>
                  <th>Debit</th>
                  <th>Bukti</th>
                  <th>Pejabat</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
              <tbody>

              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>