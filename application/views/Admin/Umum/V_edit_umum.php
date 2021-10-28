  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Transaksi Umum
        <!-- <small>Rekanan</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Admin/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Data Transaksi Umum </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Form Edit Data Transaksi Umum</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">

                <form method="POST" action="<?php echo base_url('Admin/proses_edit_umum/' . $data['id']) ?>" enctype="multipart/form-data">
                  <div class="col-md-6">

                    <div class="form-group">

                      <input type="hidden" name="id" class="form-control" placeholder="" required="" value="<?php echo $data['id'] ?>">

                      <input type="date" class="form-control" name="tanggal" placeholder="Tanggal" required="" value="<?php echo $data['tanggal'] ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Keterangan</label>
                      <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" required="" value="<?php echo $data['keterangan'] ?>" autofocus autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Jumlah</label>
                      <input type="text" name="jumlah"  class="form-control" placeholder="Jumlah" required="" value="<?php echo $data['jumlah'] ?>" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jenis Transaksi</label>
                      <select class="form-control select2" id="exampleFormControlSelect1" name="jenis_transaksi" autocomplete="off">
                        <?php if ($data['jenis_transaksi'] == 'Debit') { ?>
                          <option value="Debit">Pengeluaran</option>
                          <option value="Kredit">Pemasukan</option>
                        <?php } else { ?>

                          <option value="Kredit">Pemasukan</option>
                          <option value="Debit">Pengeluaran</option>
                        <?php } ?>

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Bukti Transaksi Umum</label>
                      <input type="text" name="bukti_lama" class="form-control" value="<?php echo $data['bukti'] ?>" required="" readonly>
                      <input type="file" name="bukti" class="form-control">
                    </div>

                  </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" style="margin-right: 20px;">Submit</button>
              <a href="<?php echo base_url('Admin/lihat_umum/') ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
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
  <script type="text/javascript">
    /* Tanpa Rupiah */
    var tanpa_rupiah = document.getElementById('tanpa-rupiah');
    tanpa_rupiah.addEventListener('keyup', function(e) {
      tanpa_rupiah.value = formatRupiah(this.value);
    });

    tanpa_rupiah.addEventListener('keydown', function(event) {
      limitCharacter(event);
    });

    /* Dengan Rupiah */
    var dengan_rupiah = document.getElementById('dengan-rupiah');
    dengan_rupiah.addEventListener('keyup', function(e) {
      dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    dengan_rupiah.addEventListener('keydown', function(event) {
      limitCharacter(event);
    });

    /* Fungsi */
    function formatRupiah(bilangan, prefix) {
      var number_string = bilangan.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function limitCharacter(event) {
      key = event.which || event.keyCode;
      if (key != 188 // Comma
        &&
        key != 8 // Backspace
        &&
        key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
        &&
        (key < 48 || key > 57) // Non digit
        // Dan masih banyak lagi seperti tombol del, panah kiri dan kanan, tombol tab, dll
      ) {
        event.preventDefault();
        return false;
      }
    }
  </script>