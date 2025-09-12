<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Dompdf\Dompdf;
setlocale(LC_TIME, 'id_ID.UTF-8');

class Releasepacking extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model'); 
		$this->load->model('releasepacking_model');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'releasepacking' => $this->releasepacking_model->get_data_by_plant(),
			'active_nav' => 'releasepacking', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/releasepacking/releasepacking', $data);
		$this->load->view('partials/footer');
	}

	public function detail($uuid)
	{
		$data = array(
			'releasepacking' => $this->releasepacking_model->get_by_uuid($uuid),
			'active_nav' => 'releasepacking');

		$this->load->view('partials/head', $data);
		$this->load->view('form/releasepacking/releasepacking-detail', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{

		$rules = $this->releasepacking_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->releasepacking_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Release Packing berhasil di simpan');
				redirect('releasepacking');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Release Packing gagal di simpan');
				redirect('releasepacking');
			}
		}

		$data = array(
			'active_nav' => 'releasepacking');

		$this->load->view('partials/head', $data);
		$this->load->view('form/releasepacking/releasepacking-tambah');
		$this->load->view('partials/footer');
	}


	public function edit($uuid)
	{
		$rules = $this->releasepacking_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->releasepacking_model->update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Release Packing berhasil di Update');
				redirect('releasepacking');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Release Packing gagal di Update');
				redirect('releasepacking');
			}
		}

		$data = array(
			'releasepacking' => $this->releasepacking_model->get_by_uuid($uuid),
			'active_nav' => 'releasepacking');

		$this->load->view('partials/head', $data);
		$this->load->view('form/releasepacking/releasepacking-edit', $data);
		$this->load->view('partials/footer');
	}

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('releasepacking');
		}

		$deleted = $this->releasepacking_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('releasepacking');
	}
	
	public function verifikasi()
	{
		$data = array(
			'releasepacking' => $this->releasepacking_model->get_data_by_plant(),
			'active_nav' => 'verifikasi-releasepacking', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/releasepacking/releasepacking-verifikasi', $data);
		$this->load->view('partials/footer');
	}


	public function status($uuid)
	{
		$rules = $this->releasepacking_model->rules_verifikasi();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->releasepacking_model->verifikasi_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Release Packing berhasil di Update');
				redirect('releasepacking/verifikasi');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Release Packing gagal di Update');
				redirect('releasepacking/verifikasi');
			}
		}

		$data = array(
			'releasepacking' => $this->releasepacking_model->get_by_uuid($uuid),
			'active_nav' => 'verifikasi-releasepacking');

		$this->load->view('partials/head', $data);
		$this->load->view('form/releasepacking/releasepacking-status', $data);
		$this->load->view('partials/footer');
	}

	public function diketahui()
	{
		$data = array(
			'releasepacking' => $this->releasepacking_model->get_data_by_plant(),
			'active_nav' => 'diketahui-releasepacking', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/releasepacking/releasepacking-diketahui', $data);
		$this->load->view('partials/footer');
	}


	public function statusprod($uuid)
	{
		$rules = $this->releasepacking_model->rules_diketahui();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->releasepacking_model->diketahui_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Status Release Packing berhasil di Update');
				redirect('releasepacking/diketahui');
			}else {
				$this->session->set_flashdata('error_msg', 'Status Release Packing gagal di Update');
				redirect('releasepacking/diketahui');
			}
		}

		$data = array(
			'releasepacking' => $this->releasepacking_model->get_by_uuid($uuid),
			'active_nav' => 'diketahui-releasepacking');

		$this->load->view('partials/head', $data);
		$this->load->view('form/releasepacking/releasepacking-statusprod', $data);
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

		$releasepacking_data = $this->releasepacking_model->get_by_date($tanggal, $plant); 
		$releasepacking_data_verif = $this->releasepacking_model->get_last_verif_by_date($tanggal, $plant); 

		if (!$releasepacking_data || !$releasepacking_data_verif) {
			$this->session->set_flashdata('error_msg', 'Data tidak ditemukan untuk tanggal yang dipilih.');
			redirect('releasepacking/verifikasi'); 
		}

		$data['releasepacking'] = $releasepacking_data_verif;

		$this->load->model('pegawai_model');
		$data['releasepacking']->nama_lengkap_qc = $this->pegawai_model->get_nama_lengkap($data['releasepacking']->username);
		$data['releasepacking']->nama_lengkap_spv = $this->pegawai_model->get_nama_lengkap($data['releasepacking']->nama_spv);

		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
		$pdf->setPrintHeader(false); 
		$pdf->SetMargins(17, 16, 15); 
		$pdf->AddPage('L', 'LEGAL');
		$pdf->SetFont('times', 'B', 14);

		$logo_path = FCPATH . 'assets/img/logo.jpg';
		if (file_exists($logo_path)) {
			$pdf->Image($logo_path, 17, 14, 45);
		} else {
			$pdf->Write(7, "Logo tidak ditemukan\n");
		}

		$pdf->Write(10, "\n");
		$pdf->MultiCell(0, 5, 'DATA RELEASE PACKING', 0, 'C');
		$pdf->Ln(5);

		setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
		$tanggal = $data['releasepacking']->date;
		$date = new DateTime($tanggal);
		$formatted_date = strftime('%A, %d %B %Y', $date->getTimestamp());

		$formatted_date2 = strftime('%d %B %Y', $date->getTimestamp());

		$pdf->SetFont('times', '', 10);
		$pdf->SetX(17);
		$pdf->Write(0, 'Hari / Tanggal : ' . $formatted_date);
		$pdf->Ln(5);

		$pdf->SetFont('times', '', 11);

		$pdf->Cell(10, 12, 'No.', 1, 0, 'C');
		$pdf->Cell(80, 12, 'Nama Produk', 1, 0, 'C');
		$pdf->Cell(60, 12, 'Kode Produksi', 1, 0, 'C');
		$pdf->Cell(40, 12, 'Best Before', 1, 0, 'C');
		$pdf->Cell(40, 12, 'Jumlah', 1, 0, 'C');
		$pdf->Cell(60, 12, 'Keterangan', 1, 0, 'C');
		$pdf->Cell(30, 12, 'QC', 1, 1, 'C');

		foreach ($releasepacking_data as $releasepacking) { 
			$bb = $releasepacking->best_before;
			$best_before = new DateTime($bb);
			$formatted_bb = strftime('%d %B %Y', $best_before->getTimestamp());
			$no = 1;
			$pdf->SetFont('times', '', 10);
			$pdf->Cell(10, 8, $no, 1, 0, 'C');
			$pdf->Cell(80, 8, $releasepacking->nama_produk, 1, 0, 'C');
			$pdf->Cell(60, 8, $releasepacking->kode_produksi, 1, 0, 'C');
			$pdf->Cell(40, 8, $formatted_bb, 1, 0, 'C');
			$pdf->Cell(40, 8, $releasepacking->jumlah, 1, 0, 'C');
			$pdf->Cell(60, 8, !empty($releasepacking->keterangan) ? $releasepacking->keterangan : '-', 1, 0, 'C');
			$pdf->Cell(30, 8, $releasepacking->username, 1, 0, 'C');
			$pdf->Ln();
			$no++;
		}

		$y_after_keterangan = $pdf->GetY() + 2;
		$status_verifikasi = true;
		foreach ($releasepacking_data as $item) {
			if ($item->status_spv != '1') {
				$status_verifikasi = false;
				break;
			}
		}

		$pdf->SetFont('times', '', 8);
		$pdf->SetTextColor(0, 0, 0);

		if ($status_verifikasi) {
			$y_verifikasi = $y_after_keterangan;

			$pdf->SetXY(40, $y_verifikasi + 5);
			$pdf->Cell(60, 5, 'Dibuat Oleh,', 0, 0, 'C');
			$pdf->SetXY(40, $y_verifikasi + 10);
			$pdf->SetFont('times', 'U', 8); // underline
			$pdf->Cell(60, 5, $data['releasepacking']->nama_lengkap_qc, 0, 1, 'C');
			$pdf->SetFont('times', '', 8); 
			$pdf->Cell(105, 5, 'QC Inspector', 0, 0, 'C');

			$pdf->SetXY(250, $y_verifikasi + 5);
			$pdf->Cell(49, 5, 'Disetujui Oleh,', 0, 0, 'C');
			$update_tanggal = (new DateTime($data['releasepacking']->tgl_update_spv))->format('d-m-Y | H:i');
			$qr_text = "Diverifikasi secara digital oleh,\n" . $data['releasepacking']->nama_lengkap_spv . "\nSPV QC Bread Crumb\n" . $update_tanggal;
			$pdf->write2DBarcode($qr_text, 'QRCODE,L', 267, $y_verifikasi + 10, 15, 15, null, 'N');
			$pdf->SetXY(250, $y_verifikasi + 24);
			$pdf->Cell(49, 5, 'Supervisor QC', 0, 0, 'C');
		} else {
			$pdf->SetTextColor(255, 0, 0); 
			$pdf->SetFont('times', '', 8);
			$pdf->SetXY(100, $y_after_keterangan);
			$pdf->Cell(250, 5, 'Data Belum Diverifikasi', 0, 0, 'C');
		}

		$pdf->setPrintFooter(false);
		$filename = "Data Release Packing_{$formatted_date2}.pdf";
		$pdf->Output($filename, 'I');

	}
}

