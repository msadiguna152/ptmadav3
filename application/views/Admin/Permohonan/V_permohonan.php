<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Permohonan
      <!-- <small>Rekanan</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> PT Mada</a></li>
      <li class="active">Data Permohonan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Permohonan</h3><br>
          </div>
          <div class="box-footer">
            <a href="<?php echo base_url('Admin/tambah_permohonan') ?>"><button type="button" class="btn btn-info" title="Tambah Data Permohonan"><i class="fa fa-plus-square"></i> Tambah Permohonan</button></a>
            <!-- <a href="<?php echo base_url('Admin/cetak_permohonan') ?>"><button type="button" class="btn btn-info" title="Tambah Data Permohonan"><i class="fa fa-plus-square"></i> Cetak</button></a> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nomor Permohonan</th>
                  <th>Nama Perusahaan</th>
                  <!-- <th>Nama Pejabat</th> -->
                  <!-- <th>Jenis Jaminan</th> -->
                  <th>Nama Pekerjaan</th>
                  <th>Nilai Proyek</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                          $no = 1;
                          foreach ($data as $dt) {
                ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $dt['no_permohonan']; ?></td>
                    <td><a href="<?php echo base_url('Admin/detail_perusahaan/' . $dt['kd_perusahaan']) ?>"><?php echo $dt['nama_perusahaan']; ?></a></td>
                    <!-- <td><a href="<?php echo base_url('Admin/detail_perusahaan/' . $dt['kd_pejabat']) ?>"><?php echo $dt['nama_pejabat']; ?></a></td> -->
                    <!-- <td><?php echo $dt['jenis_jaminan']; ?></td> -->
                    <td><?php echo $dt['nama_pekerjaan']; ?></td>
                    <td><?php echo "Rp. " . number_format($dt['nilai_proyek'], 2, ',', '.'); ?></td>
                    <td>
                      <center>
                        <a href="<?php echo site_url('Admin/cetak_permohonan/' . $dt['id_permohonan']); ?>" target="_blank" title="Cetak Permohonan"><i class="fa fa-print"></i></a>
                        |
                        <a href="<?php echo site_url('Admin/detail_permohonan/' . $dt['id_permohonan']); ?>" title="Detail"><i class="fa fa-info-circle"></i></a>
                        |
                        <a href="<?php echo site_url('Admin/edit_permohonan/' . $dt['id_permohonan']); ?>" title="Edit"><i class="fa fa-edit"></i></a>
                        |
                        <a href="<?php echo site_url('Admin/hapus_permohonan/' . $dt['id_permohonan']); ?>" onclick="return konformasi()" title="Delete"><i class="fa fa-trash"></i></a>
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
                  <th>Nomor Permohonan</th>
                  <th>Nama Perusahaan</th>
                  <!-- <th>Nama Pejabat</th> -->
                  <!--  <th>Jenis Jaminan</th> -->
                  <th>Nama Pekerjaan</th>
                  <th>Nilai Proyek</th>
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