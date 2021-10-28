<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ubah Data Tarif
      <!-- <small>Rekanan</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
      <li class="active">Ubah Data Tarif</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Ubah Data Tarif</h3><br>
          </div>
          <div class="box-footer">

            <!--  <a href="<?php echo base_url('Admin/cetak_permohonan') ?>"><button type="button" class="btn btn-info" title="Tambah Data Permohonan"><i class="fa fa-plus-square"></i> Cetak</button></a> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div>
              <form method="POST" action="<?php echo base_url('Admin/proses_edit_tarif/' . $id_tarif) ?>" enctype="multipart/form-data">
                <table class="table table-striped">
                  <tr>
                    <th>No Permohonan</th>
                    <th>Nama Perusahaan</th>
                    <th>Nama Pejabat</th>
                    <th>Nama Pekerjaan</th>
                  </tr>
                  <?php
                  foreach ($data as $dt) {
                  ?>
                    <tr>
                      <td><?php echo $dt->no_permohonan; ?></td>
                      <td><?php echo $dt->nama_perusahaan; ?></td>
                      <td><?php echo $dt->nama_pejabat; ?></td>
                      <td><?php echo $dt->nama_pekerjaan; ?></td>
                    </tr>
                  <?php } ?>
                  <?php
                  //data permohonan
                  foreach ($data as $dt) {
                    $id_permohonan = $dt->id_permohonan;
                    $nilai_proyek = $dt->nilai_proyek;
                    $persen = $dt->persen;
                    $nilai_jaminan = $dt->nilai_jaminan;
                    $dari_tgl = $dt->dari_tgl;
                    $sampai_tgl = $dt->sampai_tgl;
                    $jangka_waktu = $dt->jangka_waktu;
                    $kd_jp = $dt->jenis;
                  }

                  // if ($jangka_waktu > 365) {
                  //   $numBulan = 13;
                  // } else {
                  //   $numBulan = $jangka_waktu / 30;
                  //   if ($numBulan > 12) {
                  //     $numBulan = 12;
                  //   }
                  // }

                  if ($jangka_waktu <= 360) {
                    $numBulan = $jangka_waktu / 30;
                  } else if ($jangka_waktu > 360 && $jangka_waktu <= 365) {
                    $numBulan = 12;
                  } else if ($jangka_waktu > 365 && $jangka_waktu <= 720) {
                    $numBulan = $jangka_waktu / 30;
                  } else if ($jangka_waktu > 720 && $jangka_waktu <= 730) {
                    $numBulan = 24;
                  } else if ($jangka_waktu > 730) {
                    $numBulan = $jangka_waktu / 30;
                  }

                  // $timeStart = strtotime($dari_tgl);
                  // $timeEnd = strtotime($sampai_tgl);
                  // $numBulan = 1 + (date("Y", $timeEnd) - date("Y", $timeStart)) * 12;
                  // $numBulan += date("m", $timeEnd) - date("m", $timeStart);

                  //data tarif
                  foreach ($tarif as $hit) {
                    $biaya_admin = $hit->biaya_admin;
                    $biaya_materai = $hit->biaya_materai;
                    $biaya_materai_agent = $hit->biaya_materai_agent;
                    $trf_min_bank = $hit->trf_min_bank;
                    $trf_maxbulan = $hit->trf_maxbulan;
                    $trf_enambulan = $hit->trf_enambulan;
                    $trf_min = $hit->trf_min;
                    $trf_agent = $hit->trf_agent;
                    $trf_jamkrida = $hit->trf_jamkrida;
                    $trf_min2 = $hit->trf_min2;
                    $trf_agent2 = $hit->trf_agent2;
                    $jatuh_tempo = $hit->jatuh_tempo;
                    $jangka_waktu = $hit->jangka_waktu;
                    $service_agent = $hit->service_agent;
                    $service_jamkrida = $hit->service_jamkrida;
                    $service_agent2 = $hit->service_agent2;
                    $ijpagent = $hit->ijpagent;
                    $ijpjamkrida = $hit->ijpjamkrida;
                    $garansi_bank = $hit->garansi_bank;
                    $total_biaya2 = $hit->total_biaya2;
                    $total_biaya = $hit->total_biaya;
                    $service_jamkrida2 = $hit->service_jamkrida2;
                    $diskon = $hit->diskon;
                    $nilaidiskon = $hit->nilaidiskon;
                    $saldo = $hit->saldo;
                    $trf_13 = $hit->trf_13;
                    $trf_19 = $hit->trf_19;
                    // $totalnilaidiskon = $hit->totalnilaidiskon;
                  }
                  ?>
                  <tr>
                    <th>Jenis Jaminan</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                  <tr>
                    <td>
                      <?php echo $dt->jenis_jaminan; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </table>
            </div>
            <hr>
            <div>

              <table class="table table-striped" onload="sum();">
                <tr>
                  <th>Uraian</th>
                  <th>Nilai</th>
                  <th>Satuan</th>
                  <td>Tarif Minimal Bank</td>
                  <input type="hidden" name="id_permohonan" class="form-control" value="<?php echo $id_permohonan; ?>">
                  <input type="hidden" name="kd_jp" id="kd_jp" class="form-control" value="<?php echo $kd_jp; ?>">
                  <td><input type="text" name="trf_min_bank" id="trf_min_bank" class="form-control" value="<?php echo $trf_min_bank; ?>" autocomplete="off" onkeyup="sum();"></td>
                  <th></th>
                </tr>
                <tr>
                  <td>Nilai Proyek</td>
                  <td><input type="text" class="form-control" value="<?php echo "Rp. " . number_format($nilai_proyek, 2, ',', '.'); ?>" readonly></td>
                  <td>Rupiah</td>
                  <td>Tarif&lt;6 / Maks 6 Bulan</td>
                  <td><input type="text" name="trf_maxbulan" id="trf_maxbulan" class="form-control" value="<?php echo $trf_maxbulan; ?>" autocomplete="off" onkeyup="sum();"></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Persentase Jaminan</td>
                  <td><input type="text" class="form-control" id="persen" value="<?php echo $persen; ?>" readonly></td>
                  <td>%</td>
                  <td>Tarif 6 Bulan / Lebih<br></td>
                  <td><input type="text" name="trf_enambulan" id="trf_enambulan" class="form-control" value="<?php echo $trf_enambulan; ?>" autocomplete="off" onkeyup="sum();"></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Jangka Waktu<br></td>
                  <td><input type="text" class="form-control" name="jangka_waktu" id="jangka_waktu" value="<?php echo ceil($numBulan) ?>" readonly></td>
                  <td>Bulan</td>
                  <td>Tarif 13 Bulan / Lebih</td>
                  <td><input type="text" name="trf_13" id="trf_13" class="form-control" value="<?php echo $trf_13; ?>" autocomplete="off" onkeyup="sum();"></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Nilai Jaminan</td>
                  <input type="hidden" class="form-control" id="nilai_jaminan" value="<?php echo $nilai_jaminan; ?>" readonly>
                  <td><input type="text" class="form-control" value="<?php echo "Rp. " . number_format($nilai_jaminan, 2, ',', '.'); ?>" readonly></td>
                  <td>Rupiah</td>
                  <td>Tarif 19 Bulan / Lebih</td>
                  <td><input type="text" name="trf_19" id="trf_19" class="form-control" value="<?php echo $trf_19; ?>" autocomplete="off" onkeyup="sum();"></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Biaya Administrasi</td>
                  <td><input type="text" name="biaya_admin" id="biaya_admin" class="form-control" value="<?php echo $biaya_admin; ?>" autocomplete="off" onkeyup="sum();"></td>
                  <td>Rupiah</td>
                  <td>Tarif Minimal</td>
                  <td><input type="text" name="trf_min" id="trf_min" class="form-control" value="<?php echo $trf_min; ?>" autocomplete="off" onkeyup="sum();"></td>
                  <td><input type="text" name="trf_min2" id="trf_min2" class="form-control" value="<?php echo $trf_min2; ?>" autocomplete="off" onkeyup="sum();"></td>
                </tr>
                <tr>
                  <td>Biaya Materai</td>
                  <td><input type="text" name="biaya_materai" id="biaya_materai" class="form-control" value="<?php echo $biaya_materai; ?>" autocomplete="off" onkeyup="sum();"></td>
                  <td>Rupiah</td>
                  <td>Tarif Agen</td>
                  <td><input type="text" name="trf_agent" id="trf_agent" class="form-control" value="<?php echo $trf_agent; ?>" autocomplete="off" onkeyup="sum();"></td>
                  <td><input type="text" name="trf_agent2" id="trf_agent2" class="form-control" value="<?php echo $trf_agent2; ?>" autocomplete="off" onkeyup="sum();"></td>
                </tr>
                <tr>
                  <td>Biaya Materai Agent</td>
                  <td>
                  <input type="text" name="biaya_materai_agent" id="biaya_materai_agent" class="form-control" value="<?php echo $biaya_materai_agent; ?>" autocomplete="off" onkeyup="sum();">
                  </td>
                  <td></td>
                  <td>Tarif Jamkrida</td>
                  <td><input type="text" name="trf_jamkrida" id="trf_jamkrida" class="form-control" value="<?php echo $trf_jamkrida; ?>" autocomplete="off" onkeyup="sum();"></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Service Charge Agen</td>
                  <td>
                  <input type="text" class="form-control" id="service_agent" value="<?php echo number_format($service_agent, 0, ',', '.'); ?>" readonly>
                    <input type="hidden" class="form-control" name="service_agent" id="service_agent_post" value="" readonly>
                  </td>
                  <td></td>
                  <td>Diskon</td>
                  <td><input type="text" name="diskon" id="diskon" class="form-control" autocomplete="off" value="<?php echo $diskon; ?>" onkeyup="sum();"></td>
                  <td>Persen</td>
                </tr>
                <tr>
                  <td>Service Charge Jamkrida</td>
                  <td>
                  <input type="text" class="form-control" id="service_jamkrida" value="<?php echo number_format($ijpjamkrida, 0, ',', '.'); ?>" readonly>
                    <input type="hidden" class="form-control" name="service_jamkrida" id="service_jamkrida_post" readonly>
                  </td>
                  <td></td>
                  <td>Jatuh Tempo</td>
                  <td>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" name="jatuh_tempo" class="form-control" required value="<?php echo $jatuh_tempo; ?>">
                    </div>
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td>(Service Charge Agen)</td>
                  <td>
                  <input type="text" class="form-control" id="service_agent2" value="<?php echo number_format($service_agent2, 0, ',', '.'); ?>" readonly>
                    <input type="hidden" class="form-control" name="service_agent2" id="service_agent2_post" readonly>
                  </td>
                  <td>Rupiah</td>
                  <td></td>
                  <td><button type="button" class="btn btn-primary" onclick="sum()">Hitung</button></td>
                  <td></td>
                </tr>
                <tr>
                  <td>(Service Charge Jamkrida)</td>
                  <td>
                    <input type="text" class="form-control" id="service_jamkrida2" value="<?php echo number_format($service_jamkrida2, 0, ',', '.'); ?>" readonly>
                    <input type="hidden" class="form-control" name="service_jamkrida2" id="service_jamkrida2_post" readonly>
                  </td>
                  <td>Rupiah</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
              <hr>
              <table class="table table-striped">
                <tr>
                  <th>IJP AGENT </th>
                  <td>
                    <input type="text" class="form-control" id="ijpagent" value="<?php echo number_format($ijpagent, 0, ',', '.'); ?>" readonly>
                    <input type="hidden" class="form-control" name="ijpagent" id="ijpagent_post" readonly>
                  </td>
                  <td></td>
                  <th>IJP JAMKRIDA</th>
                  <td>
                    <input type="text" class="form-control" id="ijpjamkrida" value="<?php echo number_format($ijpjamkrida, 0, ',', '.'); ?>" readonly>
                    <input type="hidden" class="form-control" name="ijpjamkrida" id="ijpjamkrida_post" readonly>
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <th>KONTRA GARANSI BANK</th>
                  <td>
                    <input type="text" class="form-control" id="garansi_bank" value="<?php echo number_format($garansi_bank, 0, ',', '.'); ?>" readonly>
                    <input type="hidden" class="form-control" name="garansi_bank" id="garansi_bank_post" readonly>
                  </td>
                  <td></td>
                  <th>KONTRA GARANSI BANK</th>
                  <td>
                    <input type="text" class="form-control" id="garansi_bankcpy" value="<?php echo number_format($garansi_bank, 0, ',', '.'); ?>" readonly>
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <!-- <th>IJP AGENT SETELAH DISKON</th>
                  <td>
                    <input type="text" class="form-control" id="totalnilaidiskon" readonly>
                    <input type="hidden" class="form-control" name="totalnilaidiskon" id="totalnilaidiskon_post" readonly>
                  </td> -->

                  <th>NILAI DISKON</th>
                  <td>
                    <input type="text" class="form-control" id="nilaidiskon" readonly value="<?php echo number_format($nilaidiskon, 0, ',', '.'); ?>">
                    <input type="hidden" class="form-control" name="nilaidiskon" id="nilaidiskon_post" readonly>
                  </td>
                  <td></td>
                  <th>TOTAL PENGELUARAN</th>
                  <td>
                    <input type="text" class="form-control" id="total_biaya2" readonly value="<?php echo number_format($total_biaya2, 0, ',', '.'); ?>">
                    <input type="hidden" class="form-control" name="total_biaya2" id="total_biaya2_post" readonly>
                  </td>

                  <td></td>
                </tr>
                <tr>
                  <th>TOTAL PEMASUKAN</th>
                  <td>
                    <input type="text" class="form-control" id="total_biaya" readonly value="<?php echo number_format($total_biaya, 0, ',', '.'); ?>">
                    <input type="hidden" class="form-control" name="total_biaya" id="total_biaya_post" readonly>
                  </td>
                  <td><input type="hidden" class="form-control" name="garansi_bank2" id="garansi_bank2" readonly></td>

                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
              <hr>
              <table class="table table-striped">
                <tr>
                  <th>PROFIT</th>
                  <td class="col-md-3">
                    <input type="text" class="form-control" id="saldo" readonly value="<?php echo number_format($saldo, 0, ',', '.'); ?>" style="margin-left: -175px;">
                    <input type="hidden" class="form-control" name="saldo" id="saldo_post" readonly>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Submit</button>
                <a href="<?php echo base_url('Admin/lihat_tarif') ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
              </div>
              </form>
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