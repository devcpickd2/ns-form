<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Dompdf\Dompdf;
setlocale(LC_TIME, 'id_ID.UTF-8');

class Pengemasan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model'); 
		$this->load->model('pengemasan_model');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'pengemasan' => $this->pengemasan_model->get_data_by_plant(),
			'active_nav' => 'pengemasan', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/pengemasan/pengemasan', $data);
		$this->load->view('partials/footer');
	}

	public function detail($uuid)
	{
		$data = array(
			'pengemasan' => $this->pengemasan_model->get_by_uuid($uuid),
			'active_nav' => 'pengemasan');

		$this->load->view('partials/head', $data);
		$this->load->view('form/pengemasan/pengemasan-detail', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{

		$rules = $this->pengemasan_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->pengemasan_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Proses Pengemasan berhasil di simpan');
				redirect('pengemasan');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Proses Pengemasan gagal di simpan');
				redirect('pengemasan');
			}
		}

		$data = array(
			'active_nav' => 'pengemasan');

		$this->load->view('partials/head', $data);
		$this->load->view('form/pengemasan/pengemasan-tambah');
		$this->load->view('partials/footer');
	}


	public function edit($uuid)
	{
		$rules = $this->pengemasan_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->pengemasan_model->update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Proses Pengemasan berhasil di Update');
				redirect('pengemasan');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Proses Pengemasan gagal di Update');
				redirect('pengemasan');
			}
		}

		$data = array(
			'pengemasan' => $this->pengemasan_model->get_by_uuid($uuid),
			'active_nav' => 'pengemasan');

		$this->load->view('partials/head', $data);
		$this->load->view('form/pengemasan/pengemasan-edit', $data);
		$this->load->view('partials/footer');
	}

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('pengemasan');
		}

		$deleted = $this->pengemasan_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('pengemasan');
	}
	
	public function verifikasi()
	{
		$data = array(
			'pengemasan' => $this->pengemasan_model->get_data_by_plant(),
			'active_nav' => 'verifikasi-pengemasan', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/pengemasan/pengemasan-verifikasi', $data);
		$this->load->view('partials/footer');
	}


	public function status($uuid)
	{
		$rules = $this->pengemasan_model->rules_verifikasi();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->pengemasan_model->verifikasi_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Proses Pengemasan berhasil di Update');
				redirect('pengemasan/verifikasi');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Proses Pengemasan gagal di Update');
				redirect('pengemasan/verifikasi');
			}
		}

		$data = array(
			'pengemasan' => $this->pengemasan_model->get_by_uuid($uuid),
			'active_nav' => 'verifikasi-pengemasan');

		$this->load->view('partials/head', $data);
		$this->load->view('form/pengemasan/pengemasan-status', $data);
		$this->load->view('partials/footer');
	}

	public function diketahui()
	{
		$data = array(
			'pengemasan' => $this->pengemasan_model->get_data_by_plant(),
			'active_nav' => 'diketahui-pengemasan', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/pengemasan/pengemasan-diketahui', $data);
		$this->load->view('partials/footer');
	}


	public function statusprod($uuid)
	{
		$rules = $this->pengemasan_model->rules_diketahui();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->pengemasan_model->diketahui_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Status Pemeriksaan Proses Pengemasan berhasil di Update');
				redirect('pengemasan/diketahui');
			}else {
				$this->session->set_flashdata('error_msg', 'Status Pemeriksaan Proses Pengemasan gagal di Update');
				redirect('pengemasan/diketahui');
			}
		}

		$data = array(
			'pengemasan' => $this->pengemasan_model->get_by_uuid($uuid),
			'active_nav' => 'diketahui-pengemasan');

		$this->load->view('partials/head', $data);
		$this->load->view('form/pengemasan/pengemasan-statusprod', $data);
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

		$pengemasan_data = $this->pengemasan_model->get_by_date($tanggal, $plant); 
		$pengemasan_data_verif = $this->pengemasan_model->get_last_verif_by_date($tanggal, $plant); 

		if (!$pengemasan_data || !$pengemasan_data_verif) {
			$this->session->set_flashdata('error_msg', 'Data tidak ditemukan untuk tanggal yang dipilih.');
			redirect('pengemasan/verifikasi'); 
		}

		$data['pengemasan'] = $pengemasan_data_verif;

		$this->load->model('pegawai_model');
		$data['pengemasan']->nama_lengkap_qc = $this->pegawai_model->get_nama_lengkap($data['pengemasan']->username);
		$data['pengemasan']->nama_lengkap_spv = $this->pegawai_model->get_nama_lengkap($data['pengemasan']->nama_spv);
		$data['pengemasan']->nama_lengkap_produksi =  $this->pegawai_model->get_nama_lengkap($data['pengemasan']->nama_produksi);

		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
		$pdf->setPrintHeader(false); 
		$pdf->SetMargins(17, 16, 15); 
		$pdf->AddPage('L', 'LEGAL');
		$pdf->SetFont('times', 'B', 13);

		$logo_path = FCPATH . 'assets/img/logo.jpg';
		if (file_exists($logo_path)) {
			$pdf->Image($logo_path, 17, 14, 38);
		} else {
			$pdf->Write(7, "Logo tidak ditemukan\n");
		}

		$pdf->Write(9, "\n");
		$pdf->MultiCell(0, 5, 'PEMERIKSAAN PROSES PENGEMASAN', 0, 'C');
		$pdf->Ln(5);

		setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
		$tanggal = $data['pengemasan']->date;
		$date = new DateTime($tanggal);
		$formatted_date = strftime('%A, %d %B %Y', $date->getTimestamp());

		$formatted_date2 = strftime('%d %B %Y', $date->getTimestamp());

		$pdf->SetFont('times', '', 10);
		$pdf->SetX(16);
		$pdf->Write(0, 'Hari / Tanggal : ' . $formatted_date);
		$pdf->SetX($pdf->GetX() + 20);
		$pdf->Write(0, 'Shift: ' . $data['pengemasan']->shift);
		$pdf->Ln(5);

		$pdf->SetFont('times', '', 10);

		$pdf->Cell(10, 14, 'Pukul', 1, 0, 'C');
		$pdf->Cell(30, 14, 'Nama Produk', 1, 0, 'C');
		$pdf->Cell(45, 14, 'Kode Produksi / Expired Date', 1, 0, 'C');
		$pdf->Cell(20, 14, 'Kondisi', 1, 0, 'C');
		$pdf->Cell(24, 14, 'Kondisi Seal', 1, 0, 'C');
		$pdf->Cell(25, 14, 'Berat Kotor per', 1, 0, 'C');
		$pdf->Cell(25, 14, 'Berat Kotor per', 1, 0, 'C');
		$pdf->Cell(25, 14, 'Berat Kotor per', 1, 0, 'C');
		$pdf->Cell(25, 14, 'Berat Kotor per', 1, 0, 'C');
		$pdf->Cell(25, 14, 'Berat Kotor per', 1, 0, 'C');
		$pdf->Cell(25, 14, 'Labelisasi', 1, 0, 'C');
		$pdf->Cell(25, 14, 'Kondisi Seal', 1, 0, 'C');
		$pdf->Cell(20, 14, 'Keterangan', 1, 0, 'C');

		$pdf->Cell(10, 6, '', 0, 1, 'C');

		$pdf->Cell(10, 8, '', 0, 0, 'C');
		$pdf->Cell(30, 8, '', 0, 0, 'C');
		$pdf->Cell(45, 8, '', 0, 0, 'C');
		$pdf->Cell(20, 8, 'Produk', 0, 0, 'C');
		$pdf->Cell(24, 8, 'Kemasan', 0, 0, 'C');
		$pdf->SetFont('times', '', 10);
		$pdf->Cell(25, 8, 'Pack (gram)', 0, 0, 'C');
		$pdf->Cell(25, 8, 'Renceng (gram)', 0, 0, 'C');
		$pdf->Cell(25, 8, 'Inner Box (gram)', 0, 0, 'C');
		$pdf->Cell(25, 8, 'Binded (gram)', 0, 0, 'C');
		$pdf->Cell(25, 8, 'Carton (gram)', 0, 0, 'C');
		$pdf->SetFont('times', '', 10);
		$pdf->Cell(25, 8, '(Karton Box)', 0, 0, 'C');
		$pdf->Cell(25, 8, '(Karton Box)', 0, 0, 'C');
		$pdf->Cell(20, 8, '', 0, 1, 'C');

		foreach ($pengemasan_data as $pengemasan) {
			$bb = $pengemasan->best_before;
			$best_before = new DateTime($bb);
			$formatted_bb = strftime('%d %b %Y', $best_before->getTimestamp());

			$pukul = $pengemasan->waktu;
			$pukul2 = new DateTime($pukul);
			$formatted_time =  $pukul2->format('H:i');

			$pdf->SetFont('times', '', 10);
			$pdf->Cell(10, 8, $formatted_time, 1, 0, 'C');
			$pdf->Cell(30, 8, $pengemasan->nama_produk, 1, 0, 'C');
			$pdf->Cell(45, 8, $pengemasan->kode_produksi. " / ". $formatted_bb, 1, 0, 'C');
			$pdf->Cell(20, 8, $pengemasan->kondisi_produk, 1, 0, 'C');
			$pdf->Cell(24, 8, $pengemasan->kondisi_seal, 1, 0, 'C');
			$pdf->Cell(25, 8, $pengemasan->berat_pack, 1, 0, 'C');
			$pdf->Cell(25, 8, $pengemasan->berat_renceng, 1, 0, 'C');
			$pdf->Cell(25, 8, $pengemasan->berat_inner, 1, 0, 'C');
			$pdf->Cell(25, 8, $pengemasan->berat_binded, 1, 0, 'C');
			$pdf->Cell(25, 8, $pengemasan->berat_carton, 1, 0, 'C');
			$pdf->Cell(25, 8, $pengemasan->labelisasi, 1, 0, 'C');
			$pdf->Cell(25, 8, $pengemasan->kondisi_karton, 1, 0, 'C');
			$pdf->Cell(20, 8, !empty($pengemasan->keterangan) ? $pengemasan->keterangan : '-', 1, 0, 'C');
			$pdf->Ln();
		}
		$y_after_keterangan = $pdf->GetY() + 2;
		$status_verifikasi = true;
		foreach ($pengemasan_data as $item) {
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
			$pdf->Cell(60, 5, $data['pengemasan']->nama_lengkap_qc, 0, 1, 'C');
			$pdf->SetFont('times', '', 8); 
			$pdf->Cell(105, 5, 'QC Inspector', 0, 0, 'C');

			$pdf->SetXY(90, $y_verifikasi + 5);
			$pdf->Cell(150, 5, 'Diketahui Oleh,', 0, 0, 'C');

			if ($data['pengemasan']->status_produksi == 1 && !empty($data['pengemasan']->nama_produksi)) {
				$update_tanggal_produksi = (new DateTime($data['pengemasan']->tgl_update_produksi))->format('d-m-Y | H:i');

				$pdf->SetFont('times', 'U', 8);
				$pdf->SetXY(90, $y_verifikasi + 10);
				$pdf->Cell(150, 5, $data['pengemasan']->nama_lengkap_produksi, 0, 0, 'C');

				$pdf->SetFont('times', '', 8);
				$pdf->SetXY(90, $y_verifikasi + 15);
				$pdf->Cell(150, 5, 'Foreman/Forelady Produksi', 0, 0, 'C');

			} else {
				$pdf->SetXY(90, $y_verifikasi + 10);
				$pdf->Cell(150, 5, 'Belum Diverifikasi', 0, 0, 'C');
			}

			$pdf->SetXY(250, $y_verifikasi + 5);
			$pdf->Cell(49, 5, 'Disetujui Oleh,', 0, 0, 'C');
			$update_tanggal = (new DateTime($data['pengemasan']->tgl_update_spv))->format('d-m-Y | H:i');
			$qr_text = "Diverifikasi secara digital oleh,\n" . $data['pengemasan']->nama_lengkap_spv . "\nSPV QC Bread Crumb\n" . $update_tanggal;
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
		$filename = "Pemeriksaan Proses Pengemasan_{$formatted_date2}.pdf";
		$pdf->Output($filename, 'I');

	}
}

