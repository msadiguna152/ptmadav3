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

              <form method="POST" action="<?php echo base_url('Admin/proses_edit_perusahaan') ?>" enctype="multipart/form-data">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" class="form-control" required placeholder="Nama Perusahaan" value="<?php echo $data['nama_perusahaan'] ?>"  autocomplete="off" autofocus>
                    <input type="hidden" name="kd_perusahaan" class="form-control" placeholder="Nama Perusahaan" value="<?php echo $data['kd_perusahaan'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pimpinan</label>
                    <input type="text" class="form-control" name="nama_direktur" required placeholder="nama_direktur" value="<?php echo $data['nama_direktur'] ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jabatan Pimpinan</label>
                    <input type="text" class="form-control" required value="<?php echo $data['jab_pimpinan'] ?>" name="Jabatan" placeholder="Jabatan Pimpinan" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">NPWP</label>
                    <input type="text" class="form-control" name="npwp" placeholder="NPWP" value="<?php echo $data['npwp'] ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $data['email'] ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nomor Telpon</label>
                    <input type="number" name="no_telpon" class="form-control" placeholder="Nomor Telpon" value="<?php echo $data['no_telpon'] ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nomor Fax</label>
                    <input type="number" name="no_fax" class="form-control" placeholder="Nomor Fax" value="<?php echo $data['no_fax'] ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="<?php echo $data['alamat'] ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Pejabat Penghubung</label>
                    <select class="form-control select2 <?= form_error('kd_pejabat') ? 'has-error' : null ?>"" name="kd_pejabat" style="width: 100%;">
                      <option value="<?php echo $data['kd_pejabat'] ?>"><?php echo $data['nama_pejabat'] ?></option>
                      <?php foreach ($pejabat as $dt) {
                        if ($data['kd_pejabat'] != $dt['kd_pejabat']) {
                      ?>
                        <option value="<?php echo $dt['kd_pejabat'] ?>"><?php echo $dt['nama_pejabat'] ?></option>
                      <?php } }
                      ?>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_pejabat') ?></span>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Agent</label>
                    <select class="form-control select2 <?= form_error('kd_agent') ? 'has-error' : null ?>" name="kd_agent" style="width: 100%;">
                      <option value="<?php echo $data['kd_agent'] ?>"><?php echo $data['nama_agent'] ?></option>
                      <?php foreach ($agent as $dt) {
                        if ($data['kd_agent'] != $dt['kd_agent']) {
                      ?>
                        <option value="<?php echo $dt['kd_agent'] ?>"><?php echo $dt['nama_agent'] ?></option>
                      <?php  }}
                      ?>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_agent') ?></span>
                  <div class="form-group">
                    <label for="exampleInputFile">Company Profile</label>
                    <input type="text" name="company_profile_lama" class="form-control" value="<?php echo $data['company_profile'] ?>" readonly>
                    <input type="file" name="company_profil">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Akta Pendirian</label>
                    <input type="text" name="akta_pendirian_lama" class="form-control" value="<?php echo $data['akta_pendirian'] ?>" readonly>
                    <input type="file" name="akta_pendirian">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">SPKMGR</label>
                    <input type="text" name="spkmgr_lama" class="form-control" value="<?php echo $data['spkmgr'] ?>" readonly>
                    <input type="file" name="spkmgr">
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">


                  <div class="form-group">
                    <label for="exampleInputFile">STDP</label>
                    <input type="text" name="stdp_lama" class="form-control" value="<?php echo $data['stdp'] ?>" readonly>
                    <input type="file" name="stdp">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">SIUP</label>
                    <input type="text" name="siup_lama" class="form-control" value="<?php echo $data['siup'] ?>" readonly>
                    <input type="file" name="siup">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">SKTU</label>
                    <input type="text" name="sktu_lama" class="form-control" required="" value="<?php echo $data['sktu'] ?>" readonly>
                    <input type="file" name="sktu">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">SIUJK</label>
                    <input type="text" name="siujk_lama" class="form-control" required="" value="<?php echo $data['siujk'] ?>" readonly>
                    <input type="file" name="siujk">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">SPT</label>
                    <input type="text" name="spt_lama" class="form-control" required="" value="<?php echo $data['spt'] ?>" readonly>
                    <input type="file" name="spt">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">KTP</label>
                    <input type="text" name="ktp_lama" class="form-control" required="" value="<?php echo $data['ktp'] ?>" readonly>
                    <input type="file" name="ktp">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Laporan Keuangan</label>
                    <input type="text" name="laporan_lama" class="form-control" required="" value="<?php echo $data['laporan_keuangan'] ?>" readonly>
                    <input type="file" name="laporan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Proyek Sebelumnya</label>
                    <input type="text" name="proyek_lama" class="form-control" required="" value="<?php echo $data['proyek_sebelumnya'] ?>" readonly>
                    <input type="file" name="proyek">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">NPWP</label>
                    <input type="text" name="npwp_lama" class="form-control" required="" value="<?php echo $data['npwp_file'] ?>" readonly>
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