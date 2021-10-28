  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!-- <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.13
    </div> -->
    <strong>Copyright &copy; 2019 <a href="https://adminlte.io">PT MADA</a>.</strong> All rights
    reserved.
  </footer>
        <span disable=""
        <?php if ($this->session->flashdata('hasil')=="swalberhasilsimpan") { echo 'class="swalberhasilsimpan"';}?>>
        </span>
        <span disable=""
        <?php if ($this->session->flashdata('hasil')=="swalberhasilhapus") { echo 'class="swalberhasilhapus"';}?>>
        </span>
        <span disable=""
        <?php if ($this->session->flashdata('hasil')=="swalberhasilubah") { echo 'class="swalberhasilubah"';};?>>
        </span>

        <span disable=""
        <?php if ($this->session->flashdata('hasil')=="swalgagallsimpan") { echo 'class="swalgagallsimpan"';}?>>
        </span>
        <span disable=""
        <?php if ($this->session->flashdata('hasil')=="swalgagalhapus") { echo 'class="swalgagalhapus"';}?>>
        </span>
        <span disable=""
        <?php if ($this->session->flashdata('hasil')=="swalgagalubah") { echo 'class="swalgagalubah"';};?>>
        </span>
  </div>
  <!-- ./wrapper -->
  <script src="<?php echo base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
  <script src="<?php echo base_url() ?>assets/bower_components/moment/min/locales.min.js"></script>
  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery1.1.min.js"></script>
  <!-- <script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script> -->
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datetimepicker.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
  <!-- page script -->
  
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

  <!-- SweetAlert2 -->
  <script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>

  <script type="text/javascript">
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
      }else {
        return true;
      }
    };
  </script>

  <script type="text/javascript">
    $(function () {
      const Toast = Swal.mixin({
        toast: false,
        position: 'top-end',
        showConfirmButton: true,
      });

      $('.berhasillogin').show(function () {
        Toast.fire({
          type: 'success',
          timer: 2000,
          onOpen: function () {
            swal.showLoading()
          },
          title: ' Selamat Datang <?php echo $this->session->userdata("nama")?>, Anda Login Sebagai <?php echo $this->session->userdata("level")?>'
        })
      });

      $('.gagallogin').show(function () {
        Toast.fire({
          type: 'error',
          timer: 2000,
          onOpen: function () {
            swal.showLoading()
          },
          title: 'Username dan Password Salah..!'
        })
      });

      $('.swalberhasilhapus').show(function () {
        Toast.fire({
          toast: true,
          timer: 3000,
          type: 'success',
          title: ' Data Berhasil Di Hapus!'
        })
      });

      $('.swalberhasilsimpan').show(function () {
        Toast.fire({
          toast: true,
          timer: 3000,
          type: 'success',
          title: ' Data Berhasil Di Simpan!'
        })
      });

      $('.swalberhasilubah').show(function () {
        Toast.fire({
          toast: true,
          timer: 3000,
          type: 'success',
          title: ' Data Berhasil Di Ubah!'
        })
      });

      //Gagal
      $('.swalgagalhapus').show(function () {
        Toast.fire({
          type: 'error',
          title: ' Data Gagal Di Hapus!'
        })
      });

      $('.swalgagalsimpan').show(function () {
        Toast.fire({
          type: 'error',
          title: ' Data Gagal Di Simpan!'
        })
      });

      $('.swalgagalubah').show(function () {
        Toast.fire({
          type: 'error',
          title: ' Data Gagal Di Ubah!'
        })
      });
    });

  </script>

  
  <script>
    $(function() {
      $('#example1').DataTable()
      $('#example3').DataTable()
      $('#example5').DataTable()
      $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': false
      })
      $('#example4').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': true,
        "language": {
            "lengthMenu": "Tampilkan _MENU_ Data Perhalaman",
            "info": "Halaman _PAGE_ Dari _PAGES_ Halaman",
            "infoEmpty": "Data Tidak Tersedia",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "infoEmpty":      "Menampilkan 0 Ke 0 Dari 0 Data",
            "infoFiltered":   "(filtered from _MAX_ total entries)",
            "infoPostFix":    "",
            "thousands":      ",",
            "loadingRecords": "Loading...",
            "processing":     "Processing...",
            "search":         "Pencarian :",
            "zeroRecords":    "Data Tidak Tersedia",
            "paginate": {
                "first":      "Pertaman",
                "last":       "Terakhir",
                "next":       "Selanjutnya",
                "previous":   "Sebelumnya"
            },
        }
      })
    })
  </script>

  </body>

  </html>