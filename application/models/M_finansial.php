<?php

class M_finansial extends CI_Model
{
	// public function lihat_pengeluaran($status)
	// {
	// 	$query = $this->db->query("SELECT * FROM saldo WHERE `status`='$status' order by tanggal desc");
	// 	return $query->result_array();
	// }

	// public function proses_tambah_pengeluaran()
	// {
	// 	$tanggal = $this->input->post('tanggal');
	// 	$keterangan = $this->input->post('keterangan');
	// 	$jumlah = $this->input->post('jumlah');
	// 	$jenis_pengeluaran = $this->input->post('jenis_pengeluaran');
	// 	$status = $this->input->post('status');

	// 	$data = array(
	// 		'tanggal' => $tanggal,
	// 		'keterangan' => $keterangan,
	// 		'jumlah' => $jumlah,
	// 		'jenis_pengeluaran' => $jenis_pengeluaran,
	// 		'status' => $status
	// 	);
	// 	//print_r($data);
	// 	$this->db->insert('saldo', $data);
	// }

	// public function get_pengeluaran($id)
	// {
	// 	$query = $this->db->query("SELECT * from saldo where id='$id'");
	// 	return $query->row_array();
	// }

	// public function proses_edit_pengeluaran()
	// {
	// 	$data = array(
	// 		'tanggal' => $_POST['tanggal'],
	// 		'keterangan' => $_POST['keterangan'],
	// 		'jumlah' => $_POST['jumlah'],
	// 		'jenis_pengeluaran' => $_POST['jenis_pengeluaran'],
	// 		'status' => $_POST['status']

	// 	);

	// 	$this->db->where('id', $_POST['id']);
	// 	$this->db->update('saldo', $data);
	// }

	// public function hapus_pengeluaran($id)
	// {
	// 	$this->db->where('id', $id);
	// 	$this->db->delete('saldo');
	// }
	public function get_dashboard()
	{
		return $this->db->query("SELECT (SELECT
			CONCAT('Rp.', FORMAT(sum(total_biaya), 2))
		FROM
			tarif) pendapatan,(SELECT
			CONCAT('Rp.', FORMAT(SUM(saldo), 2)) profit
		FROM
			tarif) profit,
			(SELECT
			CONCAT('Rp.', FORMAT(sum(t2.total_biaya) - sum(b.jml_pembayaran), 2)) piutang
		FROM
			(
			SELECT
				p2.id_permohonan , sum(jml_pembayaran) AS jml_pembayaran
			FROM
				pembayaran p
			RIGHT JOIN permohonan p2 ON
				p.id_permohonan = p2.id_permohonan
			group by
				p2.id_permohonan)b
		JOIN tarif t2 ON
			t2.id_permohonan = b.id_permohonan) piutang,
		(SELECT
			CONCAT('Rp.', FORMAT(sum(t2.total_biaya2) - sum(b.jml_pembayaran), 2)) wajib_bayar
		FROM
			(
			SELECT
				p2.id_permohonan,
				CASE
					WHEN SUM(jml_pembayaran) IS NULL THEN 0
					ELSE SUM(jml_pembayaran)
				END jml_pembayaran
			FROM
				pembayaran_jamkrida p
			RIGHT JOIN permohonan p2 ON
				p.id_permohonan = p2.id_permohonan
			GROUP BY
				p2.id_permohonan)b
		JOIN tarif t2 ON
			t2.id_permohonan = b.id_permohonan) wajib_bayar,
			(SELECT count(*) permohonan_diproses FROM tarif) permohonan_diproses")->result();
	}

