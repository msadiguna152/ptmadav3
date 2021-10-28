<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Permohonan
      <!-- <small>Rekanan</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Ptmada/') ?>"><i class="fa fa-dashboard"></i> PT Mada</a></li>
      <li class="active">Data Permohonan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-footer">
            <a href="<?php echo base_url('Ptmada/tambah_permohonan') ?>">
              <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="auto" title="Tambah Data Permohonan"><i class="fa fa-plus-square"> </i> Tambah 
              </button>
            </a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="text-align: center;width: 10px;">No</th>
                  <th style="text-align: center;">Nomor Permohonan</th>
                  <th style="text-align: center;">Nama Perusahaan</th>
                  <th style="text-align: center;">Nama Pekerjaan</th>
                  <th style="text-align: center; width: 120px">Nilai Proyek</th>
                  <th style="text-align: center;width: 40px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                          $no = 1;
                          foreach ($data as $dt) {
                ?>
                  <tr>
                    <td style="text-align: center;"><?php echo $no++; ?></td>
                    <td><?php echo $dt['no_permohonan']; ?></td>
                    <td><a href="<?php echo base_url('Ptmada/detail_perusahaan/' . $dt['kd_perusahaan']) ?>"><?php echo $dt['nama_perusahaan']; ?></a></td>
                    <td><?php echo $dt['nama_pekerjaan']; ?></td>
                    <td><?php echo "Rp. " . number_format($dt['nilai_proyek'], 2, ',', '.'); ?></td>
                    <td>
                        <!-- Tombol Cetak -->
                        <a href="<?php echo site_url('Ptmada/cetak_permohonan/' . $dt['id_permohonan']); ?>" target="_blank">
                          <button class="btn btn-info btn-sm btn-block" data-toggle="tooltip" data-placement="auto" title="Cetak Data : <?php echo $dt['no_permohonan'] ?>">
                            <i class="fa fa-print"></i>
                          </button>
                        </a>
                        <!-- Tombol Detail -->
                        <a href="<?php echo site_url('Ptmada/detail_permohonan/' . $dt['id_permohonan']); ?>">
                          <button class="btn btn-secondary btn-sm btn-block" data-toggle="tooltip" data-placement="auto" title="Lihat Detail Data : <?php echo $dt['no_permohonan'] ?>">
                            <i class="fa fa-info-circle"></i>
                          </button>
                        </a>
                        <!-- Tombol Edit -->
                        <a href="<?php echo site_url('Ptmada/edit_permohonan/' . $dt['id_permohonan']); ?>">
                          <button class="btn btn-success btn-sm btn-block" data-toggle="tooltip" data-placement="auto" title="Edit Data : <?php echo $dt['no_permohonan'] ?>">
                            <i class="fa fa-edit"></i>
                          </button>
                        </a>
                        <!-- Tombol Delete -->
                        <a href="<?php echo site_url('Ptmada/hapus_permohonan/' . $dt['id_permohonan']); ?>" onclick="return confirm('Apa Anda Yakin Akan Menghapus Data <?php echo $dt['no_permohonan'] ?>?')">
                          <button class="btn btn-danger btn-sm btn-block" data-toggle="tooltip" data-placement="auto" title="Hapus Data : <?php echo $dt['no_permohonan'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        </a>
                    </td>
                  </tr>
                <?php
                                                                                                              }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th style="text-align: center;">No</th>
                  <th style="text-align: center;">Nomor Permohonan</th>
                  <th style="text-align: center;">Nama Perusahaan</th>
                  <th style="text-align: center;">Nama Pekerjaan</th>
                  <th style="text-align: center;">Nilai Proyek</th>
                  <th style="text-align: center;">Aksi</th>
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