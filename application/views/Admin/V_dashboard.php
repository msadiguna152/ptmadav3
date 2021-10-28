<?php foreach ($data as $dt) {
  $permohonan = $dt->permohonan;
} ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <!-- <small>Preview</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Admin/index') ?>"><i class="fa fa-dashboard"></i>Admin</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form">
            <div class="box-body">
              <center>
                <h3><b>SELAMAT DATANG, <?php echo $this->session->userdata('nama')?></b></h3>
              </center>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">

            </div>
          </form>
        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?php echo $permohonan  ?></h3>

                <p>Permohonan Baru</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-clipboard"></i>
              </div>
              <a href="<?php echo base_url('Admin/lihat_permohonan_f') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3 id="permohonan_diproses">0</h3>
                <p>Permohonan Diproses</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-checkbox"></i>
              </div>
              <a href="<?php echo base_url('Admin/lihat_tarif') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3 style="font-size: 20pt;" id="pendapatan">Rp.0.00</h3>

                <p> Omzet Keseluruhan</p>
              </div>
              <div class="icon">
                <i class="ion ion-social-usd"></i>
              </div>
              <a href="<?php echo base_url('Finansial/lihat_laporan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- ./col -->
        
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3 style="font-size: 20pt;" id="profit">Rp.0.00</h3>
                <p>Profit Keseluruhan</p>
              </div>
              <div class="icon">
                <i class="ion ion-arrow-graph-up-right"></i>
              </div>
              <a href="<?php echo base_url('Finansial/lihat_laporan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3 style="font-size: 20pt;" id="piutang">Rp.0.00</h3>
                <p>Piutang Keseluruhan</p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
              <a href="<?php echo base_url('Admin/laporan_pemasukan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3 style="font-size: 20pt;" id="wajib_bayar">Rp.0.00</h3>
                <p>Wajib Bayar Keseluruhan</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php echo base_url('Admin/laporan_pengeluaran') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
   <!-- ./col -->
   <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3 style="font-size: 20pt;" id="kredit">Rp.0.00</h3>
                <p>Kredit Keseluruhan</p>
              </div>
              <div class="icon">
                <i class="ion ion-card"></i>
              </div>
              <a href="#" class="small-box-footer" style="visibility: hidden;">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
           <!-- ./col -->
           <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3 style="font-size: 20pt;" id="debit">Rp.0.00</h3>
                <p>Debit Keseluruhan</p>
              </div>
              <div class="icon">
                <i class="ion ion-podium"></i>
              </div>
              <a href="#" class="small-box-footer" style="visibility: hidden;">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
           <!-- ./col -->
           <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3 style="font-size: 20pt;" id="saldo">Rp.0.00</h3>
                <p>Saldo Keseluruhan</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer" style="visibility: hidden;">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          
        </div>
        <div class="row">
          <div class="col-lg-6 text-center">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-primary active">
                <input type="radio" name="pendapatan" id="pendapatan_bulan" autocomplete="off" value="pendapatan_bulan" checked> Bulan ini
              </label>
              <label class="btn btn-primary">
                <input type="radio" name="pendapatan" id="pendapatan_tahun" autocomplete="off" value="pendapatan_tahun" > Tahun ini
              </label>
            </div>
          </div>
          <div class="col-lg-6 text-center">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-primary active">
                <input type="radio" name="profit" id="profit_bulan" autocomplete="off"  value="profit_bulan" checked> Bulan ini
              </label>
              <label class="btn btn-primary">
                <input type="radio" name="profit" id="profit_tahun" autocomplete="off"  value="profit_tahun"> Tahun ini
              </label>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <!-- ./col -->
          <div class="col-lg-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3 style="font-size: 20pt;" id="pendapatan_filter">0</h3>
                <p>Pendapatan</p>
              </div>
              <div class="icon">
                <i class="ion ion-social-usd"></i>
              </div>
              <a href="#" class="small-box-footer" style="visibility: hidden;"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3 style="font-size: 20pt;" id="profit_filter">0</h3>
                <p>Profit</p>
              </div>
              <div class="icon">
                <i class="ion ion-arrow-graph-up-right"></i>
              </div>
              <a href="#" class="small-box-footer" style="visibility: hidden;"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
        </div>
        <!-- /.row -->
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