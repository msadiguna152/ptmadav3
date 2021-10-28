<?php

class Ptmada extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_mada');
        $this->load->model('Kode');
        $this->load->helper('nominal_helper.php');
        $this->load->library('form_validation');

        if($this->session->userdata('status') != 'Login'){
            $url=base_url();
            echo "<script language='javascript'>alert('Anda Tidak Memiliki Akses'); document.location='" . $url . "';</script>";
        }

        if($this->session->userdata('level') != 'admin' && $this->session->userdata('level') != 'super'){
            $url=base_url();
            echo "<script language='javascript'>alert('Anda Tidak Memiliki Akses'); document.location='" . $url . "';</script>";
        }
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/V_dashboard');
        $this->load->view('footer');
        $this->load->view('PTMADA/js');
    }

    public function get_dashboard()
    {
        $data = $this->M_mada->get_dashboard();
		echo json_encode($data);
    }

    public function ambil_data()
    {
        $modul = $this->input->post('modul');
        $id = $this->input->post('id');

        if ($modul == 'Jaminan') {
            echo $this->M_mada->data_persen($id);
        }
    }

    public function ambil_data1()
    {
        echo $id = $this->input->post('id_instansi');
        $data = $this->M_mada->get_instansi($id);

        $data_instansi = array('pemilik_proyek'    =>  $data['pemilik_proyek'],
                            'alamat_instansi'            =>  $data['alamat_instansi'],);
         echo json_encode($data_instansi);
    }

    public function lihat_kabupaten()
    {
        $data['data'] = $this->M_mada->lihat_kabupaten();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Kabupaten/V_kabupaten', $data);
        $this->load->view('footer');
    }

    public function tambah_kabupaten()
    {
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Kabupaten/V_tambah_kabupaten');
        $this->load->view('footer');
    }


    public function proses_tambah_kabupaten()
    {
        $this->M_mada->proses_tambah_kabupaten();
        $this->session->set_flashdata('hasil','swalberhasilsimpan');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_kabupaten/') . "';</script>";
    }

    public function edit_kabupaten($kd_kabupaten)
    {
        $data['dt'] = $this->M_mada->get_kabupaten($kd_kabupaten);
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Kabupaten/V_edit_kabupaten', $data);
        $this->load->view('footer');
    }

    public function proses_edit_kabupaten()
    {
        $this->M_mada->proses_edit_kabupaten();
        $this->session->set_flashdata('hasil','swalberhasilubah');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_kabupaten/') . "';</script>";
    }

    public function hapus_kabupaten($kd_kabupaten)
    {
        $this->M_mada->hapus_kabupaten($kd_kabupaten);
        $this->session->set_flashdata('hasil','swalberhasilhapus');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_kabupaten') . "';</script>";
    }

    public function lihat_perusahaan()
    {
        $data['data'] = $this->M_mada->lihat_perusahaan();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Perusahaan/V_perusahaan', $data);
        $this->load->view('footer');
    }

    public function detail_perusahaan($kd_perusahaan)
    {
        $data['dt'] = $this->M_mada->get_perusahaan($kd_perusahaan);
        $data['data2'] = $this->M_mada->lihat_permohonan_perusahaan($kd_perusahaan);
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Perusahaan/V_detail_perusahaan', $data);
        $this->load->view('footer');
    }

    public function tambah_perusahaan()
    {
        $data['kode'] = $this->Kode->kd_perusahaan();
        $data['pejabat'] = $this->M_mada->lihat_pejabat();
        $data['agent'] = $this->M_mada->lihat_agent();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Perusahaan/V_tambah_perusahaan', $data);
        $this->load->view('footer');
    }

    public function edit_perusahaan($kd_perusahaan)
    {
        $data['data'] = $this->M_mada->get_perusahaan($kd_perusahaan);
        $data['pejabat'] = $this->M_mada->lihat_pejabat();
        $data['agent'] = $this->M_mada->lihat_agent();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Perusahaan/V_edit_perusahaan', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_perusahaan()
    {
        $this->form_validation->set_rules('kd_pejabat','Pejabat Penghubung','required');
        $this->form_validation->set_rules('kd_agent','Data Agent','required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
        if ($this->form_validation->run() == FALSE) {
            $data['kode'] = $this->Kode->kd_perusahaan();
            $data['pejabat'] = $this->M_mada->lihat_pejabat();
            $data['agent'] = $this->M_mada->lihat_agent();
            $this->load->view('header');
            $this->load->view('PTMADA/menu');
            $this->load->view('PTMADA/Perusahaan/V_tambah_perusahaan', $data);
            $this->load->view('footer');
        }else{
            $this->M_mada->proses_tambah_perusahaan();
            $this->session->set_flashdata('hasil','swalberhasilsimpan');
            echo "<script language='javascript'>document.location='" . base_url('Ptmada/lihat_perusahaan') . "';</script>";
        }
        
    }

    public function proses_edit_perusahaan()
    {
        $this->form_validation->set_rules('kd_pejabat','Pejabat Penghubung','required');
        $this->form_validation->set_rules('kd_agent','Data Agent','required');
         $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
        if ($this->form_validation->run() == FALSE) {
            $kd_perusahaan = $_POST['kd_perusahaan'];
            $data['data'] = $this->M_mada->get_perusahaan($kd_perusahaan);
            $data['pejabat'] = $this->M_mada->lihat_pejabat();
            $data['agent'] = $this->M_mada->lihat_agent();
            $this->load->view('header');
            $this->load->view('PTMADA/menu');
            $this->load->view('PTMADA/Perusahaan/V_edit_perusahaan', $data);
            $this->load->view('footer');
        }else{
            $this->M_mada->proses_edit_perusahaan();
            $this->session->set_flashdata('hasil','swalberhasilubah');
            echo "<script language='javascript'>document.location='" . base_url('Ptmada/detail_perusahaan/'.$_POST['kd_perusahaan']) . "';</script>";
        }
    }

    public function hapus_perusahaan($kd_perusahaan)
    {
        $this->M_mada->hapus_perusahaan($kd_perusahaan);
        $this->session->set_flashdata('hasil','swalberhasilhapus');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_perusahaan/') . "';</script>";
    }

    public function lihat_instansi()
    {
        $data['data'] = $this->M_mada->lihat_instansi();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Instansi/V_instansi', $data);
        $this->load->view('footer');
    }

    public function tambah_instansi()
    {
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Instansi/V_tambah_instansi');
        $this->load->view('footer');
    }

    public function lihat_detail_instansi($id_instansi)
    {
        $data['data'] = $this->M_mada->get_instansi($id_instansi);
        $data['data2'] = $this->M_mada->lihat_permohonan_instansi($id_instansi);
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Instansi/V_detail_instansi', $data);
        $this->load->view('footer');
    }


    public function proses_tambah_instansi()
    {
        $this->M_mada->proses_tambah_instansi();
        $this->session->set_flashdata('hasil','swalberhasilsimpan');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_instansi/') . "';</script>";
    }

    public function edit_instansi($id_instansi)
    {
        $data['data'] = $this->M_mada->get_instansi($id_instansi);
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Instansi/V_edit_instansi', $data);
        $this->load->view('footer');
    }

    public function proses_edit_instansi()
    {
        $this->M_mada->proses_edit_instansi();
        $this->session->set_flashdata('hasil','swalberhasilubah');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_detail_instansi/'.$_POST['id_instansi']) . "';</script>";
    }

    public function hapus_instansi($id_instansi)
    {
        $this->M_mada->hapus_instansi($id_instansi);
        $this->session->set_flashdata('hasil','swalberhasilhapus');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_instansi') . "';</script>";
    }




    public function lihat_pejabat()
    {
        $data['data'] = $this->M_mada->lihat_pejabat();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Pejabat/V_pejabat', $data);
        $this->load->view('footer');
    }

    public function detail_permohonan($kd_permohonan)
    {
        $data['pembayaran'] = $this->M_mada->lihat_pembayaran($kd_permohonan);
        $data['pembayaran_jamkrida'] = $this->M_mada->lihat_pembayaran_jamkrida($kd_permohonan);
        $data['dt'] = $this->M_mada->get_permohonan($kd_permohonan);
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Permohonan/V_detail_permohonan', $data);
        $this->load->view('footer');
    }

    public function lihat_detail_pejabat($kd_pejabat)
    {
        $data['data'] = $this->M_mada->get_pejabat($kd_pejabat);
        $data['data2'] = $this->M_mada->lihat_permohonan_pjbt($kd_pejabat);
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Pejabat/V_detail_pejabat', $data);
        $this->load->view('footer');
    }

    public function tambah_pejabat()
    {
        $data['kode'] = $this->Kode->kd_pejabat();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Pejabat/V_tambah_pejabat', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_pejabat()
    {
        $this->M_mada->proses_tambah_pejabat();
        $this->session->set_flashdata('hasil','swalberhasilsimpan');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_pejabat/') . "';</script>";
    }


    public function edit_pejabat($kd_pejabat)
    {
        $data['data'] = $this->M_mada->get_pejabat($kd_pejabat);
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Pejabat/V_edit_pejabat', $data);
        $this->load->view('footer');
    }

    public function proses_edit_pejabat()
    {
        $this->M_mada->proses_edit_pejabat();
        $this->session->set_flashdata('hasil','swalberhasilubah');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_detail_pejabat/'.$_POST['kd_pejabat']) . "';</script>";
    }

    public function hapus_pejabat($id)
    {
        $this->M_mada->hapus_pejabat($id);
        $this->session->set_flashdata('hasil','swalberhasilhapus');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_pejabat') . "';</script>";
    }

    public function lihat_dokumen()
    {
        $data['data'] = $this->M_mada->lihat_dokumen();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Dokumen/V_dokumen', $data);
        $this->load->view('footer');
    }

    public function tambah_dokumen()
    {
        $data['kd_dokumen'] = $this->Kode->kode_dokumen();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Dokumen/V_tambah_dokumen',$data);
        $this->load->view('footer');
    }


    public function proses_tambah_dokumen()
    {
        $this->M_mada->proses_tambah_dokumen();
        $this->session->set_flashdata('hasil','swalberhasilsimpan');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_dokumen/') . "';</script>";
    }

    public function edit_dokumen($kd_dokumen)
    {
        $data['dt'] = $this->M_mada->get_dokumen($kd_dokumen);
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Dokumen/V_edit_dokumen', $data);
        $this->load->view('footer');
    }

    public function proses_edit_dokumen()
    {
        $this->M_mada->proses_edit_dokumen();
        $this->session->set_flashdata('hasil','swalberhasilubah');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_dokumen/') . "';</script>";
    }

    public function hapus_dokumen($kd_dokumen)
    {
        $this->M_mada->hapus_dokumen($kd_dokumen);
        $this->session->set_flashdata('hasil','swalberhasilhapus');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_dokumen') . "';</script>";
    }


    public function lihat_jenis_jaminan()
    {
        $data['data'] = $this->M_mada->lihat_jenis_jaminan();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Jenis_Jaminan/V_jenis_jaminan', $data);
        $this->load->view('footer');
    }

    public function lihat_jenis_permohonan()
    {
        $data['data'] = $this->M_mada->lihat_jenis_permohonan();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Jenis_Jaminan/V_jenis_permohonan', $data);
        $this->load->view('footer');
    }

    public function tambah_jenis_permohonan()
    {
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Jenis_Jaminan/V_tambah_jenis_permohonan');
        $this->load->view('footer');
    }


    public function proses_tambah_jenis_permohonan()
    {
        $this->M_mada->proses_tambah_jenis_permohonan();
        $this->session->set_flashdata('hasil','swalberhasilsimpan');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_jenis_permohonan/') . "';</script>";
    }

    public function edit_jenis_permohonan($kd_jp)
    {
        $data['dt'] = $this->M_mada->get_jenis_permohonan($kd_jp);
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Jenis_Jaminan/V_edit_jenis_permohonan', $data);
        $this->load->view('footer');
    }

    public function proses_edit_jenis_permohonan()
    {
        $this->M_mada->proses_edit_jenis_permohonan();
        $this->session->set_flashdata('hasil','swalberhasilubah');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_jenis_permohonan/') . "';</script>";
    }

    public function hapus_jenis_permohonan($kd_jp)
    {
        $this->M_mada->hapus_jenis_permohonan($kd_jp);
        $this->session->set_flashdata('hasil','swalberhasilhapus');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_jenis_permohonan') . "';</script>";
    }


    public function lihat_permohonan()
    {
        $data['data'] = $this->M_mada->lihat_permohonan();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Permohonan/V_permohonan', $data);
        $this->load->view('footer');
    }

    public function ambil_data5()
    {   
        $tgl= $this->input->post('dari_tgl');
        $jml = $this->input->post('jml');
        echo $this->M_mada->ambil_tgl($tgl,$jml);
    }

    public function tambah_permohonan()
    {
        $data['perusahaan'] = $this->M_mada->lihat_perusahaan();
        $data['dt'] = $this->Kode->kode_permohonan();
        $data['pejabat'] = $this->M_mada->lihat_pejabat();
        $data['jenis'] = $this->M_mada->lihat_jenis_jaminan();
        $data['dokumen'] = $this->M_mada->lihat_dokumen();
        $data['agent'] = $this->M_mada->lihat_agent();
        $data['permohonan'] = $this->M_mada->lihat_jenis_permohonan();
        $data['instansi'] = $this->M_mada->lihat_instansi();
        $data['kabupaten'] = $this->M_mada->lihat_kabupaten();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Permohonan/V_tambah_permohonan', $data);
        $this->load->view('footer');
    }

    public function edit_permohonan($id_permohonan)
    {
        $data['agent'] = $this->M_mada->lihat_agent();
        $data['permohonan'] = $this->M_mada->get_permohonan($id_permohonan);
        $data['perusahaan'] = $this->M_mada->lihat_perusahaan();
        $data['pejabat'] = $this->M_mada->lihat_pejabat();
        $data['jenis'] = $this->M_mada->lihat_jenis_jaminan();
        $data['dokumen'] = $this->M_mada->lihat_dokumen();
        $data['instansi'] = $this->M_mada->lihat_instansi();
        $data['mohonan'] = $this->M_mada->lihat_jenis_permohonan();
        $data['kabupaten'] = $this->M_mada->lihat_kabupaten();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Permohonan/V_edit_permohonan', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_permohonan()
    {

        $this->form_validation->set_rules('status','Status Dokumen','required');
        $this->form_validation->set_rules('kd_dokumen','Dokumen Pendukung','required');
        $this->form_validation->set_rules('kd_kabupaten','Lokasi','required');
        $this->form_validation->set_rules('id_instansi','Nama Instansi','required');
        $this->form_validation->set_rules('kd_jp','Jenis Permohonan','required');
        $this->form_validation->set_rules('kd_jenis','Jenis Jaminan','required');
        $this->form_validation->set_rules('kd_pejabat','Pejabat Penghubung','required');
        $this->form_validation->set_rules('kd_perusahaan','Nama Perusahaan','required');
        $this->form_validation->set_rules('kd_agent','Data Agent','required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
        if ($this->form_validation->run() == FALSE) {
            
        $data['perusahaan'] = $this->M_mada->lihat_perusahaan();
        $data['dt'] = $this->Kode->kode_permohonan();
        $data['pejabat'] = $this->M_mada->lihat_pejabat();
        $data['jenis'] = $this->M_mada->lihat_jenis_jaminan();
        $data['dokumen'] = $this->M_mada->lihat_dokumen();
        $data['agent'] = $this->M_mada->lihat_agent();
        $data['permohonan'] = $this->M_mada->lihat_jenis_permohonan();
        $data['instansi'] = $this->M_mada->lihat_instansi();
        $data['kabupaten'] = $this->M_mada->lihat_kabupaten();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Permohonan/V_tambah_permohonan', $data);
        $this->load->view('footer');
        }else{
        $this->M_mada->proses_tambah_permohonan();
        $this->session->set_flashdata('hasil','swalberhasilsimpan');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_permohonan/') . "';</script>";
        }
    }

    public function proses_edit_permohonan()
    {
        $this->form_validation->set_rules('kd_agent','Data Agent','required');
        $this->form_validation->set_rules('status','Status Dokumen','required');
        $this->form_validation->set_rules('kd_dokumen','Dokumen Pendukung','required');
        $this->form_validation->set_rules('kd_kabupaten','Lokasi','required');
        $this->form_validation->set_rules('id_instansi','Nama Instansi','required');
        $this->form_validation->set_rules('kd_jp','Jenis Permohonan','required');
        $this->form_validation->set_rules('kd_jenis','Jenis Jaminan','required');
        $this->form_validation->set_rules('kd_pejabat','Pejabat Penghubung','required');
        $this->form_validation->set_rules('kd_perusahaan','Nama Perusahaan','required');
        $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');

        if ($this->form_validation->run() == FALSE) {
            $id_permohonan = $_POST['id_permohonan'];
            $data['agent'] = $this->M_mada->lihat_agent();
            $data['permohonan'] = $this->M_mada->get_permohonan($id_permohonan);
            $data['perusahaan'] = $this->M_mada->lihat_perusahaan();
            $data['pejabat'] = $this->M_mada->lihat_pejabat();
            $data['jenis'] = $this->M_mada->lihat_jenis_jaminan();
            $data['dokumen'] = $this->M_mada->lihat_dokumen();
            $data['instansi'] = $this->M_mada->lihat_instansi();
            $data['mohonan'] = $this->M_mada->lihat_jenis_permohonan();
            $data['kabupaten'] = $this->M_mada->lihat_kabupaten();
            $this->load->view('header');
            $this->load->view('PTMADA/menu');
            $this->load->view('PTMADA/Permohonan/V_edit_permohonan', $data);
            $this->load->view('footer');
        }else{
        $this->M_mada->proses_edit_permohonan();
        $this->session->set_flashdata('hasil','swalberhasilubah');
        echo "<script language='javascript'>document.location='" . base_url('Ptmada/detail_permohonan/'.$_POST['id_permohonan']) . "';</script>";
        }
    }

    public function hapus_permohonan($id)
    {
        $this->M_mada->hapus_permohonan($id);
        $this->session->set_flashdata('hasil','swalberhasilhapus');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_permohonan') . "';</script>";
    }

    public function cetak_permohonan($id_permohonan)
    {
        $tgl = date('Y-m-d');
        $data= $this->M_mada->get_permohonan($id_permohonan);
        $data['dt'] = $this->M_mada->get_permohonan($id_permohonan);
        $nama_dokumen = $data['no_permohonan'];
        $mpdf = new \Mpdf\Mpdf(['utf-8', 'A4']);
        $html = $this->load->view('PTMADA/Permohonan/V_cetak_permohonan',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
    }

    public function lihat_agent()
    {
        $data['data'] = $this->M_mada->lihat_agent();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Agent/V_agent', $data);
        $this->load->view('footer');
    }

    public function lihat_detail_agent($kd_agent)
    {
        $data['data'] = $this->M_mada->get_agent($kd_agent);
        $data['data2'] = $this->M_mada->get_histori_agent($kd_agent);
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Agent/V_detail_agent', $data);
        $this->load->view('footer');
    }

    public function tambah_agent()
    {
        $data['kode'] = $this->Kode->kd_agent();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Agent/V_tambah_agent', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_agent()
    {
        $this->M_mada->proses_tambah_agent();
        $this->session->set_flashdata('hasil','swalberhasilsimpan');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_agent/') . "';</script>";
    }

    public function hapus_agent($id)
    {
        $this->M_mada->hapus_agent($id);
        $this->session->set_flashdata('hasil','swalberhasilhapus');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_agent') . "';</script>";
    }

    public function edit_agent($kd_agent)
    {
        $data['data'] = $this->M_mada->get_agent($kd_agent);
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Agent/V_edit_agent', $data);
        $this->load->view('footer');
    }

    public function proses_edit_agent()
    {
        $this->M_mada->proses_edit_agent();
        $this->session->set_flashdata('hasil','swalberhasilubah');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/lihat_detail_agent/'.$_POST['kd_agent']) . "';</script>";
    }

    public function tambah_pembayaran($id_permohonan)
    {
        $data['id_permohonan'] = $id_permohonan;
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Pembayaran/V_tambah_pembayaran', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_pembayaran()
    {
        $this->M_mada->proses_tambah_pembayaran();
        $this->session->set_flashdata('hasil','swalberhasilsimpan');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/detail_permohonan/' . $_POST['id_permohonan']) . "';</script>";
    }
    

    public function edit_pembayaran($id_pembayaran)
    {
        $data['dt'] = $this->M_mada->get_pembayaran($id_pembayaran);
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Pembayaran/V_edit_pembayaran', $data);
        $this->load->view('footer');
    }

    public function proses_edit_pembayaran()
    {
        $this->M_mada->proses_edit_pembayaran();
        echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Ptmada/detail_permohonan/' . $_POST['id_permohonan']) . "';</script>";
    }

    public function hapus_pembayaran($id_pembayaran, $id_permohonan)
    {
        $this->M_mada->hapus_pembayaran($id_pembayaran);
        $this->session->set_flashdata('hasil','swalberhasilhapus');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/detail_permohonan/' . $id_permohonan) . "';</script>";
    }

    public function tambah_pembayaran_jamkrida($id_permohonan)
    {
        $data['id_permohonan'] = $id_permohonan;
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Pembayaran_jamkrida/V_tambah_pembayaran_jamkrida', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_pembayaran_jamkrida()
    {
        $this->M_mada->proses_tambah_pembayaran_jamkrida();
        $this->session->set_flashdata('hasil','swalberhasilsimpan');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/detail_permohonan/' . $_POST['id_permohonan']) . "';</script>";
    }

    public function edit_pembayaran_jamkrida($id_pembayaran)
    {
        $data['dt'] = $this->M_mada->get_pembayaran_jamkrida($id_pembayaran);
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Pembayaran_jamkrida/V_edit_pembayaran_jamkrida', $data);
        $this->load->view('footer');
    }

    public function proses_edit_pembayaran_jamkrida()
    {
        $this->M_mada->proses_edit_pembayaran_jamkrida();
        echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Ptmada/detail_permohonan/' . $_POST['id_permohonan']) . "';</script>";
    }

    public function hapus_pembayaran_jamkrida($id_pembayaran, $id_permohonan)
    {
        $this->M_mada->hapus_pembayaran_jamkrida($id_pembayaran);
        $this->session->set_flashdata('hasil','swalberhasilhapus');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/detail_permohonan/' . $id_permohonan) . "';</script>";
    }

    public function tambah_sertifikat($id_permohonan)
    {
        $data['id_permohonan'] = $id_permohonan;
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Sertifikat/V_tambah_sertifikat', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_sertifikat()
    {
        $this->M_mada->proses_tambah_sertifikat();
        $this->session->set_flashdata('hasil','swalberhasilsimpan');
        echo "<script language='javascript'> document.location='" . base_url('Ptmada/detail_permohonan/' . $_POST['id_permohonan']) . "';</script>";
    }


     public function lihat_laporan()
    {   
        $data['pejabat'] = $this->M_mada->lihat_pejabat();
        $data['agent'] = $this->M_mada->lihat_agent();
        $data['data'] = $this->M_mada->lihat_laporan();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Laporan/V_laporan', $data);
        $this->load->view('footer');
    }

    public function cari_laporan()
    {
        $data['pejabat'] = $this->M_mada->lihat_pejabat();
        $data['agent'] = $this->M_mada->lihat_agent();
        $data['data'] = $this->M_mada->cari_laporan();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Laporan/V_laporan', $data);
        $this->load->view('footer');
    }

     public function lihat_laporan_komitmen()
    {
        $data['pejabat'] = $this->M_mada->lihat_pejabat();
        $data['data'] = $this->M_mada->laporan_komitmen();
        $this->load->view('header');
        $this->load->view('PTMADA/menu');
        $this->load->view('PTMADA/Laporan/V_laporan_komitmen', $data);
        $this->load->view('footer');
    }

    public function cetak_laporan_komitmen()
    {
        $data['data'] = $this->M_mada->laporan_komitmen();
        $nama_dokumen = "Daftar Komitmen Dokumen Pendukung";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $html = $this->load->view('PTMADA/Laporan/V_cetak_komitmen',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
    }

    public function cetak_laporan()
    {
        $data['data'] = $this->M_mada->lihat_laporan();

        $nama_dokumen = "Dafta Kelengkapan Dokumen Perusahaan";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $html = $this->load->view('PTMADA/Laporan/V_cetak_laporan',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
    }
}
