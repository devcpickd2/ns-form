<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Dompdf\Dompdf;
setlocale(LC_TIME, 'id_ID.UTF-8');

class Retain extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model'); 
		$this->load->model('retain_model');
		$this->load->model('plant_model');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'retain' => $this->retain_model->get_data_by_plant(),
			'active_nav' => 'retain', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/retain/retain', $data);
		$this->load->view('partials/footer');
	}

	public function detail($uuid)
	{
		$data = array(
			'retain' => $this->retain_model->get_retain_with_plant($uuid),
			'active_nav' => 'retain');

		$this->load->view('partials/head', $data);
		$this->load->view('form/retain/retain-detail', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{

		$rules = $this->retain_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->retain_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Retain Sample Report berhasil di simpan');
				redirect('retain');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Retain Sample Report gagal di simpan');
				redirect('retain');
			}
		}

		$data = array(
			'active_nav' => 'retain', 
			'plant' => $this->plant_model->get_all()
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/retain/retain-tambah');
		$this->load->view('partials/footer');
	}


	public function edit($uuid)
	{
		$rules = $this->retain_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->retain_model->update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Retain Sample Report berhasil di Update');
				redirect('retain');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Retain Sample Report gagal di Update');
				redirect('retain');
			}
		}

		$data = array(
			'retain' => $this->retain_model->get_by_uuid($uuid),
			'plant' => $this->plant_model->get_all(),
			'active_nav' => 'retain');

		$this->load->view('partials/head', $data);
		$this->load->view('form/retain/retain-edit', $data);
		$this->load->view('partials/footer');
	}

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('retain');
		}

		$deleted = $this->retain_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('retain');
	}
	
	public function verifikasi()
	{
		$data = array(
			'retain' => $this->retain_model->get_data_by_plant(),
			'active_nav' => 'verifikasi-retain', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/retain/retain-verifikasi', $data);
		$this->load->view('partials/footer');
	}


	public function status($uuid)
	{
		$rules = $this->retain_model->rules_verifikasi();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->retain_model->verifikasi_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Retain Sample Report berhasil di Update');
				redirect('retain/verifikasi');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Retain Sample Report gagal di Update');
				redirect('retain/verifikasi');
			}
		}

		$data = array(
			'retain' => $this->retain_model->get_retain_with_plant($uuid),
			'active_nav' => 'verifikasi-retain');

		$this->load->view('partials/head', $data);
		$this->load->view('form/retain/retain-status', $data);
		$this->load->view('partials/footer');
	}

	public function diketahui()
	{
		$data = array(
			'retain' => $this->retain_model->get_data_by_plant(),
			'active_nav' => 'diketahui-retain', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/retain/retain-diketahui', $data);
		$this->load->view('partials/footer');
	}


	public function statusprod($uuid)
	{
		$rules = $this->retain_model->rules_diketahui();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->retain_model->diketahui_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Status Retain Sample Report berhasil di Update');
				redirect('retain/diketahui');
			}else {
				$this->session->set_flashdata('error_msg', 'Status Retain Sample Report gagal di Update');
				redirect('retain/diketahui');
			}
		}

		$data = array(
			'retain' => $this->retain_model->get_by_uuid($uuid),
			'active_nav' => 'diketahui-retain');

		$this->load->view('partials/head', $data);
		$this->load->view('form/retain/retain-statusprod', $data);
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

		$retain_data = $this->retain_model->get_by_date($tanggal, $plant); 
		$retain_data_verif = $this->retain_model->get_last_verif_by_date($tanggal, $plant); 

		if (!$retain_data || !$retain_data_verif) {
			$this->session->set_flashdata('error_msg', 'Data tidak ditemukan untuk tanggal yang dipilih.');
			redirect('retain/verifikasi'); 
		}

		$data['retain'] = $retain_data_verif;

		$this->load->model('pegawai_model');
		$data['retain']->nama_lengkap_qc = $this->pegawai_model->get_nama_lengkap($data['retain']->username);
		$data['retain']->nama_lengkap_spv = $this->pegawai_model->get_nama_lengkap($data['retain']->nama_spv);
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

		$pdf->Write(8, "\n");
		$pdf->MultiCell(0, 5, 'RETAIN SAMPLE REPORT', 0, 'C');
		$pdf->Ln(5);


		setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
		$tanggal = $data['retain']->date;
		$datetime = new DateTime($tanggal);
		$formatted_date = strftime('%A, %d %B %Y', $datetime->getTimestamp());
		$formatted_date2 = strftime('%d %B %Y', $datetime->getTimestamp());

		$pdf->SetFont('times', '', 9);
		$pdf->SetX(10);

		$label_width = 35; 
		$value_width = 80;

		$pdf->Cell($label_width, 5, 'Plant', 0, 0); 
		$pdf->Cell(2, 5, ':', 0, 0); 
		$pdf->Cell($value_width, 5, $data['retain']->nama_plant, 0, 1);

		$pdf->Cell($label_width, 5, 'Sample Type', 0, 0); 
		$pdf->Cell(2, 5, ':', 0, 0); 
		$pdf->Cell($value_width, 5, $data['retain']->sample_type, 0, 1);

		$pdf->Cell($label_width, 5, 'Collection Date', 0, 0); 
		$pdf->Cell(2, 5, ':', 0, 0); 
		$pdf->Cell($value_width, 5, $formatted_date, 0, 1);

		$pdf->Cell($label_width, 5, 'Sample Storage', 0, 0); 
		$pdf->Cell(2, 5, ':', 0, 0); 
		$pdf->Cell($value_width, 5, $data['retain']->sample_storage, 0, 1);
		$pdf->Ln(2); 
		$pdf->SetFont('times', '', 10);
		$pdf->Cell(12, 10, 'No', 1, 0, 'C');
		$pdf->Cell(40, 10, 'Description', 1, 0, 'C');
		$pdf->Cell(50, 10, 'Production Code', 1, 0, 'C');
		$pdf->Cell(30, 10, 'Best Before', 1, 0, 'C');
		$pdf->Cell(30, 10, 'Quantity (gr)', 1, 0, 'C');
		$pdf->Cell(30, 10, 'Remarks', 1, 1, 'C');

		foreach ($retain_data as $retain) {
			setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
			$no = 1;
			$bb = $retain->best_before;
			$date = new DateTime($bb);
			$formatted_date =  $date->format('d - m - Y');
			$pdf->SetFont('times', '', 9);
			$pdf->Cell(12, 6, $no, 1, 0, 'C');
			$pdf->Cell(40, 6, $retain->deskripsi, 1, 0, 'C');
			$pdf->Cell(50, 6, $retain->kode_produksi, 1, 0, 'C');
			$pdf->Cell(30, 6, $formatted_date, 1, 0, 'C');
			$pdf->Cell(30, 6, $retain->quantity, 1, 0, 'C');
			$pdf->Cell(30, 6, $retain->remark, 1, 0, 'C');
			$pdf->Ln();
			$no++;
		}

		$pdf->SetY($pdf->GetY() + 2); 
		$pdf->SetFont('times', '', 8);
		$pdf->Cell(5, 3, 'Catatan : ', 0, 1, 'L');
		foreach ($retain_data as $item) {
			if (!empty($item->catatan)) {
				$pdf->Cell(13, 0, '', 0, 0, 'L'); 
				$pdf->Cell(13, 0, ' - ' . $item->catatan, 0, 1, 'L');
			}
		}

		$y_after_keterangan = $pdf->GetY() + 2;
		$status_verifikasi = true;
		foreach ($retain_data as $item) {
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
			$pdf->Cell(35, 5, 'Diperiksa Oleh,', 0, 0, 'C');
			$pdf->SetXY(25, $y_verifikasi + 10);
			$pdf->SetFont('times', 'U', 8); // underline
			$pdf->Cell(35, 5, $data['retain']->nama_lengkap_qc, 0, 1, 'C');
			$pdf->SetFont('times', '', 8); 
			$pdf->Cell(65, 5, 'QC Inspector', 0, 0, 'C');

			$pdf->SetXY(150, $y_verifikasi + 5);
			$pdf->Cell(49, 5, 'Disetujui Oleh,', 0, 0, 'C');
			$update_tanggal = (new DateTime($data['retain']->tgl_update_spv))->format('d-m-Y | H:i');
			$qr_text = "Diverifikasi secara digital oleh,\n" . $data['retain']->nama_lengkap_spv . "\nSPV QC Bread Crumb\n" . $update_tanggal;
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
		$filename = "Retain Sample_{$formatted_date2}.pdf";
		$pdf->Output($filename, 'I');
	}
}

