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
                  <th style="text-align: center;width: 80px;">Opsi</th>
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
                      <div class="btn-group">
                        <button type="button" class="btn btn-info">Aksi</button>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu" style="left: -45px;">
                          <li>
                            <a class="dropdown-item" href="<?php echo site_url('Ptmada/cetak_permohonan/' . $dt['id_permohonan']); ?>">
                              <button class="btn btn-sm btn-info btn-block">Cetak</button>
                            </a>
                          </li>

                          <li>
                            <a class="dropdown-item" href="<?php echo site_url('Ptmada/detail_permohonan/' . $dt['id_permohonan']); ?>">
                              <button class="btn btn-sm btn-success btn-block">Detail</button>
                            </a>
                          </li>

                          <li>
                            <a class="dropdown-item" href="<?php echo site_url('Ptmada/edit_permohonan/' . $dt['id_permohonan']); ?>">
                              <button class="btn btn-sm btn-primary btn-block">Ubah</button>
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item" onclick="return confirm('Hapus Data?')" href="<?php echo site_url('Ptmada/hapus_permohonan/' . $dt['id_permohonan']); ?>">
                              <button class="btn btn-sm btn-danger btn-block btn-block">Hapus</button>
                            </a>
                          </li>
                        </ul>
                      </div>
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