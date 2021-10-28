<?php


foreach ($detail_tarif as $det_tarif) {
  $status_pemasukan = $det_tarif['status_pemasukan'];
  $tagihan_pemasukan = $det_tarif['pemasukan'];

  $status_pengeluaran = $det_tarif['status_pengeluaran'];
  $tagihan_pengeluaran = $det_tarif['pengeluaran'];
}

foreach ($jumlah as $jm) {
  $jm_pemasukan = $jm['jumlah'];
}

foreach ($jumlah_pengeluaran as $jm2) {
  $jm_pengeluaran = $jm2['jumlah'];
}

foreach ($tarif as $trf) {
  $ijpjmk = $trf['ijpjamkrida'];
  $kontra = $trf['garansi_bank'];
}

//menghitung sisa
$sisa_pemasukan = $tagihan_pemasukan - $jm_pemasukan;

$sisa_pengeluaran = $tagihan_pengeluaran - $jm_pengeluaran;
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Transaksi Permohonan
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="#">Permohonan</a></li>
      <li class="active">Transaksi Permohonan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <!-- /.col -->
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="<?php echo ($this->uri->segment(4) == 'detail') ? 'active' : ''; ?>"><a href="#detailpermohonan" data-toggle="tab">Detail Permohonan</a></li>
            <li class="<?php echo ($this->uri->segment(4) == 'pemasukan') ? 'active' : ''; ?>"><a href="#pemasukan" data-toggle="tab">Pemasukan</a></li>
            <li class="<?php echo ($this->uri->segment(4) == 'pengeluaran') ? 'active' : ''; ?>"><a href="#pengeluaran" data-toggle="tab">Pengeluaran</a></li>
          </ul>
          <div class="tab-content">
            <div class="<?php echo ($this->uri->segment(4) == 'detail') ? 'active' : ''; ?> tab-pane" id="detailpermohonan">
              <!-- Post -->
              <div class="card-body">
                <div class="row invoice-info">
                  <div class="col-sm-6 invoice-col">

                    <address>
                      <strong><i class="fa fa-building margin-r-5"></i> Nama Perusahaan</strong>
                      <p>
                        <?php echo $dt['nama_perusahaan']; ?>
                      </p>
                      <strong><i class="fa fa-id-card margin-r-5"></i> Nama Pejabat</strong>
                      <p>
                        <?php echo $dt['nama_pejabat']; ?>
                      </p>
                      <strong><i class="fa fa-file margin-r-5"></i> Jenis Jaminan</strong>
                      <p>
                        <?php echo $dt['jenis_jaminan']; ?>
                      </p>
                      <strong><i class="fa fa-percent margin-r-5"></i> Presentase Jaminan</strong>
                      <p>
                        <?php echo $dt['persen']; ?> %
                      </p>
                      <strong><i class="fa fa-calendar margin-r-5"></i> Jumlah Hari</strong>
                      <p>
                        <?php echo $dt['jangka_waktu']; ?>
                      </p>
                      <strong><i class="fa fa-file margin-r-5"></i> Permohonan Penerbitan</strong>
                      <p>
                        <?php echo $dt['jenis_permohonan']; ?>
                      </p>
                      <strong><i class="fa fa-building margin-r-5"></i> Nama Instansi Pemilik Proyek</strong>
                      <p>
                        <?php echo $dt['pemilik_proyek']; ?>
                      </p>
                    </address>

                  </div>

                  <div class="col-sm-6 invoice-col">


                    <strong><i class="fa fa-pencil margin-r-5"></i> Nama Pekerjaan</strong>
                    <p>
                      <?php echo $dt['nama_pekerjaan']; ?>
                    </p>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat </strong>
                    <p>
                      <?php echo $dt['alamat_instansi']; ?>
                    </p>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Lokasi Proyek</strong>
                    <p>
                      <?php echo $dt['kabupaten']; ?>
                    </p>

                    <strong><i class="fa fa-dollar margin-r-5"></i> Nilai Proyek/Kontrak/HPS</strong>
                    <p>
                      <?php echo "Rp. " . number_format($dt['nilai_proyek'], 2, ",", "."); ?>
                    </p>

                    <strong><i class="fa fa-dollar margin-r-5"></i> Nilai Jaminan</strong>
                    <p>
                      <?php echo "Rp. " . number_format($dt['nilai_jaminan'], 2, ",", "."); ?>
                    </p>

                    <strong><i class="fa fa-id-card margin-r-5"></i> Nama Agent</strong>
                    <p>
                      <?php echo $dt['nama_agent']; ?>
                    </p>
                    <strong><i class="fa fa-calendar margin-r-5"></i>Tanggal Permohonan</strong>
                    <p>
                      <?php echo tgl_indo($dt['tgl_permohonan']); ?>
                    </p>
                  </div>
                  <!-- /.col -->
                </div>

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-xs-12">
                    <h4><i class="fa fa-calendar"></i><b> Jangka Waktu :</b> <?php echo tgl_indo($dt['dari_tgl']); ?> - <?php echo tgl_indo($dt['sampai_tgl']); ?></h4>
                    <b>Dokumen Pendukung : </b><?php echo $dt['dokumen']; ?><br>
                    <b>Nomor : </b><?php echo $dt['no_dokumen']; ?> <br>
                    <b>Tanggal : </b><?php echo tgl_indo($dt['tgl_dokumen']); ?><br>
                    <!-- <p class="text-muted well well-sm no-shadow col-xs-6" style="margin-top: 10px;">
                      <?php
                      if ($dt['file_dokumen'] == 'Tidak Ada Data') {
                      ?>
                        <i class="fa fa-file"></i><a href="#"> <?php echo $dt['file_dokumen'] ?></a>
                      <?php
                      } else {
                      ?>
                        <i class="fa fa-file"></i><a href="<?php echo base_url() ?>/file/Permohonan/<?php echo $dt['file_dokumen'] ?>"> <?php echo $dt['file_dokumen'] ?></a>
                      <?php } ?>
                    </p> -->
                  </div>
                </div>
                <!-- /.row -->
                <!-- this row will not appear when printing -->
                <!-- <div class="row no-print">
                  <div class="col-xs-12">
                    <a href="<?php echo base_url('Ptmada/cetak_permohonan/' . $dt['id_permohonan']) ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    <a href="<?php echo site_url('Ptmada/edit_permohonan/' . $dt['id_permohonan']); ?>"><button class="btn btn-success"><i class="fa fa-edit"></i> Edit</button></a>

                  </div>
                </div> -->
              </div>

            </div>
            <!-- /.tab-pane -->
            <div class="<?php echo ($this->uri->segment(4) == 'pemasukan') ? 'active' : ''; ?> tab-pane" id="pemasukan">
              <div class="row no-print" style="margin-bottom: 30px;">
                <!-- <div class="col-xs-12">


                </div> -->
              </div>
              <div class="row">
                <div class="col-xs-6">
                  <br><br><br><br><br><br>
                  <?php if ($status_pemasukan == 0) { ?>
                    <a href="<?php echo base_url('Finansial/tambah_pemasukan/' . $dt['id_permohonan']) ?>" class="btn btn-primary " title="Tambah Data Pemasukan"><i class="fa fa-plus"></i> Tambah Pemasukan</a>
                  <?php } ?>
                </div>
                <div class="col-xs-6">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <td>Jumlah Tagihan</td>
                      <td><?php echo "Rp. " . number_format($tagihan_pemasukan, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                      <td>Jumlah Bayar</td>
                      <td><?php echo "Rp. " . number_format($jm_pemasukan, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                      <td>Sisa Bayar</td>
                      <td><?php echo "Rp. " . number_format($sisa_pemasukan, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <th> <?php echo ($status_pemasukan == 1) ? "LUNAS" : "BELUM LUNAS"; ?></th>
                    </tr>
                  </table>
                </div>
              </div>


              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Pemasukan</th>
                    <th>Jumlah Pemasukan</th>
                    <th>Uraian</th>
                    <!-- <th>Bukti Pemasukan</th> -->
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no1 = 1;
                  foreach ($pemasukan as $td) {
                  ?>
                    <tr>
                      <td><?php echo $no1++; ?></td>
                      <td><?php echo tgl_indo($td['tgl_pembayaran']); ?></td>
                      <td><?php echo "Rp. " . number_format($td['jml_pembayaran'], 2, ',', '.'); ?></td>
                      <td><?php echo $td['uraian'] ?></td>
                      <!-- <td>
                        <a href="<?php echo base_url() ?>file/Pembayaran/<?php echo $td['bukti_pembayaran'] ?>"> <i class="fa fa-download"></i> Download </a>
                      </td> -->
                      <td>
                        <a href="<?php echo site_url('Finansial/edit_pemasukan/' . $td['id_pembayaran']); ?>" title="Edit"><i class="fa fa-edit"></i></a>
                        |
                        <a href="<?php echo site_url('Finansial/hapus_pemasukan/' . $td['id_pembayaran'] . '/' . $td['id_permohonan']); ?>" onclick="return konformasi()" title="Hapus"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Pemasukan</th>
                    <th>Jumlah Pemasukan</th>
                    <th>Uraian</th>
                    <!-- <th>Bukti Pemasukan</th> -->
                    <th>Aksi</th>
                  </tr>
                </tfoot>
              </table>
            </div>

            <div class="<?php echo ($this->uri->segment(4) == 'pengeluaran') ? 'active' : ''; ?> tab-pane" id="pengeluaran">
              <div class="row no-print" style="margin-bottom: 30px;">
                <div class="col-xs-12">


                </div>
              </div>
              <div class="row">
                <div class="col-xs-6">
                  <br><br><br><br><br><br><br><br><br>
                  <?php if ($status_pengeluaran == 0) { ?>
                    <a href="<?php echo base_url('Finansial/tambah_pengeluaran/' . $dt['id_permohonan']) ?>" class="btn btn-primary " title="Tambah Data Pengeluaran"><i class="fa fa-plus"></i> Tambah Pengeluaran</a>
                  <?php } ?>
                </div>
                <div class="col-xs-6">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <td>IJP Jamkrida</td>
                      <td><?php echo "Rp. " . number_format($ijpjmk, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                      <td>Kontra Garansi Bank</td>
                      <td><?php echo "Rp. " . number_format($kontra, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                      <td>Jumlah Tagihan</td>
                      <td><?php echo "Rp. " . number_format($tagihan_pengeluaran, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                      <td>Jumlah Bayar</td>
                      <td><?php echo "Rp. " . number_format($jm_pengeluaran, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                      <td>Sisa Bayar</td>
                      <td><?php echo "Rp. " . number_format($sisa_pengeluaran, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <th> <?php echo ($status_pengeluaran == 1) ? "LUNAS" : "BELUM LUNAS"; ?></th>
                    </tr>
                  </table>
                </div>
              </div>
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Pengeluaran</th>
                    <th>Jumlah Pengeluaran</th>
                    <th>Uraian</th>
                    <th>Bukti Pengeluaran</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no1 = 1;
                  foreach ($pengeluaran as $td) {
                  ?>
                    <tr>
                      <td><?php echo $no1++; ?></td>
                      <td><?php echo tgl_indo($td['tgl_pembayaran']); ?></td>
                      <td><?php echo "Rp. " . number_format($td['jml_pembayaran'], 2, ',', '.'); ?></td>
                      <td><?php echo $td['uraian']; ?></td>
                      <td>
                        <a href="<?php echo base_url() ?>file/Pembayaran/<?php echo $td['bukti_pembayaran'] ?>"> <i class="fa fa-download"></i> Download </a>
                      </td>
                      <!-- <td><?php echo $dt['uraian']; ?></td> -->
                      <td>
                        <a href="<?php echo site_url('Finansial/edit_pengeluaran/' . $td['id_pembayaran']); ?>" title="Edit"><i class="fa fa-edit"></i></a>
                        |
                        <a href="<?php echo site_url('Finansial/hapus_pengeluaran/' . $td['id_pembayaran'] . '/' . $td['id_permohonan']); ?>" onclick="return konformasi()" title="Hapus"><i class="fa fa-trash"></i></a>
                      </td>

                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Pengeluaran</th>
                    <th>Jumlah Pengeluaran</th>
                    <th>Uraian</th>
                    <th>Bukti Pengeluaran</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>