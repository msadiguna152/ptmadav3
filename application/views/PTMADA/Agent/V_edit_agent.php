  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Agent
        <small>Rekanan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Ptmada/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Data Agent</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">EDIT DATA AGENT</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">

                <form method="POST" action="<?php echo base_url('Ptmada/proses_edit_agent') ?>" enctype="multipart/form-data">
                  <div class="col-md-6">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Induk</label>

                      <input type="hidden" name="kd_agent" class="form-control" placeholder="" required="" value="<?php echo $data['kd_agent'] ?>">

                      <input type="text" class="form-control" name="induk" placeholder="Induk" required="" value="<?php echo $data['induk'] ?>" autofocus>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama Agent</label>
                      <input type="text" name="nama_agent" class="form-control" placeholder="Nama Pejabat" required="" value="<?php echo $data['nama_agent'] ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Alamat</label>
                      <textarea name="alamat" class="form-control" placeholder="Alamat" required=""><?php echo $data['alamat'] ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="Email" required="" value="<?php echo $data['email'] ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Nomor Telpon</label>
                      <input type="text" maxlength="13" onkeypress="return hanyaAngka(event)" name="no_telp" class="form-control" placeholder="Nomor Telpon" required="" value="<?php echo $data['no_telp'] ?>">
                    </div>
                  </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Submit</button>
              <a href="<?php echo base_url('Ptmada/lihat_agent/') ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
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