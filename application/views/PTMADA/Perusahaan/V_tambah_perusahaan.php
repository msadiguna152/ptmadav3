

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
            <h3 class="box-title">TAMBAH DATA PERUSAHAAN</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">

              <form method="POST" action="<?php echo base_url('Ptmada/proses_tambah_perusahaan') ?>" onsubmit="return validasi()" enctype="multipart/form-data">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" value="<?= set_value('nama_perusahaan')?>" placeholder="Nama Perusahaan" required="" autofocus autocomplete="off">
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
                    <input type="text" onkeypress="return hanyaAngka(event)" name="no_telpon" value="<?= set_value('no_telpon')?>" class="form-control" placeholder="Nomor Telpon" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nomor Fax</label>
                    <input type="text" onkeypress="return hanyaAngka(event)" name="no_fax" class="form-control" value="<?= set_value('no_fax')?>" placeholder="Nomor Fax" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Alamat</label>
                    <textarea name="alamat" value="<?= set_value('alamat')?>" class="form-control" placeholder="Alamat"  autocomplete="off"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Scan atau Foto TTD Pimpinan Perusahaan</label>
                    <input type="file" name="foto_ttd" accept='image/*'>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Pejabat Penghubung</label>
                    <select class="form-control selectpicker show-tick <?= form_error('kd_pejabat') ? 'has-error' : null ?>" name="kd_pejabat"  data-live-search="true" required="" data-style="btn-primary" title="Pilih Pejabat" data-size="5">
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
                    <select class="form-control selectpicker show-tick <?= form_error('kd_agent') ? 'has-error' : null ?>" name="kd_agent" data-live-search="true" required="" data-style="btn-primary" title="Pilih Agent" data-size="5">
                      <?php foreach ($agent as $dt) {
                      ?>
                        <option value="<?php echo $dt['kd_agent'] ?>"><?php echo $dt['nama_agent'] ?></option>
                      <?php  }
                      ?>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_agent') ?></span>
                  

                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Company Profile</label>
                    <input type="file" name="company_profil">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Akta Pendirian</label>
                    <input type="file" name="akta_pendirian">
                  </div>
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
                  <!-- Perbaikan By Adiguna -->
                  <div class="form-group">
                    <label for="exampleInputFile">Tanda Keanggotaan Asosiasi</label>
                    <input type="file" name="tanda_keanggotaan_asosiasi">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Akta Perubahan Perusahaan</label>
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
        <script type="text/javascript">
          function validasi() {
            var get_nama_perusahaan = document.getElementById("nama_perusahaan").value;
            if (get_nama_perusahaan == "Adiguna") {
              alert('Nama Perusahaan Sudah Ada!');
              return false;
            }
            
            <?php 
              $sql_perusahaan = $this->db->query("SELECT * from perusahaan")->result_array();
              foreach ($sql_perusahaan as $dt1) {
            ?>
              else if (get_nama_perusahaan == "<?php echo $dt1['nama_perusahaan']; ?>"){
                alert('Nama Perusahaan Sudah Ada!');
                return false;
              }
            <?php } ?>
            else{
              return true;
            }
          }
        </script>
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
<!-- /.content-wrapper

