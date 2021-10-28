<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <!-- <small>Preview</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('jasa/index') ?>"><i class="fa fa-dashboard"></i> PT MADA</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">

        <label hidden=""
        <?php if ($this->session->flashdata('hasil')=="berhasillogin") { echo 'class="berhasillogin"';}?>>
        </label>

        <div class="row">
          <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3 id="semua_peromohonan">0</h3>
                <p>Permohonan</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-clipboard"></i>
              </div>
              <a href="<?php echo base_url('Ptmada/lihat_permohonan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3 id="semua_perusahaan">0</h3>
                <p>Perusahaan</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-briefcase"></i>
              </div>
              <a href="<?php echo base_url('Ptmada/lihat_perusahaan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3 id="semua_pejabat">0</h3>
                <p>Pejabat Penghubung</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-contact"></i>
              </div>
              <a href="<?php echo base_url('Ptmada/lihat_pejabat') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3 id="semua_agent">0</h3>
                <p>Agent</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="<?php echo base_url('Ptmada/lihat_agent') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3 id="semua_lokasi">0</h3>
                <p>Lokasi Proyek</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-location-outline"></i>
              </div>
              <a href="<?php echo base_url('Ptmada/lihat_kabupaten') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3 id="semua_dokumen">0</h3>
                <p>Dokumen Pendukung</p>
              </div>
              <div class="icon">
                <i class="ion ion-paperclip"></i>
              </div>
              <a href="<?php echo base_url('Ptmada/lihat_dokumen') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- box end -->
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