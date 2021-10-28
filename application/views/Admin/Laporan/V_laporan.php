<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Laporan Kelengkapan Dokumen Perusahaan Rekanan
      <!-- <small>Rekanan</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> PT Mada</a></li>
      <li class="active">Data Laporan Kelengkapan Dokumen Perusahaan Rekanan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Data Laporan Kelengkapan Dokumen Perusahaan Rekanan</h3><br>
          </div>
          <div class="row">
            <form method="POST" action="<?php echo base_url('Admin/cari_laporan') ?>">
              <div class="col-md-8" style="display: flex;" >
                  <div class="form-group col-md-4"  style="margin-right: 50px; margin-left: 30px">
                    <label for="exampleInputEmail1">Nama Pejabat</label>
                    <select class="form-control select2"  name="kd_pejabat" style="width: 100%;">
                      <option selected="" value="" >Pilih Nama Pejabat</option>
                      <?php foreach ($pejabat as $dt) {
                      ?> 
                      <option value="<?php echo $dt['kd_pejabat'] ?>"><?php echo $dt['nama_pejabat'] ?></option>
                      <?php } ?>

                    </select>
                  </div>
                  <div class="form-group  col-md-4">
                    <label for="kd_agent">Agent</label>
                    <select class="form-control select2" name="kd_agent" style="width: 100%;">
                      <option selected="" value="">Pilih Nama Agent</option>
                      <?php foreach ($agent as $dt) {
                      ?>
                        <option value="<?php echo $dt['kd_agent'] ?>"><?php echo $dt['nama_agent'] ?></option>
                      <?php  }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <button type="submit" class=" form-control btn btn-success" style="margin-top: 10px;" ><i class="fa fa-search"></i> Filter</button>
                  </div> 
              </div>
              <!-- <div class="col-md-12">
                  <div class="form-group" >
                    <button type="submit" class=" form-control btn btn-success" style="margin-left: 30px; width: 10%"><i class="fa fa-search"></i> Filter</button>
                  </div>
              </div> -->
            </form>
          </div>
          <div class="box-footer">
            <a href="<?php echo base_url('Admin/cetak_laporan') ?>"><button type="button" class="btn btn-info" title="Tambah Data Pejabat"><i class="fa fa-print"></i> Cetak</button></a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Perusahaan</th>
                  <th>Kekurangan Dokumen</th>
                  <th>Pejabat Penghubung</th>
                  <th>Agent</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($data as $dt) {
                ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><a href="<?php echo site_url('Admin/detail_perusahaan/' . $dt['kd_perusahaan']); ?>"><?php echo $dt['nama_perusahaan']; ?></a></td>
                    <td>

                      <?php
                      if ($dt['company_profile'] =='Tidak Ada Data') {
                         echo "Company Profile, ";
                       } 

                      if ($dt['akta_pendirian'] =='Tidak Ada Data') {
                         echo "Akta Pendirian, ";
                       }
                      if ($dt['spkmgr'] =='Tidak Ada Data') {
                         echo "SPKMGR, ";
                       } 
                      if ($dt['stdp'] =='Tidak Ada Data') {
                         echo "STDP, ";
                       } 
                      if ($dt['siup'] =='Tidak Ada Data') {
                         echo "SIUP, ";
                       } 
                      if ($dt['sktu'] =='Tidak Ada Data') {
                         echo "SKTU, ";
                       }
                      if ($dt['siujk'] =='Tidak Ada Data') {
                         echo "SIUJK, ";
                       } 
                      if ($dt['spt'] =='Tidak Ada Data') {
                         echo "SPT, ";
                       } 
                       if ($dt['npwp_file'] =='Tidak Ada Data') {
                         echo "NPWP, ";
                       } 
                      if ($dt['ktp'] =='Tidak Ada Data') {
                         echo "KTP, ";
                       } 
                       if ($dt['laporan_keuangan'] =='Tidak Ada Data') {
                         echo "Laporan keuangan, ";
                       } 
                       if ($dt['proyek_sebelumnya'] =='Tidak Ada Data') {
                         echo "Proyek Sebelumnya, ";
                       }  

                      ?>
                        
                      </td>
                    <td><a href="<?php echo site_url('Admin/lihat_detail_pejabat/' . $dt['kd_pejabat']); ?>"><?php echo $dt['nama_pejabat']; ?></a></td>
                    <td><a href="<?php echo site_url('Admin/lihat_detail_agent/' . $dt['kd_agent']); ?>"><?php echo $dt['nama_agent']; ?></a></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama Perusahaan</th>
                  <th>Kelengkapan Dokumen</th>
                  <th>Pejabat Penghubung</th>
                  <th>Agent</th>
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