	public function get_dashboard2()
	{
		return $this->db->query("SELECT
		case when kredit is null then CONCAT('Rp.', FORMAT(0, 2)) else  CONCAT('Rp.', FORMAT(kredit, 2)) end kredit,
		case when debit is null then CONCAT('Rp.', FORMAT(0, 2)) else  CONCAT('Rp.', FORMAT(debit, 2)) end debit,
		case when ( kredit - debit ) is null then CONCAT('Rp.', FORMAT(0, 2)) else  CONCAT('Rp.', FORMAT(( kredit - debit ), 2)) end saldo
	FROM
		(
		SELECT
			DISTINCT (
			SELECT
				sum(jumlah)
			FROM
				transaksi_umum a
			WHERE
				jenis_transaksi = 'Kredit' ) kredit, (
			SELECT
				sum(jumlah)
			FROM
				transaksi_umum b
			WHERE
				jenis_transaksi = 'Debit' ) debit
		FROM
			transaksi_umum ) c;
			")->result();
	}
	public function get_pendapatan($status)
	{

		if ($status == 'bulan') {
			$where = 'MONTH (tgl_permohonan) = MONTH (CURDATE() )';
		} else {
			$where = 'YEAR (tgl_permohonan) = YEAR(CURDATE() )';
		}

		return $this->db->query("SELECT
				CASE 
				WHEN sum(total_biaya) IS NULL THEN CONCAT('Rp.', FORMAT(0, 2)) ELSE
				CONCAT('Rp.', FORMAT(sum(total_biaya), 2))
				END pendapatan_filter
			FROM
				tarif
			JOIN permohonan p on
				tarif.id_permohonan = p.id_permohonan
			WHERE
				$where")->result();
	}

	public function get_profit($status)
	{

		if ($status == 'bulan') {
			$where = 'MONTH (tgl_permohonan) = MONTH (CURDATE() )';
		} else {
			$where = 'YEAR (tgl_permohonan) = YEAR(CURDATE() )';
		}

		return $this->db->query("SELECT
					CASE
						WHEN SUM(saldo) IS NULL THEN CONCAT('Rp.', FORMAT(0, 2))
						ELSE CONCAT('Rp.', FORMAT(SUM(saldo), 2))
					END profit_filter
				FROM
					tarif t
				JOIN permohonan p ON
					t.id_permohonan = p.id_permohonan
				WHERE
				$where")->result();
	}

	public function lihat_permohonan()
	{
		$query = $this->db->query("
				SELECT
			permohonan.no_permohonan,
			permohonan.id_permohonan,
			perusahaan.nama_perusahaan,
			perusahaan.kd_perusahaan,
			pejabat.kd_pejabat,
			pejabat.nama_pejabat,
			permohonan.nama_pekerjaan,
			permohonan.nilai_proyek,
			jenis_jaminan.jenis_jaminan
		FROM
			perusahaan
			JOIN permohonan ON perusahaan.kd_perusahaan = permohonan.kd_perusahaan
			JOIN pejabat ON pejabat.kd_pejabat = permohonan.kd_pejabat 
			JOIN jenis_jaminan on jenis_jaminan.kd_jenis = permohonan.id_persen
		WHERE
			NOT EXISTS ( SELECT * FROM tarif WHERE tarif.id_permohonan = permohonan.id_permohonan ) 
		ORDER BY
	permohonan.id_permohonan DESC
	")->result_array();
		//$query = $this->db->query("SELECT permohonan.no_permohonan, permohonan.id_permohonan, perusahaan.nama_perusahaan,perusahaan.kd_perusahaan,pejabat.kd_pejabat, pejabat.nama_pejabat,permohonan.nama_pekerjaan, permohonan.nilai_proyek, jenis_jaminan.jenis_jaminan from perusahaan join permohonan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat join persen on persen.id_persen=permohonan.id_persen join jenis_jaminan on jenis_jaminan.kd_jenis=persen.kd_jenis order by permohonan.id_permohonan DESC")->result_array();//query dulu

		return $query;
	}

	public function get_permohonan($id)
	{
		//query idpersen = idpersen
		// return $this->db->query("SELECT permohonan.*,jenis_jaminan.kd_jenis,pejabat.nama_pejabat,perusahaan.nama_perusahaan 
		// from permohonan 
		// join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat 
		// join perusahaan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan 
		// join persen on persen.id_persen = permohonan.id_persen
		// join jenis_jaminan on jenis_jaminan.kd_jenis = persen.kd_jenis
		// WHERE permohonan.id_permohonan = '$id'")->result();

		return $this->db->query("SELECT DISTINCT permohonan.*, jenis_jaminan.jenis_jaminan,jenis_jaminan.kd_jenis, pejabat.nama_pejabat, perusahaan.nama_perusahaan,jenis_permohonan.jenis
		from permohonan 
		left join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat 
		left join perusahaan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan
		left join persen on persen.kd_jenis = permohonan.id_persen
		left join jenis_jaminan on jenis_jaminan.kd_jenis = permohonan.id_persen
		left join jenis_permohonan on jenis_permohonan.kd_jp = permohonan.kd_jp
		WHERE permohonan.id_permohonan  = '$id'")->result();
	}

	// public function get_perhitungan($id)
	// {
	// 	return $this->db->query("SELECT * from perhitungan WHERE kd_jenis  = '$id'")->result();
	// }

	public function get_tarif($id)
	{
		return $this->db->query("SELECT biaya_materai_agent,trf_13,trf_19,id_tarif,saldo,diskon,nilaidiskon, id_permohonan, biaya_admin, biaya_materai, trf_min_bank, trf_maxbulan, trf_enambulan, trf_min, trf_agent, trf_jamkrida,trf_min2,trf_agent2, jatuh_tempo,jangka_waktu, service_agent,service_jamkrida, service_agent2,service_jamkrida2, ijpagent,ijpjamkrida, garansi_bank, total_biaya,total_biaya2
	 	FROM tarif
		WHERE id_tarif = '$id'")->result();
	}

	//get tarif berdasarkan id permohonan
	public function get_tarif_by_id($id)
	{
		return $this->db->query("SELECT id_tarif,saldo,diskon,nilaidiskon, id_permohonan, biaya_admin, biaya_materai, trf_min_bank, trf_maxbulan, trf_enambulan, trf_min, trf_agent, trf_jamkrida,trf_min2,trf_agent2, jatuh_tempo,jangka_waktu, service_agent,service_jamkrida, service_agent2,service_jamkrida2, ijpagent,ijpjamkrida, garansi_bank, total_biaya,total_biaya2
	 	FROM tarif
		WHERE id_permohonan = '$id'")->result_array();
	}

	public function tarif_exl($id)
	{
		//update
		// return $this->db->query("SELECT tarif.*, permohonan.* , jenis_jaminan.kd_jenis,jenis_jaminan.jenis_jaminan,perusahaan.nama_perusahaan
		// from tarif 
		// left JOIN permohonan on tarif.id_permohonan= permohonan.id_permohonan
		// LEFT JOIN persen on permohonan.id_persen = persen.id_persen
		// LEFT JOIN jenis_jaminan on persen.kd_jenis = jenis_jaminan.kd_jenis
		// LEFT JOIN perusahaan on permohonan.kd_perusahaan=perusahaan.kd_perusahaan
		// where id_tarif   = '$id'")->result();

		return $this->db->query("SELECT DISTINCT tarif.*, permohonan.* , jenis_jaminan.kd_jenis,jenis_jaminan.jenis_jaminan,perusahaan.nama_perusahaan
		from tarif 
		left JOIN permohonan on tarif.id_permohonan= permohonan.id_permohonan
		LEFT JOIN persen on permohonan.id_persen = persen.kd_jenis
		LEFT JOIN jenis_jaminan on persen.kd_jenis = jenis_jaminan.kd_jenis
		LEFT JOIN perusahaan on permohonan.kd_perusahaan=perusahaan.kd_perusahaan
		where id_tarif  = '$id'")->result();
	}


	public function lihat_tarif()
	{
		$query = $this->db->query("
				SELECT
			permohonan.id_permohonan,
			permohonan.tgl_permohonan,
			tarif.id_tarif,
			permohonan.no_permohonan,
			perusahaan.nama_perusahaan,
			pejabat.nama_pejabat,
			permohonan.nama_pekerjaan,
			permohonan.nilai_proyek,
			jenis_jaminan.jenis_jaminan
		FROM
			tarif
			JOIN permohonan ON permohonan.id_permohonan = tarif.id_permohonan
			JOIN perusahaan ON perusahaan.kd_perusahaan = permohonan.kd_perusahaan
			JOIN pejabat ON pejabat.kd_pejabat = permohonan.kd_pejabat 
			join jenis_jaminan on jenis_jaminan.kd_jenis = permohonan.id_persen
		ORDER BY
			permohonan.no_permohonan DESC
		")->result_array();
		//$query = $this->db->query("SELECT permohonan.no_permohonan, permohonan.id_permohonan, perusahaan.nama_perusahaan,perusahaan.kd_perusahaan,pejabat.kd_pejabat, pejabat.nama_pejabat,permohonan.nama_pekerjaan, permohonan.nilai_proyek, jenis_jaminan.jenis_jaminan from perusahaan join permohonan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat join persen on persen.id_persen=permohonan.id_persen join jenis_jaminan on jenis_jaminan.kd_jenis=persen.kd_jenis order by permohonan.id_permohonan DESC")->result_array();//query dulu

		return $query;
	}

	public function proses_tambah_tarif()
	{
		$data = array(
			'id_tarif' => '',
			'id_permohonan' => $_POST['id_permohonan'],
			'biaya_admin' => $_POST['biaya_admin'],
			'biaya_materai' => $_POST['biaya_materai'],
			'biaya_materai_agent' => $_POST['biaya_materai_agent'],
			'trf_min_bank' => $_POST['trf_min_bank'],
			'trf_maxbulan' => $_POST['trf_maxbulan'],
			'trf_enambulan' => $_POST['trf_enambulan'],
			'trf_min' => $_POST['trf_min'],
			'trf_agent' => $_POST['trf_agent'],
			'trf_jamkrida' => $_POST['trf_jamkrida'],
			'trf_min2' => $_POST['trf_min2'],
			'trf_agent2' => $_POST['trf_agent2'],
			'jatuh_tempo' => $_POST['jatuh_tempo'],
			'jangka_waktu' => $_POST['jangka_waktu'],
			'service_agent' => $_POST['service_agent'],
			'service_jamkrida' => $_POST['service_jamkrida'],
			'service_agent2' => $_POST['service_agent2'],
			'service_jamkrida2' => $_POST['service_jamkrida2'],
			'ijpagent' => $_POST['ijpagent'],
			'ijpjamkrida' => $_POST['ijpjamkrida'],
			'garansi_bank' => $_POST['garansi_bank'],
			'total_biaya2' => $_POST['total_biaya2'],
			'total_biaya' => $_POST['total_biaya'],
			'diskon' => $_POST['diskon'],
			'nilaidiskon' => $_POST['nilaidiskon'],
			'saldo' => $_POST['saldo'],
			'trf_13' => $_POST['trf_13'],
			'trf_19' => $_POST['trf_19'],

		);

		$data2 = array(
			'id' => '',
			'id_permohonan' => $_POST['id_permohonan'],
			'pengeluaran' => $_POST['total_biaya2'],
			'pemasukan' => $_POST['total_biaya'],
			'status_pemasukan' => 0,
			'status_pengeluaran' => 0,
		);

		$this->db->insert('tarif', $data);

		$this->db->insert('detail_tarif', $data2);

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// echo "<pre>";
		// print_r($data2);
		// echo "</pre>";

	}

	public function proses_edit_tarif($id)
	{
		$data = array(
			'id_permohonan' => $_POST['id_permohonan'],
			'biaya_admin' => $_POST['biaya_admin'],
			'biaya_materai' => $_POST['biaya_materai'],
			'biaya_materai_agent' => $_POST['biaya_materai_agent'],
			'trf_min_bank' => $_POST['trf_min_bank'],
			'biaya_materai' => $_POST['biaya_materai'],
			'trf_min_bank' => $_POST['trf_min_bank'],
			'trf_maxbulan' => $_POST['trf_maxbulan'],
			'trf_enambulan' => $_POST['trf_enambulan'],
			'trf_min' => $_POST['trf_min'],
			'trf_agent' => $_POST['trf_agent'],
			'trf_jamkrida' => $_POST['trf_jamkrida'],
			'trf_min2' => $_POST['trf_min2'],
			'trf_agent2' => $_POST['trf_agent2'],
			'jatuh_tempo' => $_POST['jatuh_tempo'],
			'jangka_waktu' => $_POST['jangka_waktu'],
			'service_agent' => $_POST['service_agent'],
			'service_jamkrida' => $_POST['service_jamkrida'],
			'service_agent2' => $_POST['service_agent2'],
			'service_jamkrida2' => $_POST['service_jamkrida2'],
			'ijpagent' => $_POST['ijpagent'],
			'ijpjamkrida' => $_POST['ijpjamkrida'],
			'garansi_bank' => $_POST['garansi_bank'],
			'total_biaya2' => $_POST['total_biaya2'],
			'total_biaya' => $_POST['total_biaya'],
			'diskon' => $_POST['diskon'],
			'nilaidiskon' => $_POST['nilaidiskon'],
			'saldo' => $_POST['saldo'],
			'trf_13' => $_POST['trf_13'],
			'trf_19' => $_POST['trf_19'],
			// 'totalnilaidiskon' => $_POST['totalnilaidiskon'],
		);
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";

		$data2 = array(
			'pengeluaran' => $_POST['total_biaya2'],
			'pemasukan' => $_POST['total_biaya'],
			'status_pemasukan' => 0,
			'status_pengeluaran' => 0,
		);


		$this->db->where('id_tarif', $id);
		$this->db->update('tarif', $data);

		$this->db->where('id_permohonan', $_POST['id_permohonan']);
		$this->db->update('detail_tarif', $data2);
	}

	public function hapus_tarif($id)
	{
		$query = $this->db->query("select id_permohonan from tarif where id_tarif ='$id'")->result_array();
		foreach ($query as $dt) {
			$ehe = $dt['id_permohonan'];
		}

		$this->db->where('id_tarif', $id);
		$this->db->delete('tarif');

		$this->db->where('id_permohonan', $ehe);
		$this->db->delete('detail_tarif');
	}

	public function lihat_perhitungan()
	{
		return $this->db->query("SELECT perhitungan.kd_jenis,jenis_jaminan.jenis_jaminan from perhitungan join jenis_jaminan on perhitungan.kd_jenis = jenis_jaminan.kd_jenis")->result_array();
	}

	//untuk edit perhitungan
	public function get_perhitungan2($id)
	{
		return $this->db->query("SELECT perhitungan.biaya_materai_agent,perhitungan.trf_13,perhitungan.trf_19,perhitungan.kd_jenis,jenis_jaminan.jenis_jaminan, biaya_admin, biaya_materai, trf_min_bank, trf_maxbulan, trf_enambulan, trf_min, trf_agent, trf_jamkrida,trf_min2,trf_agent2
		from perhitungan 
		join jenis_jaminan on perhitungan.kd_jenis = jenis_jaminan.kd_jenis 
		WHERE perhitungan.kd_jenis = '$id'")->row_array();
	}


	//untuk ditambah tarif
	public function get_perhitungan($id)
	{
		return $this->db->query("SELECT perhitungan.biaya_materai_agent,perhitungan.trf_13,perhitungan.trf_19,perhitungan.kd_jenis,jenis_jaminan.jenis_jaminan, biaya_admin, biaya_materai, trf_min_bank, trf_maxbulan, trf_enambulan, trf_min, trf_agent, trf_jamkrida,trf_min2,trf_agent2
		from perhitungan 
		join jenis_jaminan on perhitungan.kd_jenis = jenis_jaminan.kd_jenis 
		WHERE perhitungan.kd_jenis = '$id'")->result();
	}

	public function proses_edit_perhitungan($id)
	{
		$data = array(
			'biaya_admin' => $_POST['biaya_admin'],
			'biaya_materai' => $_POST['biaya_materai'],
			'biaya_materai_agent' => $_POST['biaya_materai_agent'],
			'trf_min_bank' => $_POST['trf_min_bank'],
			'trf_maxbulan' => $_POST['trf_maxbulan'],
			'trf_enambulan' => $_POST['trf_enambulan'],
			'trf_min' => $_POST['trf_min'],
			'trf_agent' => $_POST['trf_agent'],
			'trf_jamkrida' => $_POST['trf_jamkrida'],
			'trf_min2' => $_POST['trf_min2'],
			'trf_agent2' => $_POST['trf_agent2'],
			'trf_13' => $_POST['trf_13'],
			'trf_19' => $_POST['trf_19']
		);

		if ($_POST['kd_jenis'] == "JN02") {
			$this->db->where('kd_jenis', $_POST['kd_jenis']);
			$this->db->update('perhitungan', $data);

			$this->db->where('kd_jenis', 'JN04');
			$this->db->update('perhitungan', $data);
		} elseif ($_POST['kd_jenis'] == "JN04") {
			$this->db->where('kd_jenis', $_POST['kd_jenis']);
			$this->db->update('perhitungan', $data);

			$this->db->where('kd_jenis', 'JN02');
			$this->db->update('perhitungan', $data);
		} else {
			$this->db->where('kd_jenis', $_POST['kd_jenis']);
			$this->db->update('perhitungan', $data);
		}
	}



	// public function lihat_pembayaran($id)
	// {
	// 	if ($id == "Client") {
	// 		return $this->db->query("SELECT id_pembayaran,tgl_pembayaran,jml_pembayaran,bukti_pembayaran,id_permohonan,uraian 
	// 		from pembayaran 
	// 		ORDER BY tgl_pembayaran desc")->result_array();
	// 	} elseif ($id == "Jamkrida") {
	// 		return $this->db->query("SELECT id_pembayaran,tgl_pembayaran,jml_pembayaran,bukti_pembayaran,id_permohonan,uraian 
	// 		from pembayaran_jamkrida 
	// 		ORDER BY tgl_pembayaran desc")->result_array();
	// 	} else {
	// 		echo "<script language='javascript'>alert('Data Tidak Valid'); document.location='" . base_url('Finansial/index') . "';</script>";
	// 	}
	// }

	public function list_permohonan()
	{

		return $this->db->query("SELECT id_permohonan,no_permohonan, nama_perusahaan
		from permohonan 
		join perusahaan on permohonan.kd_perusahaan= perusahaan.kd_perusahaan
		ORDER BY id_permohonan desc")->result_array();
	}

	//pemasukan==================================
	public function proses_tambah_pemasukan($id)
	{
		// $config = array(
		// 	'upload_path' => './file/Pembayaran/',
		// 	'allowed_types' => 'jpg|png|jpeg|pdf'

		// );

		// $this->load->library('upload', $config);
		// if (!$this->upload->do_upload('bukti_pembayaran')) {
		// 	$bukti = 'Tidak Ada Data';
		// } else {
		// 	$result = $this->upload->data();
		// 	$bukti = $result['file_name'];
		// }

		$data = array(
			'id_pembayaran' => '',
			'tgl_pembayaran' => date('Y-m-d', strtotime($_POST['tgl_pembayaran'])),
			'jml_pembayaran' => str_replace(".", "", $_POST['jml_pembayaran']),
			// 'bukti_pembayaran' => $bukti,
			'uraian' => $_POST['uraian'],
			'id_permohonan' => $_POST['id_permohonan']
		);
		$this->db->insert('pembayaran', $data);

		$jumlahtagihan = $_POST['jumlah'];
		$jumlahbayar = $this->jml_pemasukan($id);

		foreach ($jumlahbayar as $dt) {
			$juml = $dt['jumlah'];
		}

		if ($jumlahtagihan == $juml) {
			$this->db->where('id_permohonan', $id);
			$this->db->update('detail_tarif', array('status_pemasukan' => 1));
		} else {
			$this->db->where('id_permohonan', $id);
			$this->db->update('detail_tarif', array('status_pemasukan' => 0));
		}
	}

	public function proses_edit_pemasukan($id)
	{
		// $config = array(
		// 	'upload_path' => './file/Pembayaran/',
		// 	'allowed_types' => 'jpg|png|jpeg|pdf'

		// );

		// $this->load->library('upload', $config);
		// if (!$this->upload->do_upload('bukti_pembayaran')) {
		// 	$bukti = 'Tidak Ada Data';
		// } else {
		// 	$result = $this->upload->data();
		// 	$bukti = $result['file_name'];
		// }

		$data = array(
			'tgl_pembayaran' => date('Y-m-d', strtotime($_POST['tgl_pembayaran'])),
			'jml_pembayaran' => str_replace(".", "", $_POST['jml_pembayaran']),
			// 'bukti_pembayaran' => $bukti,
			'uraian' => $_POST['uraian']
		);
		$this->db->where('id_pembayaran', $id);
		$this->db->update('pembayaran', $data);

		$jumlahtagihan = $_POST['jumlah'];
		$jumlahbayar = $this->jml_pemasukan($id);

		foreach ($jumlahbayar as $dt) {
			$juml = $dt['jumlah'];
		}

		if ($jumlahtagihan == $juml) {
			$this->db->where('id_permohonan', $_POST['id_permohonan']);
			$this->db->update('detail_tarif', array('status_pemasukan' => 1));
		} else {
			$this->db->where('id_permohonan', $_POST['id_permohonan']);
			$this->db->update('detail_tarif', array('status_pemasukan' => 0));
		}
	}

	public function hapus_pemasukan($id, $id_permohonan)
	{
		$this->db->where('id_pembayaran', $id);
		$this->db->delete('pembayaran');

		//jumlah tagihan
		$data2 = $this->detail_tarif($id_permohonan);
		foreach ($data2 as $dt2) {
			$jumlahtagihan = $dt2['pemasukan'];
		}

		//jumlah bayar
		$jumlahbayar = $this->jml_pemasukan($id_permohonan);
		foreach ($jumlahbayar as $dt) {
			$juml = $dt['jumlah'];
		}

		if ($jumlahtagihan == $juml) {
			$this->db->where('id_permohonan', $id_permohonan);
			$this->db->update('detail_tarif', array('status_pemasukan' => 1));
		} else {
			$this->db->where('id_permohonan', $id_permohonan);
			$this->db->update('detail_tarif', array('status_pemasukan' => 0));
		}
	}

	//pengeluaran ==================================
	public function proses_tambah_pengeluaran($id)
	{
		$config = array(
			'upload_path' => './file/Pembayaran/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

		);

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('bukti_pembayaran')) {
			$bukti = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$bukti = $result['file_name'];
		}

		$data = array(
			'id_pembayaran' => '',
			'tgl_pembayaran' => date('Y-m-d', strtotime($_POST['tgl_pembayaran'])),
			'jml_pembayaran' => str_replace(".", "", $_POST['jml_pembayaran']),
			'bukti_pembayaran' => $bukti,
			'uraian' => $_POST['uraian'],
			'id_permohonan' => $_POST['id_permohonan']
		);
		$this->db->insert('pembayaran_jamkrida', $data);

		$jumlahtagihan = $_POST['jumlah'];
		$jumlahbayar = $this->jml_pengeluaran($id);

		foreach ($jumlahbayar as $dt) {
			$juml = $dt['jumlah'];
		}

		if ($jumlahtagihan == $juml) {
			$this->db->where('id_permohonan', $id);
			$this->db->update('detail_tarif', array('status_pengeluaran' => 1));
		} else {
			$this->db->where('id_permohonan', $id);
			$this->db->update('detail_tarif', array('status_pengeluaran' => 0));
		}
	}

	public function proses_edit_pengeluaran($id)
	{
		$config = array(
			'upload_path' => './file/Pembayaran/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

		);

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('bukti_pembayaran')) {
			$bukti = $_POST['bukti_lama'];
		} else {
			$result = $this->upload->data();
			$bukti = $result['file_name'];
		}

		$data = array(
			'tgl_pembayaran' => date('Y-m-d', strtotime($_POST['tgl_pembayaran'])),
			'jml_pembayaran' => str_replace(".", "", $_POST['jml_pembayaran']),
			'bukti_pembayaran' => $bukti,
			'uraian' => $_POST['uraian']
		);
		$this->db->where('id_pembayaran', $id);
		$this->db->update('pembayaran_jamkrida', $data);

		$jumlahtagihan = $_POST['jumlah'];
		$jumlahbayar = $this->jml_pengeluaran($id);

		foreach ($jumlahbayar as $dt) {
			$juml = $dt['jumlah'];
		}

		if ($jumlahtagihan == $juml) {
			$this->db->where('id_permohonan', $_POST['id_permohonan']);
			$this->db->update('detail_tarif', array('status_pengeluaran' => 1));
		} else {
			$this->db->where('id_permohonan', $_POST['id_permohonan']);
			$this->db->update('detail_tarif', array('status_pengeluaran' => 0));
		}
	}

	public function hapus_pengeluaran($id, $id_permohonan)
	{
		$this->db->where('id_pembayaran', $id);
		$this->db->delete('pembayaran_jamkrida');

		//jumlah tagihan
		$data2 = $this->detail_tarif($id_permohonan);
		foreach ($data2 as $dt2) {
			$jumlahtagihan = $dt2['pengeluaran'];
		}

		//jumlah bayar
		$jumlahbayar = $this->jml_pengeluaran($id_permohonan);
		foreach ($jumlahbayar as $dt) {
			$juml = $dt['jumlah'];
		}

		if ($jumlahtagihan == $juml) {
			$this->db->where('id_permohonan', $id_permohonan);
			$this->db->update('detail_tarif', array('status_pengeluaran' => 1));
		} else {
			$this->db->where('id_permohonan', $id_permohonan);
			$this->db->update('detail_tarif', array('status_pengeluaran' => 0));
		}
	}

	public function proses_tambah_pembayaran($id)
	{
		$config = array(
			'upload_path' => './file/Pembayaran/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

		);

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('bukti_permbayaran')) {
			$bukti = 'Tidak Ada Data';
		} else {
			$result = $this->upload->data();
			$bukti = $result['file_name'];
		}


		$data = array(
			'id_pembayaran' => '',
			'tgl_pembayaran' => date('Y-m-d', strtotime($_POST['tgl_pembayaran'])),
			'jml_pembayaran' => str_replace(".", "", $_POST['jml_pembayaran']),
			'bukti_pembayaran' => $bukti,
			'uraian' => $_POST['uraian'],
			'id_permohonan' => $_POST['id_permohonan']
		);

		//print_r($data);;
		if ($id == "Client") {
			$this->db->insert('pembayaran', $data);
		} else {
			$this->db->insert('pembayaran_jamkrida', $data);
		}
	}

	public function hapus_pembayaran($id, $id_pembayaran)
	{

		$this->db->where('id_pembayaran', $id_pembayaran);
		if ($id == "Client") {
			$this->db->delete('pembayaran');
		} else {
			$this->db->delete('pembayaran_jamkrida');
		}
	}

	public function get_pembayaran($id)
	{

		// if ($id == "Client") {
		$query = $this->db->query("SELECT id_pembayaran, tgl_pembayaran, jml_pembayaran, uraian, id_permohonan
			from pembayaran
			WHERE id_pembayaran = '$id'");
		// } else {
		// 	$query = $this->db->query("SELECT id_pembayaran, tgl_pembayaran, jml_pembayaran, uraian, bukti_pembayaran, id_permohonan
		// 	from pembayaran_jamkrida
		// 	WHERE id_pembayaran = '$id_pembayaran'");
		// }

		return $query->row_array();
	}

	public function get_pengeluaran($id)
	{

		// if ($id == "Client") {
		$query = $this->db->query("SELECT id_pembayaran, tgl_pembayaran, jml_pembayaran, uraian,bukti_pembayaran, id_permohonan
			from pembayaran_jamkrida
			WHERE id_pembayaran = '$id'");
		// } else {
		// 	$query = $this->db->query("SELECT id_pembayaran, tgl_pembayaran, jml_pembayaran, uraian, bukti_pembayaran, id_permohonan
		// 	from pembayaran_jamkrida
		// 	WHERE id_pembayaran = '$id_pembayaran'");
		// }

		return $query->row_array();
	}

	public function proses_edit_pembayaran($id, $id_pembayaran)
	{
		$config = array(
			'upload_path' => './file/Pembayaran/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

		);

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('bukti_pembayaran')) {
			$bukti = $_POST['bukti_lama'];
		} else {
			$result = $this->upload->data();
			$bukti = $result['file_name'];
		}


		$data = array(
			'tgl_pembayaran' => date('Y-m-d', strtotime($_POST['tgl_pembayaran'])),
			'jml_pembayaran' => str_replace(".", "", $_POST['jml_pembayaran']),
			'bukti_pembayaran' => $bukti,
			'uraian' => $_POST['uraian'],
			'id_permohonan' => $_POST['id_permohonan']
		);

		$this->db->where('id_pembayaran', $id_pembayaran);
		if ($id == "Client") {
			$this->db->update('pembayaran', $data);
		} else {
			$this->db->update('pembayaran_jamkrida', $data);
		}
	}

	//----------------
	public function count_permohonan()
	{
		return $query = $this->db->query("SELECT count(*) as permohonan from perusahaan join permohonan on perusahaan.kd_perusahaan=permohonan.kd_perusahaan join pejabat on pejabat.kd_pejabat=permohonan.kd_pejabat WHERE NOT EXISTS (SELECT * FROM tarif WHERE tarif.id_permohonan = permohonan.id_permohonan) order by permohonan.id_permohonan DESC")->result();
	}
	//--------------
	//ttansaksi umum
	public function lihat_umum()
	{

		return $this->db->query("SELECT
		id,
		tanggal,
		bukti,
		jumlah,
		keterangan,
		jenis_transaksi,
		pejabat.nama_pejabat 
	FROM
		transaksi_umum
		LEFT JOIN pejabat ON transaksi_umum.kd_pejabat = pejabat.kd_pejabat 
	ORDER BY
		tanggal DESC")->result_array();
	}

	public function proses_tambah_umum()
	{
		$config = array(
			'upload_path' => './file/transaksi_umum/',
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
			'id' => '',
			'tanggal' => date('Y-m-d', strtotime($_POST['tanggal'])),
			'jumlah' => str_replace(".", "", $_POST['jumlah']),
			'bukti' => $bukti,
			'jenis_transaksi' => $_POST['jenis_transaksi'],
			'keterangan' => $_POST['keterangan'],
			'kd_pejabat' => $_POST['pejabat']
		);

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		$this->db->insert('transaksi_umum', $data);
	}

	public function hapus_umum($id)
	{

		$this->db->where('id', $id);
		$this->db->delete('transaksi_umum');
	}

	public function get_umum($id)
	{
		$query = $this->db->query("SELECT id,tanggal,keterangan,bukti,jumlah,jenis_transaksi
			from transaksi_umum
			WHERE id = '$id'");

		return $query->row_array();
	}

	public function proses_edit_umum($id)
	{
		$config = array(
			'upload_path' => './file/transaksi_umum/',
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
			'tanggal' => date('Y-m-d', strtotime($_POST['tanggal'])),
			'jumlah' => str_replace(".", "", $_POST['jumlah']),
			'bukti' => $bukti,
			'jenis_transaksi' => $_POST['jenis_transaksi'],
			'keterangan' => $_POST['keterangan'],
			'kd_pejabat' => $_POST['pejabat']
		);

		$this->db->where('id', $id);
		$this->db->update('transaksi_umum', $data);
	}

	// public function get_master()
	// {
	// 	return $this->db->query('SELECT
	// 	p.tgl_permohonan,
	// 	pr.nama_perusahaan,
	// 	pjb.nama_pejabat,
	// 	agn.nama_agent,
	// 	kb.kabupaten,
	// 	p.nilai_proyek,
	// 	p.nilai_jaminan,
	// 	t.jangka_waktu,
	// 	jen.jenis_jaminan,
	// 	CASE

	// 		WHEN jp.jenis = 1 THEN
	// 		"Surety Bond" ELSE "Bank Garansi" 
	// 	END AS jenis,
	// 	t.ijpagent,
	// 	t.garansi_bank,
	// 	t.total_biaya,
	// 	t.ijpjamkrida,
	// 	t.nilaidiskon,
	// 	t.total_biaya2,
	// 	t.saldo 
	// 		FROM
	// 	permohonan p
	// 	JOIN perusahaan pr ON pr.kd_perusahaan = p.kd_perusahaan
	// 	JOIN pejabat pjb ON pjb.kd_pejabat = p.kd_pejabat
	// 	JOIN agent agn ON agn.kd_agent = p.kd_agent
	// 	JOIN kabupaten kb ON kb.kd_kabupaten = p.kd_kabupaten
	// 	JOIN tarif t ON t.id_permohonan = p.id_permohonan
	// 	JOIN jenis_jaminan jen ON jen.kd_jenis = p.id_persen
	// 	JOIN jenis_permohonan jp ON jp.kd_jp = p.kd_jp')->result();
	// }

	public function get_master2($tgl_awal, $tgl_akhir, $pejabat, $agent, $perusahaan)
	{

		$where = '';
		$where2 = '';
		$where3 = '';
		$where4 = '';

		if ($tgl_awal != '' and $tgl_akhir != '') {
			$where = "WHERE p.tgl_permohonan BETWEEN '$tgl_awal' and '$tgl_akhir'";
		}

		if ($pejabat != '') {
			$where2 = "pjb.kd_pejabat = '$pejabat'";

			if ($tgl_awal == '' and $tgl_akhir == '') {
				$where2 = "WHERE " . $where2;
			} else {
				$where2 = "AND " . $where2;
			}
		}

		if ($agent != '') {
			$where3 = "agn.kd_agent = '$agent'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					$where3 = "WHERE " . $where3;
				} else {
					$where3 = "AND " . $where3;
				}
			} else {
				$where3 = "AND " . $where3;
			}
		}

		if ($perusahaan != '') {
			$where4 = "pr.kd_perusahaan = '$perusahaan'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					if ($agent == '') {
						$where4 = "WHERE " . $where4;
					} else {
						$where4 = "AND " . $where4;
					}
				} else {
					$where4 = "AND " . $where4;
				}
			} else {
				$where4 = "AND " . $where4;
			}
		}


		// var_dump($tgl_awal . "/" . $tgl_akhir . "/" . $pejabat."/".$agent);
		//var_dump($where."/".$where2."/".$where3);
		return $this->db->query("SELECT
		p.tgl_permohonan,
		pr.nama_perusahaan,
		pjb.nama_pejabat,
		agn.nama_agent,
		kb.kabupaten,
		p.nilai_proyek,
		p.nilai_jaminan,
		t.jangka_waktu,
		jen.jenis_jaminan,
		CASE
			
			WHEN jp.jenis = 1 THEN
			'Surety Bond' ELSE 'Bank Garansi'
		END AS jenis,
		t.ijpagent,
		t.garansi_bank,
		t.total_biaya,
		t.ijpjamkrida,
		t.nilaidiskon,
		t.total_biaya2,
		t.saldo 
			FROM
		permohonan p
		JOIN perusahaan pr ON pr.kd_perusahaan = p.kd_perusahaan
		JOIN pejabat pjb ON pjb.kd_pejabat = p.kd_pejabat
		JOIN agent agn ON agn.kd_agent = p.kd_agent
		JOIN kabupaten kb ON kb.kd_kabupaten = p.kd_kabupaten
		JOIN tarif t ON t.id_permohonan = p.id_permohonan
		JOIN jenis_jaminan jen ON jen.kd_jenis = p.id_persen
		JOIN jenis_permohonan jp ON jp.kd_jp = p.kd_jp 
		$where 
		$where2 
		$where3
		$where4")->result();
	}

	public function lihat_pemasukan($id_permohonan)
	{
		return $this->db->query("SELECT * from pembayaran where id_permohonan='$id_permohonan'")->result_array();
	}

	public function lihat_pengeluaran($id_permohonan)
	{
		return $this->db->query("SELECT * from pembayaran_jamkrida where id_permohonan='$id_permohonan'")->result_array();
	}

	public function detail_tarif($id_permohonan)
	{
		return $this->db->query("SELECT * FROM detail_tarif WHERE id_permohonan  ='$id_permohonan'")->result_array();
	}

	public function jml_pemasukan($id_permohonan)
	{
		return $this->db->query("SELECT sum(jml_pembayaran) as jumlah from pembayaran where id_permohonan ='$id_permohonan'")->result_array();
	}

	public function jml_pengeluaran($id_permohonan)
	{
		return $this->db->query("SELECT sum(jml_pembayaran) as jumlah from pembayaran_jamkrida where id_permohonan ='$id_permohonan'")->result_array();
	}

	public function total_tarif()
	{
		return $this->db->query("SELECT SUM(total_biaya) pemasukan, SUM(total_biaya2) pengeluaran, SUM(saldo) profit FROM tarif")->result_array();
	}

	public function total_pemasukan()
	{
		return $this->db->query("SELECT
		CASE
				WHEN sum(trf.total_biaya) IS NULL THEN 0
				ELSE sum(trf.total_biaya)
			END AS pemasukan,
			CASE
				WHEN sum(b.jml_byr) IS NULL THEN 0
				ELSE sum(b.jml_byr)
			END AS  	jml_byr,
			CASE
		WHEN sum(trf.total_biaya) - sum(b.jml_byr) IS NULL THEN
		CASE
			WHEN sum(trf.total_biaya) IS NULL THEN 0
			ELSE sum(trf.total_biaya)
		END
		ELSE sum(trf.total_biaya) - sum(b.jml_byr)
	END as sisa_byr
		FROM
			(
			SELECT
				DISTINCT a.id_permohonan ids, a.*, det.status_pemasukan
			FROM
				(
				SELECT
					p2.* , sum(jml_pembayaran) jml_byr
				FROM
					pembayaran p
				RIGHT JOIN permohonan p2 on
					p.id_permohonan = p2.id_permohonan
				GROUP BY
					p2.id_permohonan ) a
			JOIN pejabat pej ON
				pej.kd_pejabat = a.kd_pejabat
			JOIN detail_tarif det ON
				det.id_permohonan = a.id_permohonan ) b
		JOIN tarif trf ON
			trf.id_permohonan = b.id_permohonan
		")->result_array();
	}

	public function total_pengeluaran()
	{
		return $this->db->query("SELECT
		CASE
				WHEN sum(trf.total_biaya2) IS NULL THEN 0
				ELSE sum(trf.total_biaya2)
			END AS pengeluaran,
			CASE
				WHEN sum(b.jml_byr) IS NULL THEN 0
				ELSE sum(b.jml_byr)
			END AS  	jml_byr,
			CASE
		WHEN sum(trf.total_biaya2) - sum(b.jml_byr) IS NULL THEN
		CASE
			WHEN sum(trf.total_biaya2) IS NULL THEN 0
			ELSE sum(trf.total_biaya2)
		END
		ELSE sum(trf.total_biaya2) - sum(b.jml_byr)
	END as sisa_byr
		FROM
			(
			SELECT
				DISTINCT a.id_permohonan ids, a.*, det.status_pengeluaran
			FROM
				(
				SELECT
					p2.* , sum(jml_pembayaran) jml_byr
				FROM
					pembayaran_jamkrida p
				RIGHT JOIN permohonan p2 on
					p.id_permohonan = p2.id_permohonan
				GROUP BY
					p2.id_permohonan ) a
			JOIN pejabat pej ON
				pej.kd_pejabat = a.kd_pejabat
			JOIN detail_tarif det ON
				det.id_permohonan = a.id_permohonan ) b
		JOIN tarif trf ON
			trf.id_permohonan = b.id_permohonan
		")->result_array();
	}



	public function get_data($keyword = '', $tgl_awal, $tgl_akhir, $agent, $pejabat, $perusahaan)
	{
		$where = '';
		$where2 = '';
		$where3 = '';
		$where4 = '';

		if ($tgl_awal != '' and $tgl_akhir != '') {
			$where = "WHERE p.tgl_permohonan BETWEEN '$tgl_awal' and '$tgl_akhir'";
		}

		if ($pejabat != '') {
			$where2 = "pjb.kd_pejabat = '$pejabat'";

			if ($tgl_awal == '' and $tgl_akhir == '') {
				$where2 = "WHERE " . $where2;
			} else {
				$where2 = "AND " . $where2;
			}
		}

		if ($agent != '') {
			$where3 = "agn.kd_agent = '$agent'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					$where3 = "WHERE " . $where3;
				} else {
					$where3 = "AND " . $where3;
				}
			} else {
				$where3 = "AND " . $where3;
			}
		}

		if ($perusahaan != '') {
			$where4 = "pr.kd_perusahaan = '$perusahaan'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					if ($agent == '') {
						$where4 = "WHERE " . $where4;
					} else {
						$where4 = "AND " . $where4;
					}
				} else {
					$where4 = "AND " . $where4;
				}
			} else {
				$where4 = "AND " . $where4;
			}
		}

		// $this->db->query("SET @row_number = 0");
		// (@row_number:=@row_number + 1) AS num,
		$q = $this->db->query("
		SELECT
			a.* 
		FROM
			(
			SELECT
				
				DATE_FORMAT(p.tgl_permohonan, '%d-%m-%Y'),
				p.no_permohonan,
				jen.jenis_jaminan,
				pr.nama_perusahaan,
				p.nama_pekerjaan,
				pjb.nama_pejabat,
				agn.nama_agent,
				CONCAT('Rp.',FORMAT(t.total_biaya,2)),
				CONCAT('Rp.',FORMAT(t.total_biaya2,2)),
				CONCAT('Rp.',FORMAT(t.saldo,2)),
				t.total_biaya2,
				t.saldo,
				kb.kabupaten,
				p.nilai_proyek,
				p.nilai_jaminan,
				t.jangka_waktu,
				p.tgl_permohonan,
				t.total_biaya,
			CASE
					
					WHEN jp.jenis = 1 THEN
					'Surety Bond' ELSE 'Bank Garansi' 
				END AS jenis,
				t.ijpagent,
				t.garansi_bank,
				t.ijpjamkrida,
				t.nilaidiskon 
			FROM
				permohonan p
				JOIN perusahaan pr ON pr.kd_perusahaan = p.kd_perusahaan
				JOIN pejabat pjb ON pjb.kd_pejabat = p.kd_pejabat
				JOIN agent agn ON agn.kd_agent = p.kd_agent
				JOIN kabupaten kb ON kb.kd_kabupaten = p.kd_kabupaten
				JOIN tarif t ON t.id_permohonan = p.id_permohonan
				JOIN jenis_jaminan jen ON jen.kd_jenis = p.id_persen
				JOIN jenis_permohonan jp ON jp.kd_jp = p.kd_jp 
				$where $where2 $where3 $where4
				ORDER BY p.tgl_permohonan DESC
			) a
		WHERE
			lower( a.tgl_permohonan ) LIKE lower( '%$keyword%' ) 
			OR lower( a.nama_perusahaan ) LIKE lower( '%$keyword%' ) 
			OR lower( a.nama_pekerjaan ) LIKE lower( '%$keyword%' ) 
			OR lower( a.nama_pejabat ) LIKE lower( '%$keyword%' ) 
			OR lower( a.nama_agent ) LIKE lower( '%$keyword%' )
		");
		return $q;
	}

	public function get_filter($tgl_awal, $tgl_akhir, $agent, $pejabat, $perusahaan)
	{
		$where = '';
		$where2 = '';
		$where3 = '';
		$where4 = '';

		if ($tgl_awal != '' and $tgl_akhir != '') {
			$where = "WHERE p.tgl_permohonan BETWEEN '$tgl_awal' and '$tgl_akhir'";
		}

		if ($pejabat != '') {
			$where2 = "pjb.kd_pejabat = '$pejabat'";

			if ($tgl_awal == '' and $tgl_akhir == '') {
				$where2 = "WHERE " . $where2;
			} else {
				$where2 = "AND " . $where2;
			}
		}

		if ($agent != '') {
			$where3 = "agn.kd_agent = '$agent'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					$where3 = "WHERE " . $where3;
				} else {
					$where3 = "AND " . $where3;
				}
			} else {
				$where3 = "AND " . $where3;
			}
		}

		if ($perusahaan != '') {
			$where4 = "pr.kd_perusahaan = '$perusahaan'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					if ($agent == '') {
						$where4 = "WHERE " . $where4;
					} else {
						$where4 = "AND " . $where4;
					}
				} else {
					$where4 = "AND " . $where4;
				}
			} else {
				$where4 = "AND " . $where4;
			}
		}

		$q = $this->db->query("
		SELECT
			CONCAT('Rp.',FORMAT(pemasukan,2)) pemasukan,
				CONCAT('Rp.',FORMAT(pengeluaran,2)) pengeluaran,
				CONCAT('Rp.',FORMAT(profit,2)) profit
				FROM (
					SELECT
						CASE	
						WHEN
							SUM( total_biaya ) IS NULL THEN
								0 ELSE SUM( total_biaya ) 
							END pemasukan,
							CASE	
						WHEN
							SUM( total_biaya2 ) IS NULL THEN
								0 ELSE SUM( total_biaya2 ) 
							END pengeluaran ,
							CASE	
						WHEN
							SUM( saldo ) IS NULL THEN
								0 ELSE SUM( saldo ) 
							END profit 
						FROM
							permohonan p
							JOIN perusahaan pr ON pr.kd_perusahaan = p.kd_perusahaan
							JOIN pejabat pjb ON pjb.kd_pejabat = p.kd_pejabat
							JOIN agent agn ON agn.kd_agent = p.kd_agent
							JOIN kabupaten kb ON kb.kd_kabupaten = p.kd_kabupaten
							JOIN tarif t ON t.id_permohonan = p.id_permohonan
							JOIN jenis_jaminan jen ON jen.kd_jenis = p.id_persen
							JOIN jenis_permohonan jp ON jp.kd_jp = p.kd_jp 
							$where $where2 $where3 $where4) a");

		return $q->result_array();
	}

	public function get_pejabat()
	{
		$this->db->select('*');
		$this->db->from('pejabat');
		$this->db->order_by('nama_pejabat', 'asc');
		$this->db->where('status', 'Aktif');
		$query = $this->db->get();
		$result = $query->result();

		$data = array();
		foreach ($result as $row) {
			$data[$row->kd_pejabat] = $row->nama_pejabat;
		}
		return $data;
	}

	public function get_agent()
	{
		$this->db->select('*');
		$this->db->from('agent');
		$this->db->order_by('nama_agent', 'asc');
		$this->db->where('status', 'Aktif');
		$query = $this->db->get();
		$result = $query->result();

		$data = array();
		foreach ($result as $row) {
			$data[$row->kd_agent] = $row->nama_agent;
		}
		return $data;
	}

	public function get_perusahaan()
	{
		$this->db->select('*');
		$this->db->from('perusahaan');
		$this->db->order_by('nama_perusahaan', 'asc');
		$this->db->where('status', 'Aktif');
		$query = $this->db->get();
		$result = $query->result();

		$data = array();
		foreach ($result as $row) {
			$data[$row->kd_perusahaan] = $row->nama_perusahaan;
		}
		return $data;
	}

	public function get_data_pemasukan($keyword = '', $tgl_awal, $tgl_akhir, $status, $pejabat, $perusahaan)
	{
		$where = '';
		$where2 = '';
		$where3 = '';
		$where4 = '';

		if ($tgl_awal != '' and $tgl_akhir != '') {
			$where = "WHERE a.tgl_permohonan BETWEEN '$tgl_awal' and '$tgl_akhir'";
		}

		if ($pejabat != '') {
			$where2 = "pej.kd_pejabat = '$pejabat'";

			if ($tgl_awal == '' and $tgl_akhir == '') {
				$where2 = "WHERE " . $where2;
			} else {
				$where2 = "AND " . $where2;
			}
		}

		if ($status != '') {
			$where3 = "det.status_pemasukan = '$status'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					$where3 = "WHERE " . $where3;
				} else {
					$where3 = "AND " . $where3;
				}
			} else {
				$where3 = "AND " . $where3;
			}
		}

		if ($perusahaan != '') {
			$where4 = "a.kd_perusahaan = '$perusahaan'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					if ($status == '') {
						$where4 = "WHERE " . $where4;
					} else {
						$where4 = "AND " . $where4;
					}
				} else {
					$where4 = "AND " . $where4;
				}
			} else {
				$where4 = "AND " . $where4;
			}
		}

		$q = $this->db->query("SELECT
		*
		FROM
			(
			SELECT
				DISTINCT  a.no_permohonan, DATE_FORMAT( a.tgl_permohonan, '%d-%m-%Y' ) AS tgl_permohonan,  jen.jenis_jaminan, pr.nama_perusahaan, a.nama_pekerjaan, pej.nama_pejabat, CONCAT( 'Rp.', FORMAT( trf.total_biaya, 2 ) ),
				CASE
					WHEN a.jml_pembayaran IS NULL THEN CONCAT( 'Rp.', FORMAT( 0, 2 ) )
					WHEN a.jml_pembayaran <= 0 THEN CONCAT( 'Rp.', FORMAT( 0, 2 ) )
					ELSE CONCAT( 'Rp.', FORMAT( a.jml_pembayaran, 2 ) )
				END AS jml_pembayaran,
				CASE
					WHEN trf.total_biaya - a.jml_pembayaran IS NULL THEN CONCAT( 'Rp.', FORMAT( trf.total_biaya , 2 ) )
					WHEN trf.total_biaya - a.jml_pembayaran <= 0 THEN CONCAT( 'Rp.', FORMAT( 0, 2 ) )
					ELSE CONCAT( 'Rp.', FORMAT( trf.total_biaya - a.jml_pembayaran, 2 ) )
				END AS sisa_bayar,
				CASE
					WHEN det.status_pemasukan = 0 THEN 'BELUM LUNAS'
					ELSE 'LUNAS'
				END AS STATUS
			FROM
				(
				SELECT
					p2.*, sum(jml_pembayaran) AS jml_pembayaran
				FROM
					pembayaran p
				RIGHT JOIN permohonan p2 ON
					p.id_permohonan = p2.id_permohonan
				group by
					p2.id_permohonan) a
			JOIN perusahaan pr ON
				pr.kd_perusahaan = a.kd_perusahaan
			JOIN jenis_jaminan jen ON
				jen.kd_jenis = a.id_persen
			JOIN pejabat pej ON
				pej.kd_pejabat = a.kd_pejabat
			JOIN tarif trf ON
				trf.id_permohonan = a.id_permohonan
			JOIN detail_tarif det ON
				det.id_permohonan = a.id_permohonan
				$where $where2 $where3 $where4 ) b
		WHERE
			lower(b.tgl_permohonan) LIKE lower('%$keyword%')
			OR lower(b.nama_perusahaan) LIKE lower('%$keyword%')
			OR lower(b.nama_pekerjaan) LIKE lower('%$keyword%')
			OR lower(b.nama_pejabat) LIKE lower('%$keyword%')
		");
		return $q;
	}

	public function get_filter_pemasukan($tgl_awal, $tgl_akhir, $status, $pejabat, $perusahaan)
	{
		$where = '';
		$where2 = '';
		$where3 = '';
		$where4  = '';

		if ($tgl_awal != '' and $tgl_akhir != '') {
			$where = "WHERE b.tgl_permohonan BETWEEN '$tgl_awal' and '$tgl_akhir'";
		}

		if ($pejabat != '') {
			$where2 = "b.kd_pejabat = '$pejabat'";

			if ($tgl_awal == '' and $tgl_akhir == '') {
				$where2 = "WHERE " . $where2;
			} else {
				$where2 = "AND " . $where2;
			}
		}

		if ($status != '') {
			$where3 = "b.status_pemasukan = '$status'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					$where3 = "WHERE " . $where3;
				} else {
					$where3 = "AND " . $where3;
				}
			} else {
				$where3 = "AND " . $where3;
			}
		}

		if ($perusahaan != '') {
			$where4 = "b.kd_perusahaan = '$perusahaan'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					if ($status == '') {
						$where4 = "WHERE " . $where4;
					} else {
						$where4 = "AND " . $where4;
					}
				} else {
					$where4 = "AND " . $where4;
				}
			} else {
				$where4 = "AND " . $where4;
			}
		}

		$q = $this->db->query("SELECT
		CASE
				WHEN sum(trf.total_biaya) IS NULL THEN CONCAT( 'Rp.', FORMAT( 0, 2 ) )
				ELSE CONCAT( 'Rp.', FORMAT( sum(trf.total_biaya), 2 ) )
			END AS jml_masuk,
			CASE
				WHEN sum(b.jml_byr) IS NULL THEN CONCAT( 'Rp.', FORMAT( 0, 2 ) )
				ELSE CONCAT( 'Rp.', FORMAT( sum(b.jml_byr), 2 ) )
			END AS  	jml_byr,
			CASE
				WHEN sum(trf.total_biaya) - sum(b.jml_byr) IS NULL THEN
				CASE
					WHEN sum(trf.total_biaya) IS NULL THEN CONCAT( 'Rp.', FORMAT( 0, 2 ) )
					ELSE CONCAT( 'Rp.', FORMAT( sum(trf.total_biaya), 2 ) )
				END
				ELSE CONCAT( 'Rp.', FORMAT( sum(trf.total_biaya) - sum(b.jml_byr), 2 ) )
			END as sisa_byr
		FROM
			(
			SELECT
				DISTINCT a.id_permohonan ids, a.*, det.status_pemasukan
			FROM
				(
				SELECT
					p2.* , sum(jml_pembayaran) jml_byr
				FROM
					pembayaran p
				RIGHT JOIN permohonan p2 on
					p.id_permohonan = p2.id_permohonan
				GROUP BY
					p2.id_permohonan ) a
			JOIN pejabat pej ON
				pej.kd_pejabat = a.kd_pejabat
			JOIN detail_tarif det ON
				det.id_permohonan = a.id_permohonan ) b
		JOIN tarif trf ON
			trf.id_permohonan = b.id_permohonan
		$where $where2 $where3 $where4
		");

		return $q->result_array();
	}

	public function get_cetak_pemasukan($tgl_awal, $tgl_akhir, $pejabat, $status, $perusahaan)
	{

		$where = '';
		$where2 = '';
		$where3 = '';
		$where4 = '';

		if ($tgl_awal != '' and $tgl_akhir != '') {
			$where = "WHERE a.tgl_permohonan BETWEEN '$tgl_awal' and '$tgl_akhir'";
		}

		if ($pejabat != '') {
			$where2 = "pej.kd_pejabat = '$pejabat'";

			if ($tgl_awal == '' and $tgl_akhir == '') {
				$where2 = "WHERE " . $where2;
			} else {
				$where2 = "AND " . $where2;
			}
		}

		if ($status != '') {
			$where3 = "det.status_pemasukan = '$status'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					$where3 = "WHERE " . $where3;
				} else {
					$where3 = "AND " . $where3;
				}
			} else {
				$where3 = "AND " . $where3;
			}
		}

		if ($perusahaan != '') {
			$where4 = "pr.kd_perusahaan = '$perusahaan'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					if ($status == '') {
						$where4 = "WHERE " . $where4;
					} else {
						$where4 = "AND " . $where4;
					}
				} else {
					$where4 = "AND " . $where4;
				}
			} else {
				$where4 = "AND " . $where4;
			}
		}

		return $this->db->query("SELECT
		*
		FROM
			(
			SELECT
				DISTINCT a.no_permohonan, a.tgl_permohonan, jen.jenis_jaminan, pr.nama_perusahaan, a.nama_pekerjaan, pej.nama_pejabat, trf.total_biaya,
				CASE
					WHEN a.jml_pembayaran IS NULL THEN 0
					WHEN a.jml_pembayaran <= 0 THEN 0
					ELSE  a.jml_pembayaran
				END AS jml_pembayaran,
				CASE
					WHEN trf.total_biaya - a.jml_pembayaran IS NULL THEN trf.total_biaya
					WHEN trf.total_biaya - a.jml_pembayaran <= 0 THEN 0
					ELSE  trf.total_biaya - a.jml_pembayaran
				END AS sisa_bayar,
				CASE
					WHEN det.status_pemasukan = 0 THEN 'BELUM LUNAS'
					ELSE 'LUNAS'
				END AS STATUS
			FROM
				(
				SELECT
					p2.*, sum(jml_pembayaran) AS jml_pembayaran
				FROM
					pembayaran p
				RIGHT JOIN permohonan p2 ON
					p.id_permohonan = p2.id_permohonan
				group by
					p2.id_permohonan) a
			JOIN perusahaan pr ON
				pr.kd_perusahaan = a.kd_perusahaan
			JOIN jenis_jaminan jen ON
				jen.kd_jenis = a.id_persen
			JOIN pejabat pej ON
				pej.kd_pejabat = a.kd_pejabat
			JOIN tarif trf ON
				trf.id_permohonan = a.id_permohonan
			JOIN detail_tarif det ON
				det.id_permohonan = a.id_permohonan
							$where $where2 $where3 $where4 
		) b
		")->result();
	}

	public function get_data_pengeluaran($keyword = '', $tgl_awal, $tgl_akhir, $status, $pejabat, $perusahaan)
	{
		$where = '';
		$where2 = '';
		$where3 = '';
		$where4  = '';

		if ($tgl_awal != '' and $tgl_akhir != '') {
			$where = "WHERE a.tgl_permohonan BETWEEN '$tgl_awal' and '$tgl_akhir'";
		}

		if ($pejabat != '') {
			$where2 = "pej.kd_pejabat = '$pejabat'";

			if ($tgl_awal == '' and $tgl_akhir == '') {
				$where2 = "WHERE " . $where2;
			} else {
				$where2 = "AND " . $where2;
			}
		}

		if ($status != '') {
			$where3 = "det.status_pengeluaran = '$status'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					$where3 = "WHERE " . $where3;
				} else {
					$where3 = "AND " . $where3;
				}
			} else {
				$where3 = "AND " . $where3;
			}
		}

		if ($perusahaan != '') {
			$where4 = "a.kd_perusahaan = '$perusahaan'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					if ($status == '') {
						$where4 = "WHERE " . $where4;
					} else {
						$where4 = "AND " . $where4;
					}
				} else {
					$where4 = "AND " . $where4;
				}
			} else {
				$where4 = "AND " . $where4;
			}
		}

		$q = $this->db->query("SELECT
		*
		FROM
			(
			SELECT
				DISTINCT  a.no_permohonan, DATE_FORMAT( a.tgl_permohonan, '%d-%m-%Y' ) AS tgl_permohonan,  jen.jenis_jaminan, pr.nama_perusahaan, a.nama_pekerjaan, pej.nama_pejabat, CONCAT( 'Rp.', FORMAT( trf.total_biaya2, 2 ) ),
				CASE
					WHEN a.jml_pembayaran IS NULL THEN CONCAT( 'Rp.', FORMAT( 0, 2 ) )
					WHEN a.jml_pembayaran <= 0 THEN CONCAT( 'Rp.', FORMAT( 0, 2 ) )
					ELSE CONCAT( 'Rp.', FORMAT( a.jml_pembayaran, 2 ) )
				END AS jml_pembayaran,
				CASE
					WHEN trf.total_biaya2 - a.jml_pembayaran IS NULL THEN CONCAT( 'Rp.', FORMAT( trf.total_biaya2 , 2 ) )
					WHEN trf.total_biaya2 - a.jml_pembayaran <= 0 THEN CONCAT( 'Rp.', FORMAT( 0, 2 ) )
					ELSE CONCAT( 'Rp.', FORMAT( trf.total_biaya2 - a.jml_pembayaran, 2 ) )
				END AS sisa_bayar,
				CASE
					WHEN det.status_pengeluaran = 0 THEN 'BELUM LUNAS'
					ELSE 'LUNAS'
				END AS STATUS
			FROM
				(
				SELECT
					p2.*, sum(jml_pembayaran) AS jml_pembayaran
				FROM
					pembayaran_jamkrida p
				RIGHT JOIN permohonan p2 ON
					p.id_permohonan = p2.id_permohonan
				group by
					p2.id_permohonan) a
			JOIN perusahaan pr ON
				pr.kd_perusahaan = a.kd_perusahaan
			JOIN jenis_jaminan jen ON
				jen.kd_jenis = a.id_persen
			JOIN pejabat pej ON
				pej.kd_pejabat = a.kd_pejabat
			JOIN tarif trf ON
				trf.id_permohonan = a.id_permohonan
			JOIN detail_tarif det ON
				det.id_permohonan = a.id_permohonan
				$where $where2 $where3 $where4 ) b
		WHERE
			lower(b.tgl_permohonan) LIKE lower('%$keyword%')
			OR lower(b.nama_perusahaan) LIKE lower('%$keyword%')
			OR lower(b.nama_pekerjaan) LIKE lower('%$keyword%')
			OR lower(b.nama_pejabat) LIKE lower('%$keyword%')
		");
		return $q;
	}

	public function get_filter_pengeluaran($tgl_awal, $tgl_akhir, $status, $pejabat, $perusahaan)
	{
		$where = '';
		$where2 = '';
		$where3 = '';
		$where4 = '';

		if ($tgl_awal != '' and $tgl_akhir != '') {
			$where = "WHERE b.tgl_permohonan BETWEEN '$tgl_awal' and '$tgl_akhir'";
		}

		if ($pejabat != '') {
			$where2 = "b.kd_pejabat = '$pejabat'";

			if ($tgl_awal == '' and $tgl_akhir == '') {
				$where2 = "WHERE " . $where2;
			} else {
				$where2 = "AND " . $where2;
			}
		}

		if ($status != '') {
			$where3 = "b.status_pengeluaran = '$status'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					$where3 = "WHERE " . $where3;
				} else {
					$where3 = "AND " . $where3;
				}
			} else {
				$where3 = "AND " . $where3;
			}
		}

		if ($perusahaan != '') {
			$where4 = "b.kd_perusahaan = '$perusahaan'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					if ($status == '') {
						$where4 = "WHERE " . $where4;
					} else {
						$where4 = "AND " . $where4;
					}
				} else {
					$where4 = "AND " . $where4;
				}
			} else {
				$where4 = "AND " . $where4;
			}
		}

		$q = $this->db->query("SELECT
			CASE
				WHEN sum(trf.total_biaya2) IS NULL THEN CONCAT( 'Rp.', FORMAT( 0, 2 ) )
				ELSE CONCAT( 'Rp.', FORMAT( sum(trf.total_biaya2), 2 ) )
			END AS jml_keluar,
			CASE
				WHEN sum(b.jml_byr) IS NULL THEN CONCAT( 'Rp.', FORMAT( 0, 2 ) )
				ELSE CONCAT( 'Rp.', FORMAT( sum(b.jml_byr), 2 ) )
			END AS  	jml_byr,
			CASE
				WHEN sum(trf.total_biaya) - sum(b.jml_byr) IS NULL THEN
				CASE
					WHEN sum(trf.total_biaya2) IS NULL THEN CONCAT( 'Rp.', FORMAT( 0, 2 ) )
					ELSE CONCAT( 'Rp.', FORMAT( sum(trf.total_biaya2), 2 ) )
				END
				ELSE CONCAT( 'Rp.', FORMAT( sum(trf.total_biaya2) - sum(b.jml_byr), 2 ) )
			END as sisa_byr
		FROM
			(
			SELECT
				DISTINCT a.id_permohonan ids, a.*, det.status_pengeluaran
			FROM
				(
				SELECT
					p2.* , sum(jml_pembayaran) jml_byr
				FROM
					pembayaran_jamkrida p
				RIGHT JOIN permohonan p2 on
					p.id_permohonan = p2.id_permohonan
				GROUP BY
					p2.id_permohonan ) a
			JOIN pejabat pej ON
				pej.kd_pejabat = a.kd_pejabat
			JOIN detail_tarif det ON
				det.id_permohonan = a.id_permohonan ) b
		JOIN tarif trf ON
			trf.id_permohonan = b.id_permohonan
		$where $where2 $where3 $where4
		");

		return $q->result_array();
	}

	public function get_cetak_pengeluaran($tgl_awal, $tgl_akhir, $pejabat, $status, $perusahaan)
	{

		$where = '';
		$where2 = '';
		$where3 = '';
		$where4  = '';

		if ($tgl_awal != '' and $tgl_akhir != '') {
			$where = "WHERE a.tgl_permohonan BETWEEN '$tgl_awal' and '$tgl_akhir'";
		}

		if ($pejabat != '') {
			$where2 = "pej.kd_pejabat = '$pejabat'";

			if ($tgl_awal == '' and $tgl_akhir == '') {
				$where2 = "WHERE " . $where2;
			} else {
				$where2 = "AND " . $where2;
			}
		}

		if ($status != '') {
			$where3 = "det.status_pemasukan = '$status'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					$where3 = "WHERE " . $where3;
				} else {
					$where3 = "AND " . $where3;
				}
			} else {
				$where3 = "AND " . $where3;
			}
		}

		if ($perusahaan != '') {
			$where4 = "pr.kd_perusahaan = '$perusahaan'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					if ($status == '') {
						$where4 = "WHERE " . $where4;
					} else {
						$where4 = "AND " . $where4;
					}
				} else {
					$where4 = "AND " . $where4;
				}
			} else {
				$where4 = "AND " . $where4;
			}
		}

		return $this->db->query("SELECT
		*
		FROM
			(
			SELECT
				DISTINCT a.no_permohonan, a.tgl_permohonan, jen.jenis_jaminan, pr.nama_perusahaan, a.nama_pekerjaan, pej.nama_pejabat, trf.total_biaya2,
				CASE
					WHEN a.jml_pembayaran IS NULL THEN 0
					WHEN a.jml_pembayaran <= 0 THEN 0
					ELSE  a.jml_pembayaran
				END AS jml_pengeluaran,
				CASE
					WHEN trf.total_biaya2 - a.jml_pembayaran IS NULL THEN trf.total_biaya2
					WHEN trf.total_biaya2 - a.jml_pembayaran <= 0 THEN 0
					ELSE  trf.total_biaya2 - a.jml_pembayaran
				END AS sisa_bayar,
				CASE
					WHEN det.status_pengeluaran = 0 THEN 'BELUM LUNAS'
					ELSE 'LUNAS'
				END AS STATUS
			FROM
				(
				SELECT
					p2.*, sum(jml_pembayaran) AS jml_pembayaran
				FROM
					pembayaran_jamkrida p
				RIGHT JOIN permohonan p2 ON
					p.id_permohonan = p2.id_permohonan
				group by
					p2.id_permohonan) a
			JOIN perusahaan pr ON
				pr.kd_perusahaan = a.kd_perusahaan
			JOIN jenis_jaminan jen ON
				jen.kd_jenis = a.id_persen
			JOIN pejabat pej ON
				pej.kd_pejabat = a.kd_pejabat
			JOIN tarif trf ON
				trf.id_permohonan = a.id_permohonan
			JOIN detail_tarif det ON
				det.id_permohonan = a.id_permohonan
							$where $where2 $where3 $where4 
		) b
		")->result();
	}

	public function get_data_umum($keyword = '', $tgl_awal, $tgl_akhir,  $pejabat)
	{
		$where = '';
		$where2 = '';
		// $where3 = '';

		if ($tgl_awal != '' and $tgl_akhir != '') {
			$where = "WHERE t.tanggal BETWEEN  BETWEEN '$tgl_awal' and '$tgl_akhir'";
		}

		if ($pejabat != '') {
			$where2 = "p.kd_pejabat = '$pejabat'";

			if ($tgl_awal == '' and $tgl_akhir == '') {
				$where2 = "WHERE " . $where2;
			} else {
				$where2 = "AND " . $where2;
			}
		}

		// if ($status != '') {
		// 	$where3 = "det.status_pemasukan = '$status'";
		// 	if ($tgl_awal == '' and $tgl_akhir == '') {
		// 		if ($pejabat == '') {
		// 			$where3 = "WHERE " . $where3;
		// 		} else {
		// 			$where3 = "AND " . $where3;
		// 		}
		// 	} else {
		// 		$where3 = "AND " . $where3;
		// 	}
		// }

		$q = $this->db->query("SELECT
				* 
			FROM
				(
					SELECT
			t.tanggal,
			t.jumlah,
			t.keterangan,
			t.bukti,
			t.jenis_transaksi,
			p.nama_pejabat 
		FROM
			transaksi_umum t
			LEFT JOIN pejabat p ON t.kd_pejabat = p.kd_pejabat
							$where $where2 
						) a 
					WHERE
						lower( a.tanggal ) LIKE lower( '%$keyword%' ) 
						-- OR lower( a.nama_perusahaan ) LIKE lower( '%$keyword%' ) 
						-- OR lower( a.nama_pekerjaan ) LIKE lower( '%$keyword%' ) 
						OR lower( a.nama_pejabat ) LIKE lower( '%$keyword%' )
				");

		return $q;
	}

	public function get_filter_umum($tgl_awal, $tgl_akhir, $status, $pejabat)
	{
		$where = '';
		$where2 = '';
		$where3 = '';

		if ($tgl_awal != '' and $tgl_akhir != '') {
			$where = "WHERE a.tgl_permohonan BETWEEN '$tgl_awal' and '$tgl_akhir'";
		}

		if ($pejabat != '') {
			$where2 = "a.nama_pejabat = '$pejabat'";

			if ($tgl_awal == '' and $tgl_akhir == '') {
				$where2 = "WHERE " . $where2;
			} else {
				$where2 = "AND " . $where2;
			}
		}

		if ($status != '') {
			$where3 = "a.status_pemasukan = '$status'";
			if ($tgl_awal == '' and $tgl_akhir == '') {
				if ($pejabat == '') {
					$where3 = "WHERE " . $where3;
				} else {
					$where3 = "AND " . $where3;
				}
			} else {
				$where3 = "AND " . $where3;
			}
		}

		$q = $this->db->query("SELECT
		CASE
				
			WHEN
				sum( trf.total_biaya2 ) IS NULL THEN
					CONCAT( 'Rp.', FORMAT( 0, 2 ) ) ELSE CONCAT( 'Rp.', FORMAT( sum( trf.total_biaya2 ), 2 ) ) 
					END AS jml_keluar,
			CASE
					
					WHEN sum( a.jml_byr ) IS NULL THEN
					CONCAT( 'Rp.', FORMAT( 0, 2 ) ) ELSE CONCAT( 'Rp.', FORMAT( sum( a.jml_byr ), 2 ) ) 
				END AS jml_byr,
				CASE 
			WHEN sum( trf.total_biaya2 ) - sum( a.jml_byr ) IS NULL THEN
			CASE
				
			WHEN
				sum( trf.total_biaya2 ) IS NULL THEN
					CONCAT( 'Rp.', FORMAT( 0, 2 ) ) ELSE CONCAT( 'Rp.', FORMAT( sum( trf.total_biaya2 ), 2 ) ) 
					END
		
			ELSE
				CONCAT( 'Rp.', FORMAT( sum( trf.total_biaya2 ) - sum( a.jml_byr ), 2 ) ) 
		END as sisa_byr
		
			FROM
				(
				SELECT
					p.id_permohonan,
					sum( pmb.jml_pembayaran ) AS jml_byr,
					p.tgl_permohonan,
					pej.nama_pejabat,
					det.status_pemasukan 
				FROM
					permohonan p
					LEFT JOIN pembayaran_jamkrida pmb ON pmb.id_permohonan = p.id_permohonan
					JOIN pejabat pej ON pej.kd_pejabat = p.kd_pejabat
					JOIN detail_tarif det ON det.id_permohonan = p.id_permohonan 
				GROUP BY
					p.id_permohonan 
				) a
				JOIN tarif trf ON trf.id_permohonan = a.id_permohonan 
		$where $where2 $where3
		");

		return $q->result_array();
	}

	// Get DataTable data
	function get_umum2($postData = null)
	{

		$response = array();

		## Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value

		// Custom search filter 
		$tgl_awal = $postData['tgl_awal'];
		$tgl_akhir = $postData['tgl_akhir'];
		$kd_pejabat = $postData['kd_pejabat'];

		## Search 
		$search_arr = array();
		$searchQuery = "";
		if ($searchValue != '') {
			$search_arr[] = " (tanggal like '%" . $searchValue . "%' or 
			jumlah like '%" . $searchValue . "%' or 
			keterangan like'%" . $searchValue . "%' ) ";
		}

		if ($tgl_awal != '' && $tgl_akhir != '') {
			$search_arr[] = "  tanggal BETWEEN '" . $tgl_awal . "' and '" . $tgl_akhir . "'";
		}
		if ($kd_pejabat != '') {
			$search_arr[] = " transaksi_umum.kd_pejabat='" . $kd_pejabat . "' ";
		}
		// if($searchName != ''){
		//    $search_arr[] = " name like '%".$searchName."%' ";
		// }

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

		## Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$records = $this->db->get('transaksi_umum')->result();
		$totalRecords = $records[0]->allcount;

		## Total number of record with filtering
		$this->db->select('count(*) as allcount');
		if ($searchQuery != '')
			$this->db->where($searchQuery);
		$records = $this->db->get('transaksi_umum')->result();
		$totalRecordwithFilter = $records[0]->allcount;

		## Fetch records
		$this->db->select("id,tanggal,
		keterangan,
		CASE 
		WHEN jenis_transaksi != 'Debit' THEN
			jumlah	ELSE
					0
			END kredit,
				CASE 
				WHEN jenis_transaksi != 'Kredit' THEN
					jumlah
				ELSE
					0
			END debit,
			bukti,
			CASE 
				WHEN nama_pejabat IS NULL THEN
					'-'
				ELSE
					nama_pejabat
			END nama_pejabat
			");
		$this->db->join('pejabat', 'pejabat.kd_pejabat = transaksi_umum.kd_pejabat', 'left');
		if ($searchQuery != '')

			$this->db->where($searchQuery);
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get('transaksi_umum')->result();

		$data = array();

		foreach ($records as $record) {
			$data[] = array(
				"tanggal" => date("d-m-Y", strtotime($record->tanggal)),
				"keterangan" => $record->keterangan,
				"kredit" => "Rp." . number_format($record->kredit, 0, ',', '.'),
				"debit" => "Rp." . number_format($record->debit, 0, ',', '.'),
				"bukti" => "<a href='" . base_url() . "file/transaksi_umum/" . $record->bukti . "' title='Open File' target='_blank'><i class='fa fa-eye'></i> Open File</a>",
				"nama_pejabat" => $record->nama_pejabat,
				"aksi" => "<center>
				<a href='" . base_url() . "finansial/edit_umum/" . $record->id .  "' title='Edit'><i class='fa fa-edit'></i></a> |
				<a href='" . base_url() . "finansial/hapus_umum/" . $record->id .  "' onclick='return konformasi()' title='Delete'><i class='fa fa-trash'></i></a>
			  	</center>"
			);
		}

		## Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return $response;
	}

	function get_filter_umum2($tgl_awal, $tgl_akhir, $kd_pejabat)
	{

		$where = '';
		$where2 = '';

		if ($tgl_awal != '' and $tgl_akhir != '') {
			$where = "WHERE a.tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'";
		}

		if ($kd_pejabat != '') {
			$where2 = "kd_pejabat = '$kd_pejabat'";

			if ($tgl_awal == '' and $tgl_akhir == '') {
				$where2 = "WHERE " . $where2;
			} else {
				$where2 = "AND " . $where2;
			}
		}


		$records = $this->db->query("SELECT
		CASE
				
			WHEN
				SUM( kredit ) IS NULL THEN
					0 ELSE CONCAT( 'Rp.', FORMAT( SUM( kredit ), 2 ) ) 
				END kredit,
		CASE
				
				WHEN SUM( kredit ) IS NULL THEN
				0 ELSE CONCAT( 'Rp.', FORMAT( SUM( debit ), 2 ) ) 
			END debit,
		CASE
				
				WHEN SUM( kredit ) IS NULL THEN
				0 ELSE CONCAT( 'Rp.', FORMAT( SUM( kredit - debit ), 2 ) ) 
			END saldo 
		FROM
			(
			SELECT
				tanggal,
				kd_pejabat,
			CASE
					
					WHEN jenis_transaksi = 'Kredit' THEN
					jumlah ELSE 0 
				END kredit,
		CASE
				
				WHEN jenis_transaksi = 'Debit' THEN
				jumlah ELSE 0 
			END AS debit 
		FROM
			transaksi_umum
			$where
			$where2 
			) c")->result_array();



		return $records;
	}

	public function total_umum()
	{
		return $this->db->query("SELECT
		CASE WHEN kredit IS NULL THEN 0 ELSE kredit END kredit,
		CASE WHEN debit IS NULL THEN 0 ELSE debit END debit,
		CASE WHEN ( kredit - debit )  IS NULL THEN 0 ELSE ( kredit - debit )  END saldo 
	FROM
		(
		SELECT DISTINCT
			( SELECT sum( jumlah ) FROM transaksi_umum a WHERE jenis_transaksi = 'Kredit' ) kredit,
			( SELECT sum( jumlah ) FROM transaksi_umum b WHERE jenis_transaksi = 'Debit' ) debit 
		FROM
		transaksi_umum 
		) c
		")->result_array();
	}

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
