<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Dompdf\Dompdf;
setlocale(LC_TIME, 'id_ID.UTF-8');

class Kekuatanmagnet extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model'); 
		$this->load->model('kekuatanmagnet_model');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'kekuatanmagnet' => $this->kekuatanmagnet_model->get_data_by_plant(),
			'active_nav' => 'kekuatanmagnet', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/kekuatanmagnet/kekuatanmagnet', $data);
		$this->load->view('partials/footer');
	}

	public function detail($uuid)
	{
		$data = array(
			'kekuatanmagnet' => $this->kekuatanmagnet_model->get_by_uuid($uuid),
			'active_nav' => 'kekuatanmagnet');

		$this->load->view('partials/head', $data);
		$this->load->view('form/kekuatanmagnet/kekuatanmagnet-detail', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{

		$rules = $this->kekuatanmagnet_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->kekuatanmagnet_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Kekuatan Magnet Trap berhasil di simpan');
				redirect('kekuatanmagnet');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Kekuatan Magnet Trap gagal di simpan');
				redirect('kekuatanmagnet');
			}
		}

		$data = array(
			'active_nav' => 'kekuatanmagnet');

		$this->load->view('partials/head', $data);
		$this->load->view('form/kekuatanmagnet/kekuatanmagnet-tambah');
		$this->load->view('partials/footer');
	}


	public function edit($uuid)
	{
		$rules = $this->kekuatanmagnet_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->kekuatanmagnet_model->update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Kekuatan Magnet Trap berhasil di Update');
				redirect('kekuatanmagnet');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Kekuatan Magnet Trap gagal di Update');
				redirect('kekuatanmagnet');
			}
		}

		$data = array(
			'kekuatanmagnet' => $this->kekuatanmagnet_model->get_by_uuid($uuid),
			'active_nav' => 'kekuatanmagnet');

		$this->load->view('partials/head', $data);
		$this->load->view('form/kekuatanmagnet/kekuatanmagnet-edit', $data);
		$this->load->view('partials/footer');
	}
	
	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('kekuatanmagnet');
		}

		$deleted = $this->kekuatanmagnet_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('kekuatanmagnet');
	}

	public function verifikasi()
	{
		$data = array(
			'kekuatanmagnet' => $this->kekuatanmagnet_model->get_data_by_plant(),
			'active_nav' => 'verifikasi-kekuatanmagnet', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/kekuatanmagnet/kekuatanmagnet-verifikasi', $data);
		$this->load->view('partials/footer');
	}


	public function status($uuid)
	{
		$rules = $this->kekuatanmagnet_model->rules_verifikasi();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->kekuatanmagnet_model->verifikasi_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Kekuatan Magnet Trap berhasil di Update');
				redirect('kekuatanmagnet/verifikasi');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Kekuatan Magnet Trap gagal di Update');
				redirect('kekuatanmagnet/verifikasi');
			}
		}

		$data = array(
			'kekuatanmagnet' => $this->kekuatanmagnet_model->get_by_uuid($uuid),
			'active_nav' => 'verifikasi-kekuatanmagnet');

		$this->load->view('partials/head', $data);
		$this->load->view('form/kekuatanmagnet/kekuatanmagnet-status', $data);
		$this->load->view('partials/footer');
	}

	public function diketahui()
	{
		$data = array(
			'kekuatanmagnet' => $this->kekuatanmagnet_model->get_data_by_plant(),
			'active_nav' => 'diketahui-kekuatanmagnet', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/kekuatanmagnet/kekuatanmagnet-diketahui', $data);
		$this->load->view('partials/footer');
	}


	public function statusprod($uuid)
	{
		$rules = $this->kekuatanmagnet_model->rules_diketahui();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->kekuatanmagnet_model->diketahui_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Status Pemeriksaan Kekuatan Magnet Trap berhasil di Update');
				redirect('kekuatanmagnet/diketahui');
			}else {
				$this->session->set_flashdata('error_msg', 'Status Pemeriksaan Kekuatan Magnet Trap gagal di Update');
				redirect('kekuatanmagnet/diketahui');
			}
		}

		$data = array(
			'kekuatanmagnet' => $this->kekuatanmagnet_model->get_by_uuid($uuid),
			'active_nav' => 'diketahui-kekuatanmagnet');

		$this->load->view('partials/head', $data);
		$this->load->view('form/kekuatanmagnet/kekuatanmagnet-statusprod', $data);
		$this->load->view('partials/footer');
	}

	public function cetak()
	{
		$bulan = $this->input->get('bulan');
		log_message('debug', 'Bulan yang dipilih: ' . print_r($bulan, true));

		if (empty($bulan)) {
			show_error('Tidak ada bulan yang dipilih', 404);
		}

		$plant = $this->session->userdata('plant');

    $bulanNum = date('m', strtotime($bulan)); // e.g., 07
    $tahunNum = date('Y', strtotime($bulan)); // e.g., 2025

    // Ambil semua data selama bulan
    $kekuatanmagnet_data = $this->kekuatanmagnet_model->get_by_bulan($bulanNum, $tahunNum, $plant);

    // Ambil data verifikasi terakhir
    $kekuatanmagnet_data_verif = $this->kekuatanmagnet_model->get_last_verif_by_bulan($bulanNum, $tahunNum, $plant);

    if (!$kekuatanmagnet_data || !$kekuatanmagnet_data_verif) {
    	$this->session->set_flashdata('error_msg', 'Data tidak ditemukan untuk bulan yang dipilih.');
    	redirect('kekuatanmagnet/verifikasi');
    }

    $data['kekuatanmagnet'] = $kekuatanmagnet_data_verif;

    $this->load->model('pegawai_model');
    $data['kekuatanmagnet']->nama_lengkap_qc = $this->pegawai_model->get_nama_lengkap($data['kekuatanmagnet']->username);
    $data['kekuatanmagnet']->nama_lengkap_spv = $this->pegawai_model->get_nama_lengkap($data['kekuatanmagnet']->nama_spv);
    $data['kekuatanmagnet']->nama_lengkap_produksi = $data['kekuatanmagnet']->nama_produksi;

    require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
    $pdf->setPrintHeader(false); 
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();
    $pdf->SetFont('times', 'B', 11);

    $logo_path = FCPATH . 'assets/img/logo.jpg';
    if (file_exists($logo_path)) {
    	$pdf->Image($logo_path, 10, 10, 35);
    } else {
    	$pdf->Write(7, "Logo tidak ditemukan\n");
    }

    $pdf->Write(8, "\n");
    $pdf->MultiCell(0, 5, 'PEMERIKSAAN KEKUATAN MAGNET TRAP', 0, 'C');
    $pdf->Ln(4);

    $pdf->SetFont('times', '', 9);

    $pdf->Cell(30, 12, 'Hari/Tanggal', 1, 0, 'C');
    $pdf->Cell(51, 12, 'Nama Alat', 1, 0, 'C');
    $pdf->Cell(35, 12, 'Nilai Pengukuran (Gauss)', 1, 0, 'C');
    $pdf->Cell(40, 12, 'Keterangan', 1, 0, 'C');
    $pdf->Cell(38, 6, 'Paraf', 1, 1, 'C');

    $pdf->Cell(156, 12, '', 0, 0, 'L');
    $pdf->Cell(19, 6, 'QC', 1, 0, 'C');
    $pdf->Cell(19, 6, 'Prod', 1, 1, 'C');

    foreach ($kekuatanmagnet_data as $kekuatanmagnet) {
    	setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
    	$tanggal = $kekuatanmagnet->date;
    	$date = new DateTime($tanggal);
    	$formatted_date = strftime('%A, %d %B %Y', $date->getTimestamp());
    	$pdf->SetFont('times', '', 8);
    	$pdf->Cell(30, 6, $formatted_date, 1, 0, 'C');
    	$pdf->Cell(51, 6, $kekuatanmagnet->nama_alat, 1, 0, 'C');
    	$pdf->Cell(35, 6, $kekuatanmagnet->nilai, 1, 0, 'C');
    	$pdf->Cell(40, 6, !empty($kekuatanmagnet->keterangan) ? $kekuatanmagnet->keterangan : '-', 1, 0, 'C');
    	$pdf->Cell(19, 6, $kekuatanmagnet->username, 1, 0, 'C');
    	$pdf->Cell(19, 6, $kekuatanmagnet->nama_produksi, 1, 0, 'C');
    	$pdf->Ln();
    }
    
    $pdf->SetY($pdf->GetY() + 2); 
    $pdf->SetFont('times', '', 8);
    $pdf->Cell(5, 3, 'Catatan : ', 0, 1, 'L');
    foreach ($kekuatanmagnet_data as $item) {
    	if (!empty($item->catatan)) {
    		$pdf->Cell(13, 0, '', 0, 0, 'L'); 
    		$pdf->Cell(13, 0, ' - ' . $item->catatan, 0, 1, 'L');
    	}
    }

    $y_after_keterangan = $pdf->GetY() + 2;
    $status_verifikasi = true;
    foreach ($kekuatanmagnet_data as $item) {
    	if ($item->status_spv != '1') {
    		$status_verifikasi = false;
    		break;
    	}
    }

    $pdf->SetFont('times', '', 8);
    $pdf->SetTextColor(0, 0, 0);

    if ($status_verifikasi) {
    	$y_verifikasi = $y_after_keterangan;
    	$pdf->SetXY(150, $y_verifikasi + 5);
    	$pdf->Cell(49, 5, 'Disetujui Oleh,', 0, 0, 'C');
    	$update_tanggal = (new DateTime($data['kekuatanmagnet']->tgl_update_spv))->format('d-m-Y | H:i');
    	$qr_text = "Diverifikasi secara digital oleh,\n" . $data['kekuatanmagnet']->nama_lengkap_spv . "\nSPV QC Bread Crumb\n" . $update_tanggal;
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

    $currentDate = date('d-m-Y', strtotime($tanggal));
    $filename = "Pemeriksaan Magnet Trap_{$currentDate}.pdf";
    $pdf->Output($filename, 'I');
}
}

