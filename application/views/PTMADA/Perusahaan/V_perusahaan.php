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
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="text-align: center;">No</th>
                  <th style="text-align: center;">Nama Perusahaan</th>
                  <th style="text-align: center;">Nama Pimpinan</th>
                  <th style="text-align: center;">Alamat</th>
                  <th style="text-align: center; width: 80px;">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($data as $dt) {
                ?>
                  <tr>
                    <td style="text-align: center;"><?php echo $no++; ?></td>
                    <td>
                      <?php echo $dt['nama_perusahaan']; ?>
                    </td>
                    <td><?php echo $dt['nama_direktur']; ?></td>
                    <td><?php echo $dt['alamat']; ?></td>

                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-info">Aksi</button>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu" style="left: -45px;">
                          <li>
                            <a href="<?php echo base_url('Ptmada/detail_perusahaan/' . $dt['kd_perusahaan']) ?>">
                              <button class="btn btn-sm btn-success btn-block">Detail</button>
                            </a>
                          </li>

                          <li>
                            <a class="dropdown-item" href="<?php echo site_url('Ptmada/edit_perusahaan/' . $dt['kd_perusahaan']); ?>">
                            <button class="btn btn-sm btn-primary btn-block">Ubah</button>
                          </a>
                          
                          </li>
                          <li>
                            <a class="dropdown-item" onclick="return confirm('Hapus Data?')" href="<?php echo site_url('Ptmada/hapus_perusahaan/' . $dt['kd_perusahaan']); ?>">
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