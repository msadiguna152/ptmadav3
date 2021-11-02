<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Profil Pejabat : <?php echo $data['nama_pejabat']; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php base_url() ?>/ptmada/Ptmada/lihat_pejabat">Pejabat</a></li>
      <li class="active">Profil Pejabat</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <!-- /.col -->
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#profilpejabat" data-toggle="tab">Profil Pejabat</a></li>
            <li><a href="#history" data-toggle="tab">Histori Proyek</a></li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="profilpejabat">
              <!-- Post -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <table class="table table-striped table-hover table-bordered">
                      <tbody>
                        <tr>
                          <td><strong><i class="fa fa-user mr-1"></i> Profil</strong></td>
                        </tr>
                        <tr>
                          <td><?php echo $data['nama_pejabat']; ?></td>
                        </tr>
                        <tr>
                          <td><strong><i class="fa fa-building mr-1"></i> Instansi</strong></td>
                        </tr>
                        <tr>
                          <td><?php echo $data['instansi'] ?></td>
                        </tr>
                        <tr>
                          <td><strong><i class="fa fa-map-marker mr-1"></i> Alamat</strong></td>
                        </tr>
                        <tr>
                          <td><?php echo $data['alamat'] ?></td>
                        </tr>
                        <tr>
                          <td><strong><i class="fa fa-phone mr-1"></i> Kontak</strong></td>
                        </tr>
                        <tr>
                          <td>No. HP : <?php echo $data['no_telp'] ?>, Email : <?php echo $data['email'] ?></td>
                        </tr>
                        <tr>
                          <td colspan="2"><a href="<?php echo site_url('Ptmada/edit_pejabat/' . $data['kd_pejabat']); ?>"><button class="btn btn-success"><i class="fa fa-edit"></i> Edit</button></a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>

            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="history">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Permohonan</th>
                    <th>Nama Perusahaan</th>
                    <th>Nama Pejabat</th>
                    <th>Nama Pekerjaan</th>
                    <th>Nilai Proyek</th>
                    <th>Detail</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($data2 as $dt) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $dt['no_permohonan']; ?></td>
                      <td><a href="<?php echo base_url('Ptmada/detail_perusahaan/' . $dt['kd_perusahaan']) ?>"><?php echo $dt['nama_perusahaan']; ?></a></td>
                      <td><a href="<?php echo base_url('Ptmada/detail_perusahaan/' . $dt['kd_pejabat']) ?>"><?php echo $dt['nama_pejabat']; ?></a></td>
                      <td><?php echo $dt['nama_pekerjaan']; ?></td>
                      <td><?php echo "Rp. " . number_format($dt['nilai_proyek'], 2, ',', '.'); ?></td>
                      <td>
                        <center>
                          <a href="<?php echo site_url('Ptmada/detail_permohonan/' . $dt['id_permohonan']); ?>" title="Detail"><i class="fa fa-info-circle"></i></a>
                        </center>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
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