<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Agents
      <small>Rekanan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> PT Mada</a></li>
      <li class="active">Data Agents</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Agents</h3><br>
          </div>
          <div class="box-footer">
            <a href="<?php echo base_url('Admin/tambah_agent') ?>"><button type="button" class="btn btn-info" title="Tambah Data Pejabat"><i class="fa fa-plus-square"></i> Tambah Agent</button></a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
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
              </thead>
              <tbody>
                <?php
                      $no = 1;
                      foreach ($data as $dt) {
                ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $dt['induk']; ?></td>
                    <td><a href="<?php echo site_url('Admin/lihat_detail_agent/' . $dt['kd_agent']); ?>"><?php echo $dt['nama_agent']; ?></a></td>
                    <td><?php echo $dt['alamat']; ?></td>
                    <td><?php echo $dt['email']; ?></td>
                    <td><?php echo $dt['no_telp']; ?></td>
                    <!-- <td><?php echo $dt['instansi']; ?></td> -->
                    <td>
                      <center>
                        <a href="<?php echo site_url('Admin/edit_agent/' . $dt['kd_agent']); ?>" title="Edit"><i class="fa fa-edit"></i></a>
                        |
                        <a href="<?php echo site_url('Admin/hapus_agent/' . $dt['kd_agent']); ?>" onclick="return konformasi()" title="Delete"><i class="fa fa-trash"></i></a>
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