<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Kelengkapan Dokumen Proyek</title>
</head>
<body>
 <div id="container">
 
<div id="body">
        <h2 style="text-align: center;">Laporan Kelengkapan Dokumen Proyek</h2>
        <table border="1" style="width: 100%; border-collapse: collapse">
        	<tr>
        		<td style="text-align: center;">No. </b></td>
                <td style="text-align: center;">No. Permohonan</b></td>
                <td style="text-align: center;">Nama Perusahaan</b></td>
                <td style="text-align: center;">Nama Proyek </b></td>
                <td style="text-align: center;">Tanggal Komitmen </b></td>
                <td style="text-align: center;">Catatan Dokumen Pendukung</b></td>
                <td style="text-align: center;">Pejabat Penghubung </b></td>
                <td style="text-align: center;">Status </b></td>
        	</tr>

            <?php 
            $no=1;
            foreach ($data as $dt) {
            ?>
            <tr>
                <td><?php echo $no++; ?></b></td>
                <td><?php echo $dt['no_permohonan']; ?></td>
                <td><?php echo $dt['nama_perusahaan']; ?></td>
                <td><?php echo $dt['nama_pekerjaan']; ?></td>
                <td><?php echo tgl_indo($dt['tgl_komitmen']); ?></td>
                <td><?php echo $dt['catatan_dokumen']; ?></td>
                <td><?php echo $dt['nama_pejabat']; ?></td>
                <td><?php echo $dt['status']; ?></td>
            </tr>

            <?php
            } ?>

        </table>

 
    </div> 
</div> 
</body>
</html>