<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Daftar Komitmen Dokumen Pendukung</title>
</head>
<body>
 <div id="container">
 
<div id="body">
        <h2 style="text-align: center;">Laporan Kelengkapan Dokumen Perusahaan Rekanan</h2>
        <table border="1" style="width: 100%; border-collapse: collapse">
        	<tr>
        		<td style="text-align: center;">No. </b></td>
                <td style="text-align: center;">Nama Perusahaan</b></td>
                <td style="text-align: center;">Kekurangan Dokumen</b></td>
                <td style="text-align: center;">Pejabat Penghubung</b></td>
                <td style="text-align: center;">Agent</b></td>
        	</tr>

            <?php 
            $no=1;
            foreach ($data as $dt) {
                if ($dt['company_profile'] =='Tidak Ada Data') {
                        $cp= "Company Profile, ";
                       }else{
                        $cp='';
                       } 

                      if ($dt['akta_pendirian'] =='Tidak Ada Data') {
                         $ap="Akta Pendirian, ";
                       }else{
                        $ap='';
                       }
                      if ($dt['spkmgr'] =='Tidak Ada Data') {
                        $spkmgr="SPKMGR, ";
                       }else{
                        $spkmgr='';
                       } 
                      if ($dt['stdp'] =='Tidak Ada Data') {
                        $stdp="STDP, ";
                       }else{
                        $stdp='';
                       }
                      if ($dt['siup'] =='Tidak Ada Data') {
                        $siup="SIUP, ";
                       }else{
                        $siup='';
                       }
                      if ($dt['sktu'] =='Tidak Ada Data') {
                        $sktu="SKTU, ";
                       }else{
                        $sktu='';
                       }
                      if ($dt['siujk'] =='Tidak Ada Data') {
                        $siujk= "SIUJK, ";
                       } else{
                        $siujk='';
                       }
                      if ($dt['spt'] =='Tidak Ada Data') {
                         $spt= "SPT, ";
                       } else{
                        $spt='';
                       }
                       if ($dt['npwp_file'] =='Tidak Ada Data') {
                          $npwp="NPWP, ";
                       } else{
                        $npwp='';
                       }
                      if ($dt['ktp'] =='Tidak Ada Data') {
                        $ktp=  "KTP, ";
                       }else{
                        $ktp ='';
                       } 
                       if ($dt['laporan_keuangan'] =='Tidak Ada Data') {
                           $lp="Laporan keuangan, ";
                       }else{
                        $lp='';
                       } 
                       if ($dt['proyek_sebelumnya'] =='Tidak Ada Data') {
                          $ps = "Proyek Sebelumnya, ";
                       }else{
                        $ps ='';
                       }  
            ?>
            <tr>
                <td><?php echo $no++; ?></b></td>
                <td><?php echo $dt['nama_perusahaan']; ?></td>
                <td><?php 
                if ($cp =='' and $ap=='' and $spkmgr =='' and $stdp=='' and $siup=='' and $sktu=='' and $siujk='' and $spt=='' and $npwp=='' and $ktp =='' and $lp=='' and $ps=='') {
                    echo "Data Dokumen Lengkap";
                }else{
                echo $cp."".$ap."".$spkmgr."".$stdp."".$siup."".$sktu."".$siujk."".$spt."".$npwp."".$ktp."".$lp."".$ps;
                } ?></td>
            

                <td><?php echo $dt['nama_pejabat']; ?></td>
                <td><?php echo $dt['nama_agent']; ?></td>
            </tr>

            <?php
            } ?>

        </table>

 
    </div> 
</div> 
</body>
</html>