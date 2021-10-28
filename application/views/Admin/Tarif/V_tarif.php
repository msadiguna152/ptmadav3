<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Tarif
      <!-- <small>Rekanan</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
      <li class="active">Data Tarif</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Tarif</h3><br>
          </div>
          <div class="box-footer">
            <!-- <a href="<?php echo site_url('Admin/master_cetak/'); ?>" target="_blank" title="Cetak Master"><button type="button" class="btn btn-info" title="Tambah Data Tarif"><i class="fa fa-print"></i> Cetak Master</button></a> -->
            <!--  <a href="<?php echo base_url('Admin/cetak_permohonan') ?>"><button type="button" class="btn btn-info" title="Tambah Data Tarif"><i class="fa fa-plus-square"></i> Cetak</button></a> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped" width="100%">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="10%">Tanggal</th>
                  <th width="20%">Nomor Tarif</th>
                  <th width="10%">Nama Perusahaan</th>
                  <th width="10%">Nama Pejabat</th>
                  <th width="10%">Nama Pekerjaan</th>
                  <th width="10%">Nilai Proyek</th>
                  <th width="10%">Jenis Jaminan</th>
                  <th width="20%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($data as $dt) {
                ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo date('d-m-Y',strtotime($dt['tgl_permohonan'])); ?></td>
                    <td><?php echo $dt['no_permohonan']; ?></td>
                    <td>
                      <?php echo $dt['nama_perusahaan']; ?>
                      <!-- <a href="<?php echo base_url('Admin/detail_perusahaan/' . $dt['kd_perusahaan']) ?>"></a> -->
                    </td>
                    <td>
                      <?php echo $dt['nama_pejabat']; ?>
                      <!-- <a href="<?php echo base_url('Admin/detail_perusahaan/' . $dt['kd_pejabat']) ?>"></a> -->
                    </td>

                    <td><?php echo $dt['nama_pekerjaan']; ?></td>
                    <td><?php echo "Rp. " . number_format($dt['nilai_proyek'], 2, ',', '.'); ?></td>
                    <td><?php echo $dt['jenis_jaminan']; ?></td>
                    <td>
                      <center>
                        <!-- <a href="<?php echo site_url('Admin/tarif_cetak/' . $dt['id_tarif']); ?>" target="_blank" title="Cetak Tarif"><i class="fa fa-print"></i></a>| -->
                        <a href="<?php echo site_url('Admin/ubah_tarif/' . $dt['id_tarif']); ?>" title="Ubah Tarif"><i class="fa fa-edit"></i></a>|
                        <a href="<?php echo site_url('Admin/detail_tarif/' . $dt['id_tarif']); ?>" title="Detail Tarif"><i class="fa fa-info-circle"></i></a>|
                        <a href="<?php echo site_url('Admin/hapus_tarif/' . $dt['id_tarif']); ?>" onclick="return konformasi()" title="Hapus Tarif"><i class="fa fa-trash"></i></a>

                      </center>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Nomor Tarif</th>
                  <th>Nama Perusahaan</th>
                  <th>Nama Pejabat</th>
                  <th>Nama Pekerjaan</th>
                  <th>Nilai Proyek</th>
                  <th>Jenis Jaminan</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  </section>
  <!-- /.content -->
</div>