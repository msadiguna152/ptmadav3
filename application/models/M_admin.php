<?php

/**
 * 
 */
class M_admin extends CI_Model
{


	public function lihat_akun()
	{
		$query = $this->db->query("SELECT * FROM akun where level != 'super' ORDER BY level ASC");
		return $query->result_array();
	}

	public function get_akun($kd_akun)
	{
		$query = $this->db->query("SELECT * FROM akun WHERE id_akun = '$kd_akun'");
		return $query->row_array();
	}

	public function proses_tambah_akun()
	{
		
		$data = array(
			'nama' => $_POST['nama'],
			'username' => $_POST['username'],
			'password' => md5($_POST['password']),
			'level' => $_POST['level']

		);

		$this->db->insert('akun', $data);
	}

	public function proses_edit_akun()
	{
		
		$data = array(
			'nama' => $_POST['nama'],
			'username' => $_POST['username'],
			'password' => md5($_POST['password']),
			'level' => $_POST['level']

		);

		$this->db->where('id_akun', $_POST['id_akun']);
		$this->db->update('akun', $data);
	}


	public function hapus_akun($id_akun)
	{
		$this->db->where('id_akun', $id_akun);
		$this->db->delete('akun');
	}

	
}
