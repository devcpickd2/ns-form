<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . '../vendor/autoload.php');
// require_once(APPPATH . 'libraries/phpqrcode.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


use Dompdf\Dompdf;

setlocale(LC_TIME, 'id_ID.UTF-8');

class Suhu extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model');
		$this->load->model('suhu_model');
		$this->load->model('pegawai_model');
		$this->load->helper(['url', 'form']);
		$this->load->library(['session']);
		if (!$this->auth_model->current_user()) {
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'suhu' => $this->suhu_model->get_suhu_by_plant(),
			'active_nav' => 'suhu',
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/suhu/suhu', $data);
		$this->load->view('partials/footer');
	}

	public function detail($uuid)
	{
		$data = array(
			'suhu' => $this->suhu_model->get_by_uuid($uuid),
			'active_nav' => 'suhu'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/suhu/suhu-detail', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{

		$rules = $this->suhu_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->suhu_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Suhu Ruang berhasil di simpan');
				redirect('suhu');
			} else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Suhu Ruang gagal di simpan');
				redirect('suhu');
			}
		}

		$data = array(
			'active_nav' => 'suhu'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/suhu/suhu-tambah');
		$this->load->view('partials/footer');
	}


	public function edit($uuid)
	{
		$rules = $this->suhu_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->suhu_model->update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Suhu Ruang berhasil di Update');
				redirect('suhu');
			} else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Suhu Ruang gagal di Update');
				redirect('suhu');
			}
		}

		$data = array(
			'suhu' => $this->suhu_model->get_by_uuid($uuid),
			'active_nav' => 'suhu'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/suhu/suhu-edit', $data);
		$this->load->view('partials/footer');
	}

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('suhu');
		}

		$deleted = $this->suhu_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('suhu');
	}

	public function verifikasi()
	{
		$data = array(
			'suhu' => $this->suhu_model->get_suhu_by_plant(),
			'active_nav' => 'verifikasi-suhu',
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/suhu/suhu-verifikasi', $data);
		$this->load->view('partials/footer');
	}


	public function status($uuid)
	{
		$rules = $this->suhu_model->rules_verifikasi();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->suhu_model->verifikasi_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Suhu Ruang berhasil di Update');
				redirect('suhu/verifikasi');
			} else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Suhu Ruang gagal di Update');
				redirect('suhu/verifikasi');
			}
		}

		$data = array(
			'suhu' => $this->suhu_model->get_by_uuid($uuid),
			'active_nav' => 'verifikasi-suhu'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/suhu/suhu-status', $data);
		$this->load->view('partials/footer');
	}

	public function diketahui()
	{
		$data = array(
			'suhu' => $this->suhu_model->get_suhu_by_plant(),
			'active_nav' => 'diketahui-suhu',
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/suhu/suhu-diketahui', $data);
		$this->load->view('partials/footer');
	}


	public function statusprod($uuid)
	{
		$rules = $this->suhu_model->rules_diketahui();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->suhu_model->diketahui_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Status Pemeriksaan Suhu Ruang berhasil di Update');
				redirect('suhu/diketahui');
			} else {
				$this->session->set_flashdata('error_msg', 'Status Pemeriksaan Suhu Ruang gagal di Update');
				redirect('suhu/diketahui');
			}
		}

		$data = array(
			'suhu' => $this->suhu_model->get_by_uuid($uuid),
			'active_nav' => 'diketahui-suhu'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/suhu/suhu-statusprod', $data);
		$this->load->view('partials/footer');
	}

	public function cetak()
	{
		$tanggal = $this->input->post('tanggal');
		if (empty($tanggal)) {
			show_error('Tanggal tidak boleh kosong', 404);
		}

		$this->load->model('suhu_model');
		$this->load->model('pegawai_model');

		$suhu_data = $this->suhu_model->get_by_date($tanggal);
		$suhu_data_verif = $this->suhu_model->get_by_date_verif($tanggal);
		$data['suhu'] = $suhu_data_verif;

		if (!$suhu_data || !$suhu_data_verif) {
			$this->session->set_flashdata('error_msg', 'Data tidak ditemukan untuk tanggal yang dipilih.');
			redirect('suhu/verifikasi');
		}

		$data['suhu']->nama_lengkap_qc = $this->pegawai_model->get_nama_lengkap($data['suhu']->username);
		$data['suhu']->nama_lengkap_spv = $this->pegawai_model->get_nama_lengkap($data['suhu']->nama_spv);
		$data['suhu']->nama_lengkap_produksi = $this->pegawai_model->get_nama_lengkap($data['suhu']->nama_produksi);

		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->SetMargins(10, 14, 10);
		$pdf->AddPage();
		$pdf->SetFont('times', 'B', 11);

		$logo_path = FCPATH . 'assets/img/logo.jpg';
		if (file_exists($logo_path)) {
			$pdf->Image($logo_path, 10, 10, 38);
		} else {
			$pdf->Write(7, "Logo tidak ditemukan\n");
		}
		setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
		$pdf->Write(7, "\n");
		$pdf->MultiCell(0, 5, 'PEMERIKSAAN SUHU RUANG DAN KELEMBABAN RUANG', 0, 'C');
		$pdf->Ln(4);

		$tanggal = $data['suhu']->date;
		$datetime = new DateTime($tanggal);
		$formatted_date  = $date->format('l, d F Y');
		$formatted_date2 = $date->format('d F Y');

		$pdf->SetFont('times', '', 9);
		$pdf->SetX(10);
		$pdf->Write(0, 'Hari / Tanggal: ' . $formatted_date);
		$pdf->SetX($pdf->GetX() + 20);
		$pdf->Write(0, 'Shift: ' . $data['suhu']->shift);
		$pdf->Ln(5);

		$lokasi_unik = [];
		foreach ($suhu_data as $item) {
			$lokasi_arr = json_decode($item->lokasi, true);
			if (is_array($lokasi_arr)) {
				foreach ($lokasi_arr as $lok) {
					$lokasi_unik[] = $lok['nama'];
				}
			}
		}
		$lokasi_unik = array_unique($lokasi_unik);

		$standar_per_lokasi = [
			'Ruang Produksi' => ['suhu' => '20-30', 'rh' => '40-70'],
			'Gudang Finish Good' => ['suhu' => '28-36', 'rh' => '40-80'],
		];

		$col_suhu = 21;
		$col_ket = 65;
		$col_paraf = 15;
		$col_pukul = 15;

		$pdf->SetFont('times', '', 10);
		$baris_tinggi = 5;

		$pdf->Cell($col_pukul, $baris_tinggi * 2, 'Pukul', 1, 0, 'C');
		foreach ($lokasi_unik as $lokasi) {
			$pdf->Cell($col_suhu * 2, $baris_tinggi, $lokasi, 1, 0, 'C');
		}
		$pdf->Cell($col_ket, $baris_tinggi * 3, 'Keterangan', 1, 0, 'C');
		$pdf->Cell($col_paraf * 2, $baris_tinggi, 'PARAF', 1, 0, 'C');
		$pdf->Ln();

		$pdf->Cell($col_pukul, $baris_tinggi, '', 0, 0);
		foreach ($lokasi_unik as $lokasi) {
			$pdf->Cell($col_suhu, $baris_tinggi, 'Suhu °C', 1, 0, 'C');
			$pdf->Cell($col_suhu, $baris_tinggi, 'RH %', 1, 0, 'C');
		}
		$pdf->Cell($col_ket, $baris_tinggi, '', 0, 0);
		$pdf->Cell($col_paraf, $baris_tinggi * 2, 'QC', 1, 0, 'C');
		$pdf->Cell($col_paraf, $baris_tinggi * 2, 'PROD.', 1, 0, 'C');
		$pdf->Cell($col_paraf, $baris_tinggi, '', 0, 1, 'C');

		$pdf->Cell($col_pukul, $baris_tinggi, 'STD', 1, 0, 'C');
		foreach ($lokasi_unik as $lokasi) {
			$suhu_std = isset($standar_per_lokasi[$lokasi]) ? $standar_per_lokasi[$lokasi]['suhu'] : '-';
			$rh_std   = isset($standar_per_lokasi[$lokasi]) ? $standar_per_lokasi[$lokasi]['rh']   : '-';

			$pdf->Cell($col_suhu, $baris_tinggi, $suhu_std, 1, 0, 'C');
			$pdf->Cell($col_suhu, $baris_tinggi, $rh_std, 1, 0, 'C');
		}
		$pdf->Cell($col_ket, $baris_tinggi, '', 0, 0);
		$pdf->Cell($col_paraf, $baris_tinggi, '', 0, 0);
		$pdf->Cell($col_paraf, $baris_tinggi, '', 0, 1);

		$grouped = [];
		foreach ($suhu_data as $item) {
			$jam = (new DateTime($item->pukul))->format('H:i');
			$lokasi_arr = json_decode($item->lokasi, true);

			if (!is_array($lokasi_arr)) continue;

			foreach ($lokasi_arr as $lok) {
				$nama = $lok['nama'];
				$grouped[$jam][$nama] = [
					'suhu' => $lok['suhu'],
					'rh'   => $lok['rh'],
					'keterangan' => $item->keterangan ?? '',
				];
			}
		}

		foreach ($grouped as $jam => $lokasi_data) {
			$pdf->Cell($col_pukul, $baris_tinggi, $jam, 1, 0, 'C');

			foreach ($lokasi_unik as $lokasi) {
				$suhu = isset($lokasi_data[$lokasi]['suhu']) ? $lokasi_data[$lokasi]['suhu'] : '-';
				$rh   = isset($lokasi_data[$lokasi]['rh']) ? $lokasi_data[$lokasi]['rh'] : '-';
				$pdf->Cell($col_suhu, $baris_tinggi, $suhu, 1, 0, 'C');
				$pdf->Cell($col_suhu, $baris_tinggi, $rh, 1, 0, 'C');
			}

			$keterangan_parts = [];
			foreach ($lokasi_unik as $lokasi) {
				if (!empty($lokasi_data[$lokasi]['keterangan'])) {
					$keterangan_parts[] = $lokasi_data[$lokasi]['keterangan'];
				}
			}
			$keterangan = !empty($keterangan_parts) ? implode(', ', array_unique($keterangan_parts)) : '-';
			$pdf->Cell($col_ket, $baris_tinggi, $keterangan, 1, 0, 'L');

			$username = '-';
			$nama_produksi = '-';
			foreach ($suhu_data as $item) {
				$item_jam = date('H:i', strtotime($item->pukul));
				if ($item_jam == $jam) {
					$username = !empty($item->username) ? $item->username : '-';
					$nama_produksi = !empty($item->nama_produksi) ? $item->nama_produksi : '-';
					break;
				}
			}

			$pdf->Cell($col_paraf, $baris_tinggi, $username, 1, 0, 'C');
			$pdf->Cell($col_paraf, $baris_tinggi, $nama_produksi, 1, 0, 'C');
			$pdf->Ln();
		}

		$pdf->SetFont('times', 'I', 7);
		$pdf->Cell(190, 5, 'QN 11/00', 0, 1, 'R');
		$pdf->SetY($pdf->GetY() + 2);
		$pdf->SetFont('times', '', 8);
		$pdf->Cell(5, 3, 'Catatan : ', 0, 1, 'L');
		foreach ($suhu_data as $item) {
			if (!empty($item->catatan)) {
				$pdf->Cell(13, 0, '', 0, 0, 'L');
				$pdf->Cell(13, 0, ' - ' . $item->catatan, 0, 1, 'L');
			}
		}

		$y_after_keterangan = $pdf->GetY() + 2;
		$status_verifikasi = true;
		foreach ($suhu_data as $item) {
			if ($item->status_spv != '1') {
				$status_verifikasi = false;
				break;
			}
		}

		$pdf->SetFont('times', '', 8);
		$pdf->SetTextColor(0, 0, 0);

		$y_ttd   = $pdf->GetY() + 6;
		$qr_size = 15;

		$qc_usernames  = [];
		$qc_created_at = null;

		foreach ($suhu_data as $item) {
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

		if (!empty($data['suhu']->nama_lengkap_produksi) && !empty($data['suhu']->tgl_update_produksi)) {
			$prod_tanggal = (new DateTime($data['suhu']->tgl_update_produksi ?? $data['suhu']->tgl_update_produksi))
				->format('d-m-Y | H:i');

			$qr_produksi_text = "Diketahui secara digital oleh,\n"
				. $data['suhu']->nama_lengkap_produksi . "\n"
				. "Foreman/Forelady Produksi\n"
				. $prod_tanggal;
		}

		$spv_tanggal = !empty($data['suhu']->tgl_update_spv)
			? (new DateTime($data['suhu']->tgl_update_spv))->format('d-m-Y | H:i')
			: '-';

		$qr_spv_text = "Disetujui secara digital oleh,\n"
			. $data['suhu']->nama_lengkap_spv . "\n"
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
			$pdf->write2DBarcode($qr_qc_text, 'QRCODE,L', 35, $y_ttd + 5, $qr_size, $qr_size, null, 'N');
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
		$filename = "Suhu Ruang_{$formatted_date2}.pdf";
		$pdf->Output($filename, 'I');
	}

	public function export_excel()
	{
		require_once(APPPATH . 'libraries/phpqrcode.php');
		$tanggal = $this->input->post('tanggal') ?: $this->input->get('tanggal');
		if (!$tanggal) {
			show_error('Tanggal tidak boleh kosong');
		}

		$this->load->model('suhu_model');
		$this->load->model('pegawai_model');

		$suhu_data = $this->suhu_model->get_by_date($tanggal);
		if (!$suhu_data) {
			show_error('Data tidak ditemukan');
		}

		$data['suhu'] = $suhu_data[0];
		$data['suhu']->nama_lengkap_qc = $this->pegawai_model->get_nama_lengkap($data['suhu']->username ?? '');
		$data['suhu']->nama_lengkap_produksi = $this->pegawai_model->get_nama_lengkap($data['suhu']->nama_produksi ?? '');
		$data['suhu']->nama_lengkap_spv = $this->pegawai_model->get_nama_lengkap($data['suhu']->nama_spv ?? '');

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// Logo
		$logo_path = FCPATH . 'assets/img/logo.jpg';
		if (file_exists($logo_path)) {
			$logo = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
			$logo->setName('Logo');
			$logo->setDescription('Logo');
			$logo->setPath($logo_path);
			$logo->setCoordinates('A1');
			$logo->setHeight(20);
			$logo->setOffsetX(5);
			$logo->setOffsetY(5);
			$logo->setWorksheet($sheet);
		}

		// Ambil tanggal
		$tanggal = $this->input->post('tanggal') ?: $this->input->get('tanggal');

		// Konversi hari ke Bahasa Indonesia
		$nama_hari = [
			'Sunday' => 'Minggu',
			'Monday' => 'Senin',
			'Tuesday' => 'Selasa',
			'Wednesday' => 'Rabu',
			'Thursday' => 'Kamis',
			'Friday' => 'Jumat',
			'Saturday' => 'Sabtu'
		];

		$hariInggris = date('l', strtotime($tanggal));
		$hariIndonesia = $nama_hari[$hariInggris] ?? $hariInggris;

		// Judul
		$sheet->mergeCells('C1:I1');
		$sheet->setCellValue('C1', 'PEMERIKSAAN SUHU RUANG DAN KELEMBABAN RUANG');
		$sheet->getStyle('C1')->getFont()->setBold(true)->setSize(14);
		$sheet->getStyle('C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$sheet->setCellValue('A3', 'Hari/Tanggal : ' . $hariIndonesia . ', ' . date('d-m-Y', strtotime($tanggal)));
		$sheet->mergeCells('A3:E3');
		$sheet->setCellValue('F3', 'Shift : ' . $data['suhu']->shift);
		$sheet->mergeCells('F3:G3');

		// Header tabel
		$sheet->mergeCells('A4:A5')->setCellValue('A4', 'Pukul');
		$sheet->mergeCells('B4:C4')->setCellValue('B4', 'Ruang Produksi');
		$sheet->mergeCells('D4:E4')->setCellValue('D4', 'Gudang Finish Good');
		$sheet->mergeCells('F4:I6')->setCellValue('F4', 'Keterangan');
		$sheet->mergeCells('J4:K5')->setCellValue('J4', 'PARAF');
		$sheet->setCellValue('B5', 'Suhu °C');
		$sheet->setCellValue('C5', 'RH %');
		$sheet->setCellValue('D5', 'Suhu °C');
		$sheet->setCellValue('E5', 'RH %');
		$sheet->setCellValue('J6', 'QC');
		$sheet->setCellValue('K6', 'PROD.');

		// Baris STD
		$row = 6;
		$sheet->setCellValue("A{$row}", 'STD');
		$sheet->setCellValue("B{$row}", '20-30');
		$sheet->setCellValue("C{$row}", '40-70');
		$sheet->setCellValue("D{$row}", '28-36');
		$sheet->setCellValue("E{$row}", '40-80');

		$grouped = [];
		foreach ($suhu_data as $item) {
			$jam = date('H:i', strtotime($item->pukul));
			if (!isset($grouped[$jam])) {
				$grouped[$jam] = [];
			}
			$grouped[$jam][] = $item;
		}

		foreach ($grouped as $jam => $items) {
			$row++;

			$suhu_rp = null;
			$suhu_fg = null;

			foreach ($items as $item) {
				$lokasi_arr = json_decode($item->lokasi, true);
				if (!is_array($lokasi_arr)) continue;

				foreach ($lokasi_arr as $lok) {
					$nama_lokasi = strtolower($lok['nama'] ?? '');

					if (!$suhu_rp && preg_match('/produksi/', $nama_lokasi)) {
						$suhu_rp = (object)[
							'suhu' => $lok['suhu'] ?? '',
							'rh'   => $lok['rh'] ?? '',
							'keterangan' => $item->keterangan ?? '',
							'username' => $item->username ?? '',
							'nama_produksi' => $item->nama_produksi ?? ''
						];
					}

					if (!$suhu_fg && preg_match('/(finish|fg|gudang)/', $nama_lokasi)) {
						$suhu_fg = (object)[
							'suhu' => $lok['suhu'] ?? '',
							'rh'   => $lok['rh'] ?? '',
							'keterangan' => $item->keterangan ?? '',
							'username' => $item->username ?? '',
							'nama_produksi' => $item->nama_produksi ?? ''
						];
					}
				}
			}

			$sheet->setCellValue("A{$row}", $jam);
			$sheet->setCellValue("B{$row}", $suhu_rp->suhu ?? '');
			$sheet->setCellValue("C{$row}", $suhu_rp->rh ?? '');
			$sheet->setCellValue("D{$row}", $suhu_fg->suhu ?? '');
			$sheet->setCellValue("E{$row}", $suhu_fg->rh ?? '');

			// Gabungkan keterangan
			$keterangan_rp = ($suhu_rp && !empty($suhu_rp->keterangan)) ? "Produksi: {$suhu_rp->keterangan}" : '';
			$keterangan_fg = ($suhu_fg && !empty($suhu_fg->keterangan)) ? "FG: {$suhu_fg->keterangan}" : '';
			$keterangan_full = trim($keterangan_rp . ($keterangan_rp && $keterangan_fg ? "\n" : '') . $keterangan_fg);

			$sheet->mergeCells("F{$row}:I{$row}");
			$sheet->setCellValue("F{$row}", $keterangan_full);
			$sheet->getStyle("F{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
			$sheet->getStyle("F{$row}")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
			$sheet->getStyle("F{$row}")->getAlignment()->setWrapText(true);

			$lineCount = substr_count($keterangan_full, "\n") + 1;
			$defaultHeight = 15;
			$sheet->getRowDimension($row)->setRowHeight($lineCount * $defaultHeight);

			// Paraf dari QC dan Produksi
			$nama_qc = $this->pegawai_model->get_nama_lengkap($suhu_rp->username ?? '');
			$nama_prod = $this->pegawai_model->get_nama_lengkap($suhu_rp->nama_produksi ?? '');

			$sheet->setCellValue("J{$row}", $nama_qc ?: '-');
			$sheet->setCellValue("K{$row}", $nama_prod ?: '-');
		}


		// Border dan alignment
		$sheet->getStyle("A4:K{$row}")->applyFromArray([
			'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
			'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER]
		]);
		$sheet->getStyle("J6:J{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

		// TTD dan QR Code
		$row += 3;
		$startRowTTD = $row;

		$sheet->setCellValue("B{$row}", "Dibuat Oleh");
		$sheet->setCellValue("E{$row}", "Diketahui Oleh");
		$sheet->setCellValue("I{$row}", "Disetujui Oleh");

		$row += 4;
		$sheet->setCellValue("B{$row}", $data['suhu']->nama_lengkap_qc ?: '-');
		$sheet->setCellValue("B" . ($row + 1), "QC Inspector");
		$sheet->setCellValue("E{$row}", '');
		$sheet->setCellValue("E" . ($row + 1), "Foreman/Forelady Produksi");
		$sheet->setCellValue("I{$row}", '');
		$sheet->setCellValue("I" . ($row + 1), "Supervisor QC");

		// QR QC
		$qrPathSPV = FCPATH . 'assets/qr_spv.png';
		$qrTextSPV = "Diverifikasi secara digital oleh:\n" .
			($data['suhu']->nama_lengkap_spv ?: '-') .
			"\nSupervisor QC Bread Crumb\nTanggal: " . ($data['suhu']->tgl_update_spv ?? '-');
		QRcode::png($qrTextSPV, $qrPathSPV, QR_ECLEVEL_H, 4);
		$drawingSPV = new Drawing();
		$drawingSPV->setPath($qrPathSPV);
		$drawingSPV->setCoordinates("E" . ($startRowTTD + 1));
		$drawingSPV->setHeight(80);
		$drawingSPV->setWorksheet($sheet);

		$qrPathProd = FCPATH . 'assets/qr_produksi.png';
		$qrTextProd = "Diverifikasi secara digital oleh:\n" .
			($data['suhu']->nama_lengkap_produksi ?: '-') .
			"\nForeman/Forelady Produksi\nTanggal: " . ($data['suhu']->tgl_update_produksi ?? '-');
		QRcode::png($qrTextProd, $qrPathProd, QR_ECLEVEL_H, 4);
		$drawingProd = new Drawing();
		$drawingProd->setPath($qrPathProd);
		$drawingProd->setCoordinates("I" . ($startRowTTD + 1));
		$drawingProd->setHeight(80);
		$drawingProd->setWorksheet($sheet);

		// Export
		$filename = 'Suhu_Ruang_' . date('d-m-Y', strtotime($tanggal)) . '.xlsx';
		ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit;
	}
}
