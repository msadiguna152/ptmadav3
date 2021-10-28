<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Instansi
      <!-- <small>Rekanan</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Ptmada/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Data Instansi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <a href="<?php echo base_url('Ptmada/tambah_instansi') ?>"><button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="auto" title="Tambah Data Instansi"><i class="fa fa-plus-square"> </i> Tambah</button></a>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="text-align: center;">ID</th>
                  <th style="text-align: center;">Nama Instansi</th>                  
                  <th style="text-align: center;">Pemilik Proyek</th>
                  <th style="text-align: center;">Alamat Instansi</th>
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
                    <td><?php echo $dt['instansi']; ?></td>
                    <td><?php echo $dt['pemilik_proyek']; ?></td>
                    <td><?php echo $dt['alamat_instansi']; ?></td>
                    <td>
                        <!-- Tombol Lihat Detail -->
                        <a href="<?php echo site_url('Ptmada/lihat_detail_instansi/' . $dt['id_instansi']); ?>">
                          <button class="btn btn-light btn-sm btn-block" data-toggle="tooltip" data-placement="auto" title="Lihat Detail Data Instansi : <?php echo $dt['instansi'] ?>">
                            <i class="fa fa-info-circle"></i>
                          </button>
                        </a>
                        <!-- Tombol Edit -->
                        <a href="<?php echo site_url('Ptmada/edit_instansi/' . $dt['id_instansi']); ?>">
                          <button class="btn btn-success btn-sm btn-block" data-toggle="tooltip" data-placement="auto" title="Edit Data Instansi : <?php echo $dt['instansi'] ?>">
                            <i class="fa fa-edit"></i>
                          </button>
                        </a>
                        <!-- Tombol Delete -->
                        <a href="<?php echo site_url('Ptmada/hapus_instansi/' . $dt['id_instansi']); ?>" onclick="return confirm('Apa Anda Yakin Akan Menghapus Data <?php echo $dt['instansi'] ?>?')">
                          <button class="btn btn-danger btn-sm btn-block" data-toggle="tooltip" data-placement="auto" title="Hapus Data Instansi : <?php echo $dt['instansi'] ?>">
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