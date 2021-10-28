<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Perusahaan
      <small>Rekanan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Ptmada/') ?>"><i class="fa fa-dashboard"></i> PT Mada</a></li>
      <li class="active">Data Perusahaan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <a href="<?php echo base_url('Ptmada/tambah_perusahaan') ?>"><button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="auto" title="Tambah Data Perusahaan"><i class="fa fa-plus-square"> </i> Tambah</button></a>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example4" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="text-align: center;">No</th>
                  <th style="text-align: center;">Nama Perusahaan</th>
                  <th style="text-align: center;">Nama Pimpinan</th>
                  <th style="text-align: center;">Alamat</th>
                  <th style="text-align: center;">View</th>
                  <th style="text-align: center;">Edit</th>
                  <th style="text-align: center;">Hapus</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($data as $dt) {
                ?>
                  <tr>
                    <td style="text-align: center;"><?php echo $no++; ?></td>
                    <td><?php echo $dt['nama_perusahaan']; ?></td>
                    <td><?php echo $dt['nama_direktur']; ?></td>
                    <td><?php echo $dt['alamat']; ?></td>
                    <td style="text-align: center;">
                      <!-- Tombol Lihat -->
                      <a href="<?php echo base_url('Ptmada/detail_perusahaan/' . $dt['kd_perusahaan']) ?>">
                          <button class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat Data : <?php echo $dt['nama_perusahaan'] ?>">
                            <i class="fa fa-eye"></i>
                          </button>
                        </a>
                    </td>
                    <td style="text-align: center;">
                      <!-- Tombol Edit -->
                        <a href="<?php echo site_url('Ptmada/edit_perusahaan/' . $dt['kd_perusahaan']); ?>">
                          <button class="btn btn-success btn-sm " data-toggle="tooltip" data-placement="auto" title="Edit Data Perusahaan : <?php echo $dt['nama_perusahaan'] ?>">
                            <i class="fa fa-edit"></i>
                          </button>
                        </a>
                    </td>
                    <td style="text-align: center;">
                        <!-- Tombol Delete -->
                        <a href="<?php echo site_url('Ptmada/hapus_perusahaan/' . $dt['kd_perusahaan']); ?>" onclick="return confirm('Apa Anda Yakin Akan Menghapus Data <?php echo $dt['nama_perusahaan'] ?>?')">
                          <button class="btn btn-danger btn-sm " data-toggle="tooltip" data-placement="auto" title="Hapus Data Perusahaan : <?php echo $dt['nama_perusahaan'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        </a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
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