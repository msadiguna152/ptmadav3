<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#kd_jenis').on('change', function() {
      var kd_provinsi = $(this).val();
      $.ajax({

        url: "<?php echo base_url('Admin/ambil_data') ?>",
        type: "POST",
        data: {
          modul: 'Jaminan',
          id: kd_provinsi
        },
        success: function(respond) {

          $("#id_persen").html(respond);
        },
        error: function() {
          alert('hahah');
        }
      })


    })
  })

  function get() {
    //document.getElementById("text").value = document.getElementById("id_persen").value;

    var persen = document.getElementById('text').value;
    var nilai_proyek = document.getElementById('nilai_proyek').value;


    var hasil = nilai_proyek * (persen / 100);

    var nilai_jaminan = document.getElementById('nilai_jaminan').value = hasil;




  }

  function CalcDiff() {
    var y = document.getElementById("tgl1").value;
    var x = document.getElementById("tgl2").value;

    var b = moment(y);
    var a = moment(x);
    var c = a.diff(b, 'days');

    if (isNaN(c)) c = 0;
    if (c < 0) {
      alert("Tanggal Tidak Valid")
      c = 0;
    }

    document.getElementById("selisih").value = c + 1;
  }
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Permohonan
      <!-- <small>Rekanan</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Data Permohonan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">FORM DATA PERMOHONAN</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
               <?php $kd_perusahaan =set_value('kd_perusahaan'); ?>

              <form method="POST" action="<?php echo base_url('Admin/proses_tambah_permohonan') ?>" enctype="multipart/form-data">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nomor Permohonan</label>
                    <input type="text" name="no_permohonan" class="form-control" placeholder="Nomor Permohonan" value="<?php echo $dt ?>" readonly required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Perusahaan</label>
                    <select class="form-control select2" required="" name="kd_perusahaan" style="width: 100%;"  onchange="Value(this.value)">
                      <option selected="" disabled="">Pilih Nama Perusahaan</option>
                      <?php 
                      $js = "var prd = new Array();\n"
                      ;
                      foreach ($perusahaan as $key) { 
                        if ($kd_perusahaan == $key['kd_perusahaan']) {
                          ?>

                          <option value="<?php echo $key['kd_perusahaan'] ?>" selected  ><?php echo $key['nama_perusahaan'] ?></option>
                          <?php
                        }else{
                        ?>
                          <option value="<?php echo $key['kd_perusahaan'] ?>" ><?php echo $key['nama_perusahaan'] ?></option>
                        <?php
                      }
                        ?>
                        
                      <?php 
                      $js.= "prd['" . $key['kd_perusahaan'] . "'] = {alamat_perusahaan:'".$key['alamat']."'};\n";
                    } ?>

                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_perusahaan') ?></span>
                  <div class="form-group">
                    <label for="exampleInputFile">Alamat Perusahaan</label>
                    <textarea class="form-control" required="" name="alamat_perusahaan" id="alamat_perusahaan"><?= set_value('alamat_perusahaan')?></textarea>
                  </div>

                  <?php $kd_pejabat =set_value('kd_pejabat'); ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pejabat</label>
                    <select class="form-control select2 <?= form_error('kd_pejabat') ? 'is-invalid' : null ?>"  required="" name="kd_pejabat" style="width: 100%;">
                      <option selected="" disabled="">Pilih Nama Pejabat</option>
                      <?php foreach ($pejabat as $dt) { 
                        if ($kd_pejabat == $dt['kd_pejabat']) {
                          ?>
                            <option value="<?php echo $dt['kd_pejabat'] ?>" selected><?php echo $dt['nama_pejabat'] ?></option>
                        <?php
                        }else{
                        ?>
                          <option value="<?php echo $dt['kd_pejabat'] ?>"><?php echo $dt['nama_pejabat'] ?></option>
                        <?php
                        }
                      ?>
                        
                      <?php } ?>

                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_pejabat') ?></span>

                  <?php $kd_jenis =set_value('kd_jenis'); ?>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Jenis Jaminan</label>
                    <select class="form-control select2 <?= form_error('kd_jenis') ? 'is-invalid' : null ?>" required="" id="kd_jenis" name="kd_jenis" style="width: 100%;">
                      <option selected="" disabled="">Pilih Jenis Jaminan</option>
                      <?php foreach ($jenis as $dt) { 
                        
                         
                      ?>
                        <option value="<?php echo $dt['kd_jenis'] ?>" <?php if ($kd_jenis == $dt['kd_jenis']) { echo "selected"; } ?>><?php echo $dt['jenis_jaminan'] ?></option>
                      <?php } ?>

                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_jenis') ?></span>
                 <!--  <div class="form-group">
                    <label for="exampleInputPassword1">Persen</label>
                    <select class="form-control select2" id="id_persen" name="id_persen" style="width: 100%;" onchange="get()" onclick="get()">
                      <option>Jumlah Persen</option>
                    </select>
                  </div> -->
                  <div class="form-group">
                     <label for="exampleInputPassword1">Persentase Jaminan</label>
                    <input type="number" id="text" name="persen" class="form-control" value="<?= set_value('persen')?>" placeholder="persen" onkeyup="get()">
                  </div>
                  <div class="form-group">
                   <!--  <div>
                      <center>
                        <h3 for="exampleInputPassword1">Jangka waktu</h3>
                      </center>
                      <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control pull-right">
                          </div>
                    </div> -->
                    <div style="margin-left:0px;display: flex;">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Tanggal Mulai</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="date" name="dari_tgl" required="" style="width: 100%;padding-right: 0px;padding-left: 0px;" id="tgl1" value="<?= set_value('dari_tgl')?>" class="form-control">
                        </div>
                      </div>
                      <div class="form-group" style="margin-left: 10px">
                        <label for="exampleInputPassword1">Jumlah Hari Proyek</label>
                        <!-- <div class="input-group date"> -->
                         <!--  <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div> -->
                          <input type="text" name="jangka_waktu" onkeyup="isi_otomatis()" style="width: 80%;" required="" value="<?= set_value('jangka_waktu')?>" id="jml" class="form-control">
                        <!-- </div> -->
                      </div>

                      <div class="form-group" > 
                        <label for="exampleInputPassword1">Tanggal Selesai</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" name="tgl_sampai" style="width: 100%;padding-left: 0px;padding-right: 0px;" readonly="" value="<?= set_value('tgl_sampai')?>" required="" id="tgl_sampai" class="form-control">
                        </div>
                      </div>

                    </div>

                  </div>
                  <!-- <div class="form-group">
                    <label for="exampleInputPassword1">Jumlah Hari</label>
                    <input type="text" id="selisih" name="jangka_waktu" class="form-control" placeholder="Jumlah Hari" readonly="" required="">
                  </div> -->
                  <?php $kd_jp =set_value('kd_jp'); ?>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mohon Terbitkan</label>
                    <select class="form-control select2 <?= form_error('kd_jp') ? 'is-invalid' : null ?>" required="" id="terbitkan" name="kd_jp" style="width: 100%;">
                      <option selected="selected" disabled="">Pilih Jenis Permohonan</option>
                      <?php 
                        foreach ($permohonan as $ue) {
                      ?>
                      <option value="<?php echo $ue['kd_jp'] ?>" <?php if ($kd_jp == $ue['kd_jp']) { echo "selected"; } ?>><?php echo $ue['jenis_permohonan'] ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_jp') ?></span>

                  <?php $id_instansi =set_value('id_instansi'); ?>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nama Instansi</label>
                    <select class="form-control select2 <?= form_error('id_instansi') ? 'is-invalid' : null ?>" required=""  name="id_instansi" id="id_instansi" onchange="changeValue(this.value)" style="width: 100%;">
                      <option selected="selected" disabled="">Pilih Instansi</option>
                      <?php
                      $jsArray = "var prdName = new Array();\n"; 
                        foreach ($instansi as $e) {
                      ?>
                      <option value="<?php echo $e['id_instansi'] ?>" <?php if ($id_instansi == $e['id_instansi']) { echo "selected"; } ?>><?php echo $e['instansi'] ?></option>
                    <?php 
                      $jsArray .= "prdName['" . $e['id_instansi'] . "'] = {pemilik_proyek:'" .$e['pemilik_proyek']. "',alamat_instansi:'".$e['alamat_instansi']."'};\n";
                    } ?>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('id_instansi') ?></span>
                  <div class="form-group">
                    <label for="exampleInputFile">Pemilik Proyek/Obligee</label>
                    <textarea class="form-control" required="" name="pemilik" id="pemilik_proyek"><?= set_value('pemilik')?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Alamat Instansi</label>
                    <textarea class="form-control" name="alamat_instansi" required="" readonly id="alamat_instansi"><?= set_value('alamat_instansi')?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Nama Pekerjaan</label>
                    <input type="text" required="" name="nama_pekerjaan" value="<?= set_value('nama_pekerjaan')?>" class="form-control">
                  </div>
                  
                </div>
                
                <!-- /.col -->
                <div class="col-md-6">
                  
                  <?php $kd_kabupaten =set_value('kd_kabupaten'); ?>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Lokasi Proyek</label>
                    <select class="form-control select2 <?= form_error('kd_kabupaten') ? 'is-invalid' : null ?>" id="lokasi" name="kd_kabupaten" style="width: 100%;" required="">
                      <option selected="selected" disabled="">Pilih Lokasi Proyek</option>
                      <?php 
                        foreach ($kabupaten as $u) {
                      ?>
                      <option value="<?php echo $u['kd_kabupaten'] ?>" <?php if ($kd_kabupaten == $u['kd_kabupaten']) { echo "selected"; } ?>><?php echo $u['kabupaten'] ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_kabupaten') ?></span>
                  <div class="form-group">
                    <label for="exampleInputFile">Nilai Proyek/Kontrak/HPS</label>
                    <input type="text" required="" name="nilai_proyek" id="nilai_proyek" value="<?= set_value('nilai_proyek')?>" onkeyup="get();" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Nilai Jaminan</label>
                    <input type="text" required="" name="nilai_jaminan" value="<?= set_value('nilai_jaminan')?>" id="nilai_jaminan"  class="form-control">
                  </div>
                  <?php $kd_dokumen =set_value('kd_dokumen'); ?>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Dokumen Pendukung</label>
                    <select class="form-control select2 <?= form_error('kd_dokumen') ? 'is-invalid' : null ?>" required="" name="kd_dokumen" style="width: 100%;">
                      <option selected="selected" disabled="">Pilih Dokumen Pendukung</option>
                      <?php foreach ($dokumen as $dt) {
                      ?>
                        <option value="<?php echo $dt['kd_dokumen'] ?>"  <?php if ($kd_dokumen == $dt['kd_dokumen']) { echo "selected"; } ?>><?php echo $dt['dokumen'] ?></option>
                      <?php  }
                      ?>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_dokumen') ?></span>
                  <div class="form-group">
                    <label for="exampleInputFile">File Dokumen Pendukung</label>
                    <input type="file" name="file_dokumen" required="" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">No. Dokumen Pendukung</label>
                    <input type="text" value="<?= set_value('no_dokumen')?>" name="no_dokumen" required="" class="form-control">
                  </div>
                  <div class="form-group">
                    <div>
                      <label for="exampleInputPassword1">Tanggal Dok. Pendukung</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" value="<?= set_value('tgl_dokumen')?>" name="tgl_dokumen" required="" class="form-control pull-right">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div>
                      <label for="exampleInputPassword1">Tanggal Komitmen Dok. Pendukung</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" value="<?= set_value('tgl_komitmen')?>" name="tgl_komitmen" class="form-control pull-right">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Catatan Dokumen Pendukung</label>
                    <textarea class="form-control" name="catatan"><?= set_value('catatan')?></textarea>
                  </div>
                  <?php $status =set_value('status'); ?>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Status Dokumen Pendunkung</label>
                    <select class="form-control select2 <?= form_error('status') ? 'is-invalid' : null ?>" name="status" style="width: 100%;">
                      <option selected="" disabled="">Pilih Status</option>
                      <option value="Lengkap" <?php if ($status == "Lengkap") { echo "selected"; } ?>>Lengkap</option>
                      <option value="Tidak Lengkap"  <?php if ($status == "Tidak Lengkap") { echo "selected"; } ?>>Tidak Lengkap</option>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('status') ?></span>

                  <?php $kd_agent =set_value('kd_agent'); ?>
                  <div class="form-group">
                    <label for="kd_agent">Agent</label>
                    <select class="form-control select2 <?= form_error('kd_agent') ? 'has-error' : null ?>" name="kd_agent" style="width: 100%;">
                      <option selected="" disabled="">Pilih Agent</option>
                      <?php foreach ($agent as $dt) {
                      ?>
                        <option value="<?php echo $dt['kd_agent'] ?>" <?php if ($kd_agent == $dt['kd_agent']) { echo "selected"; } ?>><?php echo $dt['nama_agent'] ?></option>
                      <?php  }
                      ?>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_agent') ?></span>

                  
                  <div class="form-group">
                    <div>
                      <label for="exampleInputPassword1">Tanggal Permohonan</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" required value="<?= set_value('tgl_permohonan')?>" name="tgl_permohonan" class="form-control pull-right" >
                      </div>
                    </div>
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
            <a href="<?php echo base_url('Admin/lihat_permohonan/') ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
          </div>

          </form>
        </div>
      </div>
    
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
    <?php echo $js; ?>  
    function Value(x){  
    document.getElementById('alamat_perusahaan').value = prd[x].alamat_perusahaan;   
    };  
    </script> 

<script type="text/javascript">    
    <?php echo $jsArray; ?>  
    function changeValue(x){  
    document.getElementById('pemilik_proyek').value = prdName[x].pemilik_proyek;
    document.getElementById('alamat_instansi').value = prdName[x].alamat_instansi;   
    };  
    </script>

<script type="text/javascript">
                    function isi_otomatis(){
                      var a = $("#tgl1").val();
                      var b = $("#jml").val();


                        $.ajax({
                             type    : 'POST',
                            url: '<?php echo base_url('Admin/ambil_data5') ?>',
                            data:"dari_tgl=" + a + "&jml="+ b,
                        }).success(function (data) {
                            var json = data;
                            $('#tgl_sampai').val(json);
                        });
                    }
                </script>

