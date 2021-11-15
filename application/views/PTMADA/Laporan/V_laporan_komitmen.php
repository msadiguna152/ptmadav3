<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Laporan Kelengkapan Dokumen Proyek
      <!-- <small>Rekanan</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Ptmada/') ?>"><i class="fa fa-dashboard"></i> PT Mada</a></li>
      <li class="active">Laporan Kelengkapan Dokumen Proyek</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Laporan Kelengkapan Dokumen Proyek</h3><br>
          </div>
          <div class="box-header">
            <div class="row">
              <form method="POST" action="<?php echo base_url('Ptmada/cari_laporan') ?>">
                <div class="col-md-12">
                  <div class="form-group col-md-1">
                    <label for="exampleInputEmail1">Filter : </label>
                  </div>
                  <div class="form-group col-md-3">
                    <select class="form-control selectpicker show-tick" data-live-search="true" required="" data-style="btn-primary" title="Pilih Nama Pejabat" data-size="5" name="kd_pejabat">
                      <option selected="" value="" >Pilih Nama Pejabat</option>
                      <?php foreach ($pejabat as $dt) {
                        ?> 
                        <option value="<?php echo $dt['kd_pejabat'] ?>"><?php echo $dt['nama_pejabat'] ?></option>
                      <?php } ?>

                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <select class="form-control selectpicker show-tick" name="kd_agent" data-live-search="true" required="" data-style="btn-primary" title="Pilih Nama Agent" data-size="5" onchange="this.form.submit();">
                      <option selected="" value="">Pilih Nama Agent</option>
                      <?php foreach ($agent as $dt) {
                        ?>
                        <option value="<?php echo $dt['kd_agent'] ?>"><?php echo $dt['nama_agent'] ?></option>
                      <?php  }
                      ?>
                    </select>
                  </div>

                </div>
              </form>
            </div>
          </div>
          <div class="box-footer">
            <a href="<?php echo base_url('Ptmada/cetak_laporan_komitmen') ?>"><button type="button" class="btn btn-info" title="Tambah Data Pejabat"><i class="fa fa-print"></i> Cetak</button></a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No. Permohonan</th>
                  <th>Nama Perusahaan</th>
                  <th>Nama Proyek</th>
                  <th>Tanggal Komitmen</th>
                  <th>Catatan Dokumen</th>
                  <th>Pejabat Penghubung</th>
                  <th>Status Dokumen</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($data as $dt) {
                ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $dt['no_permohonan']; ?> </td>
                    <td><a href="<?php echo site_url('Ptmada/detail_perusahaan/' . $dt['kd_perusahaan']); ?>"><?php echo $dt['nama_perusahaan']; ?></a></td>
                    <td><?php echo $dt['nama_pekerjaan']; ?></td>
                    <td><?php echo tgl_indo($dt['tgl_komitmen']); ?></td>
                    <td><?php echo $dt['catatan_dokumen']; ?></td>
                    <td><a href="<?php echo site_url('Ptmada/lihat_detail_pejabat/' . $dt['kd_pejabat']); ?>"><?php echo $dt['nama_pejabat']; ?></a></td>
                    <td><?php echo $dt['status']; ?></td>
                  </tr>
                <?php
                }
                ?> 
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>No. Permohonan</th>
                  <th>Nama Perusahaan</th>
                  <th>Nama Proyek</th>
                  <th>Tanggal Komitmen</th>
                  <th>Catatan Dokumen</th>
                  <th>Pejabat Penghubung</th>
                  <th>Status Dokumen</th>
                </tr>
              </tfoot>
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