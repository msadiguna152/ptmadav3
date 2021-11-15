<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#kd_jenis').on('change', function() {
      var kd_provinsi = $(this).val();
      $.ajax({

        url: "<?php echo base_url('Ptmada/ambil_data') ?>",
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
      <li><a href="<?php echo base_url('Ptmada/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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

              <form method="POST" action="<?php echo base_url('Ptmada/proses_edit_permohonan') ?>" enctype="multipart/form-data">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nomor Permohonan</label>
                    <input type="text" name="no_permohonan" class="form-control" placeholder="Nomor Permohonan" required="" value="<?php echo $permohonan['no_permohonan'] ?>">
                    <input type="hidden" name="id_permohonan" value="<?php echo $permohonan['id_permohonan'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Perusahaan</label>
                    <select onchange="Value(this.value)" class="form-control selectpicker show-tick <?= form_error('kd_perusahaan') ? 'is-invalid' : null ?>" name="kd_perusahaan" data-live-search="true" required="" data-style="btn-primary">
                      <option selected value="<?php echo $permohonan['kd_perusahaan'] ?>"><?php echo $permohonan['nama_perusahaan'] ?></option>
                      <?php 
                      $js = "var prd = new Array();\n";
                      foreach ($perusahaan as $key) {
                        if ($permohonan['kd_perusahaan'] != $key['kd_perusahaan']) {

                          ?>
                          <option value="<?php echo $key['kd_perusahaan'] ?>" <?php if ($permohonan['kd_perusahaan'] == $key['kd_perusahaan']) { echo "selected='selected'"; } ?>><?php echo $key['nama_perusahaan'] ?></option>
                          <?php
                          $js.= "prd['" . str_replace(array("\r","\n"),"",addslashes($key['kd_perusahaan'])) . "'] = {alamat_perusahaan:'".str_replace(array("\r","\n"),"",addslashes($key['alamat']))."'};\n";
                        }
                      } ?>

                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_perusahaan') ?></span>
                  <div class="form-group">
                    <label for="exampleInputFile">Alamat Perusahaan</label>
                    <textarea class="form-control" required="" name="alamat_perusahaan" id="alamat_perusahaan"><?php echo $permohonan['alamat_perusahaan']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pejabat</label>
                    <select class="form-control selectpicker show-tick <?= form_error('kd_pejabat') ? 'is-invalid' : null ?>" name="kd_pejabat" data-live-search="true" data-style="btn-primary">
                      <option selected="" value="<?php echo $permohonan['kd_pejabat'] ?>"><?php echo $permohonan['nama_pejabat'] ?></option>
                      <?php foreach ($pejabat as $dt) { 
                        if ($permohonan['kd_pejabat'] != $dt['kd_pejabat']) {
                      ?>
                        <option value="<?php echo $dt['kd_pejabat'] ?>" <?php if ($permohonan['kd_pejabat'] == $dt['kd_pejabat']) { echo "selected='selected'"; } ?>><?php echo $dt['nama_pejabat'] ?></option>
                        <?php } }?>

                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_pejabat') ?></span>

                  <div class="row">
                    <div class="col-md-6">
                      <?php $kd_jenis =set_value('kd_jenis'); ?>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Jenis Jaminan</label>
                        <select class="form-control selectpicker show-tick <?= form_error('kd_jenis') ? 'is-invalid' : null ?>" id="kd_jenis" name="kd_jenis" data-live-search="true" data-style="btn-primary">
                          <option value="<?php echo $permohonan['kd_jenis'] ?>"><?php echo $permohonan['jenis_jaminan'] ?></option>
                          <?php foreach ($jenis as $dt) { 
                            if ($permohonan['kd_jenis'] != $dt['kd_jenis']) {

                              ?>
                              <option value="<?php echo $dt['kd_jenis'] ?>" <?php if ($permohonan['kd_jenis'] == $dt['kd_jenis']) {echo "selected='selected'"; } ?>><?php echo $dt['jenis_jaminan'] ?></option>
                            <?php }} ?>

                          </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                      <?php $persen =set_value('persen'); ?>

                     <div class="form-group"> 
                        <label for="exampleInputPassword1">Persentase Jaminan</label>
                        <div class="input-group">
                          <input type="text" maxlength="13" onkeypress="return hanyaAngka(event)" id="text" name="persen" class="form-control" value="<?php echo $permohonan['persen'] ?>" placeholder="persen" onkeyup="get()">
                          <div class="input-group-addon">
                            <b>%</b>
                          </div>
                        </div>
                      </div>
                   </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Tanggal Mulai</label>
                        <div class="input-group">
                          <input type="date" name="dari_tgl" required="" id="tgl1" onchange="CalcDiff()" value="<?php echo $permohonan['dari_tgl'] ?>" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Jumlah Hari Proyek</label>
                          <input type="text" name="jangka_waktu" onkeyup="isi_otomatis()" required="" value="<?php echo $permohonan['jangka_waktu'] ?>" id="jml" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group" > 
                        <label for="exampleInputPassword1">Tanggal Selesai</label>
                        <div class="input-group date">
                          <input type="text" name="tgl_sampai" readonly="" value="<?php echo date("d/m/Y", strtotime($permohonan['sampai_tgl'])) ?>" required="" id="tgl_sampai" class="form-control">
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Mohon Terbitkan</label>
                    <select class="form-control selectpicker show-tick <?= form_error('kd_jp') ? 'is-invalid' : null ?>" id="terbitkan" name="kd_jp" data-live-search="true" data-style="btn-primary">
                      <option value="<?php echo $permohonan['kd_jp'] ?>"><?php echo $permohonan['jenis_permohonan'] ?></option>
                      <?php 
                        foreach ($mohonan as $ue) {
                          if ($permohonan['kd_jp'] != $ue['kd_jp']) {
                      ?>
                      <option value="<?php echo $ue['kd_jp'] ?>"><?php echo $ue['jenis_permohonan'] ?></option>
                    <?php } }?>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_jp') ?></span>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nama Instansi</label>
                    <select class="form-control selectpicker show-tick <?= form_error('id_instansi') ? 'is-invalid' : null ?>"  name="id_instansi" id="id_instansi" onchange="changeValue(this.value)" data-live-search="true" required="" data-style="btn-primary" data-size="5">
                      <option value="<?php echo $permohonan['id_instansi'] ?>"><?php echo $permohonan['instansi'];
                      $jsArray = "var prdName = new Array();\n";  
                      $jsArray .= "prdName['" . $permohonan['id_instansi'] . "'] = {pemilik_proyek:'" .$permohonan['pemilik_proyek']. "',alamat_instansi:'".$permohonan['alamat_instansi']."'};\n";
                      ?>
                        
                      </option>
                      <?php
                      
                        foreach ($instansi as $e) {
                          if ($permohonan['id_instansi'] != $e['id_instansi']) {
                      ?>
                      <option value="<?php echo $e['id_instansi'] ?>"><?php echo substr($e['instansi'],0,'100') ?></option>
                    <?php 
                      $jsArray .= "prdName['" . $e['id_instansi'] . "'] = {pemilik_proyek:'" .str_replace(array("\r","\n"),"",addslashes($e['pemilik_proyek'])). "',alamat_instansi:'".str_replace(array("\r","\n"),"",addslashes($e['alamat_instansi']))."'};\n";
                    } }?>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('id_instansi') ?></span>
                  <div class="form-group">
                    <label for="exampleInputFile">Pemilik Proyek/Obligee</label>
                    <textarea class="form-control" name="pemilik" required="" id="pemilik_proyek"><?php echo $permohonan['pemilik'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Alamat Instansi</label>
                    <textarea class="form-control" readonly required="" id="alamat_instansi"><?php echo $permohonan['alamat_instansi'] ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Nama Pekerjaan</label>
                    <textarea name="nama_pekerjaan" required="" class="form-control"><?php echo $permohonan['nama_pekerjaan'] ?></textarea>
                  </div>

                  
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Lokasi Proyek</label>
                    <select class="form-control selectpicker show-tick <?= form_error('kd_kabupaten') ? 'is-invalid' : null ?>" id="lokasi" name="kd_kabupaten" data-live-search="true" data-style="btn-primary">
                      <option value="<?php echo $permohonan['kd_kabupaten'] ?>"><?php echo $permohonan['kabupaten'] ?></option>
                      <?php 
                        foreach ($kabupaten as $u) {
                          if ($u['kd_kabupaten'] != $permohonan['kd_kabupaten']) {
                      ?>
                      <option value="<?php echo $u['kd_kabupaten'] ?>"><?php echo $u['kabupaten'] ?></option>
                    <?php } }?>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_kabupaten') ?></span>
                  <div class="form-group">
                    <label for="exampleInputFile">Nilai Proyek/Kontrak/HPS</label>
                    <input type="text" name="nilai_proyek" required id="nilai_proyek" onkeyup="get();" class="form-control" value="<?php echo $permohonan['nilai_proyek'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Nilai Jaminan</label>
                    <input type="text" name="nilai_jaminan" required id="nilai_jaminan"  class="form-control" value="<?php echo $permohonan['nilai_jaminan'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Dokumen Pendukung</label>
                    <select class="form-control selectpicker show-tick <?= form_error('kd_dokumen') ? 'is-invalid' : null ?>" name="kd_dokumen" data-live-search="true" data-style="btn-primary">
                      <option selected="" disabled="">Pilih Dokumen Pendukung</option>
                      <?php foreach ($dokumen as $dt) {
                      ?>
                        <option value="<?php echo $dt['kd_dokumen'] ?>" <?php if ($permohonan['kd_dokumen'] == $dt['kd_dokumen']) { echo "selected='selected'"; } ?>>
                          <?php echo $dt['dokumen'] ?>
                        </option>
                      <?php }
                      ?>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('kd_dokumen') ?></span>
                  <div class="form-group">
                    <label for="exampleInputFile">File Dokumen Pendukung</label>
                    <input type="text" name="file_dokumen_lama" class="form-control" required="" value="<?php echo $permohonan['file_dokumen'] ?>" readonly onclick="window.open('<?php echo base_url()."/file/Permohonan/".$permohonan['file_dokumen'] ?>', '_blank')" >
                    <input type="file" name="file_dokumen" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">No. Dokumen Pendukung</label>
                    <input type="text" name="no_dokumen" required class="form-control" value="<?php echo $permohonan['no_dokumen'] ?>">
                  </div>
                  <div class="form-group">
                    <div>
                      <label for="exampleInputPassword1">Tanggal Dok. Pendukung</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" name="tgl_dokumen" required class="form-control pull-right" value="<?php echo $permohonan['tgl_dokumen'] ?>">
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
                        <input type="date" name="tgl_komitmen" required value="<?php echo $permohonan['tgl_komitmen'] ?>" class="form-control pull-right">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Catatan Dokumen Pendukung</label>
                    <textarea class="form-control"  name="catatan" ><?php echo $permohonan['catatan_dokumen'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Status Dokumen Pendunkung</label>
                    <select class="form-control selectpicker show-tick <?= form_error('status') ? 'is-invalid' : null ?>" name="status" data-live-search="true" data-style="btn-primary">
                      <option selected="" disabled="">Pilih Status</option>
                      <option value="Lengkap" <?php if ($permohonan['status'] =='Lengkap') { echo "selected='selected'"; } ?>>Lengkap</option>
                      <option value="Tidak Lengkap" <?php if ($permohonan['status'] =='Tidak Lengkap') { echo "selected='selected'"; } ?>>Tidak Lengkap</option>
                    </select>
                  </div>
                  <span style="color: red"><?= form_error('status') ?></span>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Agent</label>
                    <select class="form-control selectpicker show-tick <?= form_error('kd_agent') ? 'is-invalid' : null ?>" name="kd_agent" data-live-search="true" data-style="btn-primary">
                      <option selected="" disabled="">Pilih Agent</option>
                      <?php foreach ($agent as $dt) {
                      ?>
                        <option value="<?php echo $dt['kd_agent'] ?>" 
                          <?php if ($permohonan['kd_agent'] == $dt['kd_agent']) { echo "selected='selected'"; } ?>>
                          <?php echo $dt['nama_agent'] ?>
                        </option>
                      <?php }
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
                        <input type="date" name="tgl_permohonan" required value="<?php echo $permohonan['tgl_permohonan'] ?>" class="form-control pull-right">
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
            <a href="<?php echo base_url('Ptmada/lihat_permohonan/') ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
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
     url: '<?php echo base_url('Ptmada/ambil_data5') ?>',
     data:"dari_tgl=" + a + "&jml="+ b,
   }).success(function (data) {
    var json = data;
    $('#tgl_sampai').val(json);
  });
 }
</script>

<script type="text/javascript">
  $(function () {
    $('.datetimepicker-input').datetimepicker({
      format: 'L'
    });
  });
</script>
