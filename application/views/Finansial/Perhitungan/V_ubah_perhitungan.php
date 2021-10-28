<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Perhitungan Tarif
            <!-- <small>Rekanan</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('Finansial/') ?>"><i class="fa fa-dashboard"></i> Finansial</a></li>
            <li class="active">Data Perhitungan Tarif <?php echo $perhit['jenis_jaminan']; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Perhitungan Tarif <?php echo $perhit['jenis_jaminan']; ?></h3><br>
                    </div>
                    <div class="box-footer">

                        <!--  <a href="<?php echo base_url('Finansial/cetak_permohonan') ?>"><button type="button" class="btn btn-info" title="Tambah Data Perhitungan"><i class="fa fa-plus-square"></i> Cetak</button></a> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="POST" action="<?php echo base_url('Finansial/proses_edit_perhitungan/' . $perhit['kd_jenis']) ?>" enctype="multipart/form-data">
                            <table class="table table-striped">
                                <tr>
                                    <th>Biaya Administrasi</th>
                                    <input type="hidden" name="kd_jenis" class="form-control" value="<?php echo $perhit['kd_jenis']; ?>" autocomplete="off">
                                    <td><input type="text" name="biaya_admin" class="form-control" value="<?php echo $perhit['biaya_admin']; ?>" autocomplete="off"></td>
                                    <th>Tarif Minimal</th>
                                    <td><input type="text" name="trf_min" class="form-control" value="<?php echo $perhit['trf_min']; ?>" autocomplete="off"></td>
                                    <td><input type="text" name="trf_min2" class="form-control" value="<?php echo $perhit['trf_min2']; ?>" autocomplete="off"></td>
                                </tr>
                                <tr>
                                    <th>Biaya Materai</th>
                                    <td><input type="text" name="biaya_materai" class="form-control" value="<?php echo $perhit['biaya_materai']; ?>" autocomplete="off"></td>
                                    <th>Tarif Agen</th>
                                    <td><input type="text" name="trf_agent" class="form-control" value="<?php echo $perhit['trf_agent']; ?>" autocomplete="off"></td>
                                    <td><input type="text" name="trf_agent2" class="form-control" value="<?php echo $perhit['trf_agent2']; ?>" autocomplete="off"></td>
                                </tr>
                                <tr>
                                    <th>Biaya Materai Agent</th>
                                    <td><input type="text" name="biaya_materai_agent" class="form-control" value="<?php echo $perhit['biaya_materai_agent']; ?>" autocomplete="off"></td>
                                    <th>Tarif Jamkrida</th>
                                    <td><input type="text" name="trf_jamkrida" class="form-control" value="<?php echo $perhit['trf_jamkrida']; ?>" autocomplete="off"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Tarif Minimal Bank</th>
                                    <td><input type="text" name="trf_min_bank" class="form-control" value="<?php echo $perhit['trf_min_bank']; ?>" autocomplete="off"></td>
                                    <th>Tarif 13 Bulan / Lebih</th>
                                    <td><input type="text" name="trf_13" class="form-control" value="<?php echo $perhit['trf_13']; ?>" autocomplete="off"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Tarif &lt;6 / Maks 6 Bulan</th>
                                    <td><input type="text" name="trf_maxbulan" class="form-control" value="<?php echo $perhit['trf_maxbulan']; ?>" autocomplete="off"></td>
                                    <th>Tarif 19 Bulan / Lebih</th>
                                    <td><input type="text" name="trf_19" class="form-control" value="<?php echo $perhit['trf_19']; ?>" autocomplete="off"></td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <td>Tarif 6 Bulan / Lebih</td>
                                    <td><input type="text" name="trf_enambulan" class="form-control" value="<?php echo $perhit['trf_enambulan']; ?>" autocomplete="off"></td>
                                    <td></td>
                                    <td></td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td> <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Submit</button><a href="<?php echo base_url('Finansial/lihat_perhitungan/') ?>"><button type="button" class="btn btn-danger">Cancel</button></a></td>
                                    <td> </td>
                                </tr>
                            </table>
                        </form>
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