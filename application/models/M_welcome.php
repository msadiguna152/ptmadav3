<?php

class M_welcome extends CI_Model
{
    public function cetak_umum($tgl_awal, $tgl_akhir, $pejabat)
    {

        $where = '';
        $where2 = '';

        if ($tgl_awal != '' and $tgl_akhir != '') {
            $where = "WHERE tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'";
        }

        if ($pejabat != '') {
            $where2 = "kd_pejabat = '$pejabat'";

            if ($tgl_awal == '' and $tgl_akhir == '') {
                $where2 = "WHERE " . $where2;
            } else {
                $where2 = "AND " . $where2;
            }
        }

        return $this->db->query("SELECT
            tanggal,
            keterangan,
            CASE
                WHEN jenis_transaksi != 'Kredit' THEN jumlah
                ELSE 0
            END AS debit,
            CASE
                WHEN jenis_transaksi != 'Debit' THEN jumlah
                ELSE 0
            END AS kredit
        FROM
            transaksi_umum

            $where 
		$where2
        ORDER BY
            tanggal DESC
		")->result();
    }
}
