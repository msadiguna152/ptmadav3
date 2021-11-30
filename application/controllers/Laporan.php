<?php

class Laporan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        ini_set('max_execution_time', 60);
        $this->load->model('M_mada');
        $this->load->model('M_finansial');
        $this->load->helper('tgl');
        $this->load->helper('nominal');

        if($this->session->userdata('status') != 'Login'){
            $url=base_url();
            echo "<script language='javascript'>alert('Anda Tidak Memiliki Akses'); document.location='" . $url . "';</script>";
        }

        if($this->session->userdata('level') != 'finansial' && $this->session->userdata('level') != 'super'){
            $url=base_url();
            echo "<script language='javascript'>alert('Anda Tidak Memiliki Akses'); document.location='" . $url . "';</script>";
        }

    }

    public function lihat_laporan()
    {

        $data['list_pejabat'] = $this->M_finansial->get_pejabat();
        $data['list_agent'] = $this->M_finansial->get_agent();
        $data['list_perusahaan'] = $this->M_finansial->get_perusahaan();

        $total = $this->M_finansial->total_tarif();
        foreach ($total as $row) {
            $data['pemasukan'] = $row['pemasukan'];
            $data['pengeluaran'] = $row['pengeluaran'];
            $data['profit'] = $row['profit'];
        }

        $this->load->view('header');
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Laporan/V_pendapatan', $data);
        $this->load->view('footer');
        $this->load->view('Finansial/Laporan/js');
    }

}
