<?php


class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
	}

	public function index()
	{
		$this->load->view('V_login');
	}

	public function proses_login()
	{
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$where = array(
			'username' => $username,
			'password' => md5($password)
		);

		$cek = $this->M_login->cek_login($username, $password)->num_rows();
		$data = $this->M_login->cek_login($username, $password)->row_array();


		if ($cek > 0) {
			if ($data['level'] == 'admin') {

				$data_session = array(
					'username' => $data['username'],
					'status' => "Login",
					'level' => $data['level'],
					'nama'	=> $data['nama']
					
				);
				$this->session->set_userdata($data_session);
				$this->session->set_flashdata('hasil','berhasillogin'); 

				echo "<script language='javascript'>document.location='" . base_url('Ptmada/') . "';</script>";
			} else if ($data['level'] == 'finansial') {
				$data_session = array(
					'username' => $data['username'],
					'status' => "Login",
					'level' => $data['level'],
					'nama'	=> $data['nama']
				);
				$this->session->set_userdata($data_session);
				$this->session->set_flashdata('hasil','berhasillogin');

				echo "<script language='javascript'>document.location='" . base_url('Finansial/') . "';</script>";
			} else if ($data['level'] == 'super') {
				$data_session = array(
					'username' => $data['username'],
					'status' => "Login",
					'level' => $data['level'],
					'nama'	=> $data['nama']
				);
				$this->session->set_userdata($data_session);
				$this->session->set_flashdata('hasil','berhasillogin');

				echo "<script language='javascript'>document.location='" . base_url('Admin/') . "';</script>";
			}  else {
				$this->session->set_flashdata('hasil','gagallogin');
				echo "<script language='javascript'>document.location='" . base_url('Login/') . "';</script>";
			}
		} else {
			$this->session->set_flashdata('hasil','gagallogin');
			echo "<script language='javascript'>document.location='" . base_url('Login/') . "';</script>";
		}
	}

	public function logout()
	{
		$this->session->unset_userdata(array(
			'username',
			'status' => "Logout",
			'level'
		));
		redirect('Login/');
	}
}
