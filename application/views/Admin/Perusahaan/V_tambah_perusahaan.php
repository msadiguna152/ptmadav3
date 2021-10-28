<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Perusahaan
      <small>Rekanan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Data Perusahaan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">FORM DATA PERUSAHAAN</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">

              <form method="POST" action="<?php echo base_url('Admin/proses_tambah_perusahaan') ?>" enctype="multipart/form-data">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" class="form-control" value="<?= set_value('nama_perusahaan')?>" placeholder="Nama Perusahaan" required="" autofocus autocomplete="off">
                    <input type="hidden" name="kd_perusahaan" class="form-control" placeholder="Nama Perusahaan" required="" value="<?php echo $kode ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pimpinan</label>
                    <input type="text" class="form-control" required="" value="<?= set_value('nama_direktur')?>" name="nama_direktur" placeholder="Nama Direktur" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jabatan Pimpinan</label>
                    <input type="text" class="form-control" required="" value="<?= set_value('Jabatan')?>" name="Jabatan" placeholder="Jabatan Pimpinan" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">NPWP</label>
                    <input type="text" class="form-control" name="npwp" value="<?= set_value('npwp')?>" placeholder="NPWP" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= set_value('email')?>" placeholder="Email" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nomor Telpon</label>
                    <input type="number" name="no_telpon" value="<?= set_value('no_telpon')?>" class="form-control" placeholder="Nomor Telpon" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nomor Fax</label>
                    <input type="number" name="no_fax" class="form-control" value="<?= set_value('no_fax')?>" placeholder="Nomor Fax" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Alamat</label>
                    <input type="text" name="alamat" value="<?= set_value('alamat')?>" class="form-control" placeholder="Alamat"  autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Pejabat Penghubung</label>
                    <select class="form-control select2 <?= form_error('kd_pejabat') ? 'has-error' : null ?>" name="kd_pejabat" style="width: 100%;">
                      <option selected="" disabled="">Pilih Pejabat</option>
                      <?php foreach ($pejabat as $dt) {
                      ?>
                        <option value="<?php echo $dt['kd_pejabat'] ?>"><?php echo $dt['nama_pejabat'] ?></option>
                      <?php  }
                      ?>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_pejabat') ?></span>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Agent</label>
                    <select class="form-control select2 <?= form_error('kd_agent') ? 'has-error' : null ?>" name="kd_agent" style="width: 100%;">
                      <option selected="" disabled="">Pilih Agent</option>
                      <?php foreach ($agent as $dt) {
                      ?>
                        <option value="<?php echo $dt['kd_agent'] ?>"><?php echo $dt['nama_agent'] ?></option>
                      <?php  }
                      ?>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_agent') ?></span>
                  <div class="form-group">
                    <label for="exampleInputFile">Company Profile</label>
                    <input type="file" name="company_profil">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Akta Pendirian</label>
                    <input type="file" name="akta_pendirian">
                  </div>

                </div>
                <!-- /.col -->
                <div class="col-md-6">

                  <div class="form-group">
                    <label for="exampleInputFile">SPKMGR</label>
                    <input type="file" name="spkmgr">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">STDP</label>
                    <input type="file" name="stdp">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">SIUP</label>
                    <input type="file" name="siup">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">SKTU</label>
                    <input type="file" name="sktu">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">SIUJK</label>
                    <input type="file" name="siujk">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">SPT</label>
                    <input type="file" name="spt">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">KTP</label>
                    <input type="file" name="ktp">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Laporan Keuangan</label>
                    <input type="file" name="laporan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Proyek Sebelumnya</label>
                    <input type="file" name="proyek">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">NPWP</label>
                    <input type="file" name="npwp_file">
                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Submit</button>
            <a href="<?php echo base_url('Admin/lihat_perusahaan/') ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
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