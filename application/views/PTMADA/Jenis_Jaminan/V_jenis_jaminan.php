<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Jenis Jaminan
      <small>Rekanan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Ptmada/') ?>"><i class="fa fa-dashboard"></i> PT Mada</a></li>
      <li class="active">Data Jenis Jaminan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-footer">
            <!-- <a href="<?php echo base_url('Ptmada/tambah_dokumen') ?>"><button type="button" class="btn btn-info" title="Tambah Data Dokumen"><i class="fa fa-plus-square"></i> Tambah</button></a> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="text-align: center;width: 10px;">No</th>
                  <th style="text-align: center">Jenis Jaminan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($data as $dt) {
                  ?>
                  <tr>
                    <td style="text-align: center;width: 10px;"><?php echo $no++; ?></td>
                    <td><?php echo $dt['jenis_jaminan']; ?></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th style="text-align: center;width: 10px;">No</th>
                  <th style="text-align: center">Jenis Jaminan</th>
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