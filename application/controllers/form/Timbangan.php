<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Dompdf\Dompdf;

setlocale(LC_TIME, 'id_ID.UTF-8');

class Timbangan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model');
		$this->load->model('timbangan_model');
		if (!$this->auth_model->current_user()) {
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'timbangan' => $this->timbangan_model->get_data_by_plant(),
			'active_nav' => 'timbangan',
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/timbangan/timbangan', $data);
		$this->load->view('partials/footer');
	}

	public function detail($uuid)
	{
		$data = array(
			'timbangan' => $this->timbangan_model->get_by_uuid($uuid),
			'active_nav' => 'timbangan'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/timbangan/timbangan-detail', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{

		$rules = $this->timbangan_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->timbangan_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Timbangan berhasil di simpan');
				redirect('timbangan');
			} else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Timbangan gagal di simpan');
				redirect('timbangan');
			}
		}

		$data = array(
			'active_nav' => 'timbangan'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/timbangan/timbangan-tambah');
		$this->load->view('partials/footer');
	}


	public function edit($uuid)
	{
		$rules = $this->timbangan_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->timbangan_model->update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Timbangan berhasil di Update');
				redirect('timbangan');
			} else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Timbangan gagal di Update');
				redirect('timbangan');
			}
		}

		$data = array(
			'timbangan' => $this->timbangan_model->get_by_uuid($uuid),
			'active_nav' => 'timbangan'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/timbangan/timbangan-edit', $data);
		$this->load->view('partials/footer');
	}

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('timbangan');
		}

		$deleted = $this->timbangan_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('timbangan');
	}

	public function verifikasi()
	{
		$data = array(
			'timbangan' => $this->timbangan_model->get_data_by_plant(),
			'active_nav' => 'verifikasi-timbangan',
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/timbangan/timbangan-verifikasi', $data);
		$this->load->view('partials/footer');
	}


	public function status($uuid)
	{
		$rules = $this->timbangan_model->rules_verifikasi();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->timbangan_model->verifikasi_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Timbangan berhasil di Update');
				redirect('timbangan/verifikasi');
			} else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Timbangan gagal di Update');
				redirect('timbangan/verifikasi');
			}
		}

		$data = array(
			'timbangan' => $this->timbangan_model->get_by_uuid($uuid),
			'active_nav' => 'verifikasi-timbangan'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/timbangan/timbangan-status', $data);
		$this->load->view('partials/footer');
	}

	public function diketahui()
	{
		$data = array(
			'timbangan' => $this->timbangan_model->get_data_by_plant(),
			'active_nav' => 'diketahui-timbangan',
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/timbangan/timbangan-diketahui', $data);
		$this->load->view('partials/footer');
	}


	public function statusprod($uuid)
	{
		$rules = $this->timbangan_model->rules_diketahui();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->timbangan_model->diketahui_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Status Pemeriksaan Timbangan berhasil di Update');
				redirect('timbangan/diketahui');
			} else {
				$this->session->set_flashdata('error_msg', 'Status Pemeriksaan Timbangan gagal di Update');
				redirect('timbangan/diketahui');
			}
		}

		$data = array(
			'timbangan' => $this->timbangan_model->get_by_uuid($uuid),
			'active_nav' => 'diketahui-timbangan'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/timbangan/timbangan-statusprod', $data);
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

		$timbangan_data = $this->timbangan_model->get_by_date($tanggal, $plant);
		$timbangan_data_verif = $this->timbangan_model->get_last_verif_by_date($tanggal, $plant);

		if (!$timbangan_data || !$timbangan_data_verif) {
			$this->session->set_flashdata('error_msg', 'Data tidak ditemukan untuk tanggal yang dipilih.');
			redirect('timbangan/verifikasi');
		}

		$data['timbangan'] = $timbangan_data_verif;

		$this->load->model('pegawai_model');
		$data['timbangan']->nama_lengkap_qc = $this->pegawai_model->get_nama_lengkap($data['timbangan']->username);
		$data['timbangan']->nama_lengkap_spv = $this->pegawai_model->get_nama_lengkap($data['timbangan']->nama_spv);
		$data['timbangan']->nama_lengkap_produksi = $this->pegawai_model->get_nama_lengkap($data['timbangan']->nama_produksi);

		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->SetMargins(17, 16, 15);
		$pdf->AddPage('L', 'LEGAL');
		$pdf->SetFont('times', 'B', 15);

		$logo_path = FCPATH . 'assets/img/logo.jpg';
		if (file_exists($logo_path)) {
			$pdf->Image($logo_path, 17, 14, 45);
		} else {
			$pdf->Write(7, "Logo tidak ditemukan\n");
		}

		$pdf->Write(9, "\n");
		$pdf->MultiCell(0, 5, 'PEMERIKSAAN TIMBANGAN', 0, 'C');
		$pdf->Ln(5);

		setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
		$tanggal = $data['timbangan']->date;
		$date = new DateTime($tanggal);
		$formatted_date  = $date->format('l, d F Y');
		$formatted_date2 = $date->format('d F Y');

		$pdf->SetFont('times', '', 10);
		$pdf->SetX(16);
		$pdf->Write(0, 'Tanggal : ' . $formatted_date);
		$pdf->SetX($pdf->GetX() + 10);
		$pdf->Write(0, 'Shift : ' . $data['timbangan']->shift);
		$pdf->Ln(5);

		$pdf->SetFont('times', '', 11);

		$pdf->Cell(10, 15, 'No.', 1, 0, 'C');
		$pdf->Cell(60, 15, 'Jenis dan Kode Timbangan', 1, 0, 'C');
		$pdf->Cell(25, 15, 'Kapasitas (kg)', 1, 0, 'C');
		$pdf->Cell(25, 15, 'Lokasi', 1, 0, 'C');
		$pdf->Cell(25, 15, 'Standar', 1, 0, 'C');
		$pdf->Cell(140, 5, 'Hasil Pemeriksaan', 1, 0, 'C');
		$pdf->Cell(38, 15, 'Keterangan', 1, 0, 'C');
		$pdf->Cell(10, 5, '', 0, 1, 'C');

		$pdf->Cell(145, 15, '', 0, 0, 'C');
		$pdf->SetFont('times', '', 9);
		$pdf->Cell(20, 5, 'Check-1', 1, 0, 'C');
		$pdf->Cell(20, 5, 'Check-2', 1, 0, 'C');
		$pdf->Cell(20, 5, 'Check-3', 1, 0, 'C');
		$pdf->Cell(20, 5, 'Check-4', 1, 0, 'C');
		$pdf->Cell(20, 5, 'Check-5', 1, 0, 'C');
		$pdf->Cell(20, 5, 'Check-6', 1, 0, 'C');
		$pdf->Cell(20, 5, 'Check-7', 1, 0, 'C');
		$pdf->Cell(10, 5, '', 0, 1, 'C');

		$pdf->Cell(120, 15, '', 0, 0, 'C');
		$pdf->SetFont('times', '', 11);
		$pdf->Cell(25, 1, 'Berat (g)', 0, 0, 'C');
		$pdf->SetFont('times', '', 9);
		$pdf->Cell(10, 5, 'Pukul', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Hasil', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Pukul', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Hasil', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Pukul', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Hasil', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Pukul', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Hasil', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Pukul', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Hasil', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Pukul', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Hasil', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Pukul', 1, 0, 'C');
		$pdf->Cell(10, 5, 'Hasil', 1, 0, 'C');
		$pdf->Cell(38, 0, '', 0, 0, 'C');
		$pdf->Cell(10, 5, '', 0, 1, 'C');


		$no = 1;
		foreach ($timbangan_data as $timbangan) {
			$pdf->SetFont('times', '', 10);

			$pdf->Cell(10, 8, $no, 1, 0, 'C');
			$pdf->Cell(60, 8, $timbangan->model . " / " . $timbangan->kode_timbangan, 1, 0, 'C');
			$pdf->Cell(25, 8, $timbangan->kapasitas, 1, 0, 'C');
			$pdf->Cell(25, 8, $timbangan->lokasi, 1, 0, 'C');
			$pdf->Cell(25, 8, $timbangan->peneraan_standar, 1, 0, 'C');

			$hasil_array = json_decode($timbangan->peneraan_hasil, true);
			if (!is_array($hasil_array)) {
				$hasil_array = [];
			}
			for ($i = 0; $i < 7; $i++) {
				$pdf->SetFont('times', '', 8);
				$pukul = isset($hasil_array[$i]['pukul']) ? $hasil_array[$i]['pukul'] : '';
				$hasil = isset($hasil_array[$i]['hasil']) ? $hasil_array[$i]['hasil'] : '';

				$pdf->Cell(10, 8, $pukul, 1, 0, 'C');
				$pdf->Cell(10, 8, $hasil, 1, 0, 'C');
			}
			$pdf->Cell(38, 8, !empty($timbangan->keterangan) ? $timbangan->keterangan : '-', 1, 0, 'C');
			$pdf->Ln();
			$no++;
		}

		$pdf->SetFont('times', 'I', 7);
		$pdf->Cell(320, 5, 'QN 09/00', 0, 1, 'R');
		$pdf->SetY($pdf->GetY() + 2);
		$pdf->SetFont('times', '', 8);
		$pdf->Cell(5, 3, 'Catatan : ', 0, 1, 'L');
		foreach ($timbangan_data as $item) {
			if (!empty($item->catatan)) {
				$pdf->Cell(13, 0, '', 0, 0, 'L');
				$pdf->Cell(13, 0, ' - ' . $item->catatan, 0, 1, 'L');
			}
		}

		$y_after_keterangan = $pdf->GetY() + 2;
		$status_verifikasi = true;
		foreach ($timbangan_data as $item) {
			if ($item->status_spv != '1') {
				$status_verifikasi = false;
				break;
			}
		}

		$pdf->SetFont('times', '', 8);
		$pdf->SetTextColor(0, 0, 0);

		// if ($status_verifikasi) {
		// 	$y_verifikasi = $y_after_keterangan;

		// 	$pdf->SetXY(40, $y_verifikasi + 5);
		// 	$pdf->Cell(60, 5, 'Dibuat Oleh,', 0, 0, 'C');
		// 	$pdf->SetXY(40, $y_verifikasi + 10);
		// 	$pdf->SetFont('times', 'U', 8); // underline
		// 	$pdf->Cell(60, 5, $data['timbangan']->nama_lengkap_qc, 0, 1, 'C');
		// 	$pdf->SetFont('times', '', 8); 
		// 	$pdf->Cell(105, 5, 'QC Inspector', 0, 0, 'C');

		// 	$pdf->SetXY(90, $y_verifikasi + 5);
		// 	$pdf->Cell(150, 5, 'Diketahui Oleh,', 0, 0, 'C');

		// 	if ($data['timbangan']->status_produksi == 1 && !empty($data['timbangan']->nama_produksi)) {
		// 		$update_tanggal_produksi = (new DateTime($data['timbangan']->tgl_update_produksi))->format('d-m-Y | H:i');

		// 		$pdf->SetFont('times', 'U', 8);
		// 		$pdf->SetXY(90, $y_verifikasi + 10);
		// 		$pdf->Cell(150, 5, $data['timbangan']->nama_lengkap_produksi, 0, 0, 'C');

		// 		$pdf->SetFont('times', '', 8);
		// 		$pdf->SetXY(90, $y_verifikasi + 15);
		// 		$pdf->Cell(150, 5, 'Foreman/Forelady Produksi', 0, 0, 'C');

		// 	} else {
		// 		$pdf->SetXY(90, $y_verifikasi + 10);
		// 		$pdf->Cell(150, 5, 'Belum Diverifikasi', 0, 0, 'C');
		// 	}

		// 	$pdf->SetXY(250, $y_verifikasi + 5);
		// 	$pdf->Cell(49, 5, 'Disetujui Oleh,', 0, 0, 'C');
		// 	$update_tanggal = (new DateTime($data['timbangan']->tgl_update_spv))->format('d-m-Y | H:i');
		// 	$qr_text = "Diverifikasi secara digital oleh,\n" . $data['timbangan']->nama_lengkap_spv . "\nSPV QC Bread Crumb\n" . $update_tanggal;
		// 	$pdf->write2DBarcode($qr_text, 'QRCODE,L', 267, $y_verifikasi + 10, 15, 15, null, 'N');
		// 	$pdf->SetXY(250, $y_verifikasi + 24);
		// 	$pdf->Cell(49, 5, 'Supervisor QC', 0, 0, 'C');
		// } else {
		// 	$pdf->SetTextColor(255, 0, 0); 
		// 	$pdf->SetFont('times', '', 8);
		// 	$pdf->SetXY(100, $y_after_keterangan);
		// 	$pdf->Cell(250, 5, 'Data Belum Diverifikasi', 0, 0, 'C');
		// }

		$y_ttd   = $pdf->GetY() + 6;
		$qr_size = 15;

		$qc_usernames  = [];
		$qc_created_at = null;

		foreach ($timbangan_data as $item) {
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

		if (!empty($data['timbangan']->nama_lengkap_produksi) && !empty($data['timbangan']->tgl_update_produksi)) {
			$prod_tanggal = (new DateTime($data['timbangan']->tgl_update_produksi ?? $data['timbangan']->tgl_update_produksi))
				->format('d-m-Y | H:i');

			$qr_produksi_text = "Diketahui secara digital oleh,\n"
				. $data['timbangan']->nama_lengkap_produksi . "\n"
				. "Foreman/Forelady Produksi\n"
				. $prod_tanggal;
		}

		$spv_tanggal = !empty($data['timbangan']->tgl_update_spv)
			? (new DateTime($data['timbangan']->tgl_update_spv))->format('d-m-Y | H:i')
			: '-';

		$qr_spv_text = "Disetujui secara digital oleh,\n"
			. $data['timbangan']->nama_lengkap_spv . "\n"
			. "Supervisor QC Bread Crumb\n"
			. $spv_tanggal;

		if ($status_verifikasi) {
			$pdf->SetFont('times', '', 8);
			$pdf->SetXY(20, $y_ttd);
			$pdf->Cell(45, 5, 'Dibuat Oleh,', 0, 0, 'C');
			$pdf->SetXY(85, $y_ttd);
			$pdf->Cell(130, 5, 'Diketahui Oleh,', 0, 0, 'C');
			$pdf->SetXY(150, $y_ttd);
			$pdf->Cell(220, 5, 'Disetujui Oleh,', 0, 1, 'C');
			$pdf->write2DBarcode($qr_qc_text, 'QRCODE,L', 35, $y_ttd + 5, $qr_size, $qr_size, null, 'N');
			if ($qr_produksi_text) {
				$pdf->write2DBarcode($qr_produksi_text, 'QRCODE,L', 143, $y_ttd + 5, $qr_size, $qr_size, null, 'N');
			}
			$pdf->write2DBarcode($qr_spv_text, 'QRCODE,L', 253, $y_ttd + 5, $qr_size, $qr_size, null, 'N');
			$pdf->SetXY(20, $y_ttd + 20);
			$pdf->Cell(45, 5, 'QC Inspector', 0, 0, 'C');
			$pdf->SetXY(85, $y_ttd + 20);
			$pdf->Cell(130, 5, 'Foreman/Forelady Produksi', 0, 0, 'C');
			$pdf->SetXY(150, $y_ttd + 20);
			$pdf->Cell(220, 5, 'Supervisor QC', 0, 1, 'C');
		} else {
			$pdf->SetFont('times', '', 8);
			$pdf->SetTextColor(255, 0, 0);
			$pdf->SetXY(80, $y_ttd);
			$pdf->Cell(80, 6, 'Data Belum Diverifikasi', 0, 1, 'C');
			$pdf->SetTextColor(0, 0, 0);
		}


		$pdf->setPrintFooter(false);
		$filename = "Pemeriksaan Timbangan_{$formatted_date2}.pdf";
		$pdf->Output($filename, 'I');
	}
}
