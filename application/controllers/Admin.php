<?php

/**
 * 
 */
class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_mada');
        $this->load->model('Kode');
        $this->load->model('M_finansial');
        $this->load->model('M_admin');
        $this->load->helper('tgl');
        $this->load->helper('nominal');
        $this->load->helper('nominal_helper.php');
        $this->load->library('form_validation');

        if($this->session->userdata('status') != 'Login'){
            $url=base_url();
            echo "<script language='javascript'>alert('Anda Tidak Memiliki Akses'); document.location='" . $url . "';</script>";
        }

        if($this->session->userdata('level') != 'super'){
            $url=base_url();
            echo "<script language='javascript'>alert('Anda Tidak Memiliki Akses'); document.location='" . $url . "';</script>";
        }

    }

    public function index()
    {
        $data['data'] = $this->M_finansial->count_permohonan();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Finansial/V_dashboard', $data);
        $this->load->view('footer');
        $this->load->view('Finansial/dashboard');
        
    }

    // public function get_dashboard()
    // {
    //     $data = $this->M_mada->get_dashboard();
	// 	echo json_encode($data);
    // }

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
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Kabupaten/V_kabupaten', $data);
        $this->load->view('footer');
    }

    public function tambah_kabupaten()
    {
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Kabupaten/V_tambah_kabupaten');
        $this->load->view('footer');
    }


    public function proses_tambah_kabupaten()
    {
        $this->M_mada->proses_tambah_kabupaten();
        echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Ptmada/lihat_kabupaten/') . "';</script>";
    }

    public function edit_kabupaten($kd_kabupaten)
    {
        $data['dt'] = $this->M_mada->get_kabupaten($kd_kabupaten);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Kabupaten/V_edit_kabupaten', $data);
        $this->load->view('footer');
    }

    public function proses_edit_kabupaten()
    {
        $this->M_mada->proses_edit_kabupaten();
        echo "<script language='javascript'>alert('Data Berhasil Diedit'); document.location='" . base_url('Ptmada/lihat_kabupaten/') . "';</script>";
    }

    public function hapus_kabupaten($kd_kabupaten)
    {
        $this->M_mada->hapus_kabupaten($kd_kabupaten);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Ptmada/lihat_kabupaten') . "';</script>";
    }

    public function lihat_perusahaan()
    {
        $data['data'] = $this->M_mada->lihat_perusahaan();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Perusahaan/V_perusahaan', $data);
        $this->load->view('footer');
    }

    public function detail_perusahaan($kd_perusahaan)
    {
        $data['dt'] = $this->M_mada->get_perusahaan($kd_perusahaan);
        $data['data2'] = $this->M_mada->lihat_permohonan_perusahaan($kd_perusahaan);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Perusahaan/V_detail_perusahaan', $data);
        $this->load->view('footer');
    }

    public function tambah_perusahaan()
    {
        $data['kode'] = $this->Kode->kd_perusahaan();
        $data['pejabat'] = $this->M_mada->lihat_pejabat();
        $data['agent'] = $this->M_mada->lihat_agent();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Perusahaan/V_tambah_perusahaan', $data);
        $this->load->view('footer');
    }

    public function edit_perusahaan($kd_perusahaan)
    {
        $data['data'] = $this->M_mada->get_perusahaan($kd_perusahaan);
        $data['pejabat'] = $this->M_mada->lihat_pejabat();
        $data['agent'] = $this->M_mada->lihat_agent();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Perusahaan/V_edit_perusahaan', $data);
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
            $this->load->view('Admin/menu');
            $this->load->view('Admin/Perusahaan/V_tambah_perusahaan', $data);
            $this->load->view('footer');
        }else{
            $this->M_mada->proses_tambah_perusahaan();
            echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Ptmada/lihat_perusahaan') . "';</script>";
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
            $this->load->view('Admin/menu');
            $this->load->view('Admin/Perusahaan/V_edit_perusahaan', $data);
            $this->load->view('footer');
        }else{
            $this->M_mada->proses_edit_perusahaan();
            echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Ptmada/detail_perusahaan/'.$_POST['kd_perusahaan']) . "';</script>";
        }
    }

    public function hapus_perusahaan($kd_perusahaan)
    {
        $this->M_mada->hapus_perusahaan($kd_perusahaan);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Ptmada/lihat_perusahaan/') . "';</script>";
    }

    public function lihat_instansi()
    {
        $data['data'] = $this->M_mada->lihat_instansi();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Instansi/V_instansi', $data);
        $this->load->view('footer');
    }

    public function tambah_instansi()
    {
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Instansi/V_tambah_instansi');
        $this->load->view('footer');
    }

    public function lihat_detail_instansi($id_instansi)
    {
        $data['data'] = $this->M_mada->get_instansi($id_instansi);
        $data['data2'] = $this->M_mada->lihat_permohonan_instansi($id_instansi);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Instansi/V_detail_instansi', $data);
        $this->load->view('footer');
    }


    public function proses_tambah_instansi()
    {
        $this->M_mada->proses_tambah_instansi();
        echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Ptmada/lihat_instansi/') . "';</script>";
    }

    public function edit_instansi($id_instansi)
    {
        $data['data'] = $this->M_mada->get_instansi($id_instansi);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Instansi/V_edit_instansi', $data);
        $this->load->view('footer');
    }

    public function proses_edit_instansi()
    {
        $this->M_mada->proses_edit_instansi();
        echo "<script language='javascript'>alert('Data Berhasil Diedit'); document.location='" . base_url('Ptmada/lihat_detail_instansi/'.$_POST['id_instansi']) . "';</script>";
    }

    public function hapus_instansi($id_instansi)
    {
        $this->M_mada->hapus_instansi($id_instansi);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Ptmada/lihat_instansi') . "';</script>";
    }




    public function lihat_pejabat()
    {
        $data['data'] = $this->M_mada->lihat_pejabat();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pejabat/V_pejabat', $data);
        $this->load->view('footer');
    }

    public function detail_permohonan($kd_permohonan)
    {
        $data['pembayaran'] = $this->M_mada->lihat_pembayaran($kd_permohonan);
        $data['pembayaran_jamkrida'] = $this->M_mada->lihat_pembayaran_jamkrida($kd_permohonan);
        $data['dt'] = $this->M_mada->get_permohonan($kd_permohonan);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Permohonan/V_detail_permohonan', $data);
        $this->load->view('footer');
    }

    public function lihat_detail_pejabat($kd_pejabat)
    {
        $data['data'] = $this->M_mada->get_pejabat($kd_pejabat);
        $data['data2'] = $this->M_mada->lihat_permohonan_pjbt($kd_pejabat);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pejabat/V_detail_pejabat', $data);
        $this->load->view('footer');
    }

    public function tambah_pejabat()
    {
        $data['kode'] = $this->Kode->kd_pejabat();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pejabat/V_tambah_pejabat', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_pejabat()
    {
        $this->M_mada->proses_tambah_pejabat();
        echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Ptmada/lihat_pejabat/') . "';</script>";
    }


    public function edit_pejabat($kd_pejabat)
    {
        $data['data'] = $this->M_mada->get_pejabat($kd_pejabat);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pejabat/V_edit_pejabat', $data);
        $this->load->view('footer');
    }

    public function proses_edit_pejabat()
    {
        $this->M_mada->proses_edit_pejabat();
        echo "<script language='javascript'>alert('Data Berhasil Diedit'); document.location='" . base_url('Ptmada/lihat_detail_pejabat/'.$_POST['kd_pejabat']) . "';</script>";
    }

    public function hapus_pejabat($id)
    {
        $this->M_mada->hapus_pejabat($id);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Ptmada/lihat_pejabat') . "';</script>";
    }

    public function lihat_dokumen()
    {
        $data['data'] = $this->M_mada->lihat_dokumen();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Dokumen/V_dokumen', $data);
        $this->load->view('footer');
    }

    public function tambah_dokumen()
    {
        $data['kd_dokumen'] = $this->Kode->kode_dokumen();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Dokumen/V_tambah_dokumen',$data);
        $this->load->view('footer');
    }


    public function proses_tambah_dokumen()
    {
        $this->M_mada->proses_tambah_dokumen();
        echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Ptmada/lihat_dokumen/') . "';</script>";
    }

    public function edit_dokumen($kd_dokumen)
    {
        $data['dt'] = $this->M_mada->get_dokumen($kd_dokumen);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Dokumen/V_edit_dokumen', $data);
        $this->load->view('footer');
    }

    public function proses_edit_dokumen()
    {
        $this->M_mada->proses_edit_dokumen();
        echo "<script language='javascript'>alert('Data Berhasil Diedit'); document.location='" . base_url('Ptmada/lihat_dokumen/') . "';</script>";
    }

    public function hapus_dokumen($kd_dokumen)
    {
        $this->M_mada->hapus_dokumen($kd_dokumen);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Ptmada/lihat_dokumen') . "';</script>";
    }


    public function lihat_jenis_jaminan()
    {
        $data['data'] = $this->M_mada->lihat_jenis_jaminan();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Jenis_Jaminan/V_jenis_jaminan', $data);
        $this->load->view('footer');
    }

    public function lihat_jenis_permohonan()
    {
        $data['data'] = $this->M_mada->lihat_jenis_permohonan();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Jenis_Jaminan/V_jenis_permohonan', $data);
        $this->load->view('footer');
    }

    public function tambah_jenis_permohonan()
    {
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Jenis_Jaminan/V_tambah_jenis_permohonan');
        $this->load->view('footer');
    }


    public function proses_tambah_jenis_permohonan()
    {
        $this->M_mada->proses_tambah_jenis_permohonan();
        echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Ptmada/lihat_jenis_permohonan/') . "';</script>";
    }

    public function edit_jenis_permohonan($kd_jp)
    {
        $data['dt'] = $this->M_mada->get_jenis_permohonan($kd_jp);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Jenis_Jaminan/V_edit_jenis_permohonan', $data);
        $this->load->view('footer');
    }

    public function proses_edit_jenis_permohonan()
    {
        $this->M_mada->proses_edit_jenis_permohonan();
        echo "<script language='javascript'>alert('Data Berhasil Diedit'); document.location='" . base_url('Ptmada/lihat_jenis_permohonan/') . "';</script>";
    }

    public function hapus_jenis_permohonan($kd_jp)
    {
        $this->M_mada->hapus_jenis_permohonan($kd_jp);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Ptmada/lihat_jenis_permohonan') . "';</script>";
    }


    public function lihat_permohonan()
    {
        $data['data'] = $this->M_mada->lihat_permohonan();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Permohonan/V_permohonan', $data);
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
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Permohonan/V_tambah_permohonan', $data);
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
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Permohonan/V_edit_permohonan', $data);
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
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Permohonan/V_tambah_permohonan', $data);
        $this->load->view('footer');
        }else{
        $this->M_mada->proses_tambah_permohonan();
       echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Ptmada/lihat_permohonan/') . "';</script>";
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
            $this->load->view('Admin/menu');
            $this->load->view('Admin/Permohonan/V_edit_permohonan', $data);
            $this->load->view('footer');
        }else{
        $this->M_mada->proses_edit_permohonan();
       echo "<script language='javascript'>alert('Data Berhasil DiUbah'); document.location='" . base_url('Ptmada/detail_permohonan/'.$_POST['id_permohonan']) . "';</script>";
        }
    }

    public function hapus_permohonan($id)
    {
        $this->M_mada->hapus_permohonan($id);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Ptmada/lihat_permohonan') . "';</script>";
    }

    public function cetak_permohonan($id_permohonan)
    {
        $tgl = date('Y-m-d');
        $data= $this->M_mada->get_permohonan($id_permohonan);
        $data['dt'] = $this->M_mada->get_permohonan($id_permohonan);
        $nama_dokumen = $data['no_permohonan'];
        $mpdf = new \Mpdf\Mpdf(['utf-8', 'A4']);
        $html = $this->load->view('Admin/Permohonan/V_cetak_permohonan',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output($nama_dokumen.".pdf" ,'I');








       // // echo $a = strlen($data['alamat_perusahaan']);
       //echo  $b = strlen($data['pemilik_proyek']);
       //  $this->load->library('fpdf');
       //  $pdf = new FPDF('p', 'mm', 'A4');
       //  $cellWidth = 135; //lebar sel
       //  $cellHeight = 5; //tinggi sel satu baris normal

        




       //  // membuat halaman baru
       //  $pdf->AddPage();
       //  // setting jenis font yang akan digunakan
       //  $pdf->SetFont('Arial', 'B', 15);
       //  // mencetak string 
       //  $pdf->Image('file/Logo.jpg', 10, 10, 10, 'L');
       //  $pdf->Cell(10, 17, '', 0, 0, 'C');
       //  $pdf->Cell(10, 10, 'PT. JAMKRIDA KALSEL', 0, 0, 'L');
       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', 'B', 8);
       //  $pdf->Cell(190, 1, '', 0, 0, 'C');
       //  $pdf->Ln();
       //  $pdf->Cell(190, 6, 'PERMOHONAN SURETY BOND/BANK GARANSI', 1, 0, 'C');
       //  $pdf->Ln();
       //  $pdf->Cell(50, 5, 'No. Permohonan', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->Cell(135, 5, $data['no_permohonan'], 1, 0);
       //  $pdf->Ln();
       //  $pdf->Cell(190, 4, 'DATA PEMOHON', 1, 0);


       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->Cell(50, 5, '1. Nama Perusahaan/Principal', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->SetFont('Arial', 'B', 8);
       //  $pdf->Cell(135, 5, $data['nama_perusahaan'], 1, 0);

       //  $a = strlen($data['alamat_perusahaan']);

       //  if ($a >= 100) {
       //      $line = 2;
       //      $tinggi = 5;
       //      $cellHeight1 = 2.5;
       //  }elseif ($a<100) {
       //      $line = 2;
       //      $cellHeight1 = 2.5;
       //      $tinggi = 2.5;
       //  }
       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->Cell(50, ($line * $tinggi ), '2. Alamat', 1, 0);
       //  $pdf->Cell(5, ($line * $tinggi ), ' : ', 1, 0, 'C');
       //  $pdf->MultiCell($cellWidth,($line * $cellHeight1 ), $data['alamat_perusahaan'], 1, "T");
    
       //  $pdf->Cell(50, 5, '3. Nomor Telpon', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->Cell(135, 5, $data['no_telpon'], 1, 0);

       //  $pdf->Ln();
       //  $pdf->Cell(50, 5, '4. Nomor Fax', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->Cell(135, 5, $data['no_fax'], 1, 0);

       //  $pdf->Ln();
       //  $pdf->Cell(50, 5, '5. E-mail', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->Cell(135, 5, $data['email'], 1, 0);

       //  $pdf->Ln();
       //  $pdf->Cell(50, 9, '6. Nama Pejabat', 1, 0);
       //  $pdf->Cell(5, 9, ' : ', 1, 0, 'C');
       //  $pdf->Cell(135, 9, $data['nama_pejabat'], 1, 0);

       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', 'B', 8);
       //  $pdf->Cell(190, 5, 'JAMINAN YANG DIMINTA', 1, 0);

       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->Cell(50, 5, '1. Jenis Jaminan', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->Cell(135, 5, $data['jenis_jaminan'], 1, 0);

       //  // $pdf->Ln();
       //  // $pdf->SetFont('Arial', '', 8);
       //  // $pdf->Cell(50, 5, '', 1, 0);
       //  // $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  // $pdf->Cell(135, 5, '1. Nama Perusahaan/Principal', 1, 0);

       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->Cell(50, 5, '2. Nilai Jaminan', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->SetFont('Arial', 'B', 8);
       //  $pdf->Cell(135, 5, "Rp." . number_format($data['nilai_jaminan'], 2, ",", "."), 1, 0);

       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', 'B', 8);
       //  $pdf->Cell(50, 5, '', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->Cell(135, 5, $data['persen'] . " %", 1, 0);

       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->Cell(50, 5, '3. Jangka Waktu', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->SetFont('Arial', 'B', 8);
       //  $pdf->Cell(135, 5,     $data['jangka_waktu'] . " Hari  Mulai Dari : " . date('d-M-Y', strtotime($data['dari_tgl'])) . " Sampai Dengan : " . date('d-M-Y', strtotime($data['sampai_tgl'])), 1, 0, 'C');

       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->Cell(50, 5, '', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->Cell(135, 5, '', 1, 0);

       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->Cell(50, 5, '4. Mohon Terbit', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->SetFont('Arial', 'B', 8);
       //  $pdf->Cell(135, 5, $data['jenis_permohonan'], 1, 0, 'C');

       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', 'B', 8);
       //  $pdf->Cell(190, 5, 'RINCIAN PROYEK', 1, 0);

       //  $b = strlen($data['pemilik_proyek']);

       //  if ($b >= 180) {
       //      $line = 2;
       //      $cellHeight = 2.5;
       //      $y =10;
       //  }elseif ($b> 30 && $b <175) {
       //      $line = 1;
       //      $cellHeight = 5;
       //      $y = 115;
       //  }
       //  else{
       //      $line = 1;
       //      $cellHeight = 5;
       //      $y = 110;
       //  }
       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->MultiCell(50,   ($line * $cellHeight), '1. Nama Instansi Pemilik Proyek / Oblige', 1, 'T');
       //  $pdf->SetX(60);
       //  $pdf->SetY($y);
       //  $pdf->Cell(50, ($line * 2), '', 0, 0);
       //  $pdf->Cell(5, 10, ' : ', 1, 0, 'T');
       //  $pdf->MultiCell($cellWidth, ($line * $cellHeight), $data['pemilik_proyek'], 1, 'T');
       // //$pdf->Ln();

       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->Cell(50, 5, '2. Alamat', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->Cell(135, 5, $data['alamat_instansi'], 1, 1);

       //  $c = strlen($data['nama_pekerjaan']);

       //  if ($c > 100) {
       //      $line = 2;
       //      $cellHeight = 2.5 ;
       //  }else{
       //      $line = 1;
       //      $cellHeight = 5;
       //  }
       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->Cell(50, ($line * 5), '3. Nama Pekerjaan', 1, 0);
       //  $pdf->Cell(5, ($line * 5), ' : ', 1, 0, 'C');
       //  $pdf->MultiCell($cellWidth,  ($line * $cellHeight), $data['nama_pekerjaan'], 1,'T');
       //  // $pdf->Ln();
       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->Cell(50, 5, '4. Lokasi Proyek', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->SetFont('Arial', 'B', 8);
       //  $pdf->Cell(135, 5, $data['kabupaten'], 1, 0);

       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->Cell(50, 7, '5. Nilai Proyek/Kontrak/HPS', 1, 0);
       //  $pdf->Cell(5, 7, ' : ', 1, 0, 'L');
       //  $pdf->SetFont('Arial', 'B', 10);
       //  $pdf->Cell(135, 7, 'Rp.' . number_format($data['nilai_proyek'], 2, ',', '.'), 1, 0);


       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->Cell(50, 5, '6. Dokumen Pendukung', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->Cell(135, 5, $data['dokumen'], 1, 0);

       //  $pdf->Ln();
       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->Cell(50, 5, '7. No. Dokumen Pendukung', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->Cell(135, 5, $data['no_dokumen'], 1, 0);
       //  $pdf->Ln();

       //  $pdf->Cell(50, 5, '', 1, 0);
       //  $pdf->Cell(5, 5, '  ', 1, 0, 'C');
       //  $pdf->Cell(135, 5, '', 1, 0);
       //  $pdf->Ln();

       //  $pdf->Cell(50, 5, '8. Tanggal Dok. Pendukung', 1, 0);
       //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  $pdf->Cell(135, 5, tgl_indo($data['tgl_dokumen']), 1, 0);
       //  // $pdf->Ln();
       //  //  $pdf->Cell(5, 5, ' : ', 1, 0, 'C');
       //  // $pdf->Cell(5, 5, '', 0, 0);
       //  // $pdf->Cell(135, 5, 'Kabupaten Hulu Sungai Tengah', 1, 0);

       //  $pdf->Ln();
       //  $pdf->Cell(50, 5, '', 0, 0);
       //  $pdf->Ln();
       //  $pdf->Cell(190, 5, 'Sebagai bahan pertimbangan, terlampir kami kirimkan fotocopy dokumen pendukung.', 0, 0);

       //  $pdf->Ln();
       //  $pdf->Cell(190, 5, 'Demikian Permohonan kami, Atas bantuan dan perhatiannya kami ucapkan terima kasih', 0, 0);


       //  $pdf->Ln();
       //  $pdf->Cell(50, 25, '', 0, 1);
       //  $pdf->Cell(190, 5, "Banjarmasin, " . tgl_indo($data['tgl_permohonan']), 0, 0);

       //  $pdf->SetLineWidth(1);
       //  $pdf->Ln(5);
       //  $pdf->SetFont('Arial', 'B', 9);
       //  $pdf->Cell(50, 25, '', 0, 1);
       //  $pdf->Cell(190, 5, $data['nama_direktur'], 0, 0);

       //  $pdf->Ln(5);
       //  $pdf->SetFont('Arial', '', 8);
       //  $pdf->Cell(50, 2, '', 0, 1);
       //  $pdf->Cell(190, 0, "Direktur", 0, 0);
       //  //       $pdf->SetLineWidth(1);
       //  // $pdf->Line(10,36,138,36);
       //  // Memberikan space kebawah agar tidak terlalu rapat

       //  $nama = "PERMOHONAN " . $data['no_permohonan'] . ".pdf";
        //  $pdf->Output($nama, "I");
    }


    public function lihat_agent()
    {
        $data['data'] = $this->M_mada->lihat_agent();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Agent/V_agent', $data);
        $this->load->view('footer');
    }

    public function lihat_detail_agent($kd_agent)
    {
        $data['data'] = $this->M_mada->get_agent($kd_agent);
        $data['data2'] = $this->M_mada->get_histori_agent($kd_agent);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Agent/V_detail_agent', $data);
        $this->load->view('footer');
    }

    public function tambah_agent()
    {
        $data['kode'] = $this->Kode->kd_agent();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Agent/V_tambah_agent', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_agent()
    {
        $this->M_mada->proses_tambah_agent();
        echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Ptmada/lihat_agent/') . "';</script>";
    }

    public function hapus_agent($id)
    {
        $this->M_mada->hapus_agent($id);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Ptmada/lihat_agent') . "';</script>";
    }

    public function edit_agent($kd_agent)
    {
        $data['data'] = $this->M_mada->get_agent($kd_agent);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Agent/V_edit_agent', $data);
        $this->load->view('footer');
    }

    public function proses_edit_agent()
    {
        $this->M_mada->proses_edit_agent();
        echo "<script language='javascript'>alert('Data Berhasil Diedit'); document.location='" . base_url('Ptmada/lihat_detail_agent/'.$_POST['kd_agent']) . "';</script>";
    }

    public function tambah_pembayaran($id_permohonan)
    {
        $data['id_permohonan'] = $id_permohonan;
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pembayaran/V_tambah_pembayaran', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_pembayaran()
    {
        $this->M_mada->proses_tambah_pembayaran();
        echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Ptmada/detail_permohonan/' . $_POST['id_permohonan']) . "';</script>";
    }
    

    public function edit_pembayaran($id_pembayaran)
    {
        $data['dt'] = $this->M_mada->get_pembayaran($id_pembayaran);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pembayaran/V_edit_pembayaran', $data);
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
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Ptmada/detail_permohonan/' . $id_permohonan) . "';</script>";
    }

    public function tambah_pembayaran_jamkrida($id_permohonan)
    {
        $data['id_permohonan'] = $id_permohonan;
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pembayaran_jamkrida/V_tambah_pembayaran_jamkrida', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_pembayaran_jamkrida()
    {
        $this->M_mada->proses_tambah_pembayaran_jamkrida();
        echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Ptmada/detail_permohonan/' . $_POST['id_permohonan']) . "';</script>";
    }

    public function edit_pembayaran_jamkrida($id_pembayaran)
    {
        $data['dt'] = $this->M_mada->get_pembayaran_jamkrida($id_pembayaran);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pembayaran_jamkrida/V_edit_pembayaran_jamkrida', $data);
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
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Ptmada/detail_permohonan/' . $id_permohonan) . "';</script>";
    }

    public function tambah_sertifikat($id_permohonan)
    {
        $data['id_permohonan'] = $id_permohonan;
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Sertifikat/V_tambah_sertifikat', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_sertifikat()
    {
        $this->M_mada->proses_tambah_sertifikat();
        echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Ptmada/detail_permohonan/' . $_POST['id_permohonan']) . "';</script>";
    }


     public function lihat_laporan()
    {   
        $data['pejabat'] = $this->M_mada->lihat_pejabat();
        $data['agent'] = $this->M_mada->lihat_agent();
        $data['data'] = $this->M_mada->lihat_laporan();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Laporan/V_laporan', $data);
        $this->load->view('footer');
    }

    public function cari_laporan()
    {
        $data['pejabat'] = $this->M_mada->lihat_pejabat();
        $data['agent'] = $this->M_mada->lihat_agent();
        $data['data'] = $this->M_mada->cari_laporan();
        // echo $_POST['kd_pejabat'];
        // echo $_POST['kd_agent'];
        // echo "<pre>";
        // echo print_r($data['data']);
        // echo "</pre>";
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Laporan/V_laporan', $data);
        $this->load->view('footer');
    }

     public function lihat_laporan_komitmen()
    {
        $data['pejabat'] = $this->M_mada->lihat_pejabat();
        $data['data'] = $this->M_mada->laporan_komitmen();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Laporan/V_laporan_komitmen', $data);
        $this->load->view('footer');
    }

    public function cetak_laporan_komitmen()
    {
        //$data = $this->M_mada->get_permohonan($id_permohonan);
        $data['data'] = $this->M_mada->laporan_komitmen();
        $nama_dokumen = "Daftar Komitmen Dokumen Pendukung";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $html = $this->load->view('Admin/Laporan/V_cetak_komitmen',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
        // $this->load->library('fpdf');
        // $pdf = new FPDF('L', 'mm', 'Legal');
        // $pdf->AddPage();
        // $pdf->SetFont('Arial', 'B', 15);
        // $pdf->Cell(340, 10, 'Daftar Komitmen Dokumen Pendukung', 0,0,'C');
        // $pdf->SetFont('Arial', 'B', 10);
        // $pdf->ln();
        // $pdf->Cell(10, 10, 'No', 1,0,'C');
        // $pdf->SetY(20);
        // $pdf->SetX(20);
        // $pdf->MultiCell(30, 5, "Nomor Permohonan", 1,'C');
        // $pdf->SetY(20);
        // $pdf->SetX(50);
        // $pdf->Cell(70, 10, "Nama Perusahaan", 1, 0,'C');
        // $pdf->Cell(70, 10, "Nama Proyek", 1, 0,'C');
        // $pdf->MultiCell(25, 5, "Tanggal Komitmen", 1,'C');
        
        // $pdf->SetY(20);
        // $pdf->SetX(215);
        // $pdf->MultiCell(50, 5, "Catatan Dokumen Pendukung", 1,'C');

        // $pdf->SetY(20);
        // $pdf->SetX(265);
        // $pdf->MultiCell(45, 10, "Pejabat Penghubung", 1,'C');
        // $pdf->SetY(20);
        // $pdf->SetX(310);
        // $pdf->Cell(30, 10, "Status", 1, 0,'C');
        // $pdf->Ln();
        // $pdf->SetFont('Arial', '', 10);
        // $no=1;
        // $y = 30;
        // $tinggi = 5;
        // foreach ($data as $dt) {
        //     $proyek = strlen($dt['nama_pekerjaan']);
        //     $catatan = strlen($dt['catatan_dokumen']);
        //     if ($proyek > $catatan) {
        //         if ($proyek < 90) {
        //             $tinggi = 5;

        //         $tinggi2 = 10;
        //         $x = 20;
        //         $tg = 10;
        //         }else{
        //         $tinggi = 7.5;
        //         $tg = 15;


        //         $tinggi2 = 15;
        //         }
                
        //         $tgl = strlen(tgl_indo($dt['tgl_komitmen']));
        //         if ($tgl > 13) {
        //             //$tgl1 = 5;
        //             if ($proyek < 90) {
        //                 $tgl1 = 5;  
        //             }else{
        //                 $tgl1 = 7.5;
        //             }
        //         }else{
        //             if ($proyek < 90) {
        //                 $tgl1 = 10;  
        //             }else{
        //                 $tgl1 = 7.5;
        //             }
        //             //$tgl1 = 10;
        //         }


        //         $tinggi1 = 5;
        //         $pejabat = strlen($dt['nama_pejabat']);
        //         if ($pejabat > 20) {
        //             if ($proyek < 90) {
        //                 $tinggi3 = 5;  
        //             }else{
        //                 $tinggi3 = 7.5;
        //             }
        //         }else{
        //             if ($proyek < 90) {
        //                 $tinggi3 = 10;  
        //             }else{
        //                 $tinggi3 = 7.5;
        //             }
        //         //$tinggi3 = 10;
        //         }

        //     }else{
        //         $tinggi = 5;
        //         $tinggi1 = 10;
        //         $tinggi3 = 10;
        //     }
        //     $pdf->Cell(10, $tg, $no++, 1,0,'C');
        //     $pdf->SetY($y);
        //     $pdf->SetX(20);
        //     $pdf->MultiCell(30, $tinggi, $dt['no_permohonan'], 1,'C');
        //     $pdf->SetY($y);
        //     $pdf->SetX(50);
        //     $pdf->Cell(70, $tg, $dt['nama_perusahaan'], 1, 0,'L');
        //     $pdf->SetY($y);
        //     $pdf->SetX(120);
        //     $pdf->MultiCell(70, $tinggi1, $dt['nama_pekerjaan'], 1,'L');
        //     $pdf->SetY($y);
        //     $pdf->SetX(190);
        //     $pdf->MultiCell(25, $tgl1, tgl_indo($dt['tgl_komitmen']), 1,'C');
            
        //     $pdf->SetY($y);
        //     $pdf->SetX(215);
        //     $pdf->MultiCell(50, $tinggi2, $dt['catatan_dokumen'], 1,'L');

        //     $pdf->SetY($y);
        //     $pdf->SetX(265);
        //     $pdf->MultiCell(45, $tinggi3, $dt['nama_pejabat'], 1,'L');
        //     $pdf->SetY($y);
        //     $pdf->SetX(310);
        //     $pdf->Cell(30, $tg, $dt['status'] ,1, 0,'C');
        //     $pdf->Ln();

        //     if ($proyek < 90) {
        //                 $y+=10;  
        //             }else{
        //                $y+=15;
        //             }
            
        // }
        // $nama = "Laporan Komitmen Dokumen Pendukung.pdf";
        // $pdf->Output($nama, "I");
    }

    public function cetak_laporan()
    {
        //$data = $this->M_mada->get_permohonan($id_permohonan);
        $data['data'] = $this->M_mada->lihat_laporan();

        $nama_dokumen = "Dafta Kelengkapan Dokumen Perusahaan";
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $html = $this->load->view('Admin/Laporan/V_cetak_laporan',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
        //$this->load->library('fpdf');
        // $pdf = new FPDF('L', 'mm', 'Legal');
        // $pdf->AddPage();
        // $pdf->SetFont('Arial', 'B', 15);
        // $pdf->Cell(340, 10, 'Daftar Kelengkapan Dokumen Perusahaan', 0,0,'C');
        // $pdf->SetFont('Arial', 'B', 10);
        // $pdf->ln();
        // $pdf->Cell(10, 10, 'No', 1,0,'C');
        // $pdf->Cell(70, 10, "Nama Perusahaan", 1, 0,'C');
        // $pdf->Cell(160, 10, "Kekurangan Dokumen", 1, 0,'C');
        // $pdf->Cell(50, 10, "Pejabat Penghubung", 1, 0,'C');
        // $pdf->Cell(50, 10, "Agent", 1, 0,'C');
        // $pdf->Ln();
        // $no=1;
        // foreach ($data as $dt) {
        //     if ($dt['company_profile'] =='Tidak Ada Data') {
        //                 $cp= "Company Profile, ";
        //                }else{
        //                 $cp='';
        //                } 

        //               if ($dt['akta_pendirian'] =='Tidak Ada Data') {
        //                  $ap="Akta Pendirian, ";
        //                }else{
        //                 $ap='';
        //                }
        //               if ($dt['spkmgr'] =='Tidak Ada Data') {
        //                 $spkmgr="SPKMGR, ";
        //                }else{
        //                 $spkmgr='';
        //                } 
        //               if ($dt['stdp'] =='Tidak Ada Data') {
        //                 $stdp="STDP, ";
        //                }else{
        //                 $stdp='';
        //                }
        //               if ($dt['siup'] =='Tidak Ada Data') {
        //                 $siup="SIUP, ";
        //                }else{
        //                 $siup='';
        //                }
        //               if ($dt['sktu'] =='Tidak Ada Data') {
        //                 $sktu="SKTU, ";
        //                }else{
        //                 $sktu='';
        //                }
        //               if ($dt['siujk'] =='Tidak Ada Data') {
        //                 $siujk= "SIUJK, ";
        //                } else{
        //                 $siujk='';
        //                }
        //               if ($dt['spt'] =='Tidak Ada Data') {
        //                  $spt= "SPT, ";
        //                } else{
        //                 $spt='';
        //                }
        //                if ($dt['npwp_file'] =='Tidak Ada Data') {
        //                   $npwp="NPWP, ";
        //                } else{
        //                 $npwp='';
        //                }
        //               if ($dt['ktp'] =='Tidak Ada Data') {
        //                 $ktp=  "KTP, ";
        //                }else{
        //                 $ktp ='';
        //                } 
        //                if ($dt['laporan_keuangan'] =='Tidak Ada Data') {
        //                    $lp="Laporan keuangan, ";
        //                }else{
        //                 $lp='';
        //                } 
        //                if ($dt['proyek_sebelumnya'] =='Tidak Ada Data') {
        //                   $ps = "Proyek Sebelumnya, ";
        //                }else{
        //                 $ps ='';
        //                }  

        //     $pdf->SetFont('Arial', '', 7.5);
        //     $pdf->Cell(10, 10, $no++.".", 1,0);
        //     $pdf->Cell(70, 10, $dt['nama_perusahaan'], 1, 0);
        //     $pdf->Cell(160, 10, $cp."".$ap."".$spkmgr."".$stdp."".$siup."".$sktu."".$siujk."".$spt."".$npwp."".$ktp."".$lp."".$ps, 1, 0);
        //     $pdf->Cell(50, 10, $dt['nama_pejabat'], 1, 0);
        //     $pdf->Cell(50, 10, $dt['nama_agent'], 1, 0);
        // $pdf->Ln();
        // }
        // $nama = "Laporan.pdf";
        // $pdf->Output($nama, "I");
    }

    // ============================================================finansial
    public function get_dashboard()
    {
        $data = $this->M_finansial->get_dashboard();
		echo json_encode($data);
    }

    
    public function get_pendapatan($status=NULL)
    {
        $data = $this->M_finansial->get_pendapatan($status);
		echo json_encode($data);
    }

    public function get_profit($status=NULL)
    {
        $data = $this->M_finansial->get_profit($status);
		echo json_encode($data);
    }

    //pengeluaran ==============================================================================
    // public function lihat_pengeluaran($status)
    // {
    //     $data['status'] = $status;
    //     $data['data'] = $this->M_finansial->lihat_pengeluaran($status);
    //     $this->load->view('header');
    //     $this->load->view('Admin/menu');
    //     $this->load->view('Admin/Pengeluaran/V_pengeluaran', $data);
    //     $this->load->view('footer');
    // }

    // public function tambah_pengeluaran($status)
    // {
    //     $data['status'] = $status;
    //     //$data['kode'] = $this->Kode->kd_pengeluaran();
    //     $this->load->view('header');
    //     $this->load->view('Admin/menu');
    //     $this->load->view('Admin/Pengeluaran/V_tambah_pengeluaran', $data);
    //     $this->load->view('footer');
    // }

    // public function edit_pengeluaran($id, $status)
    // {
    //     $data['status'] = $status;
    //     $data['data'] = $this->M_finansial->get_pengeluaran($id);
    //     $this->load->view('header');
    //     $this->load->view('Admin/menu');
    //     $this->load->view('Admin/pengeluaran/V_edit_pengeluaran', $data);
    //     $this->load->view('footer');
    // }

    // public function proses_tambah_pengeluaran($status)
    // {
    //     $this->M_finansial->proses_tambah_pengeluaran();
    //     echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Admin/lihat_pengeluaran/' . $status) . "';</script>";
    // }

    // public function proses_edit_pengeluaran($id, $status)
    // {
    //     $this->M_finansial->proses_edit_pengeluaran($id);
    //     echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Admin/lihat_pengeluaran/' . $status) . "';</script>";
    // }

    // public function hapus_pengeluaran($id, $status)
    // {
    //     $this->M_finansial->hapus_pengeluaran($id);
    //     echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Admin/lihat_pengeluaran/' . $status) . "';</script>";
    // }

    //permohonan ==============================================================================
    public function lihat_permohonan_f()
    {
        $data['data'] = $this->M_finansial->lihat_permohonan();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Permohonan/V_permohonan_f', $data);
        $this->load->view('footer');
    }

    public function detail_permohonan_f($kd_permohonan)
    {

        //get data jumlah tagihan
        $data['detail_tarif'] = $this->M_finansial->detail_tarif($kd_permohonan);

        //menampilkan data pemasuukan
        $data['pemasukan'] = $this->M_finansial->lihat_pemasukan($kd_permohonan);
        //jumlah pemasukan
        $data['jumlah'] = $this->M_finansial->jml_pemasukan($kd_permohonan);

        //jumlah pengeluaran
        $data['jumlah_pengeluaran'] = $this->M_finansial->jml_pengeluaran($kd_permohonan);

        //menampilkan data pengeluaran
        $data['pengeluaran'] = $this->M_finansial->lihat_pengeluaran($kd_permohonan);

        //menampilkan data tarif di pengeluaran
        $data['tarif'] = $this->M_finansial->get_tarif_by_id($kd_permohonan);

        $data['dt'] = $this->M_mada->get_permohonan($kd_permohonan);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Transaksi/V_detail_permohonan', $data);
        $this->load->view('footer');
    }

    //transaksi permohonan ==============================================================================
    public function lihat_transaksi()
    {
        $data['data'] = $this->M_finansial->lihat_tarif();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Transaksi/V_transaksi', $data);
        $this->load->view('footer');
    }

    //tarif ==============================================================================

    public function tarif_cetak($id)
    {
        $tarif = $this->M_finansial->tarif_exl($id);
        foreach ($tarif as $data) {

            require_once APPPATH . "/third_party/PHPExcel.php";

            //fungsi menghitung jumlah bulan
            $timeStart = strtotime($data->dari_tgl);
            $timeEnd = strtotime($data->sampai_tgl);
            $numBulan = 1 + (date("Y", $timeEnd) - date("Y", $timeStart)) * 12;
            $numBulan += date("m", $timeEnd) - date("m", $timeStart);
            //memotong jaminan
            $a = substr($data->jenis_jaminan, 8);
            $nama_jaminan = strtoupper($a);
            //1 dan 2 artinya suretybond
            if ($data->kd_jenis == "JN02" or $data->kd_jenis == "JN04") {
                if ($data->kd_jp == 1 or $data->kd_jp == 2) {
                    $objPHPExcel = PHPExcel_IOFactory::load("file/template/JN02.xlsx");
                } else {
                    $objPHPExcel = PHPExcel_IOFactory::load("file/template/JN02BNK.xlsx");
                }
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C3', $data->tanggal)
                    ->setCellValue('C4', $data->persen . "%")
                    ->setCellValue('C5', $numBulan)
                    ->setCellValue('C7', $data->biaya_admin)
                    ->setCellValue('C8', $data->biaya_materai)
                    ->setCellValue('F2', $data->trf_min_bank)
                    ->setCellValue('F3', $data->trf_maxbulan . "%")
                    ->setCellValue('F4', $data->trf_enambulan . "%")
                    ->setCellValue('F5', $data->trf_min)
                    ->setCellValue('F6', $data->trf_agent . "%")
                    ->setCellValue('F7', $data->trf_jamkrida . "%")
                    ->setCellValue('G5', $data->trf_min2)
                    ->setCellValue('G6', $data->trf_agent2 . "%");

                //1 or 2 surty bon
                if ($data->kd_jp == 1 or $data->kd_jp == 2) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('20', $data->nama_perusahaan);
                } else {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B19', $data->nama_perusahaan);
                }
            } else if ($data->kd_jenis == "JN01") {
                //1 or 2 surty bon
                if ($data->kd_jp == 1 or $data->kd_jp == 2) {
                    $objPHPExcel = PHPExcel_IOFactory::load("file/template/JN01.xlsx");
                } else {
                    $objPHPExcel = PHPExcel_IOFactory::load("file/template/JN01BNK.xlsx");
                }
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C2', $data->nilai_proyek)
                    ->setCellValue('C3', $data->persen . "%")
                    ->setCellValue('C4', $numBulan)
                    ->setCellValue('C6', $data->biaya_admin)
                    ->setCellValue('C7', $data->biaya_materai)
                    ->setCellValue('F1', $data->trf_min_bank)
                    ->setCellValue('F2', $data->trf_maxbulan . "%")
                    ->setCellValue('F3', $data->trf_enambulan . "%")
                    ->setCellValue('F4', $data->trf_min)
                    ->setCellValue('F5', $data->trf_agent . "%")
                    ->setCellValue('F6', $data->trf_jamkrida . "%")
                    ->setCellValue('G4', $data->trf_min2)
                    ->setCellValue('G5', $data->trf_agent2 . "%");
                //1 or 2 surty bon
                if ($data->kd_jp == 1 or $data->kd_jp == 2) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B19', $data->nama_perusahaan);
                } else {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B18', $data->nama_perusahaan);
                }
            } else if ($data->kd_jenis == "JN03") {
                if ($data->kd_jp == 1 or $data->kd_jp == 2) {
                    $objPHPExcel = PHPExcel_IOFactory::load("file/template/JN03.xlsx");
                } else {
                    $objPHPExcel = PHPExcel_IOFactory::load("file/template/JN03BNK.xlsx");
                }
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C3', $data->nilai_proyek)
                    ->setCellValue('C4', $data->persen . "%")
                    ->setCellValue('C5', $numBulan)
                    ->setCellValue('C7', $data->biaya_admin)
                    ->setCellValue('C8', $data->biaya_materai)
                    ->setCellValue('F2', $data->trf_min_bank)
                    ->setCellValue('F3', $data->trf_maxbulan . "%")
                    ->setCellValue('F4', $data->trf_enambulan . "%")
                    ->setCellValue('F5', $data->trf_min)
                    ->setCellValue('F6', $data->trf_agent . "%")
                    ->setCellValue('F7', $data->trf_jamkrida . "%")
                    ->setCellValue('G5', $data->trf_min2)
                    ->setCellValue('G6', $data->trf_agent2 . "%");
                if ($data->kd_jp == 1 or $data->kd_jp == 2) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B19', $data->nama_perusahaan);
                } else {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B18', $data->nama_perusahaan);
                }
            } else {
                if ($data->kd_jp == 1 or $data->kd_jp == 2) {
                    $objPHPExcel = PHPExcel_IOFactory::load("file/template/JN05.xlsx");
                } else {
                    $objPHPExcel = PHPExcel_IOFactory::load("file/template/JN05BNK.xlsx");
                }
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C3', $data->nilai_proyek)
                    ->setCellValue('C4', $data->persen . "%")
                    ->setCellValue('C5', $numBulan)
                    ->setCellValue('C7', $data->biaya_admin)
                    ->setCellValue('C8', $data->biaya_materai)
                    ->setCellValue('F2', $data->trf_min_bank)
                    ->setCellValue('F3', $data->trf_maxbulan . "%")
                    ->setCellValue('F4', $data->trf_enambulan . "%")
                    ->setCellValue('F5', $data->trf_min)
                    ->setCellValue('F6', $data->trf_agent)
                    ->setCellValue('F7', $data->trf_jamkrida . "%")
                    ->setCellValue('G5', $data->trf_min2)
                    ->setCellValue('G6', $data->trf_agent2 . "%");
                if ($data->kd_jp == 1 or $data->kd_jp == 2) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B19', $data->nama_perusahaan);
                } else {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B18', $data->nama_perusahaan);
                }
            }
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="TARIF ' . $nama_jaminan . " " . strtoupper($data->nama_perusahaan) . '.xlsx"'); // Set nama file excel nya
        //header('Content-Disposition: attachment; filename="TARIF tes.xlsx"'); // Set nama file excel nya
        //header('Content-Disposition: attachment; filename="TARIF '  . $data->nama_perusahaan . '.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

    public function lihat_tarif()
    {
        $data['data'] = $this->M_finansial->lihat_tarif();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Tarif/V_tarif', $data);
        $this->load->view('footer');
    }

    public function tambah_tarif($id)
    {

        $data['data'] = $this->M_finansial->get_permohonan($id);
        foreach ($data['data'] as $dt) {
            $dt->kd_jenis;
        }
        $data['perhit'] = $this->M_finansial->get_perhitungan($dt->kd_jenis);
        $this->load->view('Admin/Tarif/js');
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Tarif/V_tambah_tarif', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_tarif()
    {
        $this->M_finansial->proses_tambah_tarif();
        echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Admin/lihat_tarif') . "';</script>";
    }

    public function ubah_tarif($id)
    {

        $data['tarif'] = $this->M_finansial->get_tarif($id);
        foreach ($data['tarif'] as $dt) {
            $dt->id_permohonan;
        }
        $data['data'] = $this->M_finansial->get_permohonan($dt->id_permohonan);
        $data['id_tarif'] = $id;

        $this->load->view('Admin/Tarif/js');
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Tarif/V_ubah_tarif', $data);
        $this->load->view('footer');
    }

    public function detail_tarif($id)
    {

        $data['tarif'] = $this->M_finansial->get_tarif($id);
        foreach ($data['tarif'] as $dt) {
            $dt->id_permohonan;
        }
        $data['data'] = $this->M_finansial->get_permohonan($dt->id_permohonan);
        $data['id_tarif'] = $id;

        $this->load->view('Admin/Tarif/js');
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Tarif/V_detail_tarif', $data);
        $this->load->view('footer');
    }

    public function proses_edit_tarif($id)
    {
        $this->M_finansial->proses_edit_tarif($id);
        echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Admin/detail_tarif/' . $id) . "';</script>";
    }

    public function hapus_tarif($id)
    {
        $this->M_finansial->hapus_tarif($id);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Admin/lihat_tarif/') . "';</script>";
    }

    //perhitungan ==============================================================================
    public function lihat_perhitungan()
    {
        $data['data'] = $this->M_finansial->lihat_perhitungan();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Perhitungan/V_perhitungan', $data);
        $this->load->view('footer');
    }

    public function edit_perhitungan($id)
    {
        $data['perhit'] = $this->M_finansial->get_perhitungan2($id);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Perhitungan/V_ubah_perhitungan', $data);
        $this->load->view('footer');
    }

    public function proses_edit_perhitungan($id)
    {
        $this->M_finansial->proses_edit_perhitungan($id);
        echo "<script language='javascript'>alert('Data Berhasil Diedit'); document.location='" . base_url('Admin/edit_perhitungan/' . $id) . "';</script>";
    }


    //pemasukan ==============================================================================
    public function tambah_pemasukan($id)
    {
        //get
        $data['dt'] = $this->M_finansial->get_tarif_by_id($id);

        //get data jumlah tagihan
        $data['detail_tarif'] = $this->M_finansial->detail_tarif($id);

        //mennghitung jumlah pemasukan
        $data['jumlah'] = $this->M_finansial->jml_pemasukan($id);

        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pemasukan/V_tambah_pemasukan', $data);
        $this->load->view('footer');
        $this->load->view('Admin/Pemasukan/js');
        //print_r($data['dt']);
    }

    public function proses_tambah_pemasukan($id)
    {
        $this->M_finansial->proses_tambah_pemasukan($id);
        echo "<script language='javascript'>alert('Data Berhasil Ditambah'); document.location='" . base_url('Admin/detail_permohonan_f/' . $id . '/pemasukan') . "';</script>";
    }

    public function edit_pemasukan($id)
    {
        // $data['datas'] = $this->M_finansial->list_permohonan();
        // $data['data'] = $this->M_finansial->get_pembayaran($id, $id_pembayaran);
        // $data['status'] = $id;


        //GET DATA PEMASUKAN 
        $data['data'] = $this->M_finansial->get_pembayaran($id);
        foreach ($data as $dt) {
            $id_permohonan = $dt['id_permohonan'];
        }
        //GET DATA JUMLAH TAGIHAN 
        $data['detail_tarif'] = $this->M_finansial->detail_tarif($id_permohonan);

        //mennghitung jumlah pemasukan
        $data['jumlah'] = $this->M_finansial->jml_pemasukan($id_permohonan);

        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pemasukan/V_edit_pemasukan', $data);
        $this->load->view('footer');
        $this->load->view('Admin/Pemasukan/js');
    }

    public function proses_edit_pemasukan($id)
    {
        $this->M_finansial->proses_edit_pemasukan($id);
        echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Admin/edit_pemasukan/' . $id . '/pemasukan') . "';</script>";
    }

    public function hapus_pemasukan($id, $id_permohonan)
    {
        $this->M_finansial->hapus_pemasukan($id, $id_permohonan);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Admin/detail_permohonan_f/' . $id_permohonan . '/pemasukan') . "';</script>";
    }

    // pengeluaran ======================================
    public function tambah_pengeluaran($id)
    {
        //get
        $data['dt'] = $this->M_finansial->get_tarif_by_id($id);

        //get data jumlah tagihan
        $data['detail_tarif'] = $this->M_finansial->detail_tarif($id);

        //mennghitung jumlah pemasukan
        $data['jumlah'] = $this->M_finansial->jml_pengeluaran($id);

        //menampilkan data tarif di pengeluaran
        $data['tarif'] = $this->M_finansial->get_tarif_by_id($id);

        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pengeluaran/V_tambah_pengeluaran', $data);
        $this->load->view('footer');
        $this->load->view('Admin/Pengeluaran/js');
        //print_r($data['dt']);
    }

    public function proses_tambah_pengeluaran($id)
    {
        $this->M_finansial->proses_tambah_pengeluaran($id);
        echo "<script language='javascript'>alert('Data Berhasil Ditambah'); document.location='" . base_url('Admin/detail_permohonan_f/' . $id . '/pengeluaran') . "';</script>";
    }

    public function edit_pengeluaran($id)
    {
        // $data['datas'] = $this->M_finansial->list_permohonan();
        // $data['data'] = $this->M_finansial->get_pembayaran($id, $id_pembayaran);
        // $data['status'] = $id;


        //GET DATA PEMASUKAN 
        $data['data'] = $this->M_finansial->get_pengeluaran($id);
        foreach ($data as $dt) {
            $id_permohonan = $dt['id_permohonan'];
        }
        //GET DATA JUMLAH TAGIHAN 
        $data['detail_tarif'] = $this->M_finansial->detail_tarif($id_permohonan);

        //mennghitung jumlah pemasukan
        $data['jumlah'] = $this->M_finansial->jml_pengeluaran($id_permohonan);

        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pengeluaran/V_edit_pengeluaran', $data);
        $this->load->view('footer');
        $this->load->view('Admin/Pengeluaran/js');
    }

    public function proses_edit_pengeluaran($id)
    {
        $this->M_finansial->proses_edit_pengeluaran($id);
        echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Admin/edit_pengeluaran/' . $id . '/pengeluaran') . "';</script>";
    }

    public function hapus_pengeluaran($id, $id_permohonan)
    {
        $this->M_finansial->hapus_pengeluaran($id, $id_permohonan);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Admin/detail_permohonan_f/' . $id_permohonan . '/pengeluaran') . "';</script>";
    }
    //pembayaran===================================================

    public function proses_tambah_pembayaran_f($id)
    {
        $this->M_finansial->proses_tambah_pembayaran($id);
        echo "<script language='javascript'>alert('Data Berhasil Ditambah'); document.location='" . base_url('Admin/lihat_pembayaran/' . $id) . "';</script>";
    }

    public function hapus_pembayaran_f($id, $id_pembayaran)
    {
        $this->M_finansial->hapus_pembayaran($id, $id_pembayaran);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Admin/lihat_pembayaran/' . $id) . "';</script>";
    }

    public function edit_pembayaran_f($id, $id_pembayaran)
    {
        $data['datas'] = $this->M_finansial->list_permohonan();
        $data['data'] = $this->M_finansial->get_pembayaran($id, $id_pembayaran);
        $data['status'] = $id;
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pembayaran/V_edit_pembayaran', $data);
        $this->load->view('footer');
    }

    public function proses_edit_pembayaran_f($id, $id_pembayaran)
    {
        $this->M_finansial->proses_edit_pembayaran($id, $id_pembayaran);
        echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Admin/edit_pembayaran/' . $id . '/' . $id_pembayaran) . "';</script>";
    }

    //transaksi umum ==============================================================================

    public function lihat_umum()
    {
        $pejabat = $this->M_finansial->get_pejabat();
        $pejabat[''] = 'Pilih Pejabat';
        $data['form_pejabat'] = form_dropdown('', $pejabat, '', 'id="kd_pejabat" name="kd_pejabat" class="form-control select2"');

        $total = $this->M_finansial->total_umum();
        foreach ($total as $row) {
            $data['kredit'] = $row['kredit'];
            $data['debit'] = $row['debit'];
            $data['saldo'] = $row['saldo'];
        }

        // $data['data'] = $this->M_finansial->lihat_umum();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Umum/V_umum', $data);
        $this->load->view('footer');
        $this->load->view('Admin/Umum/js');
    }

    public function get_data_umum()
    {
        $tgl_awal = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
        $pejabat = $this->input->get('pejabat');
        $keyword = $this->input->get('search')['value'];
        $start = $this->input->get('start');
        $draw = $this->input->get('draw');
        $length = $this->input->get('length');

        $q = $this->M_finansial->get_data_umum($keyword, $tgl_awal, $tgl_akhir, $pejabat);
        $data = array();

        foreach ($q as $record) {

            $data[] = array(
                "tanggal" => $record->tanggal
            );
        }
        $hasil = $this->paging_datatables($data, $draw, $start, $length);
        echo json_encode($hasil, JSON_PRETTY_PRINT);
    }

    public function get_filter_umum()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $pejabat = $this->input->post('pejabat');
        $q = $this->M_finansial->get_filter_umum($tgl_awal, $tgl_akhir, $pejabat);
        echo json_encode($q, JSON_PRETTY_PRINT);
    }

    //ini yg dipakai
    public function get_umum2()
    {

        // POST data
        $postData = $this->input->post();

        // Get data
        $data = $this->M_finansial->get_umum2($postData);

        echo json_encode($data);
    }

    public function get_filter_umum2()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $pejabat = $this->input->post('pejabat');
        $q = $this->M_finansial->get_filter_umum2($tgl_awal, $tgl_akhir, $pejabat);
        echo json_encode($q, JSON_PRETTY_PRINT);
    }

    public function cetak_umum()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $pejabat = $this->input->post('pejabat');

        // var_dump($tgl_awal."/".$tgl_akhir."/".$pejabat."/".$agent);
        require_once APPPATH . "/third_party/PHPExcel.php";
        $objPHPExcel = PHPExcel_IOFactory::load("file/template/umum.xlsx");

        $style_row = array(
            'font'  => array(
                'size'  => 12,
                'name'  => 'Times New Roman'
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $style_col = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

        $style_footer = array(
            'font'  => array(
                'size'  => 12,
                'name'  => 'Times New Roman',
                'bold' => True
            )
        );

        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);

        $objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('E2')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('F2')->applyFromArray($style_col);

        $master = $this->M_finansial->cetak_umum($tgl_awal, $tgl_akhir, $pejabat);
        //echo json_encode($master);
        $no = 1;
        $numrow = 3;
        $debit = 0;
        $kredit = 0;
        $totsaldo = 0;
        foreach ($master as $data) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B' . $numrow, $no)
                ->setCellValue('C' . $numrow, tgl_indo($data->tanggal))
                ->setCellValue('D' . $numrow, $data->keterangan)
                ->setCellValue('E' . $numrow, nominal($data->debit))
                ->setCellValue('F' . $numrow, nominal($data->kredit));

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $objPHPExcel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);

            $debit += $data->debit;
            $kredit += $data->kredit;
            $no++;
            $numrow++;
        }

        $fot = $no + 2;
        $saldo = $fot + 2;
        $saldoplus = $saldo + 1;
        $totsaldo = $kredit - $debit;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('D' . $fot, "Total")
            ->setCellValue('E' . $fot, nominal($debit))
            ->setCellValue('F' . $fot, nominal($kredit));

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C' . $saldo, "Saldo");

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C' . $saldoplus, $totsaldo);

        $objPHPExcel->getActiveSheet()->getStyle('D' . $fot)->applyFromArray($style_footer);
        $objPHPExcel->getActiveSheet()->getStyle('E' . $fot)->applyFromArray($style_footer);
        $objPHPExcel->getActiveSheet()->getStyle('F' . $fot)->applyFromArray($style_footer);

        $objPHPExcel->getActiveSheet()->getStyle('C' . $saldo)->applyFromArray($style_row);
        $objPHPExcel->getActiveSheet()->getStyle('C' . $saldo)->applyFromArray($style_col);

        $objPHPExcel->getActiveSheet()->getStyle('C' . $saldoplus)->applyFromArray($style_row);
        $objPHPExcel->getActiveSheet()->getStyle('C' . $saldoplus)->applyFromArray($style_col);


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="umum.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

    public function tambah_umum()
    {

        $pejabat = $this->M_finansial->get_pejabat();
        $pejabat[''] = 'Pilih Pejabat';
        $data['form_pejabat'] = form_dropdown('', $pejabat, '', 'id="pejabat" name="pejabat" class="form-control select2 select2"');

        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Umum/V_tambah_umum', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_umum()
    {
        $this->M_finansial->proses_tambah_umum();
        echo "<script language='javascript'>alert('Data Berhasil Ditambah'); document.location='" . base_url('Admin/lihat_umum/') . "';</script>";
    }

    public function hapus_umum($id)
    {
        $this->M_finansial->hapus_umum($id);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Admin/lihat_umum/') . "';</script>";
    }

    public function edit_umum($id)
    {
        $data['data'] = $this->M_finansial->get_umum($id);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Umum/V_edit_umum', $data);
        $this->load->view('footer');
    }

    public function proses_edit_umum($id)
    {
        $this->M_finansial->proses_edit_umum($id);
        echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Admin/lihat_umum/') . "';</script>";
    }


    //laporan ==============================================================================
    // public function master_cetak()
    // {
    //     require_once APPPATH . "/third_party/PHPExcel.php";
    //     $objPHPExcel = PHPExcel_IOFactory::load("file/template/master.xlsx");

    //     $style_row = array(
    //         'font'  => array(
    //             'size'  => 12,
    //             'name'  => 'Times New Roman'
    //         ),
    //         'borders' => array(
    //             'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    //             'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    //             'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    //             'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    //         )
    //     );

    //     $style_col = array(
    //         'alignment' => array(
    //             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    //         )
    //     );

    //     $style_footer = array(
    //         'font'  => array(
    //             'size'  => 12,
    //             'name'  => 'Times New Roman',
    //             'bold' => True
    //         )
    //     );

    //     $master = $this->M_finansial->get_master();
    //     $no = 1;
    //     $numrow = 2;
    //     foreach ($master as $data) {
    //         $objPHPExcel->setActiveSheetIndex(0)
    //             ->setCellValue('A' . $numrow, $no)
    //             ->setCellValue('B' . $numrow, date_indo($data->tgl_permohonan))
    //             ->setCellValue('C' . $numrow, $data->nama_perusahaan)
    //             ->setCellValue('D' . $numrow, $data->nama_pejabat)
    //             ->setCellValue('E' . $numrow, $data->nama_agent)
    //             ->setCellValue('F' . $numrow, $data->kabupaten)
    //             ->setCellValue('G' . $numrow, nominal($data->nilai_proyek))
    //             ->setCellValue('H' . $numrow, nominal($data->nilai_jaminan))
    //             ->setCellValue('I' . $numrow, $data->jangka_waktu)
    //             ->setCellValue('J' . $numrow, "Bulan")
    //             // ->setCellValue('K' . $numrow, $data->trf_jamkrida . "%")
    //             ->setCellValue('L' . $numrow, $data->jenis_jaminan)
    //             ->setCellValue('M' . $numrow, $data->jenis)
    //             ->setCellValue('N' . $numrow, nominal($data->ijpagent))
    //             ->setCellValue('O' . $numrow, nominal($data->garansi_bank))
    //             ->setCellValue('P' . $numrow, nominal($data->total_biaya))
    //             ->setCellValue('Q' . $numrow, nominal($data->ijpjamkrida))
    //             ->setCellValue('R' . $numrow, nominal($data->nilaidiskon))
    //             ->setCellValue('S' . $numrow, nominal($data->garansi_bank))
    //             ->setCellValue('T' . $numrow, nominal($data->total_biaya2))
    //             ->setCellValue('U' . $numrow, nominal($data->saldo));

    //         // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
    //         $objPHPExcel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_col);
    //         $objPHPExcel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_col);
    //         $objPHPExcel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_col);
    //         $objPHPExcel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_col);
    //         $objPHPExcel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_col);

    //         $objPHPExcel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_row);
    //         $objPHPExcel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_row);

    //         $no++;
    //         $numrow++;
    //     }

    //     $fot = $no + 1;

    //     $objPHPExcel->setActiveSheetIndex(0)
    //         ->setCellValue('P' . $fot, "Hutang IJP")
    //         ->setCellValue('Q' . $fot, $fot)
    //         ->setCellValue('T' . $fot, "Total Pendapatan")
    //         ->setCellValue('U' . $fot, $no);

    //     $objPHPExcel->getActiveSheet()->getStyle('P' . $fot)->applyFromArray($style_footer);
    //     $objPHPExcel->getActiveSheet()->getStyle('Q' . $fot)->applyFromArray($style_footer);
    //     $objPHPExcel->getActiveSheet()->getStyle('T' . $fot)->applyFromArray($style_footer);
    //     $objPHPExcel->getActiveSheet()->getStyle('U' . $fot)->applyFromArray($style_footer);

    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment; filename="MASTER.xlsx"');
    //     header('Cache-Control: max-age=0');
    //     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    //     $objWriter->save('php://output');
    // }

    public function master_cetak2()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $agent = $this->input->post('kd_agent');
        $pejabat = $this->input->post('kd_pejabat');
        $perusahaan = $this->input->post('kd_perusahaan');
        // var_dump($tgl_awal."/".$tgl_akhir."/".$pejabat."/".$agent);
        require_once APPPATH . "/third_party/PHPExcel.php";
        $objPHPExcel = PHPExcel_IOFactory::load("file/template/master.xlsx");

        $style_row = array(
            'font'  => array(
                'size'  => 12,
                'name'  => 'Times New Roman'
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $style_col = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

        $style_footer = array(
            'font'  => array(
                'size'  => 12,
                'name'  => 'Times New Roman',
                'bold' => True
            )
        );

        $master = $this->M_finansial->get_master2($tgl_awal, $tgl_akhir, $pejabat, $agent, $perusahaan);
        //echo json_encode($master);
        $no = 1;
        $numrow = 2;
        $profit = 0;
        $ijp = 0;
        foreach ($master as $data) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $numrow, $no)
                ->setCellValue('B' . $numrow, date_indo($data->tgl_permohonan))
                ->setCellValue('C' . $numrow, $data->nama_perusahaan)
                ->setCellValue('D' . $numrow, $data->nama_pejabat)
                ->setCellValue('E' . $numrow, $data->nama_agent)
                ->setCellValue('F' . $numrow, $data->kabupaten)
                ->setCellValue('G' . $numrow, nominal($data->nilai_proyek))
                ->setCellValue('H' . $numrow, nominal($data->nilai_jaminan))
                ->setCellValue('I' . $numrow, $data->jangka_waktu)
                ->setCellValue('J' . $numrow, "Bulan")
                // ->setCellValue('K' . $numrow, $data->trf_jamkrida . "%")
                ->setCellValue('L' . $numrow, $data->jenis_jaminan)
                ->setCellValue('M' . $numrow, $data->jenis)
                ->setCellValue('N' . $numrow, nominal($data->ijpagent))
                ->setCellValue('O' . $numrow, nominal($data->garansi_bank))
                ->setCellValue('P' . $numrow, nominal($data->total_biaya))
                ->setCellValue('Q' . $numrow, nominal($data->ijpjamkrida))
                ->setCellValue('R' . $numrow, nominal($data->nilaidiskon))
                ->setCellValue('S' . $numrow, nominal($data->garansi_bank))
                ->setCellValue('T' . $numrow, nominal($data->total_biaya2))
                ->setCellValue('U' . $numrow, nominal($data->saldo));

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $objPHPExcel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_col);

            $objPHPExcel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_row);
            $profit += $data->saldo;
            $ijp += $data->ijpjamkrida;
            $no++;
            $numrow++;
        }

        $fot = $no + 1;

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('P' . $fot, "Hutang IJP")
            ->setCellValue('Q' . $fot, nominal($ijp))
            ->setCellValue('T' . $fot, "Total Pendapatan")
            ->setCellValue('U' . $fot, nominal($profit));

        $objPHPExcel->getActiveSheet()->getStyle('P' . $fot)->applyFromArray($style_footer);
        $objPHPExcel->getActiveSheet()->getStyle('Q' . $fot)->applyFromArray($style_footer);
        $objPHPExcel->getActiveSheet()->getStyle('T' . $fot)->applyFromArray($style_footer);
        $objPHPExcel->getActiveSheet()->getStyle('U' . $fot)->applyFromArray($style_footer);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="MASTER.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

    //lihat laporan pendapatan
    public function lihat_laporan_f()
    {

        $pejabat = $this->M_finansial->get_pejabat();
        $pejabat[''] = 'Pilih Pejabat';
        $data['form_pejabat'] = form_dropdown('', $pejabat, '', 'id="kd_pejabat" name="kd_pejabat" class="form-control select2"');

        $agent = $this->M_finansial->get_agent();
        $agent[''] = 'Pilih Agent';
        $data['form_agent'] = form_dropdown('', $agent, '', 'id="kd_agent" name="kd_angent" class="form-control select2"');

        $perusahaan = $this->M_finansial->get_perusahaan();
        $perusahaan[''] = 'Pilih Perusahaan';
        $data['form_perusahaan'] = form_dropdown('', $perusahaan, '', 'id="kd_perusahaan" name="kd_perusahaan" class="form-control select2"');

        $total = $this->M_finansial->total_tarif();
        foreach ($total as $row) {
            $data['pemasukan'] = $row['pemasukan'];
            $data['pengeluaran'] = $row['pengeluaran'];
            $data['profit'] = $row['profit'];
        }

        // $data['form_pejabat'] = form_dropdown('', $opt1, '', 'id="pejabat" name="pejabat" class="form-control select2"');
        // $data['form_agent'] = form_dropdown('', $opt2, '', 'id="agent" name="agent" class="form-control select2"');

        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Laporan/V_pendapatan', $data);
        $this->load->view('footer');
        $this->load->view('Admin/Laporan/js');
    }

    public function get_data()
    {
        $tgl_awal = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
        $agent = $this->input->get('agent');
        $pejabat = $this->input->get('pejabat');
        $perusahaan = $this->input->get('perusahaan');
        $keyword = $this->input->get('search')['value'];
        $start = $this->input->get('start');
        $draw = $this->input->get('draw');
        $length = $this->input->get('length');
        $q = $this->M_finansial->get_data($keyword, $tgl_awal, $tgl_akhir, $agent, $pejabat, $perusahaan);
        $hasil = $this->paging_datatables($q, $draw, $start, $length);
        echo json_encode($hasil, JSON_PRETTY_PRINT);
    }

    public function get_filter()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $agent = $this->input->post('agent');
        $pejabat = $this->input->post('pejabat');
        $perusahaan = $this->input->post('perusahaan');
        $q = $this->M_finansial->get_filter($tgl_awal, $tgl_akhir, $agent, $pejabat, $perusahaan);
        echo json_encode($q, JSON_PRETTY_PRINT);
    }

    //------------------- laporan pemasukan
    public function laporan_pemasukan()
    {

        $pejabat = $this->M_finansial->get_pejabat();
        $pejabat[''] = 'Pilih Pejabat';
        $data['form_pejabat'] = form_dropdown('', $pejabat, '', 'id="kd_pejabat" name="kd_pejabat" class="form-control select2"');

        $opt2 = array(
            '' => 'Semua Status',
            0 => 'Belum Lunas',
            1 => 'Lunas',
        );


        $total = $this->M_finansial->total_pemasukan();
        foreach ($total as $row) {
            $data['pemasukan'] = $row['pemasukan'];
            $data['jml_byr'] = $row['jml_byr'];
            $data['sisa_byr'] = $row['sisa_byr'];
        }

        // $data['form_pejabat'] = form_dropdown('', $opt1, '', 'id="pejabat" name="pejabat" class="form-control select2"');
        $data['form_status'] = form_dropdown('', $opt2, '', 'id="status" name="status" class="form-control select2"');

        $perusahaan = $this->M_finansial->get_perusahaan();
        $perusahaan[''] = 'Pilih Perusahaan';
        $data['form_perusahaan'] = form_dropdown('', $perusahaan, '', 'id="kd_perusahaan" name="kd_perusahaan" class="form-control select2"');

        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pemasukan/V_pemasukan', $data);
        $this->load->view('footer');
        $this->load->view('Admin/Pemasukan/js2');
    }

    public function get_data_pemasukan()
    {
        $tgl_awal = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
        $status = $this->input->get('status');
        $pejabat = $this->input->get('pejabat');
        $perusahaan = $this->input->get('perusahaan');
        $keyword = $this->input->get('search')['value'];
        $start = $this->input->get('start');
        $draw = $this->input->get('draw');
        $length = $this->input->get('length');
        // var_dump($status);
        $q = $this->M_finansial->get_data_pemasukan($keyword, $tgl_awal, $tgl_akhir, $status, $pejabat, $perusahaan);
        $hasil = $this->paging_datatables($q, $draw, $start, $length);
        echo json_encode($hasil, JSON_PRETTY_PRINT);
    }

    public function get_filter_pemasukan()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $status = $this->input->post('status');
        $pejabat = $this->input->post('pejabat');
        $perusahaan = $this->input->post('perusahaan');
        $q = $this->M_finansial->get_filter_pemasukan($tgl_awal, $tgl_akhir, $status, $pejabat, $perusahaan);
        echo json_encode($q, JSON_PRETTY_PRINT);
    }

    public function master_pemasukan()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $status = $this->input->post('status');
        $pejabat = $this->input->post('kd_pejabat');
        $perusahaan = $this->input->post('kd_perusahaan');

        require_once APPPATH . "/third_party/PHPExcel.php";
        $objPHPExcel = PHPExcel_IOFactory::load("file/template/pemasukan.xlsx");

        $style_row = array(
            'font'  => array(
                'size'  => 12,
                'name'  => 'Times New Roman'
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $style_col = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

        $style_footer = array(
            'font'  => array(
                'size'  => 12,
                'name'  => 'Times New Roman',
                'bold' => True
            )
        );


        $master = $this->M_finansial->get_cetak_pemasukan($tgl_awal, $tgl_akhir, $pejabat, $status, $perusahaan);
        // var_dump("/ntanggal : ".$tgl_awal."/ntanggal akhir : ".$tgl_akhir."/npejabat : ".$pejabat."/nstatus ".$status."/nperusahaan : ".$perusahaan);
        $no = 1;
        $numrow = 3;

        $jumlah_pemasukan = 0;
        $jumlah_pembayaran_pemasukan = 0;
        $sisa_pembayaran_pemasukan = 0;

        foreach ($master as $data) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B' . $numrow, $no)
                ->setCellValue('C' . $numrow, date_indo($data->tgl_permohonan))
                ->setCellValue('D' . $numrow, $data->no_permohonan)
                ->setCellValue('E' . $numrow, $data->jenis_jaminan)
                ->setCellValue('F' . $numrow, $data->nama_perusahaan)
                ->setCellValue('G' . $numrow, $data->nama_pekerjaan)
                ->setCellValue('H' . $numrow, $data->nama_pejabat)
                ->setCellValue('I' . $numrow, nominal($data->total_biaya))
                ->setCellValue('J' . $numrow, nominal($data->jml_pembayaran))
                ->setCellValue('K' . $numrow, nominal($data->sisa_bayar))
                ->setCellValue('L' . $numrow, $data->STATUS);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $objPHPExcel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_col);

            $objPHPExcel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);

            $jumlah_pemasukan += $data->total_biaya;
            $jumlah_pembayaran_pemasukan += $data->jml_pembayaran;
            $sisa_pembayaran_pemasukan += $data->sisa_bayar;
            $no++;
            $numrow++;
        }

        $fot = $no + 3;
        $isi = $fot + 1;

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('I' . $fot, "Total Pemasukan")
            ->setCellValue('I' . $isi, nominal($jumlah_pemasukan))
            ->setCellValue('J' . $fot, "Total Pemb. Pemasukan")
            ->setCellValue('J' . $isi, nominal($jumlah_pembayaran_pemasukan))
            ->setCellValue('K' . $fot, "Total Sisa Pemb. Pemasukan")
            ->setCellValue('K' . $isi, nominal($sisa_pembayaran_pemasukan));

        $objPHPExcel->getActiveSheet()->getStyle('I' . $fot)->applyFromArray($style_row);
        $objPHPExcel->getActiveSheet()->getStyle('J' . $fot)->applyFromArray($style_row);
        $objPHPExcel->getActiveSheet()->getStyle('K' . $fot)->applyFromArray($style_row);
        $objPHPExcel->getActiveSheet()->getStyle('I' . $isi)->applyFromArray($style_row);
        $objPHPExcel->getActiveSheet()->getStyle('J' . $isi)->applyFromArray($style_row);
        $objPHPExcel->getActiveSheet()->getStyle('K' . $isi)->applyFromArray($style_row);


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="pemasukan.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

    //--------------- laporan pengeluaran
    public function laporan_pengeluaran()
    {

        $pejabat = $this->M_finansial->get_pejabat();
        $pejabat[''] = 'Pilih Pejabat';
        $data['form_pejabat'] = form_dropdown('', $pejabat, '', 'id="kd_pejabat" name="kd_pejabat" class="form-control select2"');

        $opt2 = array(
            '' => 'Semua Status',
            0 => 'Belum Lunas',
            1 => 'Lunas',
        );

        $perusahaan = $this->M_finansial->get_perusahaan();
        $perusahaan[''] = 'Pilih Perusahaan';
        $data['form_perusahaan'] = form_dropdown('', $perusahaan, '', 'id="kd_perusahaan" name="kd_perusahaan" class="form-control select2"');

        $total = $this->M_finansial->total_pengeluaran();
        foreach ($total as $row) {
            $data['pengeluaran'] = $row['pengeluaran'];
            $data['jml_byr'] = $row['jml_byr'];
            $data['sisa_byr'] = $row['sisa_byr'];
        }

        // $data['form_pejabat'] = form_dropdown('', $opt1, '', 'id="pejabat" name="pejabat" class="form-control select2"');
        $data['form_status'] = form_dropdown('', $opt2, '', 'id="status" name="status" class="form-control select2"');

        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Pengeluaran/V_pengeluaran', $data);
        $this->load->view('footer');
        $this->load->view('Admin/Pengeluaran/js2');
    }

    public function get_data_pengeluaran()
    {
        $tgl_awal = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
        $status = $this->input->get('status');
        $pejabat = $this->input->get('pejabat');
        $perusahaan = $this->input->get('perusahaan');
        $keyword = $this->input->get('search')['value'];
        $start = $this->input->get('start');
        $draw = $this->input->get('draw');
        $length = $this->input->get('length');
        // var_dump($status);
        $q = $this->M_finansial->get_data_pengeluaran($keyword, $tgl_awal, $tgl_akhir, $status, $pejabat,$perusahaan);
        $hasil = $this->paging_datatables($q, $draw, $start, $length);
        echo json_encode($hasil, JSON_PRETTY_PRINT);
    }

    public function get_filter_pengeluaran()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $status = $this->input->post('status');
        $pejabat = $this->input->post('pejabat');
        $perusahaan = $this->input->post('perusahaan');
        $q = $this->M_finansial->get_filter_pengeluaran($tgl_awal, $tgl_akhir, $status, $pejabat,$perusahaan);
        echo json_encode($q, JSON_PRETTY_PRINT);
    }

    public function master_pengeluaran()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $status = $this->input->post('status');
        $pejabat = $this->input->post('kd_pejabat');
        $perusahaan = $this->input->post('kd_perusahaan');

        require_once APPPATH . "/third_party/PHPExcel.php";
        $objPHPExcel = PHPExcel_IOFactory::load("file/template/pengeluaran.xlsx");

        $style_row = array(
            'font'  => array(
                'size'  => 12,
                'name'  => 'Times New Roman'
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $style_col = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

        $style_footer = array(
            'font'  => array(
                'size'  => 12,
                'name'  => 'Times New Roman',
                'bold' => True
            )
        );


        $master = $this->M_finansial->get_cetak_pengeluaran($tgl_awal, $tgl_akhir, $pejabat, $status, $perusahaan);
        // var_dump("/ntanggal : ".$tgl_awal."/ntanggal akhir : ".$tgl_akhir."/npejabat : ".$pejabat."/nstatus ".$status."/nperusahaan : ".$perusahaan);
        $no = 1;
        $numrow = 3;

        $jumlah_pengeluaran = 0;
        $jumlah_pembayaran_pengeluaran = 0;
        $sisa_pembayaran_pengeluaran = 0;

        foreach ($master as $data) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B' . $numrow, $no)
                ->setCellValue('C' . $numrow, date_indo($data->tgl_permohonan))
                ->setCellValue('D' . $numrow, $data->no_permohonan)
                ->setCellValue('E' . $numrow, $data->jenis_jaminan)
                ->setCellValue('F' . $numrow, $data->nama_perusahaan)
                ->setCellValue('G' . $numrow, $data->nama_pekerjaan)
                ->setCellValue('H' . $numrow, $data->nama_pejabat)
                ->setCellValue('I' . $numrow, nominal($data->total_biaya2))
                ->setCellValue('J' . $numrow, nominal($data->jml_pengeluaran))
                ->setCellValue('K' . $numrow, nominal($data->sisa_bayar))
                ->setCellValue('L' . $numrow, $data->STATUS);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $objPHPExcel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_col);
            $objPHPExcel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_col);

            $objPHPExcel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);

            $jumlah_pengeluaran += $data->total_biaya2;
            $jumlah_pembayaran_pengeluaran += $data->jml_pengeluaran;
            $sisa_pembayaran_pengeluaran += $data->sisa_bayar;
            $no++;
            $numrow++;
        }

        $fot = $no + 3;
        $isi = $fot + 1;

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('I' . $fot, "Total pengeluaran")
            ->setCellValue('I' . $isi, nominal($jumlah_pengeluaran))
            ->setCellValue('J' . $fot, "Total Pemb. pengeluaran")
            ->setCellValue('J' . $isi, nominal($jumlah_pembayaran_pengeluaran))
            ->setCellValue('K' . $fot, "Total Sisa Pemb. pengeluaran")
            ->setCellValue('K' . $isi, nominal($sisa_pembayaran_pengeluaran));

        $objPHPExcel->getActiveSheet()->getStyle('I' . $fot)->applyFromArray($style_row);
        $objPHPExcel->getActiveSheet()->getStyle('J' . $fot)->applyFromArray($style_row);
        $objPHPExcel->getActiveSheet()->getStyle('K' . $fot)->applyFromArray($style_row);
        $objPHPExcel->getActiveSheet()->getStyle('I' . $isi)->applyFromArray($style_row);
        $objPHPExcel->getActiveSheet()->getStyle('J' . $isi)->applyFromArray($style_row);
        $objPHPExcel->getActiveSheet()->getStyle('K' . $isi)->applyFromArray($style_row);


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="pengeluaran.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

    function paging_datatables($q, $draw, $start, $length)
    {
        $rows = $length;
        $page = $start / $rows;
        $total = $q->num_rows();
        $items = array();
        if ($q->num_rows() > 0) {
            if (!empty($key)) {
                $rows = $total;
            }
            for ($i = 0; $i < $rows; $i++) {
                $index = $i + ($page) * $rows;
                if ($index < $total) {
                    $items[] = array_values($q->row_array($index));
                }
            }
        }
        $isi = array(
            "draw"                 => $draw,
            "recordsTotal"         => $total,
            "recordsFiltered"     => $total,
            "data"                 => $items,
        );
        return $isi;
    }

    // ============================== tambah user
    public function lihat_akun()
    {
        $data['data'] = $this->M_admin->lihat_akun();
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Akun/V_akun', $data);
        $this->load->view('footer');
    }

    public function tambah_akun()
    {
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Akun/V_tambah_akun');
        $this->load->view('footer');
    }

    public function proses_tambah_akun()
    {
        $this->M_admin->proses_tambah_akun();
        echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Admin/lihat_akun/') . "';</script>";
    }

    public function edit_akun($id_akun)
    {
        $data['dt'] = $this->M_admin->get_akun($id_akun);
        $this->load->view('header');
        $this->load->view('Admin/menu');
        $this->load->view('Admin/Akun/V_edit_akun', $data);
        $this->load->view('footer');
    }

    public function proses_edit_akun()
    {
        $this->M_admin->proses_edit_akun();
        echo "<script language='javascript'>alert('Data Berhasil Diedit'); document.location='" . base_url('Admin/lihat_akun/') . "';</script>";
    }

    public function hapus_akun($id_akun)
    {
        $this->M_admin->hapus_akun($id_akun);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Admin/lihat_akun') . "';</script>";
    }
}
