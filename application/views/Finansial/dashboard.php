<script type="text/javascript">
    $(document).ready(function() {

        var tes = $('#pendapatan_bulan').prop("checked");
        var tes2 = $('#pendapatan_tahun').prop("checked");
        console.log('tes1: ' + tes + ' tes2 : ' + tes2);
        $.getJSON('<?php echo base_url() ?>Finansial/get_dashboard', function(data) {
            console.log(data);
            // $('#load').hide();
            // alert(data.)
            $.each(data, function(i, rows) {
                i++;
                $('#pendapatan').text(rows.pendapatan);
                $('#permohonan_diproses').text(rows.permohonan_diproses);
                $('#piutang').text(rows.piutang);
                $('#profit').text(rows.profit);
                $('#wajib_bayar').text(rows.wajib_bayar);
            });
        });

        $.getJSON('<?php echo base_url() ?>Finansial/get_dashboard2', function(data) {
            console.log(data);
            $.each(data, function(i, rows) {
                i++;
                $('#kredit').text(rows.kredit);
                $('#debit').text(rows.debit);
                $('#saldo').text(rows.saldo);
            });
        });

        $.getJSON('<?php echo base_url() ?>Finansial/get_profit/bulan', function(data) {
            $.each(data, function(i, rows) {
                $('#profit_filter').text(rows.profit_filter);
            });
        });

        $.getJSON('<?php echo base_url() ?>Finansial/get_pendapatan/bulan', function(data) {
            $.each(data, function(i, rows) {
                $('#pendapatan_filter').text(rows.pendapatan_filter);
            });
        });

        $('input:radio[name=pendapatan]').change(function() {
            if (this.value == 'pendapatan_bulan') {
                $.getJSON('<?php echo base_url() ?>Finansial/get_pendapatan/bulan', function(data) {
                    $.each(data, function(i, rows) {
                        $('#pendapatan_filter').text(rows.pendapatan_filter);
                    });
                });
            } else if (this.value == 'pendapatan_tahun') {
                $.getJSON('<?php echo base_url() ?>Finansial/get_pendapatan', function(data) {
                    $.each(data, function(i, rows) {
                        $('#pendapatan_filter').text(rows.pendapatan_filter);
                    });
                });
            }
        });

        $('input:radio[name=profit]').change(function() {
            if (this.value == 'profit_bulan') {
                $.getJSON('<?php echo base_url() ?>Finansial/get_profit/bulan', function(data) {
                    $.each(data, function(i, rows) {
                        $('#profit_filter').text(rows.profit_filter);
                    });
                });
            } else if (this.value == 'profit_tahun') {
                $.getJSON('<?php echo base_url() ?>Finansial/get_profit', function(data) {
                    $.each(data, function(i, rows) {
                        $('#profit_filter').text(rows.profit_filter);
                    });
                });
            }
        });


    });
</script>