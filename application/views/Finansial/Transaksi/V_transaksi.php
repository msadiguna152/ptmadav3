<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Transaksi Permohonan
      <!-- <small>Rekanan</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Finansial/') ?>"><i class="fa fa-dashboard"></i> Finansial</a></li>
      <li class="active">Data Transaksi Permohonan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Transaksi Permohonan</h3><br>
          </div>
          <div class="box-footer">

            <!--  <a href="<?php echo base_url('Finansial/cetak_Transaksi Permohonan') ?>"><button type="button" class="btn btn-info" title="Tambah Data Transaksi Permohonan"><i class="fa fa-plus-square"></i> Cetak</button></a> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Nomor Permohonan</th>
                  <th>Nama Perusahaan</th>
                  <th>Nama Pejabat</th>
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
                    <td><?php echo $dt['tgl_permohonan']; ?></td>
                    <td><?php echo $dt['no_permohonan']; ?></td>
                    <td>
                      <?php echo $dt['nama_perusahaan']; ?>
                      <!-- <a href="<?php echo base_url('Ptmada/detail_perusahaan/' . $dt['kd_perusahaan']) ?>"></a> -->
                    </td>
                    <td>
                      <?php echo $dt['nama_pejabat']; ?>
                      <!-- <a href="<?php echo base_url('Ptmada/detail_perusahaan/' . $dt['kd_pejabat']) ?>"></a> -->
                    </td>
                    <!-- <td><?php echo $dt['jenis_jaminan']; ?></td> -->
                    <td><?php echo $dt['nama_pekerjaan']; ?></td>
                    <td><?php echo "Rp. " . number_format($dt['nilai_proyek'], 2, ',', '.'); ?></td>
                    <td>
                      <center>
                        <a href="<?php echo site_url('Finansial/detail_permohonan/' . $dt['id_permohonan'].'/detail'); ?>" title="Detail"><i class="fa fa-edit"></i></a>
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
                  <th>Nomor Permohonan</th>
                  <th>Nama Perusahaan</th>
                  <th>Nama Pejabat</th>
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