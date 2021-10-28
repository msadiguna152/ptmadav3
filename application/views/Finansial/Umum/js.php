<script type="text/javascript">
    $(document).ready(function() {

        var userDataTable = $('#data').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            //'searching': false, // Remove default Search Control
            'ajax': {
                'url': '<?= base_url() ?>finansial/get_umum2',
                'data': function(data) {
                    data.tgl_awal = $('#tgl_awal').val();
                    data.tgl_akhir = $('#tgl_akhir').val();
                    data.kd_pejabat = $('#kd_pejabat').val();
                }
            },



            'columns': [{
                    data: 'tanggal'
                },
                {
                    data: 'keterangan'
                },
                {
                    data: 'kredit'
                },
                {
                    data: 'debit'
                },
                
               
                {
                    data: 'bukti'
                },
                {
                    data: 'nama_pejabat'
                },
                {
                    data: 'aksi'
                },
            ]
        });

        get_filter();
        
        function get_filter() {
            $('#total').html('');
            var tgl_awal = $("#tgl_awal").val();
            var tgl_akhir = $("#tgl_akhir").val();
            var kd_pejabat = $("#kd_pejabat").val();

            var str = '';
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Finansial/get_filter_umum2') ?>",
                data: {
                    tgl_awal: tgl_awal,
                    tgl_akhir: tgl_akhir,
                    pejabat: kd_pejabat
                },
                dataType: "json",
                success: function(resdok) {
                    console.log("+" + resdok);
                    if (resdok != null) {
                        for (i = 0; i < resdok.length; i++) {
                            $str = '<tr id="total">' +
                                '<th colspan="2" class="text-center">Total</th>' +
                                '<th>' + resdok[i]['kredit'] + '</th>' +
                                '<th>' + resdok[i]['debit'] + '</th>' +
                                '<th>' + resdok[i]['saldo'] + '</th>' +
                                '</tr>';
                            $('#total').append($str);
                        }
                    }
                }
            });
        };

        $('#btn-filter').click(function() { //button filter event click
            userDataTable.draw(); //just reload table
            get_filter();
            //$("#total").remove();
        });

        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            userDataTable.draw(); 
            get_filter();
        });
    });
</script>