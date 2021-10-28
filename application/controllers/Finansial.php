<?php

class Finansial extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_mada');
        $this->load->model('M_finansial');
        $this->load->helper('tgl');
        $this->load->helper('nominal');
        //	$this->load->model('Kode');

        if($this->session->userdata('status') != 'Login'){
            $url=base_url();
            echo "<script language='javascript'>alert('Anda Tidak Memiliki Akses'); document.location='" . $url . "';</script>";
        }

        if($this->session->userdata('level') != 'finansial' && $this->session->userdata('level') != 'super'){
            $url=base_url();
            echo "<script language='javascript'>alert('Anda Tidak Memiliki Akses'); document.location='" . $url . "';</script>";
        }


    }

    public function index()
    {
        $data['data'] = $this->M_finansial->count_permohonan();
        $this->load->view('header');
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/V_dashboard', $data);
        $this->load->view('footer');
        $this->load->view('Finansial/dashboard');
        
    }

    public function get_dashboard()
    {
        $data = $this->M_finansial->get_dashboard();
		echo json_encode($data);
    }

    public function get_dashboard2()
    {
        $data = $this->M_finansial->get_dashboard2();
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
    //     $this->load->view('Finansial/menu');
    //     $this->load->view('Finansial/Pengeluaran/V_pengeluaran', $data);
    //     $this->load->view('footer');
    // }

    // public function tambah_pengeluaran($status)
    // {
    //     $data['status'] = $status;
    //     //$data['kode'] = $this->Kode->kd_pengeluaran();
    //     $this->load->view('header');
    //     $this->load->view('Finansial/menu');
    //     $this->load->view('Finansial/Pengeluaran/V_tambah_pengeluaran', $data);
    //     $this->load->view('footer');
    // }

    // public function edit_pengeluaran($id, $status)
    // {
    //     $data['status'] = $status;
    //     $data['data'] = $this->M_finansial->get_pengeluaran($id);
    //     $this->load->view('header');
    //     $this->load->view('Finansial/menu');
    //     $this->load->view('Finansial/pengeluaran/V_edit_pengeluaran', $data);
    //     $this->load->view('footer');
    // }

    // public function proses_tambah_pengeluaran($status)
    // {
    //     $this->M_finansial->proses_tambah_pengeluaran();
    //     echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Finansial/lihat_pengeluaran/' . $status) . "';</script>";
    // }

    // public function proses_edit_pengeluaran($id, $status)
    // {
    //     $this->M_finansial->proses_edit_pengeluaran($id);
    //     echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Finansial/lihat_pengeluaran/' . $status) . "';</script>";
    // }

    // public function hapus_pengeluaran($id, $status)
    // {
    //     $this->M_finansial->hapus_pengeluaran($id);
    //     echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Finansial/lihat_pengeluaran/' . $status) . "';</script>";
    // }

    //permohonan ==============================================================================
    public function lihat_permohonan()
    {
        $data['data'] = $this->M_finansial->lihat_permohonan();
        $this->load->view('header');
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Permohonan/V_permohonan', $data);
        $this->load->view('footer');
    }

    public function detail_permohonan($kd_permohonan)
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
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Transaksi/V_detail_permohonan', $data);
        $this->load->view('footer');
    }

    //transaksi permohonan ==============================================================================
    public function lihat_transaksi()
    {
        $data['data'] = $this->M_finansial->lihat_tarif();
        $this->load->view('header');
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Transaksi/V_transaksi', $data);
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
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Tarif/V_tarif', $data);
        $this->load->view('footer');
    }

    public function tambah_tarif($id)
    {

        $data['data'] = $this->M_finansial->get_permohonan($id);
        foreach ($data['data'] as $dt) {
            $dt->kd_jenis;
        }
        $data['perhit'] = $this->M_finansial->get_perhitungan($dt->kd_jenis);
        $this->load->view('Finansial/Tarif/js');
        $this->load->view('header');
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Tarif/V_tambah_tarif', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_tarif()
    {
        $this->M_finansial->proses_tambah_tarif();
        echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='" . base_url('Finansial/lihat_tarif') . "';</script>";
    }

    public function ubah_tarif($id)
    {

        $data['tarif'] = $this->M_finansial->get_tarif($id);
        foreach ($data['tarif'] as $dt) {
            $dt->id_permohonan;
        }
        $data['data'] = $this->M_finansial->get_permohonan($dt->id_permohonan);
        $data['id_tarif'] = $id;

        $this->load->view('Finansial/Tarif/js');
        $this->load->view('header');
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Tarif/V_ubah_tarif', $data);
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

        $this->load->view('Finansial/Tarif/js');
        $this->load->view('header');
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Tarif/V_detail_tarif', $data);
        $this->load->view('footer');
    }

    public function proses_edit_tarif($id)
    {
        $this->M_finansial->proses_edit_tarif($id);
        echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Finansial/detail_tarif/' . $id) . "';</script>";
    }

    public function hapus_tarif($id)
    {
        $this->M_finansial->hapus_tarif($id);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Finansial/lihat_tarif/') . "';</script>";
    }

    //perhitungan ==============================================================================
    public function lihat_perhitungan()
    {
        $data['data'] = $this->M_finansial->lihat_perhitungan();
        $this->load->view('header');
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Perhitungan/V_perhitungan', $data);
        $this->load->view('footer');
    }

    public function edit_perhitungan($id)
    {
        $data['perhit'] = $this->M_finansial->get_perhitungan2($id);
        $this->load->view('header');
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Perhitungan/V_ubah_perhitungan', $data);
        $this->load->view('footer');
    }

    public function proses_edit_perhitungan($id)
    {
        $this->M_finansial->proses_edit_perhitungan($id);
        echo "<script language='javascript'>alert('Data Berhasil Diedit'); document.location='" . base_url('Finansial/edit_perhitungan/' . $id) . "';</script>";
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
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Pemasukan/V_tambah_pemasukan', $data);
        $this->load->view('footer');
        $this->load->view('Finansial/Pemasukan/js');
        //print_r($data['dt']);
    }

    public function proses_tambah_pemasukan($id)
    {
        $this->M_finansial->proses_tambah_pemasukan($id);
        echo "<script language='javascript'>alert('Data Berhasil Ditambah'); document.location='" . base_url('Finansial/detail_permohonan/' . $id . '/pemasukan') . "';</script>";
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
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Pemasukan/V_edit_pemasukan', $data);
        $this->load->view('footer');
        $this->load->view('Finansial/Pemasukan/js');
    }

    public function proses_edit_pemasukan($id)
    {
        $this->M_finansial->proses_edit_pemasukan($id);
        echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Finansial/edit_pemasukan/' . $id . '/pemasukan') . "';</script>";
    }

    public function hapus_pemasukan($id, $id_permohonan)
    {
        $this->M_finansial->hapus_pemasukan($id, $id_permohonan);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Finansial/detail_permohonan/' . $id_permohonan . '/pemasukan') . "';</script>";
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
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Pengeluaran/V_tambah_pengeluaran', $data);
        $this->load->view('footer');
        $this->load->view('Finansial/Pengeluaran/js');
        //print_r($data['dt']);
    }

    public function proses_tambah_pengeluaran($id)
    {
        $this->M_finansial->proses_tambah_pengeluaran($id);
        echo "<script language='javascript'>alert('Data Berhasil Ditambah'); document.location='" . base_url('Finansial/detail_permohonan/' . $id . '/pengeluaran') . "';</script>";
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
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Pengeluaran/V_edit_pengeluaran', $data);
        $this->load->view('footer');
        $this->load->view('Finansial/Pengeluaran/js');
    }

    public function proses_edit_pengeluaran($id)
    {
        $this->M_finansial->proses_edit_pengeluaran($id);
        echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Finansial/edit_pengeluaran/' . $id . '/pengeluaran') . "';</script>";
    }

    public function hapus_pengeluaran($id, $id_permohonan)
    {
        $this->M_finansial->hapus_pengeluaran($id, $id_permohonan);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Finansial/detail_permohonan/' . $id_permohonan . '/pengeluaran') . "';</script>";
    }
    //pembayaran===================================================

    public function proses_tambah_pembayaran($id)
    {
        $this->M_finansial->proses_tambah_pembayaran($id);
        echo "<script language='javascript'>alert('Data Berhasil Ditambah'); document.location='" . base_url('Finansial/lihat_pembayaran/' . $id) . "';</script>";
    }

    public function hapus_pembayaran($id, $id_pembayaran)
    {
        $this->M_finansial->hapus_pembayaran($id, $id_pembayaran);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Finansial/lihat_pembayaran/' . $id) . "';</script>";
    }

    public function edit_pembayaran($id, $id_pembayaran)
    {
        $data['datas'] = $this->M_finansial->list_permohonan();
        $data['data'] = $this->M_finansial->get_pembayaran($id, $id_pembayaran);
        $data['status'] = $id;
        $this->load->view('header');
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Pembayaran/V_edit_pembayaran', $data);
        $this->load->view('footer');
    }

    public function proses_edit_pembayaran($id, $id_pembayaran)
    {
        $this->M_finansial->proses_edit_pembayaran($id, $id_pembayaran);
        echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Finansial/edit_pembayaran/' . $id . '/' . $id_pembayaran) . "';</script>";
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
        // var_dump($total);
        // $data['data'] = $this->M_finansial->lihat_umum();
        $this->load->view('header');
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Umum/V_umum', $data);
        $this->load->view('footer');
        $this->load->view('Finansial/Umum/js');
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
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Umum/V_tambah_umum', $data);
        $this->load->view('footer');
    }

    public function proses_tambah_umum()
    {
        $this->M_finansial->proses_tambah_umum();
        echo "<script language='javascript'>alert('Data Berhasil Ditambah'); document.location='" . base_url('Finansial/lihat_umum/') . "';</script>";
    }

    public function hapus_umum($id)
    {
        $this->M_finansial->hapus_umum($id);
        echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='" . base_url('Finansial/lihat_umum/') . "';</script>";
    }

    public function edit_umum($id)
    {
        $data['data'] = $this->M_finansial->get_umum($id);
        $this->load->view('header');
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Umum/V_edit_umum', $data);
        $this->load->view('footer');
    }

    public function proses_edit_umum($id)
    {
        $this->M_finansial->proses_edit_umum($id);
        echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='" . base_url('Finansial/lihat_umum/') . "';</script>";
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
    public function lihat_laporan()
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
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Laporan/V_pendapatan', $data);
        $this->load->view('footer');
        $this->load->view('Finansial/Laporan/js');
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
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Pemasukan/V_pemasukan', $data);
        $this->load->view('footer');
        $this->load->view('Finansial/Pemasukan/js2');
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
        $this->load->view('Finansial/menu');
        $this->load->view('Finansial/Pengeluaran/V_pengeluaran', $data);
        $this->load->view('footer');
        $this->load->view('Finansial/Pengeluaran/js2');
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
}
