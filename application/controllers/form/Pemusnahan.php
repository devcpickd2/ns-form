<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Dompdf\Dompdf;
setlocale(LC_TIME, 'id_ID.UTF-8');

class Pemusnahan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model'); 
		$this->load->model('pemusnahan_model');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'pemusnahan' => $this->pemusnahan_model->get_data_by_plant(),
			'active_nav' => 'pemusnahan', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/pemusnahan/pemusnahan', $data);
		$this->load->view('partials/footer');
	}

	public function detail($uuid)
	{
		$data = array(
			'pemusnahan' => $this->pemusnahan_model->get_by_uuid($uuid),
			'active_nav' => 'pemusnahan');

		$this->load->view('partials/head', $data);
		$this->load->view('form/pemusnahan/pemusnahan-detail', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{

		$rules = $this->pemusnahan_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->pemusnahan_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Pemusnahan Produk berhasil di simpan');
				redirect('pemusnahan');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pemusnahan Produk gagal di simpan');
				redirect('pemusnahan');
			}
		}

		$data = array(
			'active_nav' => 'pemusnahan');

		$this->load->view('partials/head', $data);
		$this->load->view('form/pemusnahan/pemusnahan-tambah');
		$this->load->view('partials/footer');
	}


	public function edit($uuid)
	{
		$rules = $this->pemusnahan_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->pemusnahan_model->update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemusnahan Produk berhasil di Update');
				redirect('pemusnahan');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pemusnahan Produk gagal di Update');
				redirect('pemusnahan');
			}
		}

		$data = array(
			'pemusnahan' => $this->pemusnahan_model->get_by_uuid($uuid),
			'active_nav' => 'pemusnahan');

		$this->load->view('partials/head', $data);
		$this->load->view('form/pemusnahan/pemusnahan-edit', $data);
		$this->load->view('partials/footer');
	}

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('pemusnahan');
		}

		$deleted = $this->pemusnahan_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('pemusnahan');
	}
	
	public function verifikasi()
	{
		$data = array(
			'pemusnahan' => $this->pemusnahan_model->get_data_by_plant(),
			'active_nav' => 'verifikasi-pemusnahan', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/pemusnahan/pemusnahan-verifikasi', $data);
		$this->load->view('partials/footer');
	}


	public function status($uuid)
	{
		$rules = $this->pemusnahan_model->rules_verifikasi();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->pemusnahan_model->verifikasi_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemusnahan Produk berhasil di Update');
				redirect('pemusnahan/verifikasi');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pemusnahan Produk gagal di Update');
				redirect('pemusnahan/verifikasi');
			}
		}

		$data = array(
			'pemusnahan' => $this->pemusnahan_model->get_by_uuid($uuid),
			'active_nav' => 'verifikasi-pemusnahan');

		$this->load->view('partials/head', $data);
		$this->load->view('form/pemusnahan/pemusnahan-status', $data);
		$this->load->view('partials/footer');
	}

	public function diketahui()
	{
		$data = array(
			'pemusnahan' => $this->pemusnahan_model->get_data_by_plant(),
			'active_nav' => 'diketahui-pemusnahan', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/pemusnahan/pemusnahan-diketahui', $data);
		$this->load->view('partials/footer');
	}


	public function statusprod($uuid)
	{
		$rules = $this->pemusnahan_model->rules_diketahui();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->pemusnahan_model->diketahui_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Status Pemusnahan Produk berhasil di Update');
				redirect('pemusnahan/diketahui');
			}else {
				$this->session->set_flashdata('error_msg', 'Status Pemusnahan Produk gagal di Update');
				redirect('pemusnahan/diketahui');
			}
		}

		$data = array(
			'pemusnahan' => $this->pemusnahan_model->get_by_uuid($uuid),
			'active_nav' => 'diketahui-pemusnahan');

		$this->load->view('partials/head', $data);
		$this->load->view('form/pemusnahan/pemusnahan-statusprod', $data);
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

		$pemusnahan_data = $this->pemusnahan_model->get_by_date($tanggal, $plant); 
		$pemusnahan_data_verif = $this->pemusnahan_model->get_last_verif_by_date($tanggal, $plant); 

		if (!$pemusnahan_data || !$pemusnahan_data_verif) {
			$this->session->set_flashdata('error_msg', 'Data tidak ditemukan untuk tanggal yang dipilih.');
			redirect('pemusnahan/verifikasi'); 
		}

		$data['pemusnahan'] = $pemusnahan_data_verif;

		$this->load->model('pegawai_model');
		$data['pemusnahan']->nama_lengkap_qc = $this->pegawai_model->get_nama_lengkap($data['pemusnahan']->username);
		$data['pemusnahan']->nama_lengkap_spv = $this->pegawai_model->get_nama_lengkap($data['pemusnahan']->nama_spv);

		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
		$pdf->setPrintHeader(false); 
		$pdf->SetMargins(17, 16, 15); 
		$pdf->AddPage('L', 'LEGAL');
		$pdf->SetFont('times', 'B', 13);

		$logo_path = FCPATH . 'assets/img/logo.jpg';
		if (file_exists($logo_path)) {
			$pdf->Image($logo_path, 17, 14, 45);
		} else {
			$pdf->Write(7, "Logo tidak ditemukan\n");
		}

		$pdf->Write(10, "\n");
		$pdf->MultiCell(0, 5, 'PEMUSNAHAN BARANG / PRODUK', 0, 'C');
		$pdf->Ln(5);

		setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
		$tanggal = $data['pemusnahan']->date;
		$date = new DateTime($tanggal);
		$formatted_date = strftime('%A, %d %B %Y', $date->getTimestamp());

		$formatted_date2 = strftime('%d %B %Y', $date->getTimestamp());

		$pdf->SetFont('times', '', 10);
		$pdf->SetX(17);
		$pdf->Write(0, 'Hari / Tanggal : ' . $formatted_date);
		$pdf->Ln(5);

		$pdf->SetFont('times', '', 11);

		$pdf->Cell(15, 10, 'No.', 1, 0, 'C');
		$pdf->Cell(60, 10, 'Nama Produk', 1, 0, 'C');
		$pdf->Cell(60, 10, 'Kode Produksi', 1, 0, 'C');
		$pdf->Cell(50, 10, 'Best Before', 1, 0, 'C');
		$pdf->Cell(90, 10, 'Analisa', 1, 0, 'C');
		$pdf->Cell(40, 10, 'Keterangan', 1, 1, 'C');	

		foreach ($pemusnahan_data as $pemusnahan) {
			$bb = $pemusnahan->best_before;
			$best_before = new DateTime($bb);
			$formatted_bb = strftime('%d %B %Y', $best_before->getTimestamp());
			$no = 1;
			$pdf->SetFont('times', '', 10);
			$pdf->Cell(15, 6, $no, 1, 0, 'C');
			$pdf->Cell(60, 6, $pemusnahan->nama_produk, 1, 0, 'C');
			$pdf->Cell(60, 6, $pemusnahan->kode_produksi, 1, 0, 'C');
			$pdf->Cell(50, 6, $formatted_bb, 1, 0, 'C');
			$pdf->Cell(90, 6, $pemusnahan->analisa, 1, 0, 'C');
			$pdf->Cell(40, 6, !empty($pemusnahan->keterangan) ? $pemusnahan->keterangan : '-', 1, 0, 'C');
			$pdf->Ln();
			$no++;
		}

		$y_after_keterangan = $pdf->GetY() + 2;
		$status_verifikasi = true;
		foreach ($pemusnahan_data as $item) {
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
			$pdf->SetFont('times', 'U', 8);
			$pdf->Cell(60, 5, $data['pemusnahan']->nama_lengkap_qc, 0, 1, 'C');
			$pdf->SetFont('times', '', 8); 
			$pdf->Cell(105, 5, 'QC Inspector', 0, 0, 'C');

			$pdf->SetXY(250, $y_verifikasi + 5);
			$pdf->Cell(49, 5, 'Disetujui Oleh,', 0, 0, 'C');
			$update_tanggal = (new DateTime($data['pemusnahan']->tgl_update_spv))->format('d-m-Y | H:i');
			$qr_text = "Diverifikasi secara digital oleh,\n" . $data['pemusnahan']->nama_lengkap_spv . "\nSPV QC Bread Crumb\n" . $update_tanggal;
			$pdf->write2DBarcode($qr_text, 'QRCODE,L', 267, $y_verifikasi + 10, 15, 15, null, 'N');
			$pdf->SetXY(250, $y_verifikasi + 24);
			$pdf->Cell(49, 5, 'Supervisor QC', 0, 0, 'C');
		} else {
			$pdf->SetTextColor(255, 0, 0); 
			$pdf->SetFont('times', '', 8);
			$pdf->SetXY(100, $y_after_keterangan + 10);
			$pdf->Cell(280, 5, 'Data Belum Diverifikasi', 0, 0, 'C');
		}

		$pdf->setPrintFooter(false);
		$filename = "Pemusnahan Produk_{$formatted_date2}.pdf";
		$pdf->Output($filename, 'I');

	}
}

