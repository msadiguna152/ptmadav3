<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan Pemasukan Permohonan
            <!-- <small>Rekanan</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Laporan Pemasukan Permohonan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Laporan Pemasukan Permohonan</h3><br>
                    </div>
                    <div class="box-footer">

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Custom Filter : </h3>
                                    </div>
                                    <div class="panel-body">
                                        <form id="form-filter" class="form-horizontal" method="POST" action="<?php echo base_url('Admin/master_pemasukan') ?>">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Tanggal Awal</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="date" name="tgl_awal" id="tgl_awal" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Tanggal Akhir</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Pejabat Penghubung</label>
                                                <div class="col-sm-4">
                                                    <?php echo $form_pejabat; ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Status</label>
                                                <div class="col-sm-4">
                                                    <!-- <select class="form-control" name="status" id="status">
                                                        <option value="" selected="selected">Semua Status</option>
                                                        <option value="0">BELUM LUNAS</option>
                                                        <option value="1">LUNAS</option>
                                                    </select> -->
                                                    <?php echo $form_status; ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Perusahaan</label>
                                                <div class="col-sm-4">
                                                    <?php echo $form_perusahaan; ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-4 col-sm-10">
                                                    <button type="button" id="btn-filter" class="btn btn-info" title="filter"><i class="fa fa-search"></i> Filter</button>
                                                    <button type="button" id="btn-reset" class="btn btn-default" title="reset"><i class="fa fa-undo"></i> Reset</button>
                                                    <button type="submit" id="btn-print" class="btn btn-success" title="print"><i class="fa fa-print"></i> Cetak</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Total : </h3>
                                    </div>
                                    <div class="panel-body">
                                        <form id="form-filter" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-6    control-label">Jumlah Pemasukan</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="pemasukan" id="pemasukan" class="form-control" readonly value="<?php echo "Rp." . number_format($pemasukan, 0, ',', '.'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-6  control-label">Jumlah Pemb. Pemasukan</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="pemasukan" id="pemasukan" class="form-control" readonly value="<?php echo "Rp." . number_format($jml_byr, 0, ',', '.'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-6    control-label">Jumlah Sisa Pemb. Pemasukan</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="pemasukan" id="pemasukan" class="form-control" readonly value="<?php echo "Rp." . number_format($sisa_byr, 0, ',', '.'); ?>">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <!-- <th>No</th> -->
                                        <th>Tanggal Permohonan</th>
                                        <th>No Permohonan</th>
                                        <th>Jenis Jaminan</th>
                                        <th>Perusahaan</th>
                                        <th>Nama Proyek</th>
                                        <th>Pejabat Penghubung</th>
                                        <!-- <th>Agent</th> -->
                                        <th>Jumlah Pemasukan</th>
                                        <th>Jumlah Pemb. Pemasukan</th>
                                        <th>Sisa Pemb. Pemasukan</th>
                                        <th>Status Pembayaran</th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </thead>
                                <tfoot id="total">
                                    <tr>
                                        <!-- <th>No</th> -->
                                        <th>Tanggal Permohonan</th>
                                        <th>No Permohonan</th>
                                        <th>Jenis Jaminan</th>
                                        <th>Perusahaan</th>
                                        <th>Nama Proyek</th>
                                        <th>Pejabat Penghubung</th>
                                        <!-- <th>Agent</th> -->
                                        <th>Jumlah Pemasukan</th>
                                        <th>Jumlah Pemb. Pemasukan</th>
                                        <th>Sisa Pemb. Pemasukan</th>
                                        <th>Status Pembayaran</th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </tfoot>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
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