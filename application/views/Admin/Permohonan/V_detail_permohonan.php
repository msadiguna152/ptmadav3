<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Permohonan
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php base_url() ?>/Admin/Admin/lihat_permohonan">Permohonan</a></li>
      <li class="active">Detail Permohonan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <!-- /.col -->
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#detailpermohonan" data-toggle="tab">Detail Permohonan</a></li>
            <li><a href="#pembayaran" data-toggle="tab">Pembayaran</a></li>
            <li><a href="#jamkrida" data-toggle="tab">Jamkrida</a></li>
            <li><a href="#sertifikat" data-toggle="tab">Sertifikat</a></li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="detailpermohonan">
              <!-- Post -->
              <div class="card-body">
                <div class="row invoice-info">
                  <div class="col-sm-6 invoice-col">

                    <address>
                      <strong><i class="fa fa-building margin-r-5"></i> Nama Perusahaan</strong>
                        <p>
                          <?php echo $dt['nama_perusahaan']; ?>
                        </p>
                        <p>
                          <?php echo $dt['alamat_perusahaan']; ?>
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
                          <?php echo $dt['pemilik']; ?>
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
                          <?php echo "Rp. " . number_format($dt['nilai_proyek'], 0, ",", "."); ?>
                        </p>

                      <strong><i class="fa fa-dollar margin-r-5"></i> Nilai Jaminan</strong>
                        <p>
                          <?php echo "Rp. " . number_format($dt['nilai_jaminan'], 0, ",", "."); ?>
                        </p>

                      <strong><i class="fa fa-id-card margin-r-5"></i> Nama Agent</strong>
                        <p>
                          <?php echo $dt['nama_agent']; ?>
                        </p>
                      <!-- <strong><i class="fa fa-calendar margin-r-5"></i>Tanggal Permohonan</strong>
                        <p>
                          <?php echo tgl_indo($dt['tgl_permohonan']); ?>
                        </p> -->
                  </div>
                  <!-- /.col -->
                </div>

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-xs-12">
                    <h4><i class="fa fa-calendar"></i><b> Jangka Waktu :</b> <?php echo tgl_indo($dt['dari_tgl']); ?> - <?php echo tgl_indo($dt['sampai_tgl']); ?></h4>
                    <b>Dokumen Pendukung : </b><?php echo $dt['dokumen']; ?><br>
                    <b>Nomor : </b><?php echo $dt['no_dokumen']; ?> <br>
                    <b>Tanggal Permohonan : </b><?php echo tgl_indo($dt['tgl_permohonan']); ?> <br>
                    <b>Tanggal Komitmen Pendukung : </b><?php echo tgl_indo($dt['tgl_komitmen']); ?><br>
                    <b>Catatan Dokumen Pendukung : </b><?php echo $dt['catatan_dokumen']; ?> <br>
                    <b>Status Dokumen Pendukung : </b><?php echo $dt['status']; ?> <br>
                    <p class="text-muted well well-sm no-shadow col-xs-6" style="margin-top: 10px;">
                      <?php
                         if ($dt['file_dokumen'] == 'Tidak Ada Data') {
                      ?>
                        <i class="fa fa-file"></i><a href="#"> <?php echo $dt['file_dokumen'] ?></a>
                      <?php
                      } else {
                      ?>
                        <i class="fa fa-file"></i><a href="<?php echo base_url() ?>/file/Permohonan/<?php echo $dt['file_dokumen'] ?>"> <?php echo $dt['file_dokumen'] ?></a>
                      <?php } ?>
                    </p>
                  </div>
                </div>
                <!-- /.row -->
                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-xs-12">
                    <a href="<?php echo base_url('Admin/cetak_permohonan/' . $dt['id_permohonan']) ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    <a href="<?php echo site_url('Admin/edit_permohonan/' . $dt['id_permohonan']); ?>"><button class="btn btn-success"><i class="fa fa-edit"></i> Edit</button></a>

                  </div>
                </div>
              </div>

            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="pembayaran">
              <div class="row no-print" style="margin-bottom: 30px;">
                <div class="col-xs-12">
                  <a href="<?php echo base_url('Admin/tambah_pembayaran/' . $dt['id_permohonan']) ?>" class="btn btn-primary " title="Tambah Data Pembayaran"><i class="fa fa-plus"></i> Pembayaran</a>

                </div>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Jumlah Pembayaran</th>
                    <!-- <th>Jenis Jaminan</th> -->
                    <th>Bukti Pembayaran</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                                                                                                                        $no1 = 1;
                                                                                                                                        foreach ($pembayaran as $td) {
                  ?>
                    <tr>
                      <td><?php echo $no1++; ?></td>
                      <td><?php echo tgl_indo($td['tgl_pembayaran']); ?></td>
                      <td><?php echo "Rp. " . number_format($td['jml_pembayaran'], 2, ',', '.'); ?></td>
                      <td>
                        <a href="<?php echo base_url() ?>/file/Permohonan/<?php echo $td['bukti_pembayaran'] ?>"> <i class="fa fa-download"></i> Download </a>
                      </td>
                      <!-- <td><?php echo $dt['jenis_jaminan']; ?></td> -->
                      <td>
                        <a href="<?php echo site_url('Admin/edit_pembayaran/' . $td['id_pembayaran']); ?>" title="Edit"><i class="fa fa-edit"></i></a>
                        |
                        <a href="<?php echo site_url('Admin/hapus_pembayaran/' . $td['id_pembayaran'] . '/' . $td['id_permohonan']); ?>" onclick="return konformasi()" title="Hapus"><i class="fa fa-trash"></i></a>
                      </td>

                    </tr>
                  <?php
                                                                                                                                        }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Jumlah Pembayaran</th>
                    <!-- <th>Jenis Jaminan</th> -->
                    <th>Bukti Pembayaran</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot>
              </table>
            </div>

            <div class="tab-pane" id="jamkrida">
              <div class="row no-print" style="margin-bottom: 30px;">
                <div class="col-xs-12">
                  <a href="<?php echo base_url('Admin/tambah_pembayaran_jamkrida/' . $dt['id_permohonan']) ?>" class="btn btn-primary " title="Tambah Data Pembayaran Jamkrida"><i class="fa fa-plus"></i> Pembayaran</a>

                </div>
              </div>
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Jumlah Pembayaran</th>
                    <!-- <th>Jenis Jaminan</th> -->
                    <th>Bukti Pembayaran</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                                                                                                                        $no1 = 1;
                                                                                                                                        foreach ($pembayaran_jamkrida as $td) {
                  ?>
                    <tr>
                      <td><?php echo $no1++; ?></td>
                      <td><?php echo tgl_indo($td['tgl_pembayaran']); ?></td>
                      <td><?php echo "Rp. " . number_format($td['jml_pembayaran'], 2, ',', '.'); ?></td>
                      <td>
                        <a href="<?php echo base_url() ?>/file/Permohonan/<?php echo $td['bukti_pembayaran'] ?>"> <i class="fa fa-download"></i> Download </a>
                      </td>
                      <!-- <td><?php echo $dt['jenis_jaminan']; ?></td> -->
                      <td>
                        <a href="<?php echo site_url('Admin/edit_pembayaran_jamkrida/' . $td['id_pembayaran']); ?>" title="Edit"><i class="fa fa-edit"></i></a>
                        |
                        <a href="<?php echo site_url('Admin/hapus_pembayaran_jamkrida/' . $td['id_pembayaran'] . '/' . $td['id_permohonan']); ?>" onclick="return konformasi()" title="Hapus"><i class="fa fa-trash"></i></a>
                      </td>

                    </tr>
                  <?php
                                                                                                                                        }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Jumlah Pembayaran</th>
                    <!-- <th>Jenis Jaminan</th> -->
                    <th>Bukti Pembayaran</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot>
              </table>
            </div>
