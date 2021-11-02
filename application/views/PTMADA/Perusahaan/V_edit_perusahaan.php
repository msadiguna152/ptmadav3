<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Perusahaan
      <small>Rekanan</small>
    </h1>
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

              <form method="POST" action="<?php echo base_url('Ptmada/proses_edit_perusahaan') ?>" enctype="multipart/form-data">
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
                    <input type="text" onkeypress="return hanyaAngka(event)" name="no_telpon" class="form-control" placeholder="Nomor Telpon" value="<?php echo $data['no_telpon'] ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nomor Fax</label>
                    <input type="text" onkeypress="return hanyaAngka(event)" name="no_fax" class="form-control" placeholder="Nomor Fax" value="<?php echo $data['no_fax'] ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Alamat</label>
                    <textarea name="alamat" class="form-control" placeholder="Alamat" autocomplete="off"><?php echo $data['alamat'] ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Scan atau Foto TTD Pimpinan Perusahaan</label>
                    <input type="text" name="foto_ttd_lama" class="form-control" value="<?php echo $data['foto_ttd'] ?>" readonly>

                    <div class="form-check">
                      <input class="form-check-input" name="hapus_ttd" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>

                    <input type="file" name="foto_ttd" accept='image/*'>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Pejabat Penghubung</label>
                    <select class="form-control selectpicker show-tick <?= form_error('kd_pejabat') ? 'has-error' : null ?>" name="kd_pejabat" data-live-search="true" data-style="btn-primary" data-size="5">
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
                    <select class="form-control selectpicker show-tick <?= form_error('kd_agent') ? 'has-error' : null ?>" name="kd_agent" data-live-search="true" data-style="btn-primary" data-size="5">
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

                </div>
                <!-- /.col -->
                <div class="col-md-6">

                  <div class="form-group">
                    <label for="exampleInputFile">Company Profile</label>
                    <input type="text" name="company_profile_lama" class="form-control" value="<?php echo $data['company_profile'] ?>" readonly>

                    <div class="form-check">
                      <input class="form-check-input" name="hapus_cp" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>

                    <input type="file" name="company_profil">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Akta Pendirian</label>
                    <input type="text" name="akta_pendirian_lama" class="form-control" value="<?php echo $data['akta_pendirian'] ?>" readonly>

                    <div class="form-check">
                      <input class="form-check-input" name="hapus_ap" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>

                    <input type="file" name="akta_pendirian">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">SPKMGR</label>
                    <input type="text" name="spkmgr_lama" class="form-control" value="<?php echo $data['spkmgr'] ?>" readonly>

                    <div class="form-check">
                      <input class="form-check-input" name="hapus_spkmgr" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>

                    <input type="file" name="spkmgr">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">STDP</label>
                    <input type="text" name="stdp_lama" class="form-control" value="<?php echo $data['stdp'] ?>" readonly>
                    <div class="form-check">
                      <input class="form-check-input" name="hapus_stdp" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>
                    <input type="file" name="stdp">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputFile">SIUP</label>
                    <input type="text" name="siup_lama" class="form-control" value="<?php echo $data['siup'] ?>" readonly>
                    <div class="form-check">
                      <input class="form-check-input" name="hapus_siup" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>
                    <input type="file" name="siup">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">SKTU</label>
                    <input type="text" name="sktu_lama" class="form-control" required="" value="<?php echo $data['sktu'] ?>" readonly>
                    <div class="form-check">
                      <input class="form-check-input" name="hapus_sktu" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>
                    <input type="file" name="sktu">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">SIUJK</label>
                    <input type="text" name="siujk_lama" class="form-control" required="" value="<?php echo $data['siujk'] ?>" readonly>
                    <div class="form-check">
                      <input class="form-check-input" name="hapus_siujk" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>
                    <input type="file" name="siujk">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">SPT</label>
                    <input type="text" name="spt_lama" class="form-control" required="" value="<?php echo $data['spt'] ?>" readonly>
                    <div class="form-check">
                      <input class="form-check-input" name="hapus_spt" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>
                    <input type="file" name="spt">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">KTP</label>
                    <input type="text" name="ktp_lama" class="form-control" required="" value="<?php echo $data['ktp'] ?>" readonly>
                    <div class="form-check">
                      <input class="form-check-input" name="hapus_ktp" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>
                    <input type="file" name="ktp">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Laporan Keuangan</label>
                    <input type="text" name="laporan_lama" class="form-control" required="" value="<?php echo $data['laporan_keuangan'] ?>" readonly>
                    <div class="form-check">
                      <input class="form-check-input" name="hapus_lk" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>
                    <input type="file" name="laporan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Proyek Sebelumnya</label>
                    <input type="text" name="proyek_lama" class="form-control" required="" value="<?php echo $data['proyek_sebelumnya'] ?>" readonly>
                    <div class="form-check">
                      <input class="form-check-input" name="hapus_ps" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>
                    <input type="file" name="proyek">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">NPWP</label>
                    <input type="text" name="npwp_lama" class="form-control" required="" value="<?php echo $data['npwp_file'] ?>" readonly>
                    <div class="form-check">
                      <input class="form-check-input" name="hapus_npwp" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>
                    <input type="file" name="npwp_file">
                  </div>

                  <!-- Edit By Adiguna -->

                  <div class="form-group">
                    <label for="exampleInputFile">Tanda Keanggotaan Asosiasi</label>
                    <input type="text" name="tanda_keanggotaan_asosiasi_lama" class="form-control" required="" value="<?php echo $data['tanda_keanggotaan_asosiasi'] ?>" readonly>
                    <div class="form-check">
                      <input class="form-check-input" name="hapus_kta" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>
                    <input type="file" name="tanda_keanggotaan_asosiasi">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Akta Perubahan Perusahaan</label>
                    <input type="text" name="akta_perubahan_perusahaan_lama" class="form-control" required="" value="<?php echo $data['akta_perubahan_perusahaan'] ?>" readonly>
                    <div class="form-check">
                      <input class="form-check-input" name="hapus_app" type="checkbox" value="Hapus File">
                      <label class="form-check-label">Hapus File</label>
                    </div>
                    <input type="file" name="akta_perubahan_perusahaan">
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
            <a href="<?php echo base_url('Ptmada/lihat_perusahaan/') ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
          </div>

          </form>
        </div>
      </div>

    </div>
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
