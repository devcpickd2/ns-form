<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Dompdf\Dompdf;
setlocale(LC_TIME, 'id_ID.UTF-8');

class Metal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model'); 
		$this->load->model('metal_model');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'metal' => $this->metal_model->get_data_by_plant(),
			'active_nav' => 'metal', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/metal/metal', $data);
		$this->load->view('partials/footer');
	}

	public function detail($uuid)
	{
		$data = array(
			'metal' => $this->metal_model->get_by_uuid($uuid),
			'active_nav' => 'metal');

		$this->load->view('partials/head', $data);
		$this->load->view('form/metal/metal-detail', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{

		$rules = $this->metal_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->metal_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Metal Detector berhasil di simpan');
				redirect('metal');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Metal Detector gagal di simpan');
				redirect('metal');
			}
		}

		$data = array(
			'active_nav' => 'metal');

		$this->load->view('partials/head', $data);
		$this->load->view('form/metal/metal-tambah');
		$this->load->view('partials/footer'); 
	}

	public function edit($uuid)
	{
		$rules = $this->metal_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->metal_model->update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Metal Detector berhasil di Update');
				redirect('metal');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Metal Detector gagal di Update');
				redirect('metal');
			}
		}

		$data = array(
			'metal' => $this->metal_model->get_by_uuid($uuid),
			'active_nav' => 'metal');

		$this->load->view('partials/head', $data);
		$this->load->view('form/metal/metal-edit', $data);
		$this->load->view('partials/footer');
	}

	// public function edit2($uuid)
	// {
	// 	$rules = $this->metal_model->rules_update2();
	// 	$this->form_validation->set_rules($rules);

	// 	if ($this->form_validation->run() == TRUE) {
			
	// 		$update = $this->metal_model->update2($uuid);
	// 		if ($update) {
	// 			$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Metal Detector berhasil di Update');
	// 			redirect('metal');
	// 		}else {
	// 			$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Metal Detector gagal di Update');
	// 			redirect('metal');
	// 		}
	// 	}

	// 	$data = array(
	// 		'metal' => $this->metal_model->get_by_uuid($uuid),
	// 		'active_nav' => 'metal');

	// 	$this->load->view('partials/head', $data);
	// 	$this->load->view('form/metal/metal-edit2', $data);
	// 	$this->load->view('partials/footer');
	// }
	

	// public function edit3($uuid)
	// {
	// 	$rules = $this->metal_model->rules_update3();
	// 	$this->form_validation->set_rules($rules);

	// 	if ($this->form_validation->run() == TRUE) {
			
	// 		$update = $this->metal_model->update3($uuid);
	// 		if ($update) {
	// 			$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Metal Detector berhasil di Update');
	// 			redirect('metal');
	// 		}else {
	// 			$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Metal Detector gagal di Update');
	// 			redirect('metal');
	// 		}
	// 	}

	// 	$data = array(
	// 		'metal' => $this->metal_model->get_by_uuid($uuid),
	// 		'active_nav' => 'metal');

	// 	$this->load->view('partials/head', $data);
	// 	$this->load->view('form/metal/metal-edit3', $data);
	// 	$this->load->view('partials/footer');
	// }

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('metal');
		}

		$deleted = $this->metal_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('metal');
	}

	public function verifikasi()
	{
		$data = array(
			'metal' => $this->metal_model->get_data_by_plant(),
			'active_nav' => 'verifikasi-metal', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/metal/metal-verifikasi', $data);
		$this->load->view('partials/footer');
	}


	public function status($uuid)
	{
		$rules = $this->metal_model->rules_verifikasi();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->metal_model->verifikasi_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Metal Detector berhasil di Update');
				redirect('metal/verifikasi');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Metal Detector gagal di Update');
				redirect('metal/verifikasi');
			}
		}

		$data = array(
			'metal' => $this->metal_model->get_by_uuid($uuid),
			'active_nav' => 'verifikasi-metal');

		$this->load->view('partials/head', $data);
		$this->load->view('form/metal/metal-status', $data);
		$this->load->view('partials/footer');
	}

	public function diketahui()
	{
		$data = array(
			'metal' => $this->metal_model->get_data_by_plant(),
			'active_nav' => 'diketahui-metal', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/metal/metal-diketahui', $data);
		$this->load->view('partials/footer');
	}


	public function statusprod($uuid)
	{
		$rules = $this->metal_model->rules_diketahui();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->metal_model->diketahui_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Status Pemeriksaan Metal Detector berhasil di Update');
				redirect('metal/diketahui');
			}else {
				$this->session->set_flashdata('error_msg', 'Status Pemeriksaan Metal Detector gagal di Update');
				redirect('metal/diketahui');
			}
		}

		$data = array(
			'metal' => $this->metal_model->get_by_uuid($uuid),
			'active_nav' => 'diketahui-metal');

		$this->load->view('partials/head', $data);
		$this->load->view('form/metal/metal-statusprod', $data);
		$this->load->view('partials/footer');
	}

	public function cetak()
	{
		$tanggal = $this->input->post('tanggal');  

		log_message('debug', 'Tanggal yang dipilih: ' . print_r($tanggal, true));

		if (empty($tanggal)) {
			show_error('Tidak ada tanggal yang dipilih', 404);
		}

		$plant = $this->session->userdata('plant');

		$metal_data = $this->metal_model->get_by_date($tanggal, $plant); 
		$metal_data_verif = $this->metal_model->get_last_verif_by_date($tanggal, $plant); 

		if (!$metal_data || !$metal_data_verif) {
			$this->session->set_flashdata('error_msg', 'Data tidak ditemukan untuk tanggal yang dipilih.');
			redirect('metal/verifikasi'); 
		}

		$data['metal'] = $metal_data_verif;

		$this->load->model('pegawai_model');
		$data['metal']->nama_lengkap_qc = $this->pegawai_model->get_nama_lengkap($data['metal']->username_1);
		$data['metal']->nama_lengkap_spv = $this->pegawai_model->get_nama_lengkap($data['metal']->nama_spv_metal);
		$data['metal']->nama_lengkap_produksi = $this->pegawai_model->get_nama_lengkap($data['metal']->nama_produksi_metal);

		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
		$pdf->setPrintHeader(false); 
		$pdf->SetMargins(10, 10, 10);
		$pdf->AddPage();
		$pdf->SetFont('times', 'B', 12);

		$logo_path = FCPATH . 'assets/img/logo.jpg';
		if (file_exists($logo_path)) {
			$pdf->Image($logo_path, 10, 10, 35);
		} else {
			$pdf->Write(7, "Logo tidak ditemukan\n");
		}

		$pdf->Write(7, "\n");
		$pdf->MultiCell(0, 5, 'PEMERIKSAAN METAL DETECTOR', 0, 'C');
		$pdf->Ln(4);

		setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
		$tanggal = $data['metal']->date_metal;
		$date = new DateTime($tanggal);
		$formatted_date = strftime('%A, %d %B %Y', $date->getTimestamp());
		$formatted_date2 = strftime('%d %B %Y', $date->getTimestamp());

		$pdf->SetFont('times', '', 9);
		$pdf->SetX(10);
		$pdf->Write(0, 'Tanggal: ' . $formatted_date);
		$pdf->SetX($pdf->GetX() + 20);
		$pdf->Write(0, 'Shift: ' . $data['metal']->shift);
		$pdf->Ln(5);

		$pdf->SetFont('times', '', 8);

		$pdf->Cell(14, 16, 'Pukul', 1, 0, 'C');
		$pdf->Cell(58, 16, 'Produk / Kode Produksi', 1, 0, 'C');
		$pdf->Cell(12, 16, 'No. ', 1, 0, 'C');
		// $pdf->Cell(12, 16, 'Deteksi', 1, 0, 'C');
		$pdf->Cell(60, 4, 'STD. Spesimen', 1, 0, 'C');
		$pdf->Cell(20, 16, 'Keterangan', 1, 0, 'C');
		$pdf->Cell(30, 4, 'Paraf', 1, 1, 'C');

		$pdf->Cell(72, 4, '', 0, 0, 'L');
		$pdf->Cell(12, 12, 'Program', 0, 0, 'C');
		// $pdf->Cell(12, 12, 'NG', 0, 0, 'C');
		$pdf->Cell(20, 4, 'Fe (mm)', 1, 0, 'C');
		$pdf->Cell(20, 4, 'Non FE (mm)', 1, 0, 'C');
		$pdf->Cell(20, 4, 'SUS 304 (mm)', 1, 0, 'C');
		$pdf->Cell(20, 4, '', 0, 0, 'C');
		$pdf->Cell(15, 12, 'QC', 1, 0, 'C');
		$pdf->Cell(15, 12, 'Prod', 1, 0, 'C');
		$pdf->Cell(10, 4, '', 0, 1, 'C');

		$pdf->Cell(84, 4, '', 0, 0, 'L');
		// $pdf->Cell(12, 8, 'Product', 0, 0, 'C');
		$pdf->Cell(20, 4, $data['metal']->std_fe, 1, 0, 'C');
		$pdf->Cell(20, 4, $data['metal']->std_nonfe, 1, 0, 'C');
		$pdf->Cell(20, 4, $data['metal']->std_sus316, 1, 0, 'C');
		$pdf->Cell(50, 4, '', 0, 0, 'C');
		$pdf->Cell(16, 4, '', 0, 1, 'C');

		$pdf->Cell(84, 4, '', 0, 0, 'L');
		$pdf->Cell(6, 4, 'D', 1, 0, 'C');
		$pdf->Cell(7, 4, 'T', 1, 0, 'C');
		$pdf->Cell(7, 4, 'B', 1, 0, 'C');
		$pdf->Cell(6, 4, 'D', 1, 0, 'C');
		$pdf->Cell(7, 4, 'T', 1, 0, 'C');
		$pdf->Cell(7, 4, 'B', 1, 0, 'C');
		$pdf->Cell(6, 4, 'D', 1, 0, 'C');
		$pdf->Cell(7, 4, 'T', 1, 0, 'C');
		$pdf->Cell(7, 4, 'B', 1, 0, 'C');
		$pdf->Cell(50, 0, '', 0, 0, 'C');
		$pdf->Cell(16, 4, '', 0, 1, 'C');

		foreach ($metal_data as $metal) {
			$formattedTime = date('H:i', strtotime($metal->time));

			$pdf->Cell(14, 5, $formattedTime, 1, 0, 'C');
			$pdf->Cell(58, 5, $metal->nama_produk.' - '. $metal->kode_produksi, 1, 0, 'L');
			$pdf->Cell(12, 5, $metal->no_program, 1, 0, 'C');
			// $pdf->Cell(12, 5, $metal->deteksi_ng, 1, 0, 'C');

			$pdf->SetFont('dejavusans', '', 8);	
			$pdf->Cell(6, 5, ($metal->fe_d === null || $metal->fe_d === '') ? '-' : (($metal->fe_d == 'terdeteksi') ? '✔' : '✘'), 1, 0, 'C');
			$pdf->Cell(7, 5, ($metal->nonfe_d === null || $metal->nonfe_d === '') ? '-' : (($metal->nonfe_d == 'terdeteksi') ? '✔' : '✘'), 1, 0, 'C');
			$pdf->Cell(7, 5, ($metal->sus_d === null || $metal->sus_d === '') ? '-' : (($metal->sus_d == 'terdeteksi') ? '✔' : '✘'), 1, 0, 'C');
			$pdf->Cell(6, 5, ($metal->fe_t === null || $metal->fe_t === '') ? '-' : (($metal->fe_t == 'terdeteksi') ? '✔' : '✘'), 1, 0, 'C');
			$pdf->Cell(7, 5, ($metal->nonfe_t === null || $metal->nonfe_t === '') ? '-' : (($metal->nonfe_t == 'terdeteksi') ? '✔' : '✘'), 1, 0, 'C');
			$pdf->Cell(7, 5, ($metal->sus_t === null || $metal->sus_t === '') ? '-' : (($metal->sus_t == 'terdeteksi') ? '✔' : '✘'), 1, 0, 'C');
			$pdf->Cell(6, 5, ($metal->fe_b === null || $metal->fe_b === '') ? '-' : (($metal->fe_b == 'terdeteksi') ? '✔' : '✘'), 1, 0, 'C');
			$pdf->Cell(7, 5, ($metal->nonfe_b === null || $metal->nonfe_b === '') ? '-' : (($metal->nonfe_b == 'terdeteksi') ? '✔' : '✘'), 1, 0, 'C');
			$pdf->Cell(7, 5, ($metal->sus_b === null || $metal->sus_b === '') ? '-' : (($metal->sus_b == 'terdeteksi') ? '✔' : '✘'), 1, 0, 'C');
			$pdf->SetFont('times', '', 7);
			$pdf->Cell(20, 5, !empty($metal->keterangan) ? $metal->keterangan : '-', 1, 0, 'C');
			$pdf->Cell(15, 5, $metal->username_1, 1, 0, 'C');
			$pdf->Cell(15, 5, $metal->nama_produksi_metal, 1, 0, 'C');
			$pdf->Ln();
		}

		$pdf->SetY($pdf->GetY() + 3); 
		$pdf->SetFont('dejavusans', '', 5);

		// $col1 = "1. Belt Conveyor Berhenti\n2. Rejector";
		$col2 = "✓ : Spesimen terdeteksi oleh metal detector\n✗ : Spesimen tidak terdeteksi oleh metal detector";
		$col3 = "D : Depan\nT : Tengah\nB : Belakang";
		$startX = $pdf->GetX();
		$startY = $pdf->GetY();
		$colWidth = 50;

		$pdf->SetXY($startX, $startY);
		// $pdf->MultiCell($colWidth, 4, "1) Deteksi NG Product\n" . $col1, 0, 'L', false);
		// $pdf->SetXY($startX + 40, $startY);
		$pdf->MultiCell($colWidth, 4, "2) Hasil Verifikasi\n" . $col2, 0, 'L', false);
		$pdf->SetXY($startX + 2 * $colWidth, $startY);
		$pdf->MultiCell($colWidth, 4, $col3, 0, 'L', false);

		$pdf->SetY($pdf->GetY() + 2); 
		$pdf->SetFont('times', '', 8);
		$pdf->Cell(5, 3, 'Catatan : ', 0, 1, 'L');
		foreach ($metal_data as $item) {
			if (!empty($item->catatan)) {
				$pdf->Cell(13, 0, '', 0, 0, 'L'); 
				$pdf->Cell(13, 0, ' - ' . $item->catatan, 0, 1, 'L');
			}
		}

		$y_after_keterangan = $pdf->GetY() + 2;
		$status_verifikasi = true;
		foreach ($metal_data as $item) {
			if ($item->status_spv != '1') {
				$status_verifikasi = false;
				break;
			}
		}

		$pdf->SetFont('times', '', 8);
		$pdf->SetTextColor(0, 0, 0);

		if ($status_verifikasi) {
			$y_verifikasi = $y_after_keterangan;

			$pdf->SetXY(25, $y_verifikasi + 5);
			$pdf->Cell(35, 5, 'Dibuat Oleh,', 0, 0, 'C');
			$pdf->SetXY(25, $y_verifikasi + 10);
			$pdf->SetFont('times', 'U', 8); // underline
			$pdf->Cell(35, 5, $data['metal']->nama_lengkap_qc, 0, 1, 'C');
			$pdf->SetFont('times', '', 8); 
			$pdf->Cell(65, 5, 'QC Inspector', 0, 0, 'C');

			$pdf->SetXY(90, $y_verifikasi + 5);
			$pdf->Cell(35, 5, 'Diketahui Oleh,', 0, 0, 'C');

			if ($data['metal']->status_produksi == 1 && !empty($data['metal']->nama_produksi_metal)) {
				$update_tanggal_produksi = (new DateTime($data['metal']->tgl_update_produksi_metal))->format('d-m-Y | H:i');

				$pdf->SetFont('times', 'U', 8);
				$pdf->SetXY(90, $y_verifikasi + 10);
				$pdf->Cell(35, 5, $data['metal']->nama_lengkap_produksi, 0, 0, 'C');

				$pdf->SetFont('times', '', 8);
				$pdf->SetXY(90, $y_verifikasi + 15);
				$pdf->Cell(35, 5, 'Foreman/Forelady Produksi', 0, 0, 'C');

			} else {
				$pdf->SetXY(90, $y_verifikasi + 10);
				$pdf->Cell(35, 5, 'Belum Diverifikasi', 0, 0, 'C');
			}

			$pdf->SetXY(150, $y_verifikasi + 5);
			$pdf->Cell(49, 5, 'Disetujui Oleh,', 0, 0, 'C');
			$update_tanggal = (new DateTime($data['metal']->tgl_update_spv_metal))->format('d-m-Y | H:i');
			$qr_text = "Diverifikasi secara digital oleh,\n" . $data['metal']->nama_lengkap_spv . "\nSPV QC Bread Crumb\n" . $update_tanggal;
			$pdf->write2DBarcode($qr_text, 'QRCODE,L', 167, $y_verifikasi + 10, 15, 15, null, 'N');
			$pdf->SetXY(150, $y_verifikasi + 24);
			$pdf->Cell(49, 5, 'Supervisor QC', 0, 0, 'C');
		} else {
			$pdf->SetTextColor(255, 0, 0); 
			$pdf->SetFont('times', '', 8);
			$pdf->SetXY(100, $y_after_keterangan);
			$pdf->Cell(80, 5, 'Data Belum Diverifikasi', 0, 0, 'C');
		}


		$pdf->setPrintFooter(false);
		$filename = "Metal Detector_{$formatted_date2}.pdf";
		$pdf->Output($filename, 'I');

	}
}

