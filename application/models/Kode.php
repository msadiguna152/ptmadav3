<?php

/**
 * 
 */
class Kode extends CI_Model
{
	/**
======================================================================================
Kode Bidang
======================================================================================
	 */
	public function kode_dokumen(){

		$this->db->select('RIGHT(dokumen.kd_dokumen,3) as kode', FALSE);
		$this->db->order_by('kd_dokumen', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('dokumen');      //cek dulu apakah ada sudah ada kode di tabel. 

		if ($query->num_rows() == 0) {

			$kode = 1;
		} else {

			$data = $query->row();
			$kode = intval($data->kode) + 1;
		}

		$kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0

		$kodejadi = "DOC" . $kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;
	}


	public function kode_permohonan()   {
		$d = date('d');
		$m = date('m');
		  $this->db->select('RIGHT(permohonan.no_urut,4) as kode', FALSE);
		  $this->db->order_by('no_urut','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('permohonan');      //cek dulu apakah ada sudah ada kode di tabel. 

		  if ($d == 01 AND $m == 01){
		  	
		  	$kode = 1;

		  }elseif($query->num_rows() == 0 ){
		  	$kode = 1;
		  }else{

		  	$data = $query->row();      
		    $kode = intval($data->kode) + 1;
		  }   
		  
		  $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		  $c = array('','I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII');
		  $d = date('Y');
		  $kodejadi = $kodemax."/SP-MADA/".$c[date('n')]."/".$d;    // hasilnya ODJ-9921-0001 dst.
		  return $kodejadi;
	}


	public function kd_perusahaan()
	{
		$this->db->select('RIGHT(perusahaan.kd_perusahaan,4) as kode', FALSE);
		$this->db->order_by('kd_perusahaan', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('perusahaan');      //cek dulu apakah ada sudah ada kode di tabel. 

		if ($query->num_rows() == 0) {

			$kode = 1;
		} else {

			$data = $query->row();
			$kode = intval($data->kode) + 1;
		}

		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0

		$kodejadi = "PSHN" . $kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;
	}

	public function kd_pejabat()
	{
		$this->db->select('RIGHT(pejabat.kd_pejabat,4) as kode', FALSE);
		$this->db->order_by('kd_pejabat', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('pejabat');      //cek dulu apakah ada sudah ada kode di tabel. 

		if ($query->num_rows() == 0) {

			$kode = 1;
		} else {

			$data = $query->row();
			$kode = intval($data->kode) + 1;
		}

		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0

		$kodejadi = "PJBT" . $kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;
	}

	public function kd_agent()
	{
		$this->db->select('RIGHT(agent.kd_agent,4) as kode', FALSE);
		$this->db->order_by('kd_agent', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('agent');      //cek dulu apakah ada sudah ada kode di tabel. 

		if ($query->num_rows() == 0) {

			$kode = 1;
		} else {

			$data = $query->row();
			$kode = intval($data->kode) + 1;
		}

		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0

		$kodejadi = "AGNT" . $kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;
	}

}
