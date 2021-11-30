<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan Pendapatan Perusahaan
            <!-- <small>Rekanan</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('Finansial/') ?>"><i class="fa fa-dashboard"></i> Finansial</a></li>
            <li class="active">Laporan Pendapatan Perusahaan</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Laporan Pendapatan Perusahaan</h3><br>
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
                                        <form id="form-filter" class="form-horizontal" method="POST" action="<?php echo base_url('Finansial/master_cetak2') ?>">
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
                                                <label class="col-sm-6    control-label">Jumlah Pengeluaran</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="pemasukan" id="pemasukan" class="form-control" readonly value="<?php echo "Rp." . number_format($pengeluaran, 0, ',', '.'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-6    control-label">Jumlah Profit</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="pemasukan" id="pemasukan" class="form-control" readonly value="<?php echo "Rp." . number_format($profit, 0, ',', '.'); ?>">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->
</div>