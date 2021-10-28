<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Instansi
      <!-- <small>Rekanan</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> PT Mada</a></li>
      <li class="active">Data Instansi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Instansi</h3><br>
          </div>
          <div class="box-footer">
            <a href="<?php echo base_url('Admin/tambah_instansi') ?>"><button type="button" class="btn btn-info" title="Tambah Data Instansi"><i class="fa fa-plus-square"></i> Tambah Instansi</button></a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped" width="100%">
              <thead>
                <tr>
                  <th width="5%">ID</th>
                  <th width="30%">Nama Instansi</th>                  
                  <th width="30%">Pemilik Proyek</th>
                  <th width="25%">Alamat Instansi</th>
                  <th width="10%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($data as $dt) {
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $dt['instansi']; ?></td>
                    <td><?php echo $dt['pemilik_proyek']; ?></td>
                    <td><?php echo $dt['alamat_instansi']; ?></td>
                    <td>
                      <center>
                        <a href="<?php echo site_url('Admin/lihat_detail_instansi/' . $dt['id_instansi']); ?>" title="Detail"><i class="fa fa-info-circle"></i></a>
                        |
                        <a href="<?php echo site_url('Admin/edit_instansi/' . $dt['id_instansi']); ?>" title="Edit"><i class="fa fa-edit"></i></a>
                        |
                        <a href="<?php echo site_url('Admin/hapus_instansi/' . $dt['id_instansi']); ?>" onclick="return konformasi()" title="Delete"><i class="fa fa-trash"></i></a>
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
                  <th>Jenis Jaminan</th>
                  <!-- <th>Aksi</th> -->
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