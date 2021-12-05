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
                    <td><?php echo $dt['jenis_permohonan']; ?></td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-info">Aksi</button>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu" style="left: -45px;">
                          <li>
                            <a class="dropdown-item" href="<?php echo site_url('Ptmada/edit_jenis_permohonan/' . $dt['kd_jp']); ?>">
                              <button class="btn btn-sm btn-primary btn-block">Ubah</button>
                            </a>

                          </li>
                          <li>
                            <a class="dropdown-item" onclick="return confirm('Hapus Data?')" href="<?php echo site_url('Ptmada/hapus_jenis_permohonan/' . $dt['kd_jp']); ?>">
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