<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_welcome');
		$this->load->helper('nominal');
		$this->load->helper('tgl');
	}

	public function index()
	{
		$this->load->view('welcome_message');
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

		$master = $this->M_welcome->cetak_umum($tgl_awal, $tgl_akhir, $pejabat);
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
}
