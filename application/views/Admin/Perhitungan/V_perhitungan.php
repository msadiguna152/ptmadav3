<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Perhitungan  Tarif
            <!-- <small>Rekanan</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Data Perhitungan  Tarif</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Perhitungan Tarif</h3><br>
                    </div>
                    <div class="box-footer">

                        <!--  <a href="<?php echo base_url('Admin/cetak_permohonan') ?>"><button type="button" class="btn btn-info" title="Tambah Data Perhitungan"><i class="fa fa-plus-square"></i> Cetak</button></a> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Jaminan</th>
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
                                        <td><?php echo $dt['jenis_jaminan']; ?></td>
                                        <td>
                                            <center>
                                                <a href="<?php echo site_url('Admin/edit_perhitungan/' . $dt['kd_jenis']); ?>" title="Detail"><i class="fa fa-edit"></i></a>
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
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body
          </div>
          <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->
</div>