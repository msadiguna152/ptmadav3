  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pejabat
        <small>Rekanan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Ptmada/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Data Pejabat</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-default">
            
            <div class="box-header with-border">
              <h3 class="box-title">FORM DATA PEJABAT</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">

                <form method="POST" action="<?php echo base_url('Ptmada/proses_tambah_pejabat') ?>" enctype="multipart/form-data">
                  <div class="col-md-6">
                    <div class="form-group">
                      <!-- <label for="exampleInputEmail1">NIP</label> -->
                      <input type="hidden" name="kd_pejabat" class="form-control" required="" value="<?php echo $kode; ?>">
                      <input type="hidden" class="form-control" name="nip" placeholder="NIP" required=" " value="<?php echo $kode; ?>" autofocus autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama Pejabat</label>
                      <input type="text" name="nama_pejabat" class="form-control" placeholder="Nama Pejabat" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Alamat</label>
                      <textarea type="text" name="alamat" class="form-control" placeholder="Alamat" autocomplete="off"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nomor Telpon</label>
                      <input type="text" onkeypress="return hanyaAngka(event)" name="no_telp" class="form-control" placeholder="Nomor Telpon" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Instansi</label>
                      <input type="text" name="instansi" class="form-control" placeholder="Instansi" autocomplete="off">
                    </div>
                  </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Submit</button>
              <a href="<?php echo base_url('Ptmada/lihat_pejabat/') ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
            </div>

            </form>
          </div>
        </div>
        <!-- /.box -->

        <!-- Form Element sizes -->

        <!-- /.box -->


        <!-- /.box -->


        <!-- /.box -->

      </div>
      <!--/.col (left) -->
      <!-- right column -->

      <!--/.col (right) -->
  </div>
  <!-- /.row -->
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->