<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Jenis Permohonan
      <!-- <small>Rekanan</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Ptmada/') ?>"><i class="fa fa-dashboard"></i> PT Mada</a></li>
      <li class="active">Data Jenis Permohonan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-footer">
            <a href="<?php echo base_url('Ptmada/tambah_jenis_permohonan') ?>">
              <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="auto" title="Tambah Data Jenis Permohonan"><i class="fa fa-plus-square"> </i> Tambah 
              </button>
            </a>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="text-align: center;width: 10px;">No</th>
                  <th style="text-align: center;">Jenis Permohonan</th>
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
                    <td><?php echo $dt['jenis_permohonan']; ?></td>
                    <td>
                      <!-- Tombol Edit -->
                        <a href="<?php echo site_url('Ptmada/edit_jenis_permohonan/' . $dt['kd_jp']); ?>">
                          <button class="btn btn-success btn-sm btn-block" data-toggle="tooltip" data-placement="auto" title="Edit Data : <?php echo $dt['jenis_permohonan'] ?>">
                            <i class="fa fa-edit"></i>
                          </button>
                        </a>
                        <!-- Tombol Delete -->
                        <a href="<?php echo site_url('Ptmada/hapus_jenis_permohonan/' . $dt['kd_jp']); ?>" onclick="return confirm('Apa Anda Yakin Akan Menghapus Data <?php echo $dt['jenis_permohonan'] ?>?')">
                          <button class="btn btn-danger btn-sm btn-block" data-toggle="tooltip" data-placement="auto" title="Hapus Data : <?php echo $dt['jenis_permohonan'] ?>">
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
                  <th style="text-align: center;">Jenis Jaminan</th>
                  <th style="text-align: center;">Aksi</th>
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