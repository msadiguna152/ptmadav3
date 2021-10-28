<?php

/**
 * 
 */
class M_mada extends CI_Model
{

	public function get_dashboard()
	{
		return $this->db->query("SELECT
			(
			SELECT
				count(*)
			FROM
				permohonan p) permohonan ,
			(
			SELECT
				count(*)
			FROM
				perusahaan p) perusahaan,
			(
			SELECT
				count(*)
			FROM
				pejabat p) pejabat,
			(
			SELECT
				count(*)
			FROM
				agent) agent,
			(
			SELECT
				count(*)
			FROM
				kabupaten) lokasi,
			(
			SELECT
				count(*)
			FROM
				dokumen ) dokumen
	")->result();
	}


	public function data_persen($id)
	{
		$query = $this->db->query("SELECT * from persen where kd_jenis='$id' order by persen ASC");
		$data = $query->result_array();

		$kabupaten = '<option value="" title="Pilih Persen">Pilih Persen</option>';
		foreach ($data as $dt) {
			$kabupaten .= '<option value="' . $dt['persen'] . '" title="' . $dt['persen'] . '">' . $dt['persen'] . ' % </option>';
		}

		return $kabupaten;
	}

	public function lihat_kabupaten()
	{
		return $this->db->get('kabupaten')->result_array();
	}

	public function get_kabupaten($kd_kabupaten)
	{
		return $this->db->query("SELECT * from kabupaten where kd_kabupaten='$kd_kabupaten'")->row_array();
	}

	public function proses_tambah_kabupaten()
	{
		$data = array(
			'kd_kabupaten' => '',
			'kabupaten' => $_POST['lokasi']
		);

		$this->db->insert('kabupaten', $data);
	}

	public function proses_edit_kabupaten()
	{
		$data = array(
			'kabupaten' => $_POST['lokasi']
		);

		$this->db->where('kd_kabupaten', $_POST['kd_kabupaten']);
		$this->db->update('kabupaten', $data);
	}

	public function hapus_kabupaten($kd_kabupaten)
	{
		$this->db->where('kd_kabupaten', $kd_kabupaten);
		$this->db->delete('kabupaten');
	}

	public function lihat_jenis_permohonan()
	{
		return $this->db->get('jenis_permohonan')->result_array();
	}

	public function get_jenis_permohonan($kd_jp)
	{
		return $this->db->query("SELECT * from jenis_permohonan where kd_jp='$kd_jp'")->row_array();
	}

	public function proses_tambah_jenis_permohonan()
	{
		$data = array(
			'kd_jp' => '',
			'jenis_permohonan' => $_POST['jenis'],
			'jenis' => $_POST['jns']
		);

		$this->db->insert('jenis_permohonan', $data);
	}

	public function proses_edit_jenis_permohonan()
	{
		$data = array(
			'jenis_permohonan' => $_POST['jenis'],
			'jenis' => $_POST['jns']
		);

		$this->db->where('kd_jp', $_POST['kd_jp']);
		$this->db->update('jenis_permohonan', $data);
	}

	public function hapus_jenis_permohonan($kd_jp)
	{
		$this->db->where('kd_jp', $kd_jp);
		$this->db->delete('jenis_permohonan');
	}



	public function lihat_instansi()
	{
		return $this->db->query("SELECT * from instansi where status='Aktif' order by id_instansi DESC")->result_array();
	}

	public function proses_tambah_instansi()
	{
		$data = array(
			'id_instansi' => '',
			'instansi' => $_POST['nama'],
			'pemilik_proyek' => $_POST['pemilik_proyek'],
			'alamat_instansi' => $_POST['alamat'],
			'status' => 'Aktif'
		);

		$this->db->insert('instansi', $data);
	}

	public function get_instansi($id_instansi)
	{
		return $this->db->query("SELECT * from instansi where id_instansi='$id_instansi'")->row_array();
	}

	public function lihat_permohonan_instansi($id_instansi)
	{
		return $query = $this->db->query("SELECT permohonan.tgl_permohonan,permohonan.tgl_komitmen,permohonan.catatan_dokumen,permohonan.status,perusahaan.jab_pimpinan, permohonan.pemilik, permohonan.alamat_perusahaan, permohonan.id_permohonan,permohonan.no_permohonan,kabupaten.kd_kabupaten,dokumen.kd_dokumen,perusahaan.nama_perusahaan,agent.kd_agent, perusahaan.no_telpon, perusahaan.no_fax,perusahaan.email, perusahaan.alamat,perusahaan.nama_direktur, permohonan.no_urut, permohonan.persen,jenis_permohonan.jenis_permohonan, permohonan.nilai_jaminan,instansi.instansi,instansi.alamat_instansi,kabupaten.kabupaten,agent.nama_agent,dokumen.dokumen, permohonan.jangka_waktu, permohonan.dari_tgl, permohonan.sampai_tgl, permohonan.nama_pekerjaan, permohonan.nilai_proyek, permohonan.file_dokumen, permohonan.tgl_dokumen, permohonan.no_dokumen, perusahaan.kd_perusahaan,jenis_permohonan.kd_jp, instansi.id_instansi,instansi.pemilik_proyek, perusahaan.nama_perusahaan,permohonan.sertifikat, pejabat.kd_pejabat, pejabat.nama_pejabat, jenis_jaminan.kd_jenis, jenis_jaminan.jenis_jaminan from jenis_jaminan join permohonan on jenis_jaminan.kd_jenis=permohonan.id_persen join perusahaan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat join jenis_permohonan on jenis_permohonan.kd_jp=permohonan.kd_jp join instansi on instansi.id_instansi=permohonan.id_instansi join kabupaten on kabupaten.kd_kabupaten=permohonan.kd_kabupaten join agent on agent.kd_agent=permohonan.kd_agent join dokumen on dokumen.kd_dokumen=permohonan.kd_dokumen where permohonan.id_instansi='$id_instansi'")->result_array();
	}

	public function proses_edit_instansi()
	{
		$data = array(
			'instansi' => $_POST['nama'],
			'pemilik_proyek' => $_POST['pemilik_proyek'],
			'alamat_instansi' => $_POST['alamat']
		);

		$this->db->where('id_instansi', $_POST['id_instansi']);
		$this->db->update('instansi', $data);
	}

	public function hapus_instansi($id_instansi)
	{
		$data = array(
			'status' => 'Tidak'
		);

		$this->db->where('id_instansi', $id_instansi);
		$this->db->update('instansi', $data);
	}



	public function lihat_perusahaan()
	{
		$query = $this->db->query("SELECT * from perusahaan where status='Aktif' order by kd_perusahaan DESC");
		return $query->result_array();
	}

	public function get_perusahaan($kd_perusahaan)
	{
		$query = $this->db->query("SELECT perusahaan.kd_perusahaan, perusahaan.nama_perusahaan, perusahaan.nama_direktur, perusahaan.jab_pimpinan, perusahaan.email, perusahaan.no_fax, perusahaan.no_telpon, perusahaan.alamat, perusahaan.company_profile, perusahaan.akta_pendirian, perusahaan.spkmgr, perusahaan.stdp, perusahaan.siup, perusahaan.sktu, perusahaan.siujk, perusahaan.spt, perusahaan.npwp, perusahaan.ktp, perusahaan.laporan_keuangan, perusahaan.proyek_sebelumnya, perusahaan.npwp_file, agent.kd_agent, agent.nama_agent, pejabat.kd_pejabat, pejabat.nama_pejabat from agent join perusahaan on agent.kd_agent=perusahaan.kd_agent join pejabat on pejabat.kd_pejabat=perusahaan.kd_pejabat where perusahaan.kd_perusahaan='$kd_perusahaan'");
		return $query->row_array();
	}

	public function proses_tambah_perusahaan()
	{
		$config = array(
			'upload_path' => './file/persyaratan/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

		);

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('company_profil')) {
			$company_profil = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$company_profil = $result['file_name'];
		}

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('akta_pendirian')) {
			$akta_pendirian = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$akta_pendirian = $result['file_name'];
		}

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('spkmgr')) {
			$spkmgr = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$spkmgr = $result['file_name'];
		}

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('stdp')) {
			$stdp = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$stdp = $result['file_name'];
		}

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('siup')) {
			$siup = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$siup = $result['file_name'];
		}

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('sktu')) {
			$sktu = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$sktu = $result['file_name'];
		}

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('siujk')) {
			$siujk = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$siujk = $result['file_name'];
		}

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('spt')) {
			$spt = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$spt = $result['file_name'];
		}

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('ktp')) {
			$ktp = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$ktp = $result['file_name'];
		}

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('laporan')) {
			$laporan_keuangan = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$laporan_keuangan = $result['file_name'];
		}

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('proyek')) {
			$proyek_sebelumnya = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$proyek_sebelumnya = $result['file_name'];
		}

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('npwp_file')) {
			$npwp_file = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$npwp_file  = $result['file_name'];
		}

		$data = array(
			'kd_perusahaan' => $_POST['kd_perusahaan'],
			'nama_direktur' => $_POST['nama_direktur'],
			'nama_perusahaan' => $_POST['nama_perusahaan'],
			'npwp' => $_POST['npwp'],
			'email' => $_POST['email'],
			'no_telpon' => $_POST['no_telpon'],
			'no_fax' => $_POST['no_fax'],
			'alamat' => $_POST['alamat'],
			'jab_pimpinan' => $_POST['Jabatan'],
			'kd_agent' => $_POST['kd_agent'],
			'kd_pejabat' => $_POST['kd_pejabat'],
			'company_profile' => $company_profil,
			'akta_pendirian' => $akta_pendirian,
			'spkmgr' => $spkmgr,
			'stdp' => $stdp,
			'siup' => $siup,
			'sktu' => $sktu,
			'siujk' => $siujk,
			'spt' => $spt,
			'ktp' => $ktp,
			'laporan_keuangan' => $laporan_keuangan,
			'proyek_sebelumnya' => $proyek_sebelumnya,
			'status' => 'Aktif',
			'npwp_file' => $npwp_file,

		);

		$this->db->insert('perusahaan', $data);
	}

	public function proses_edit_perusahaan()
	{
		$config = array(
			'upload_path' => './file/persyaratan/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

		);

		//$this->upload->do_upload('company_profil') == "Tidak Ada Data"
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('company_profil') == NUll) {
			$company_profil = $_POST['company_profile_lama'];
		} else {
			if (!$this->upload->do_upload('company_profil')) {
				$company_profil = 'Tidak Ada Data';
			} else {
				$result = $this->upload->data();
				$company_profil = $result['file_name'];
			}
		}

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('akta_pendirian') == NUll) {
			$akta_pendirian = $_POST['akta_pendirian_lama'];
		} else {
			if (!$this->upload->do_upload('akta_pendirian')) {
				$akta_pendirian = 'Tidak Ada Data';
			} else {
				$result = $this->upload->data();
				$akta_pendirian = $result['file_name'];
			}
		}

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('spkmgr') == NUll) {
			$spkmgr = $_POST['spkmgr_lama'];
		} else {
			if (!$this->upload->do_upload('spkmgr')) {
				$spkmgr = 'Tidak Ada Data';
			} else {
				$result = $this->upload->data();
				$spkmgr = $result['file_name'];
			}
		}

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('stdp') == NUll) {
			$stdp = $_POST['stdp_lama'];
		} else {
			if (!$this->upload->do_upload('stdp')) {
				$stdp = 'Tidak Ada Data';
			} else {
				$result = $this->upload->data();
				$stdp = $result['file_name'];
			}
		}

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('siup') == NUll) {
			$siup = $_POST['siup_lama'];
		} else {
			if (!$this->upload->do_upload('siup')) {
				$siup = 'Tidak Ada Data';
			} else {
				$result = $this->upload->data();
				$siup = $result['file_name'];
			}
		}

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('sktu') == NUll) {
			$sktu = $_POST['sktu_lama'];
		} else {
			if (!$this->upload->do_upload('sktu')) {
				$sktu = 'Tidak Ada Data';
			} else {
				$result = $this->upload->data();
				$sktu = $result['file_name'];
			}
		}

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('siujk') == NUll) {
			$siujk = $_POST['siujk_lama'];
		} else {
			if (!$this->upload->do_upload('siujk')) {
				$siujk = 'Tidak Ada Data';
			} else {
				$result = $this->upload->data();
				$siujk = $result['file_name'];
			}
		}


		$this->load->library('upload', $config);
		if ($this->upload->do_upload('spt') == NUll) {
			$spt = $_POST['spt_lama'];
		} else {
			if (!$this->upload->do_upload('spt')) {
				$spt = 'Tidak Ada Data';
			} else {
				$result = $this->upload->data();
				$spt = $result['file_name'];
			}
		}

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('ktp') == NUll) {
			$ktp = $_POST['ktp_lama'];
		} else {
			if (!$this->upload->do_upload('ktp')) {
				$ktp = 'Tidak Ada Data';
			} else {
				$result = $this->upload->data();
				$ktp = $result['file_name'];
			}
		}

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('laporan') == NUll) {
			$laporan_keuangan = $_POST['laporan_lama'];
		} else {
			if (!$this->upload->do_upload('laporan')) {
				$laporan_keuangan = 'Tidak Ada Data';
			} else {
				$result = $this->upload->data();
				$laporan_keuangan = $result['file_name'];
			}
		}

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('proyek') == NUll) {
			$proyek_sebelumnya = $_POST['proyek_lama'];
		} else {
			if (!$this->upload->do_upload('proyek')) {
				$proyek_sebelumnya = 'Tidak Ada Data';
			} else {
				$result = $this->upload->data();
				$proyek_sebelumnya = $result['file_name'];
			}
		}

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('npwp_file') == NUll) {
			$npwp_file = $_POST['npwp_lama'];
		} else {
			if (!$this->upload->do_upload('npwp_file')) {
				$npwp_file = 'Tidak Ada Data';
			} else {
				$result = $this->upload->data();
				$npwp_file = $result['file_name'];
			}
		}

		$data = array(
			'kd_perusahaan' => $_POST['kd_perusahaan'],
			'nama_perusahaan' => $_POST['nama_perusahaan'],
			'nama_direktur' => $_POST['nama_direktur'],
			'npwp' => $_POST['npwp'],
			'email' => $_POST['email'],
			'no_telpon' => $_POST['no_telpon'],
			'no_fax' => $_POST['no_fax'],
			'alamat' => $_POST['alamat'],
			'jab_pimpinan' => $_POST['Jabatan'],
			'kd_agent' => $_POST['kd_agent'],
			'kd_pejabat' => $_POST['kd_pejabat'],
			'company_profile' => $company_profil,
			'akta_pendirian' => $akta_pendirian,
			'spkmgr' => $spkmgr,
			'stdp' => $stdp,
			'siup' => $siup,
			'sktu' => $sktu,
			'siujk' => $siujk,
			'spt' => $spt,
			'ktp' => $ktp,
			'laporan_keuangan' => $laporan_keuangan,
			'proyek_sebelumnya' => $proyek_sebelumnya,
			'status' => 'Aktif',
			'npwp_file' => $npwp_file

		);

		$this->db->where('kd_perusahaan', $_POST['kd_perusahaan']);
		$this->db->update('perusahaan', $data);
	}


	public function hapus_perusahaan($kd_perusahaan)
	{
		$data = array(
			'status' => 'Hapus'
		);

		$this->db->where('kd_perusahaan', $kd_perusahaan);
		$this->db->update('perusahaan', $data);
	}

	public function lihat_pejabat()
	{
		$query = $this->db->query("SELECT * from pejabat where status='Aktif' order by kd_pejabat DESC");
		return $query->result_array();
	}


	public function proses_tambah_pejabat()
	{
		$kd_pejabat = $this->input->post('kd_pejabat');
		$nip = $this->input->post('nip');
		$nama_pejabat = $this->input->post('nama_pejabat');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$no_telp = $this->input->post('no_telp');
		$instansi = $this->input->post('instansi');
		$status = "Aktif";

		$data = array(
			'kd_pejabat' => $kd_pejabat,
			'nip' => $nip,
			'nama_pejabat' => $nama_pejabat,
			'alamat' => $alamat,
			'email' => $email,
			'no_telp' => $no_telp,
			'instansi' => $instansi,
			'status' => $status
		);
		//print_r($data);
		$this->db->insert('pejabat', $data);
	}

	public function lihat_permohonan_perusahaan($kd_perusahaan)
	{

		return $query = $this->db->query("SELECT permohonan.tgl_permohonan,permohonan.tgl_komitmen,permohonan.catatan_dokumen,permohonan.status,perusahaan.jab_pimpinan, permohonan.pemilik, permohonan.alamat_perusahaan, permohonan.id_permohonan,permohonan.no_permohonan,kabupaten.kd_kabupaten,dokumen.kd_dokumen,perusahaan.nama_perusahaan,agent.kd_agent, perusahaan.no_telpon, perusahaan.no_fax,perusahaan.email, perusahaan.alamat,perusahaan.nama_direktur, permohonan.no_urut, permohonan.persen,jenis_permohonan.jenis_permohonan, permohonan.nilai_jaminan,instansi.instansi,instansi.alamat_instansi,kabupaten.kabupaten,agent.nama_agent,dokumen.dokumen, permohonan.jangka_waktu, permohonan.dari_tgl, permohonan.sampai_tgl, permohonan.nama_pekerjaan, permohonan.nilai_proyek, permohonan.file_dokumen, permohonan.tgl_dokumen, permohonan.no_dokumen, perusahaan.kd_perusahaan,jenis_permohonan.kd_jp, instansi.id_instansi,instansi.pemilik_proyek, perusahaan.nama_perusahaan,permohonan.sertifikat, pejabat.kd_pejabat, pejabat.nama_pejabat, jenis_jaminan.kd_jenis, jenis_jaminan.jenis_jaminan from jenis_jaminan join permohonan on jenis_jaminan.kd_jenis=permohonan.id_persen join perusahaan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat join jenis_permohonan on jenis_permohonan.kd_jp=permohonan.kd_jp join instansi on instansi.id_instansi=permohonan.id_instansi join kabupaten on kabupaten.kd_kabupaten=permohonan.kd_kabupaten join agent on agent.kd_agent=permohonan.kd_agent join dokumen on dokumen.kd_dokumen=permohonan.kd_dokumen where permohonan.kd_perusahaan='$kd_perusahaan'")->result_array();
	}

	public function get_pejabat($kd_pejabat)
	{
		$query = $this->db->query("SELECT * FROM pejabat WHERE kd_pejabat='$kd_pejabat'");
		$query2 = $this->db->query("SELECT permohonan.no_permohonan, permohonan.id_permohonan, perusahaan.nama_perusahaan,perusahaan.kd_perusahaan,pejabat.kd_pejabat, pejabat.nama_pejabat,permohonan.nama_pekerjaan, permohonan.nilai_proyek, jenis_jaminan.jenis_jaminan 
		from perusahaan 
		join permohonan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan 
		join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat 
		join persen on persen.persen=permohonan.persen 
		join jenis_jaminan on jenis_jaminan.kd_jenis=persen.kd_jenis 
		where permohonan.kd_pejabat='$kd_pejabat' order by permohonan.id_permohonan DESC")->result_array();
		//$query2 = $this->db->query("SELECT permohonan.no_permohonan, permohonan.id_permohonan, perusahaan.nama_perusahaan,perusahaan.kd_perusahaan,pejabat.kd_pejabat, pejabat.nama_pejabat,permohonan.nama_pekerjaan, permohonan.nilai_proyek, jenis_jaminan.jenis_jaminan from perusahaan join permohonan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat join persen on persen.id_persen=permohonan.id_persen join jenis_jaminan on jenis_jaminan.kd_jenis=persen.kd_jenis where permohonan.kd_pejabat='$kd_pejabat' order by permohonan.id_permohonan DESC")->result_array(); //query asal
		return $query->row_array();
		return $query2;
	}

	public function proses_edit_pejabat()
	{
		$data = array(
			'nip' => $_POST['nip'],
			'nama_pejabat' => $_POST['nama_pejabat'],
			'alamat' => $_POST['alamat'],
			'email' => $_POST['email'],
			'no_telp' => $_POST['no_telp'],
			'instansi' => $_POST['instansi']

		);

		$this->db->where('kd_pejabat', $_POST['kd_pejabat']);
		$this->db->update('pejabat', $data);
	}

	public function hapus_pejabat($id)
	{
		$data = array(
			'status' => 'Tidak Aktif'
		);

		$this->db->where('kd_pejabat', $id);
		$this->db->update('pejabat', $data);
	}

	public function lihat_dokumen()
	{
		return $this->db->get('dokumen')->result_array();
	}

	public function proses_tambah_dokumen()
	{
		$data = array(
			'kd_dokumen' => $_POST['kd_dokumen'],
			'dokumen' => $_POST['dokumen']
		);

		$this->db->insert('dokumen', $data);
	}

	public function get_dokumen($kd_dokumen)
	{
		return $this->db->query("SELECT * from dokumen where kd_dokumen='$kd_dokumen'")->row_array();
	}

	public function proses_edit_dokumen()
	{
		$data = array(
			'dokumen' => $_POST['dokumen']
		);

		$this->db->where('kd_dokumen', $_POST['kd_dokumen']);
		$this->db->update('dokumen', $data);
	}

	public function hapus_dokumen($kd_dokumen)
	{
		$this->db->where('kd_dokumen', $kd_dokumen);
		$this->db->delete('dokumen');
	}



	public function lihat_jenis_jaminan()
	{
		return $this->db->get('jenis_jaminan')->result_array();
	}

	public function lihat_permohonan()
	{
		$query = $this->db->query("SELECT permohonan.no_permohonan, permohonan.id_permohonan, perusahaan.nama_perusahaan,perusahaan.kd_perusahaan,pejabat.kd_pejabat, pejabat.nama_pejabat,permohonan.nama_pekerjaan, permohonan.nilai_proyek from perusahaan join permohonan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat  order by permohonan.id_permohonan DESC")->result_array();
		//$query = $this->db->query("SELECT permohonan.no_permohonan, permohonan.id_permohonan, perusahaan.nama_perusahaan,perusahaan.kd_perusahaan,pejabat.kd_pejabat, pejabat.nama_pejabat,permohonan.nama_pekerjaan, permohonan.nilai_proyek, jenis_jaminan.jenis_jaminan from perusahaan join permohonan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat join persen on persen.persen=permohonan.persen join jenis_jaminan on jenis_jaminan.kd_jenis=persen.kd_jenis order by permohonan.id_permohonan DESC")->result_array();
		return $query;
	}

	public function ambil_tgl($tgl,$jml)
	{
		$jml =$jml-1;
		$data = array(
			'id' => '' ,
			'dari_tgl' => date('Y-m-d',strtotime($tgl)),
			'jml' => $jml-1 
		);

		$this->db->insert('tgl',$data);

		$dt = $this->db->query("SELECT date_add(dari_tgl, interval " . $jml . " day ) as sampai from tgl order by id DESC limit 1")->row_array();

		$tgl_sampai = date('d/m/Y',strtotime($dt['sampai']));
		return $tgl_sampai;

	}

	public function get_permohonan($id_permohonan)
	{
		return $query = $this->db->query("SELECT permohonan.tgl_permohonan,permohonan.tgl_komitmen,permohonan.catatan_dokumen,permohonan.status,perusahaan.jab_pimpinan, permohonan.pemilik, permohonan.alamat_perusahaan, permohonan.id_permohonan,permohonan.no_permohonan,kabupaten.kd_kabupaten,dokumen.kd_dokumen,perusahaan.nama_perusahaan,agent.kd_agent, perusahaan.no_telpon, perusahaan.no_fax,perusahaan.email, perusahaan.alamat,perusahaan.nama_direktur, permohonan.no_urut, permohonan.persen,jenis_permohonan.jenis_permohonan, permohonan.nilai_jaminan,instansi.instansi,instansi.alamat_instansi,kabupaten.kabupaten,agent.nama_agent,dokumen.dokumen, permohonan.jangka_waktu, permohonan.dari_tgl, permohonan.sampai_tgl, permohonan.nama_pekerjaan, permohonan.nilai_proyek, permohonan.file_dokumen, permohonan.tgl_dokumen, permohonan.no_dokumen, perusahaan.kd_perusahaan,jenis_permohonan.kd_jp, instansi.id_instansi,instansi.pemilik_proyek, perusahaan.nama_perusahaan,permohonan.sertifikat, pejabat.kd_pejabat, pejabat.nama_pejabat, jenis_jaminan.kd_jenis, jenis_jaminan.jenis_jaminan from jenis_jaminan join permohonan on jenis_jaminan.kd_jenis=permohonan.id_persen join perusahaan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat join jenis_permohonan on jenis_permohonan.kd_jp=permohonan.kd_jp join instansi on instansi.id_instansi=permohonan.id_instansi join kabupaten on kabupaten.kd_kabupaten=permohonan.kd_kabupaten join agent on agent.kd_agent=permohonan.kd_agent join dokumen on dokumen.kd_dokumen=permohonan.kd_dokumen where permohonan.id_permohonan='$id_permohonan'")->row_array();
	}

	public function lihat_permohonan_pjbt($kd_pejabat)
	{
		return $query = $this->db->query("SELECT permohonan.tgl_permohonan,permohonan.tgl_komitmen,permohonan.catatan_dokumen,permohonan.status,perusahaan.jab_pimpinan, permohonan.pemilik, permohonan.alamat_perusahaan, permohonan.id_permohonan,permohonan.no_permohonan,kabupaten.kd_kabupaten,dokumen.kd_dokumen,perusahaan.nama_perusahaan,agent.kd_agent, perusahaan.no_telpon, perusahaan.no_fax,perusahaan.email, perusahaan.alamat,perusahaan.nama_direktur, permohonan.no_urut, permohonan.persen,jenis_permohonan.jenis_permohonan, permohonan.nilai_jaminan,instansi.instansi,instansi.alamat_instansi,kabupaten.kabupaten,agent.nama_agent,dokumen.dokumen, permohonan.jangka_waktu, permohonan.dari_tgl, permohonan.sampai_tgl, permohonan.nama_pekerjaan, permohonan.nilai_proyek, permohonan.file_dokumen, permohonan.tgl_dokumen, permohonan.no_dokumen, perusahaan.kd_perusahaan,jenis_permohonan.kd_jp, instansi.id_instansi,instansi.pemilik_proyek, perusahaan.nama_perusahaan,permohonan.sertifikat, pejabat.kd_pejabat, pejabat.nama_pejabat, jenis_jaminan.kd_jenis, jenis_jaminan.jenis_jaminan from jenis_jaminan join permohonan on jenis_jaminan.kd_jenis=permohonan.id_persen join perusahaan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat join jenis_permohonan on jenis_permohonan.kd_jp=permohonan.kd_jp join instansi on instansi.id_instansi=permohonan.id_instansi join kabupaten on kabupaten.kd_kabupaten=permohonan.kd_kabupaten join agent on agent.kd_agent=permohonan.kd_agent join dokumen on dokumen.kd_dokumen=permohonan.kd_dokumen where permohonan.kd_pejabat='$kd_pejabat'")->result_array();
	}

	public function proses_tambah_permohonan()
	{
		$config = array(
			'upload_path' => './file/Permohonan/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

		);

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('file_dokumen')) {
			$file_dokumen = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$file_dokumen = $result['file_name'];
		}




		$no_urut = substr($_POST['no_permohonan'], 0, 4);
		$tg = str_replace("/","-", $_POST['tgl_sampai']);
		
		$data = array(
			'id_permohonan' => '',
			'no_permohonan' => $_POST['no_permohonan'],
			'kd_perusahaan' => $_POST['kd_perusahaan'],
			'no_urut' => $no_urut,
			'kd_pejabat' => $_POST['kd_pejabat'],
			'id_persen' => $_POST['kd_jenis'],
			'persen' => $_POST['persen'],
			'nilai_jaminan' => $_POST['nilai_jaminan'],
			'jangka_waktu' => $_POST['jangka_waktu'],
			'dari_tgl' => date('Y-m-d', strtotime($_POST['dari_tgl'])),
			'sampai_tgl' => date('Y-m-d', strtotime($tg)),
			'kd_jp' => $_POST['kd_jp'],
			'id_instansi' => $_POST['id_instansi'],
			'nama_pekerjaan' => $_POST['nama_pekerjaan'],
			'kd_kabupaten' => $_POST['kd_kabupaten'],
			'nilai_proyek' => $_POST['nilai_proyek'],
			'kd_dokumen' => $_POST['kd_dokumen'],
			'file_dokumen' => $file_dokumen,
			'no_dokumen' => $_POST['no_dokumen'],
			'tgl_dokumen' => date('Y-m-d', strtotime($_POST['tgl_dokumen'])),
			'Sertifikat' => 'Tidak Ada Data',
			'kd_agent' => $_POST['kd_agent'],
			'tgl_permohonan' => date('Y-m-d', strtotime($_POST['tgl_permohonan'])),
			'tgl_komitmen' => date('Y-m-d',strtotime($_POST['tgl_komitmen'])),
			'catatan_dokumen' => $_POST['catatan'],
			'status' => $_POST['status'],
			'alamat_perusahaan' => $_POST['alamat_perusahaan'],
			'pemilik' => $_POST['pemilik'],

		);
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		$this->db->insert('permohonan', $data);

		// $sql = $this->db->query("SELECT id_permohonan from permohonan order by id_permohonan DESC limit 1")->row_array();

		// $id_permohonan = $sql['id_permohonan'];

		// $jangka = $_POST['jangka_waktu'] - 1;

		// $query = $this->db->query("SELECT date_add(dari_tgl, interval " . $jangka . " day ) as sampai from permohonan where id_permohonan='$id_permohonan'  ")->row_array();
		// $tgl_sampai = $query['sampai'];

		// $data1 = array(
		// 	'sampai_tgl' => $tgl_sampai
		// );

		// //print_r($data1);

		// $this->db->where('id_permohonan', $id_permohonan);
		// $this->db->update('permohonan', $data1);
	}

	public function proses_edit_permohonan()
	{
		$config = array(
			'upload_path' => './file/Permohonan/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

		);

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file_dokumen')) {
			$file_dokumen = $_POST['file_dokumen_lama'];
		} else {
			$result = $this->upload->data();
			$file_dokumen = $result['file_name'];
		}


		$tg = str_replace("/","-", $_POST['tgl_sampai']);
		$data = array(
			'no_permohonan' => $_POST['no_permohonan'],
			'kd_perusahaan' => $_POST['kd_perusahaan'],
			'kd_pejabat' => $_POST['kd_pejabat'],
			'id_persen' => $_POST['kd_jenis'],
			'jangka_waktu' => $_POST['jangka_waktu'],
			'persen' => $_POST['persen'],
			'nilai_jaminan' => $_POST['nilai_jaminan'],
			'dari_tgl' => date('Y-m-d', strtotime($_POST['dari_tgl'])),
			'sampai_tgl' => date('Y-m-d', strtotime($tg)),
			'kd_jp' => $_POST['kd_jp'],
			'id_instansi' => $_POST['id_instansi'],
			'nama_pekerjaan' => $_POST['nama_pekerjaan'],
			'kd_kabupaten' => $_POST['kd_kabupaten'],
			'nilai_proyek' => $_POST['nilai_proyek'],
			'kd_dokumen' => $_POST['kd_dokumen'],
			'file_dokumen' => $file_dokumen,
			'no_dokumen' => $_POST['no_dokumen'],
			'tgl_dokumen' => date('Y-m-d', strtotime($_POST['tgl_dokumen'])),
			'kd_agent' => $_POST['kd_agent'],
			'tgl_permohonan' => date('Y-m-d', strtotime($_POST['tgl_permohonan'])),
			'tgl_komitmen' => date('Y-m-d',strtotime($_POST['tgl_komitmen'])),
			'catatan_dokumen' => $_POST['catatan'],
			'status' => $_POST['status'],
			'alamat_perusahaan' => $_POST['alamat_perusahaan'],
			'pemilik' => $_POST['pemilik']
		);
		//print_r($data);
		$this->db->where('id_permohonan', $_POST['id_permohonan']);
		$this->db->update('permohonan', $data);


		// $jangka = $_POST['jangka_waktu'] - 1;

		// $query = $this->db->query("SELECT date_add(dari_tgl, interval " . $jangka . " day ) as sampai from permohonan where id_permohonan='" . $_POST['id_permohonan'] . "'")->row_array();
		// $tgl_sampai = $query['sampai'];

		// $data1 = array(
		// 	'sampai_tgl' => $tgl_sampai
		// );

		// $id_permohonan = $_POST['id_permohonan'];

		// //print_r($data1);

		// $this->db->where('id_permohonan', $id_permohonan);
		// $this->db->update('permohonan', $data1);
	}

	public function hapus_permohonan($id)
	{
		$this->db->where('id_permohonan', $id);
		$this->db->delete('permohonan');
	}


	public function lihat_agent()
	{
		$query = $this->db->query("SELECT * FROM agent WHERE status='Aktif' order by kd_agent DESC");
		return $query->result_array();
	}

	public function proses_tambah_agent()
	{
		$kd_agent = $this->input->post('kd_agent');
		$induk = $this->input->post('induk');
		$nama_agent = $this->input->post('nama_agent');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$no_telp = $this->input->post('no_telp');
		$status = "Aktif";

		$data = array(
			'kd_agent' => $kd_agent,
			'induk' => $induk,
			'nama_agent' => $nama_agent,
			'alamat' => $alamat,
			'email' => $email,
			'no_telp' => $no_telp,
			'status' => $status
		);
		//print_r($data);
		$this->db->insert('agent', $data);
	}

	public function hapus_agent($id)
	{
		$data = array(
			'status' => 'Tidak Aktif'
		);

		$this->db->where('kd_agent', $id);
		$this->db->update('agent', $data);
	}

	public function get_agent($kd_agent)
	{
		$query = $this->db->query("SELECT * FROM agent WHERE kd_agent='$kd_agent'");
		// $query2 = $this->db->query("SELECT permohonan.no_permohonan, permohonan.id_permohonan, perusahaan.nama_perusahaan,perusahaan.kd_perusahaan,agent.kd_agent, agent.nama_agent,permohonan.nama_pekerjaan, permohonan.nilai_proyek, jenis_jaminan.jenis_jaminan 
		// from perusahaan 
		// join permohonan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan 
		// join penjabat on pejabat.kd_agent=permohonan.kd_agent 
		// join persen on persen.persen=permohonan.persen 
		// join jenis_jaminan on jenis_jaminan.kd_jenis=persen.kd_jenis 
		// where permohonan.kd_agent='$kd_agent' order by permohonan.id_permohonan DESC")->result_array();

		return $query->row_array();
		// return $query2;
	}

	public function proses_edit_agent()
	{
		$data = array(
			'induk' => $_POST['induk'],
			'nama_agent' => $_POST['nama_agent'],
			'alamat' => $_POST['alamat'],
			'email' => $_POST['email'],
			'no_telp' => $_POST['no_telp']

		);

		$this->db->where('kd_agent', $_POST['kd_agent']);
		$this->db->update('agent', $data);
	}


	public function get_histori_agent($kd_agent)
	{
		return $query = $this->db->query("SELECT permohonan.tgl_permohonan,permohonan.tgl_komitmen,permohonan.catatan_dokumen,permohonan.status,perusahaan.jab_pimpinan, permohonan.pemilik, permohonan.alamat_perusahaan, permohonan.id_permohonan,permohonan.no_permohonan,kabupaten.kd_kabupaten,dokumen.kd_dokumen,perusahaan.nama_perusahaan,agent.kd_agent, perusahaan.no_telpon, perusahaan.no_fax,perusahaan.email, perusahaan.alamat,perusahaan.nama_direktur, permohonan.no_urut, permohonan.persen,jenis_permohonan.jenis_permohonan, permohonan.nilai_jaminan,instansi.instansi,instansi.alamat_instansi,kabupaten.kabupaten,agent.nama_agent,dokumen.dokumen, permohonan.jangka_waktu, permohonan.dari_tgl, permohonan.sampai_tgl, permohonan.nama_pekerjaan, permohonan.nilai_proyek, permohonan.file_dokumen, permohonan.tgl_dokumen, permohonan.no_dokumen, perusahaan.kd_perusahaan,jenis_permohonan.kd_jp, instansi.id_instansi,instansi.pemilik_proyek, perusahaan.nama_perusahaan,permohonan.sertifikat, pejabat.kd_pejabat, pejabat.nama_pejabat, jenis_jaminan.kd_jenis, jenis_jaminan.jenis_jaminan from jenis_jaminan join permohonan on jenis_jaminan.kd_jenis=permohonan.id_persen join perusahaan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat join jenis_permohonan on jenis_permohonan.kd_jp=permohonan.kd_jp join instansi on instansi.id_instansi=permohonan.id_instansi join kabupaten on kabupaten.kd_kabupaten=permohonan.kd_kabupaten join agent on agent.kd_agent=permohonan.kd_agent join dokumen on dokumen.kd_dokumen=permohonan.kd_dokumen where permohonan.kd_agent='$kd_agent'")->result_array();
	}



	public function proses_tambah_pembayaran()
	{
		$config = array(
			'upload_path' => './file/Permohonan/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

		);

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('bukti')) {
			$bukti = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$bukti = $result['file_name'];
		}


		$data = array(
			'id_pembayaran' => '',
			'tgl_pembayaran' => date('Y-m-d', strtotime($_POST['tgl'])),
			'jml_pembayaran' => str_replace(".", "", $_POST['jml']),
			'bukti_pembayaran' => $bukti,
			'id_permohonan' => $_POST['id_permohonan']
		);

		$this->db->insert('pembayaran', $data);
	}


	public function lihat_pembayaran($id_permohonan)
	{
		return $this->db->query("SELECT * from pembayaran where id_permohonan='$id_permohonan'")->result_array();
	}

	public function get_pembayaran($id_pembayaran)
	{
		return $this->db->query("SELECT * from pembayaran where id_pembayaran='$id_pembayaran'")->row_array();
	}

	public function proses_edit_pembayaran()
	{
		$config = array(
			'upload_path' => './file/Permohonan/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

		);

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('bukti')) {
			$bukti = $_POST['bukti_lama'];
		} else {
			$result = $this->upload->data();
			$bukti = $result['file_name'];
		}


		$data = array(
			'tgl_pembayaran' => date('Y-m-d', strtotime($_POST['tgl'])),
			'jml_pembayaran' => str_replace(".", "", $_POST['jml']),
			'bukti_pembayaran' => $bukti,
			'id_permohonan' => $_POST['id_permohonan']
		);

		$this->db->where('id_pembayaran', $_POST['id_pembayaran']);
		$this->db->update('pembayaran', $data);
	}

	public function hapus_pembayaran($id_pembayaran)
	{
		$this->db->where('id_pembayaran', $id_pembayaran);
		$this->db->delete('pembayaran');
	}

	public function proses_tambah_pembayaran_jamkrida()
	{
		$config = array(
			'upload_path' => './file/Permohonan/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

		);

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('bukti')) {
			$bukti = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$bukti = $result['file_name'];
		}


		$data = array(
			'id_pembayaran' => '',
			'tgl_pembayaran' => date('Y-m-d', strtotime($_POST['tgl'])),
			'jml_pembayaran' => str_replace(".", "", $_POST['jml']),
			'bukti_pembayaran' => $bukti,
			'id_permohonan' => $_POST['id_permohonan']
		);

		$this->db->insert('pembayaran_jamkrida', $data);
	}

	public function lihat_pembayaran_jamkrida($id_permohonan)
	{
		return $this->db->query("SELECT * from pembayaran_jamkrida where id_permohonan='$id_permohonan'")->result_array();
	}

	public function get_pembayaran_jamkrida($id_pembayaran)
	{
		return $this->db->query("SELECT * from pembayaran_jamkrida where id_pembayaran='$id_pembayaran'")->row_array();
	}

	public function proses_edit_pembayaran_jamkrida()
	{
		$config = array(
			'upload_path' => './file/Permohonan/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

		);

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('bukti')) {
			$bukti = $_POST['bukti_lama'];
		} else {
			$result = $this->upload->data();
			$bukti = $result['file_name'];
		}


		$data = array(
			'tgl_pembayaran' => date('Y-m-d', strtotime($_POST['tgl'])),
			'jml_pembayaran' => str_replace(".", "", $_POST['jml']),
			'bukti_pembayaran' => $bukti,
			'id_permohonan' => $_POST['id_permohonan']
		);

		$this->db->where('id_pembayaran', $_POST['id_pembayaran']);
		$this->db->update('pembayaran_jamkrida', $data);
	}

	public function hapus_pembayaran_jamkrida($id_pembayaran)
	{
		$this->db->where('id_pembayaran', $id_pembayaran);
		$this->db->delete('pembayaran_jamkrida');
	}

	public function proses_tambah_sertifikat()
	{
		$config = array(
			'upload_path' => './file/Permohonan/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

		);

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('sertifikat')) {
			$sertifikat = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$sertifikat = $result['file_name'];
		}

		$data = array(
			'sertifikat' => $sertifikat
		);

		$this->db->where('id_permohonan', $_POST['id_permohonan']);
		$this->db->update('permohonan', $data);
		/* 		$query="UPDATE permohonan (sertifikat) VALUES ('$sertifikat') WHERE id_permohonan = '$_POST['id_permohonan']'";
		$this->db->query($query); */
	}


	public function lihat_laporan()
	{
		$query = $this->db->query("SELECT perusahaan.kd_perusahaan, perusahaan.nama_perusahaan, perusahaan.nama_direktur, perusahaan.jab_pimpinan, perusahaan.email, perusahaan.no_fax, perusahaan.no_telpon, perusahaan.alamat, perusahaan.company_profile, perusahaan.akta_pendirian, perusahaan.spkmgr, perusahaan.stdp, perusahaan.siup, perusahaan.sktu, perusahaan.siujk, perusahaan.spt, perusahaan.npwp, perusahaan.ktp, perusahaan.laporan_keuangan, perusahaan.proyek_sebelumnya, perusahaan.npwp_file, agent.kd_agent, agent.nama_agent, pejabat.kd_pejabat, pejabat.nama_pejabat from agent join perusahaan on agent.kd_agent=perusahaan.kd_agent join pejabat on pejabat.kd_pejabat=perusahaan.kd_pejabat ");
		return $query->result_array();
	}

	public function cari_laporan()
	{
		$kd_agent = $_POST['kd_agent'];
		$pejabat = $_POST['kd_pejabat'];
		if ( $pejabat !='' and $kd_agent !='') {
			$query = $this->db->query("SELECT perusahaan.kd_perusahaan, perusahaan.nama_perusahaan, perusahaan.nama_direktur, perusahaan.jab_pimpinan, perusahaan.email, perusahaan.no_fax, perusahaan.no_telpon, perusahaan.alamat, perusahaan.company_profile, perusahaan.akta_pendirian, perusahaan.spkmgr, perusahaan.stdp, perusahaan.siup, perusahaan.sktu, perusahaan.siujk, perusahaan.spt, perusahaan.npwp, perusahaan.ktp, perusahaan.laporan_keuangan, perusahaan.proyek_sebelumnya, perusahaan.npwp_file, agent.kd_agent, agent.nama_agent, pejabat.kd_pejabat, pejabat.nama_pejabat from agent join perusahaan on agent.kd_agent=perusahaan.kd_agent join pejabat on pejabat.kd_pejabat=perusahaan.kd_pejabat where pejabat.kd_pejabat='".$_POST['kd_pejabat']."' and agent.kd_agent='".$_POST['kd_agent']."' ");
			
			return $query->result_array();
		
		}elseif ($pejabat !='') {
			// echo ";";
			$query = $this->db->query("SELECT perusahaan.kd_perusahaan, perusahaan.nama_perusahaan, perusahaan.nama_direktur, perusahaan.jab_pimpinan, perusahaan.email, perusahaan.no_fax, perusahaan.no_telpon, perusahaan.alamat, perusahaan.company_profile, perusahaan.akta_pendirian, perusahaan.spkmgr, perusahaan.stdp, perusahaan.siup, perusahaan.sktu, perusahaan.siujk, perusahaan.spt, perusahaan.npwp, perusahaan.ktp, perusahaan.laporan_keuangan, perusahaan.proyek_sebelumnya, perusahaan.npwp_file, agent.kd_agent, agent.nama_agent, pejabat.kd_pejabat, pejabat.nama_pejabat from agent join perusahaan on agent.kd_agent=perusahaan.kd_agent join pejabat on pejabat.kd_pejabat=perusahaan.kd_pejabat where  pejabat.kd_pejabat='".$_POST['kd_pejabat']."' ");
			return $query->result_array();
		}
		elseif ($kd_agent !='') {
			// echo "string";
			$query = $this->db->query("SELECT perusahaan.kd_perusahaan, perusahaan.nama_perusahaan, perusahaan.nama_direktur, perusahaan.jab_pimpinan, perusahaan.email, perusahaan.no_fax, perusahaan.no_telpon, perusahaan.alamat, perusahaan.company_profile, perusahaan.akta_pendirian, perusahaan.spkmgr, perusahaan.stdp, perusahaan.siup, perusahaan.sktu, perusahaan.siujk, perusahaan.spt, perusahaan.npwp, perusahaan.ktp, perusahaan.laporan_keuangan, perusahaan.proyek_sebelumnya, perusahaan.npwp_file, agent.kd_agent, agent.nama_agent, pejabat.kd_pejabat, pejabat.nama_pejabat from agent join perusahaan on agent.kd_agent=perusahaan.kd_agent join pejabat on pejabat.kd_pejabat=perusahaan.kd_pejabat where agent.kd_agent='".$_POST['kd_agent']."' or pejabat.kd_pejabat='".$_POST['kd_pejabat']."' ");
			return $query->result_array();
		}else{
			$query = $this->db->query("SELECT perusahaan.kd_perusahaan, perusahaan.nama_perusahaan, perusahaan.nama_direktur, perusahaan.jab_pimpinan, perusahaan.email, perusahaan.no_fax, perusahaan.no_telpon, perusahaan.alamat, perusahaan.company_profile, perusahaan.akta_pendirian, perusahaan.spkmgr, perusahaan.stdp, perusahaan.siup, perusahaan.sktu, perusahaan.siujk, perusahaan.spt, perusahaan.npwp, perusahaan.ktp, perusahaan.laporan_keuangan, perusahaan.proyek_sebelumnya, perusahaan.npwp_file, agent.kd_agent, agent.nama_agent, pejabat.kd_pejabat, pejabat.nama_pejabat from agent join perusahaan on agent.kd_agent=perusahaan.kd_agent join pejabat on pejabat.kd_pejabat=perusahaan.kd_pejabat ");
		return $query->result_array();
		}
	}


	public function laporan_komitmen()
	{
		$query = $this->db->query("SELECT perusahaan.nama_perusahaan, permohonan.nama_pekerjaan, permohonan.no_permohonan, permohonan.catatan_dokumen,permohonan.tgl_komitmen,perusahaan.kd_perusahaan,pejabat.kd_pejabat, pejabat.nama_pejabat, permohonan.status from perusahaan join permohonan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat order by tgl_permohonan desc ")->result_array();
		return $query;
	}
}
