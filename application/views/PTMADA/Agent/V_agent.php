<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Agents
      <small>Rekanan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Ptmada/') ?>"><i class="fa fa-dashboard"></i> PT Mada</a></li>
      <li class="active">Data Agents</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-footer">
            <a href="<?php echo base_url('Ptmada/tambah_agent') ?>">
              <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="auto" title="Tambah Data"><i class="fa fa-plus-square"> </i> Tambah 
              </button>
            </a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="text-align: center;">No</th>
                  <th style="text-align: center;">Induk</th>
                  <th style="text-align: center;">Nama Agent</th>
                  <th style="text-align: center;">Alamat</th>
                  <th style="text-align: center;">E-mail</th>
                  <th style="text-align: center;">No telp</th>
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
                    <td><?php echo $dt['induk']; ?></td>
                    <td><a href="<?php echo site_url('Ptmada/lihat_detail_agent/' . $dt['kd_agent']); ?>"><?php echo $dt['nama_agent']; ?></a></td>
                    <td><?php echo $dt['alamat']; ?></td>
                    <td><?php echo $dt['email']; ?></td>
                    <td><?php echo $dt['no_telp']; ?></td>
                    <!-- <td><?php echo $dt['instansi']; ?></td> -->
                    <td style="text-align: center;">
                      <!-- Tombol Edit -->
                        <a href="<?php echo site_url('Ptmada/edit_agent/' . $dt['kd_agent']); ?>">
                          <button class="btn btn-success btn-sm btn-block" data-toggle="tooltip" data-placement="auto" title="Edit Data : <?php echo $dt['nama_agent'] ?>">
                            <i class="fa fa-edit"></i>
                          </button>
                        </a>
                        <!-- Tombol Delete -->
                        <a href="<?php echo site_url('Ptmada/hapus_agent/' . $dt['kd_agent']); ?>" onclick="return confirm('Apa Anda Yakin Akan Menghapus Data <?php echo $dt['nama_agent'] ?>?')">
                          <button class="btn btn-danger btn-sm btn-block" data-toggle="tooltip" data-placement="auto" title="Hapus Data : <?php echo $dt['nama_agent'] ?>">
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
                  <th>No</th>
                  <th>Induk</th>
                  <th>Nama Agent</th>
                  <th>Alamat</th>
                  <th>E-mail</th>
                  <th>No telp</th>
                  <!-- <th>Instansi</th> -->
                  <th>Aksi</th>
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