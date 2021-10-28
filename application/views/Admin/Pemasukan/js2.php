<script type="text/javascript">
    $(document).ready(function() {

        var table = $('#data').DataTable({
            // "ordering": true,
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            "ajax": {
                "url": "<?php echo site_url('Admin/get_data_pemasukan') ?>",
                "data": {
                    tgl_awal: function() {
                        return $('#tgl_awal').val()
                    },
                    tgl_akhir: function() {
                        return $('#tgl_akhir').val()
                    },
                    status: function() {
                        return $('#status').val()
                    },
                    pejabat: function() {
                        return $('#kd_pejabat').val()
                    },
                    perusahaan: function() {
                        return $('#kd_perusahaan').val()
                    }
                }
            },

        });

        get_filter();

        function get_filter() {
            $('#total').html('');
            var tgl_awal = $("#tgl_awal").val();
            var tgl_akhir = $("#tgl_akhir").val();
            var pejabat = $("#kd_pejabat").val();
            var status = $("#status").val();
            var perusahaan = $("#kd_perusahaan").val();
            console.log(tgl_awal + '/' + tgl_akhir + '/' + pejabat + '/' + status);
            var str = '';
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Admin/get_filter_pemasukan') ?>",
                data: {
                    tgl_awal: tgl_awal,
                    tgl_akhir: tgl_akhir,
                    status: status,
                    pejabat: pejabat,
                    perusahaan: perusahaan

                },
                dataType: "json",
                success: function(result) {
                    console.log("+" + result);
                    if (result != null) {
                        for (i = 0; i < result.length; i++) {
                            $str = '<tr id="total">' +
                                '<th colspan="6" class="text-center">Total</th>' +
                                '<th>' + result[i]['jml_masuk'] + '</th>' +
                                '<th>' + result[i]['jml_byr'] + '</th>' +
                                '<th>' + result[i]['sisa_byr'] + '</th>' +
                                '<th></th>' +
                                '</tr>';
                            $('#total').append($str);
                        }
                    }
                }
            });
        };
        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload();
            get_filter();
            // $("#total").remove();
        });

        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload();
            get_filter();
        });

    });
</script>