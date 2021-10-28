<script type="text/javascript">
    $(document).ready(function() {
        console.log("ready!");

        var table = $('#data').DataTable({
            // "ordering": true,
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            "ajax": {
                "url": "<?php echo site_url('Admin/get_data') ?>",
                "data": {
                    tgl_awal: function() {
                        return $('#tgl_awal').val()
                    },
                    tgl_akhir: function() {
                        return $('#tgl_akhir').val()
                    },
                    agent: function() {
                        return $('#kd_agent').val()
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
            var agent = $("#kd_agent").val();
            var perusahaan = $("#kd_perusahaan").val();
            console.log(tgl_awal + '/' + tgl_akhir + '/' + pejabat + '/' + agent);
            var str = '';
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Admin/get_filter') ?>",
                data: {
                    tgl_awal: tgl_awal,
                    tgl_akhir: tgl_akhir,
                    pejabat: pejabat,
                    agent: agent,
                    perusahaan: perusahaan
                },
                dataType: "json",
                success: function(resdok) {
                    console.log("+" + resdok);
                    if (resdok != null) {
                        for (i = 0; i < resdok.length; i++) {
                            $str = '<tr id="total">' +
                                '<th colspan="7" class="text-center">Total</th>' +
                                '<th>' + resdok[i]['pemasukan'] + '</th>' +
                                '<th>' + resdok[i]['pengeluaran'] + '</th>' +
                                '<th>' + resdok[i]['profit'] + '</th>' +
                                '</tr>';
                            $('#total').append($str);
                        }
                    }
                }
            });
        };

        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(); //just reload table
            get_filter();
            //$("#total").remove();
        });

        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(); //just reload table
            get_filter();
        });

    });
</script>