<!-- ANCHOR begin sertifikat -->
            <div class="tab-pane" id="sertifikat">
            <div class="row no-print" style="margin-bottom: 30px;">
                <div class="col-xs-12">
                  <a href="<?php echo base_url('Admin/tambah_sertifikat/' . $dt['id_permohonan']) ?>" class="btn btn-primary " title="Tambah Data Sertifikat"><i class="fa fa-plus"></i> Sertifikat</a>
                </div>
              </div>
              <table id="example5" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>File Sertifikat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no1 = 1;
                  foreach ($pembayaran_jamkrida as $td) {
                  ?>
                    <tr>
                      <td><?php echo $no1++; ?></td>
                      <td>
                        <a href="<?php echo base_url() ?>/file/Permohonan/<?php /*echo $td['bukti_pembayaran']*/ ?>"> <i class="fa fa-download"></i> Download </a>
                      </td>
                      <td>
                        <a href="<?php echo site_url('Admin/edit_sertifikat/' . $td['id_pembayaran']); ?>" title="Edit"><i class="fa fa-edit"></i></a>
                        |
                        <a href="<?php echo site_url('Admin/hapus_sertifikat/' . $td['id_pembayaran'] . '/' . $td['id_permohonan']); ?>" onclick="return konformasi()" title="Hapus"><i class="fa fa-trash"></i></a>
                      </td>

                    </tr>
                  <?php
                                                                                                                                        }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>File Sertifikat</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot>
              </table>                                                                                                                  
            </div>
            <!-- /.tab-pane -->
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