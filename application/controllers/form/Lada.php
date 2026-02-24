<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Dompdf\Dompdf;
setlocale(LC_TIME, 'id_ID.UTF-8');

class Lada extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model'); 
		$this->load->model('lada_model');
		$this->load->library('upload');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'lada' => $this->lada_model->get_data_by_plant(),
			'active_nav' => 'lada', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/lada/lada', $data);
		$this->load->view('partials/footer');
	}

	public function detail($uuid)
	{
		$data = array(
			'lada' => $this->lada_model->get_by_uuid($uuid),
			'active_nav' => 'lada');

		$this->load->view('partials/head', $data);
		$this->load->view('form/lada/lada-detail', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{
		$this->load->library('form_validation');

		$rules = $this->lada_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->lada_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Giling Lada berhasil disimpan');
			} else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Giling Lada gagal disimpan');
			}
			redirect('lada');
		}

		$data = array(
			'active_nav' => 'lada'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/lada/lada-tambah');
		$this->load->view('partials/footer');
	}

	public function edit($uuid)
	{
		$this->load->library('form_validation');

		$rules = $this->lada_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$update = $this->lada_model->update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Giling Lada berhasil diupdate');
			} else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Giling Lada gagal diupdate');
			}
			redirect('lada');
		}

		$data = array(
			'lada'   => $this->lada_model->get_by_uuid($uuid),
			'active_nav' => 'lada'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/lada/lada-edit', $data);
		$this->load->view('partials/footer');
	}

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('lada');
		}

		$deleted = $this->lada_model->delete_by_uuid($uuid); 

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('lada');
	}
	
	
	public function verifikasi()
	{
		$data = array(
			'lada' => $this->lada_model->get_data_by_plant(),
			'active_nav' => 'verifikasi-lada', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/lada/lada-verifikasi', $data);
		$this->load->view('partials/footer');
	}


	public function status($uuid)
	{
		$rules = $this->lada_model->rules_verifikasi();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->lada_model->verifikasi_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Giling Lada berhasil di Update');
				redirect('lada/verifikasi');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Giling Lada gagal di Update');
				redirect('lada/verifikasi');
			}
		}

		$data = array(
			'lada' => $this->lada_model->get_by_uuid($uuid),
			'active_nav' => 'verifikasi-lada');

		$this->load->view('partials/head', $data);
		$this->load->view('form/lada/lada-status', $data);
		$this->load->view('partials/footer');
	}

	public function diketahui()
	{
		$data = array(
			'lada' => $this->lada_model->get_data_by_plant(),
			'active_nav' => 'diketahui-lada', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/lada/lada-diketahui', $data);
		$this->load->view('partials/footer');
	}


	public function statusprod($uuid)
	{
		$rules = $this->lada_model->rules_diketahui();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->lada_model->diketahui_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Status Pemeriksaan Giling Lada berhasil di Update');
				redirect('lada/diketahui');
			}else {
				$this->session->set_flashdata('error_msg', 'Status Pemeriksaan Giling Lada gagal di Update');
				redirect('lada/diketahui');
			}
		}

		$data = array(
			'lada' => $this->lada_model->get_by_uuid($uuid),
			'active_nav' => 'diketahui-lada');

		$this->load->view('partials/head', $data);
		$this->load->view('form/lada/lada-statusprod', $data);
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

		$lada_data = $this->lada_model->get_by_date($tanggal, $plant); 
		$lada_data_verif = $this->lada_model->get_last_verif_by_date($tanggal, $plant); 

		if (!$lada_data || !$lada_data_verif) {
			$this->session->set_flashdata('error_msg', 'Data tidak ditemukan untuk tanggal yang dipilih.');
			redirect('lada/verifikasi'); 
		}

		$data['lada'] = $lada_data_verif;
		
		$this->load->model('pegawai_model');
		$data['lada']->nama_lengkap_qc = $this->pegawai_model->get_nama_lengkap($data['lada']->username);
		$data['lada']->nama_lengkap_spv = $this->pegawai_model->get_nama_lengkap($data['lada']->nama_spv);
		$data['lada']->nama_lengkap_produksi = $this->pegawai_model->get_nama_lengkap($data['lada']->nama_produksi);

		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
		$pdf->setPrintHeader(false); 
		$pdf->SetMargins(10, 14, 10);
		$pdf->AddPage();
		$pdf->SetFont('times', 'B', 12);

		$logo_path = FCPATH . 'assets/img/logo.jpg';
		if (file_exists($logo_path)) {
			$pdf->Image($logo_path, 10, 10, 38);
		} else {
			$pdf->Write(7, "Logo tidak ditemukan\n");
		}
		setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
		$pdf->Write(7, "\n");
		$pdf->MultiCell(0, 5, 'PEMERIKSAAN GILING LADA', 0, 'C');
		$pdf->Ln(4);

		$tanggal = $data['lada']->date;
		$datetime = new DateTime($tanggal);
		$formatted_date = strftime('%A, %d %B %Y', $datetime->getTimestamp());
		$formatted_date2 = strftime('%d %B %Y', $datetime->getTimestamp());

		$pdf->SetFont('times', '', 9);
		$pdf->SetX(10);
		$pdf->Write(0, 'Hari / Tanggal: ' . $formatted_date);
		$pdf->SetX($pdf->GetX() + 20);
		$pdf->Write(0, 'Shift: ' . $data['lada']->shift);
		$pdf->Ln(5);

		$pdf->SetFont('times', '', 9);
		$pdf->Cell(10, 10, 'Pukul', 1, 0, 'C');
		$pdf->Cell(30, 10, 'Kode Produksi', 1, 0, 'C');
		$pdf->Cell(28, 5, 'Suhu Produk', 1, 0, 'C');
		$pdf->Cell(30, 10, 'Hasil Giling', 1, 0, 'C');
		$pdf->Cell(30, 5, 'Kadar Air', 1, 0, 'C');
		$pdf->Cell(35 ,10, 'Keterangan', 1, 0, 'C');
		$pdf->Cell(30, 5, 'Paraf', 1, 1, 'C');
		$pdf->Cell(40, 5, '', 0, 0, 'L');
		$pdf->Cell(28, 5, 'STD Min 35°C', 1, 0, 'C');
		$pdf->Cell(30, 5, '', 0, 0, 'C');
		$pdf->Cell(30, 5, 'STD 9 - 12 %', 1, 0, 'C');
		$pdf->Cell(35, 0, '', 0, 0, 'C');
		$pdf->Cell(15, 5, 'QC', 1, 0, 'C');
		$pdf->Cell(15, 5, 'Prod', 1, 1, 'C');

		$pdf->SetFont('times', '', 8);
		foreach ($lada_data as $lada) {
			$time = $lada->pukul;
			$created_time = (new DateTime($time))->format('H:i');

			$pdf->Cell(10, 6, $created_time, 1, 0, 'C');
			$pdf->Cell(30, 6, $lada->kode_produksi, 1, 0, 'L');
			$pdf->Cell(28, 6, $lada->suhu_produk, 1, 0, 'C');
			$pdf->Cell(30, 6, $lada->hasil_giling, 1, 0, 'C');
			$pdf->Cell(30, 6, $lada->kadar_air, 1, 0, 'C');
			$pdf->Cell(35, 6, $lada->keterangan, 1, 0, 'C');
			$pdf->Cell(15, 6, $lada->username, 1, 0, 'C');
			$pdf->Cell(15, 6, $lada->nama_produksi, 1, 0, 'C');
			$pdf->Ln();
		}

		$pdf->SetFont('times', 'I', 7);
		$pdf->Cell(190, 5, 'QN 06/00', 0, 1, 'R'); 
		$pdf->SetY($pdf->GetY() + 2); 
		$pdf->SetFont('times', '', 8);
		$pdf->Cell(5, 3, 'Catatan : ', 0, 1, 'L');
		foreach ($lada_data as $item) {
			if (!empty($item->catatan)) {
				$pdf->Cell(13, 0, '', 0, 0, 'L'); 
				$pdf->Cell(13, 0, ' - ' . $item->catatan, 0, 1, 'L');
			}
		}

		$y_after_keterangan = $pdf->GetY() + 2;
		$status_verifikasi = true;
		foreach ($lada_data as $item) {
			if ($item->status_spv != '1') {
				$status_verifikasi = false;
				break;
			}
		}

		$pdf->SetFont('times', '', 8);
		$pdf->SetTextColor(0, 0, 0);

		// if ($status_verifikasi) {
		// 	$y_verifikasi = $y_after_keterangan;

		// 	$pdf->SetXY(25, $y_verifikasi + 5);
		// 	$pdf->Cell(35, 5, 'Dibuat Oleh,', 0, 0, 'C');
		// 	$pdf->SetXY(25, $y_verifikasi + 10);
		// 	$pdf->SetFont('times', 'U', 8);
		// 	$pdf->Cell(35, 5, $data['lada']->nama_lengkap_qc, 0, 1, 'C');
		// 	$pdf->SetFont('times', '', 8); 
		// 	$pdf->Cell(65, 5, 'QC Inspector', 0, 0, 'C');

		// 	$pdf->SetXY(90, $y_verifikasi + 5);
		// 	$pdf->Cell(35, 5, 'Diketahui Oleh,', 0, 0, 'C');

		// 	if ($data['lada']->status_produksi == 1 && !empty($data['lada']->nama_produksi)) {
		// 		$update_tanggal_produksi = (new DateTime($data['lada']->tgl_update_produksi))->format('d-m-Y | H:i');

		// 		$pdf->SetFont('times', 'U', 8);
		// 		$pdf->SetXY(90, $y_verifikasi + 10);
		// 		$pdf->Cell(35, 5, $data['lada']->nama_lengkap_produksi, 0, 0, 'C');

		// 		$pdf->SetFont('times', '', 8);
		// 		$pdf->SetXY(90, $y_verifikasi + 15);
		// 		$pdf->Cell(35, 5, 'Foreman/Forelady Produksi', 0, 0, 'C');

		// 	} else {
		// 		$pdf->SetXY(90, $y_verifikasi + 10);
		// 		$pdf->Cell(35, 5, 'Belum Diverifikasi', 0, 0, 'C');
		// 	}

		// 	$pdf->SetXY(150, $y_verifikasi + 5);
		// 	$pdf->Cell(49, 5, 'Disetujui Oleh,', 0, 0, 'C');
		// 	$update_tanggal = (new DateTime($data['lada']->tgl_update_spv))->format('d-m-Y | H:i');
		// 	$qr_text = "Diverifikasi secara digital oleh,\n" . $data['lada']->nama_lengkap_spv . "\nSPV QC Bread Crumb\n" . $update_tanggal;
		// 	$pdf->write2DBarcode($qr_text, 'QRCODE,L', 167, $y_verifikasi + 10, 15, 15, null, 'N');
		// 	$pdf->SetXY(150, $y_verifikasi + 24);
		// 	$pdf->Cell(49, 5, 'Supervisor QC', 0, 0, 'C');
		// } else {
		// 	$pdf->SetTextColor(255, 0, 0); 
		// 	$pdf->SetFont('times', '', 8);
		// 	$pdf->SetXY(100, $y_after_keterangan);
		// 	$pdf->Cell(80, 5, 'Data Belum Diverifikasi', 0, 0, 'C');
		// }

		$y_ttd   = $pdf->GetY() + 6;
		$qr_size = 15;

		$qc_usernames  = [];
		$qc_created_at = null;

		foreach ($lada_data as $item) {
			if (!empty($item->username)) {
				$qc_usernames[] = $item->username;
			}

			if (!$qc_created_at && !empty($item->created_at)) {
				$qc_created_at = $item->created_at;
			}
		}

		$qc_usernames = array_unique($qc_usernames);

		$qc_nama_lengkap = [];
		foreach ($qc_usernames as $username) {
			$nama = $this->pegawai_model->get_nama_lengkap($username);
			if (!empty($nama)) {
				$qc_nama_lengkap[] = $nama;
			}
		}

		$qc_nama_text = !empty($qc_nama_lengkap)
		? implode(', ', array_unique($qc_nama_lengkap))
		: '-';

		$qc_tanggal = $qc_created_at
		? (new DateTime($qc_created_at))->format('d-m-Y | H:i')
		: '-';

		$qr_qc_text = "Dibuat secara digital oleh,\n"
		. $qc_nama_text . "\n"
		. "QC Inspector\n"
		. $qc_tanggal;

		$qr_produksi_text = null;

		if (!empty($data['lada']->nama_lengkap_produksi) && !empty($data['lada']->tgl_update_produksi)) {
			$prod_tanggal = (new DateTime($data['lada']->tgl_update_produksi ?? $data['lada']->tgl_update_produksi))
			->format('d-m-Y | H:i');

			$qr_produksi_text = "Diketahui secara digital oleh,\n"
			. $data['lada']->nama_lengkap_produksi . "\n"
			. "Foreman/Forelady Produksi\n"
			. $prod_tanggal;
		}

		$spv_tanggal = !empty($data['lada']->tgl_update_spv)
		? (new DateTime($data['lada']->tgl_update_spv))->format('d-m-Y | H:i')
		: '-';

		$qr_spv_text = "Disetujui secara digital oleh,\n"
		. $data['lada']->nama_lengkap_spv . "\n"
		. "Supervisor QC Bread Crumb\n"
		. $spv_tanggal;

		if ($status_verifikasi) {
			$pdf->SetFont('times', '', 8);
			$pdf->SetXY(20, $y_ttd);
			$pdf->Cell(45, 5, 'Dibuat Oleh,', 0, 0, 'C');
			$pdf->SetXY(85, $y_ttd);
			$pdf->Cell(45, 5, 'Diketahui Oleh,', 0, 0, 'C');
			$pdf->SetXY(150, $y_ttd);
			$pdf->Cell(45, 5, 'Disetujui Oleh,', 0, 1, 'C');
			$pdf->write2DBarcode($qr_qc_text, 'QRCODE,L', 35,$y_ttd + 5, $qr_size, $qr_size, null, 'N');
			if ($qr_produksi_text) {
				$pdf->write2DBarcode($qr_produksi_text, 'QRCODE,L', 100, $y_ttd + 5, $qr_size, $qr_size, null, 'N');
			}
			$pdf->write2DBarcode($qr_spv_text, 'QRCODE,L', 165, $y_ttd + 5, $qr_size, $qr_size, null, 'N');
			$pdf->SetXY(20, $y_ttd + 20);
			$pdf->Cell(45, 5, 'QC Inspector', 0, 0, 'C');
			$pdf->SetXY(85, $y_ttd + 20);
			$pdf->Cell(45, 5, 'Foreman/Forelady Produksi', 0, 0, 'C');
			$pdf->SetXY(150, $y_ttd + 20);
			$pdf->Cell(45, 5, 'Supervisor QC', 0, 1, 'C');
		} else {
			$pdf->SetFont('times', '', 8);
			$pdf->SetTextColor(255, 0, 0);
			$pdf->SetXY(80, $y_ttd);
			$pdf->Cell(80, 6, 'Data Belum Diverifikasi', 0, 1, 'C');
			$pdf->SetTextColor(0, 0, 0);
		}


		$pdf->setPrintFooter(false);
		$filename = "Pemeriksaan Giling Lada_{$formatted_date2}.pdf";
		$pdf->Output($filename, 'I');
	}

}

