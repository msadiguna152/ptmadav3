<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $dt['no_permohonan']; ?></title>
    <style type="text/css">
        body {
font-family: 'Times New Roman';
}
    </style>
</head>
<body>
 <div id="container">
 
<div id="body">
		<div style="display: flex;">
			<img style="height: 90px;width: 270px" src="<?php echo base_url() ?>/file/JK.png">
		</div>
        <table border="1" style="width: 100%; border-collapse: collapse">
        	<tr>
        		<td colspan="3" style="text-align: center; font-size: 11"><b>PERMOHONAN SURETY BOND/BANK GARANSI</b></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"><b>No. Permohonan </b></td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 9pt"><b> <?php echo $dt['no_permohonan']; ?> </b></td>
        	</tr>
        	<tr>
        		<td colspan="3" style="font-size: 9"><b>DATA PEMOHON </b></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 1. Nama Perusahaan/Principal</td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 9pt"> <?php echo $dt['nama_perusahaan']; ?></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 2. Alamat</td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="text-align: justify; font-size: 9pt"> <?php echo $dt['alamat_perusahaan']; ?></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 3. Nomor Telpon</td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 9pt"> <?php echo $dt['no_telpon']; ?></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 4. Nomor Fax</td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 9pt"> <?php echo $dt['no_fax']; ?></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 5. Email</td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 9pt"> <?php echo $dt['email']; ?></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 6. Nama Pejabat</td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 9pt"> <?php echo $dt['nama_pejabat']; ?></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt" colspan="3"><b>JAMINAN YANG DIMINTA </b></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 1. Jenis Jaminan</td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 9pt"> <?php echo $dt['jenis_jaminan']; ?></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 2. Nilai Jaminan</td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 11pt"><b> Rp. <?php echo number_format($dt['nilai_jaminan'],2,",","."); ?> </b></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> </td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 9pt"><b> <?php echo $dt['persen']; ?> % </b></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 3. Jangka Waktu</td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 11px"><center><b> <?php echo $dt['jangka_waktu'] . " Hari  Mulai Dari : " . date('d-M-Y', strtotime($dt['dari_tgl'])) . " Sampai Dengan : " . date('d-M-Y', strtotime($dt['sampai_tgl'])); ?> </b> </center></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> </td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 9pt"></b></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 4. Mohon Terbit </td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 11pt"><b> <center><?php echo $dt['jenis_permohonan']; ?> </center>  </b></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt" colspan="3"><b>RINCIAN PROYEK </b></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 1. Nama Instansi Pemilik Proyek / Obligee </td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="text-align: justify; font-size: 9pt"> <?php echo $dt['pemilik_proyek']; ?></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 2. Alamat </td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="text-align: justify; font-size: 9pt"> <?php echo $dt['alamat_instansi']; ?></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 3. Nama Pekerjaan </td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="text-align: justify; font-size: 9pt"> <?php echo $dt['nama_pekerjaan']; ?></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 4. Lokasi Proyek </td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 9pt"> <b><?php echo $dt['kabupaten']; ?></b></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 5. Nilai Proyek/Kontrak/HPS</td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 11pt"><b> Rp. <?php echo number_format($dt['nilai_proyek'],2,",","."); ?> </b></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 6. Dokumen Pendukung</td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 9pt"><?php echo $dt['dokumen']; ?></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 7. No. Dokumen Pendukung</td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 9pt"><?php echo $dt['no_dokumen']; ?></td>
        	</tr>
        	<tr >
        		<td style="font-size: 9pt" rowspan="1"></td>
        		<td style="font-size: 9pt" rowspan="1">  </td>
        		<td style="font-size: 9pt" rowspan="1" style="height: 20px"></td>
        	</tr>
        	<tr>
        		<td style="font-size: 9pt"> 8. Tanggal Dok. Pendukung</td>
        		<td style="font-size: 9pt"> : </td>
        		<td style="font-size: 9pt"><?php echo tgl_indo($dt['tgl_dokumen']); ?></td>
        	</tr>

        </table>

        <br>
        <p style="margin-bottom: 0px; font-size: 9px">Sebagai bahan pertimbangan, terlampir kami kirimkan forocopy dokumen pendukung.</p>
        <p style="margin-top: 2px; font-size: 9px">Demikian Permohonan kami, Atas bantuan dan perhatiannya kami ucapkan terima kasih.</p>

        <br>
        <br>

        <p style="font-size: 9pt">Banjarmasin, <?php echo tgl_indo($dt['tgl_permohonan']); ?></p>
        <br>
        <br>
        <p style="margin-bottom: 0px; font-size: 9pt"><b><?php echo $dt['nama_direktur']; ?></b></p>
        <p style="margin-top: 2px; font-size: 9pt"><?php echo $dt['jab_pimpinan']; ?></p>

 
    </div> 
</div> 
</body>
</html>