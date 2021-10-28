<script type="text/javascript">
    $(document).ready(function() {

        $.getJSON('<?php echo base_url() ?>Ptmada/get_dashboard', function(data) {
            console.log(data);
            $.each(data, function(i, rows) {
                $('#semua_peromohonan').text(rows.permohonan);
                $('#semua_perusahaan').text(rows.perusahaan);
                $('#semua_pejabat').text(rows.pejabat);
                $('#semua_agent').text(rows.agent);
                $('#semua_lokasi').text(rows.lokasi);
                $('#semua_dokumen').text(rows.dokumen);
            });
        });

    });
</script>