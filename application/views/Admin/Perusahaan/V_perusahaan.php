<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Perusahaan
      <small>Rekanan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> PT Mada</a></li>
      <li class="active">Data Perusahaan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Perusahaan</h3><br>
          </div>
          <div class="box-footer">
            <a href="<?php echo base_url('Admin/tambah_perusahaan') ?>"><button type="button" class="btn btn-info" title="Tambah Data Perusahaan"><i class="fa fa-plus-square"></i> Tambah Perusahaan</button></a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Perusahaan</th>
                  <th>Nama Pimpinan</th>
                  <th>Alamat</th>
                  <!-- <th>Email</th>
                  <th>Nomor Telpon</th> -->
                  <!-- <th>Nomor Fax</th> -->

                  <!--<th>Company Profile</th>
                  
                  <th>Akta Pendirian</th>
                  <th>SPKMGR</th>
                  <th>STDP</th>
                  <th>SIUP</th>
                  <th>SKTU</th>
                  <th>SIUJK</th>
                  <th>SPT</th>
                  <th>NPWP</th>
                  <th>KTP</th>
                  <th>Laporan Keuangan</th>
                  <th>Proyek Sebelumnya</th> -->
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
                    <td><a href="<?php echo base_url('Admin/detail_perusahaan/' . $dt['kd_perusahaan']) ?>"><?php echo $dt['nama_perusahaan']; ?></a></td>
                    <td><?php echo $dt['nama_direktur']; ?></td>
                    <!-- <td><?php echo $dt['email']; ?></td>
                    <td><?php echo $dt['no_telpon']; ?></td> -->
                    <!-- <td><?php echo $dt['no_fax']; ?></td> -->
                    <td><?php echo $dt['alamat']; ?></td>
                    <!--<td><?php echo $dt['company_profile']; ?></td>
                   
                    <td><?php echo $dt['akta_pendirian']; ?></td>
                    <td><?php echo $dt['spkmgr']; ?></td>
                    <td><?php echo $dt['stdp']; ?></td>
                    <td><?php echo $dt['siup']; ?></td>
                    <td><?php echo $dt['sktu']; ?></td>
                    <td><?php echo $dt['siujk']; ?></td>
                    <td><?php echo $dt['spt']; ?></td>
                    <td><?php echo $dt['npwp']; ?></td>
                    <td><?php echo $dt['ktp']; ?></td>
                    <td><?php echo $dt['laporan_keuangan']; ?></td>
                    <td><?php echo $dt['proyek_sebelumnya']; ?></td> -->
                    <td>
                      <center>
                        <!-- <a href="<?php echo base_url() ?>/file/<?php echo $dt['file_pokir']; ?>" title="Download"><i class="fa fa-download"></i></a>
                      | -->
                        <a href="<?php echo site_url('Admin/edit_perusahaan/' . $dt['kd_perusahaan']); ?>" title="Edit"><i class="fa fa-edit"></i></a>
                        |
                        <a href="<?php echo site_url('Admin/hapus_perusahaan/' . $dt['kd_perusahaan']); ?>" onclick="return konformasi()" title="Delete"><i class="fa fa-trash"></i></a>
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
                  <th>Nama Perusahaan</th>
                  <th>Nama Pimpinan</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
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