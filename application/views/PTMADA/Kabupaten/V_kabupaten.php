<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Lokasi Proyek
      <!-- <small>Rekanan</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Ptmada/') ?>"><i class="fa fa-dashboard"></i> PT Mada</a></li>
      <li class="active">Data Lokasi Proyek</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-footer">
            <a href="<?php echo base_url('Ptmada/tambah_kabupaten') ?>">
              <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="auto" title="Tambah Data Lokasi Proyek"><i class="fa fa-plus-square"> </i> Tambah 
              </button>
            </a>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="text-align: center; width: 10px;">ID</th>
                  <th style="text-align: center;">Lokasi Proyek</th>
                  <th style="text-align: center; width: 80px;">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($data as $dt) {
                ?>
                  <tr>
                    <td style="text-align: center;"><?php echo $dt['kd_kabupaten']; ?></td>
                    <td><?php echo $dt['kabupaten']; ?></td>

                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-info">Aksi</button>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu" style="left: -45px;">
                          <li>
                            <a class="dropdown-item" href="<?php echo site_url('Ptmada/edit_kabupaten/' . $dt['kd_kabupaten']); ?>">
                              <button class="btn btn-sm btn-primary btn-block">Ubah</button>
                            </a>

                          </li>
                          <li>
                            <a class="dropdown-item" onclick="return confirm('Hapus Data?')" href="<?php echo site_url('Ptmada/hapus_kabupaten/' . $dt['kd_kabupaten']); ?>">
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
                  <th style="text-align: center;">Lokasi Proyek</th>
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