<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Dompdf\Dompdf;
setlocale(LC_TIME, 'id_ID.UTF-8');

class Kebersihanruang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('auth_model'); 
		$this->load->model('kebersihanruang_model');
		if(!$this->auth_model->current_user()){
			redirect('login');
		} 
	}

	public function index()
	{
		$data = array(
			'kebersihanruang' => $this->kebersihanruang_model->get_data_by_plant(),
			'active_nav' => 'kebersihanruang', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/kebersihanruang/kebersihanruang', $data);
		$this->load->view('partials/footer');
	}

	public function detail($uuid)
	{
		$data = array(
			'kebersihanruang' => $this->kebersihanruang_model->get_by_uuid($uuid),
			'active_nav' => 'kebersihanruang');

		$this->load->view('partials/head', $data);
		$this->load->view('form/kebersihanruang/kebersihanruang-detail', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{

		$rules = $this->kebersihanruang_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->kebersihanruang_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Kebersihan Ruang Produksi berhasil di simpan');
				redirect('kebersihanruang');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Kebersihan Ruang Produksi gagal di simpan');
				redirect('kebersihanruang');
			}
		}

		$data = array(
			'active_nav' => 'kebersihanruang');

		$this->load->view('partials/head', $data);
		$this->load->view('form/kebersihanruang/kebersihanruang-tambah');
		$this->load->view('partials/footer');
	}


	public function edit($uuid)
	{
		$rules = $this->kebersihanruang_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$update = $this->kebersihanruang_model->update($uuid);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Kebersihan Ruang Produksi berhasil diupdate.');
			} else {
				$this->session->set_flashdata('error_msg', 'Data tidak berubah atau gagal diupdate.');
			}

			redirect('kebersihanruang');
		}

		$data = [
			'kebersihanruang' => $this->kebersihanruang_model->get_by_uuid($uuid),
			'bagian_list' => $this->kebersihanruang_model->get_bagian_by_uuid($uuid),
			'active_nav' => 'kebersihanruang'
		];

		$this->load->view('partials/head', $data);
		$this->load->view('form/kebersihanruang/kebersihanruang-edit', $data);
		$this->load->view('partials/footer');
	}

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('kebersihanruang');
		}

		$deleted = $this->kebersihanruang_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('kebersihanruang');
	}
	
	public function verifikasi()
	{
		$data = array(
			'kebersihanruang' => $this->kebersihanruang_model->get_data_by_plant(),
			'active_nav' => 'verifikasi-kebersihanruang', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/kebersihanruang/kebersihanruang-verifikasi', $data);
		$this->load->view('partials/footer');
	}


	public function status($uuid)
	{
		$rules = $this->kebersihanruang_model->rules_verifikasi();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->kebersihanruang_model->verifikasi_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Kebersihan Ruang Produksi berhasil di Update');
				redirect('kebersihanruang/verifikasi');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Kebersihan Ruang Produksi gagal di Update');
				redirect('kebersihanruang/verifikasi');
			}
		}

		$data = array(
			'kebersihanruang' => $this->kebersihanruang_model->get_by_uuid($uuid),
			'active_nav' => 'verifikasi-kebersihanruang');

		$this->load->view('partials/head', $data);
		$this->load->view('form/kebersihanruang/kebersihanruang-status', $data);
		$this->load->view('partials/footer');
	}

	public function diketahui()
	{
		$data = array(
			'kebersihanruang' => $this->kebersihanruang_model->get_data_by_plant(),
			'active_nav' => 'diketahui-kebersihanruang', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/kebersihanruang/kebersihanruang-diketahui', $data);
		$this->load->view('partials/footer');
	}


	public function statusprod($uuid)
	{
		$rules = $this->kebersihanruang_model->rules_diketahui();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->kebersihanruang_model->diketahui_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Status Kebersihan Ruang Produksi berhasil di Update');
				redirect('kebersihanruang/diketahui');
			}else {
				$this->session->set_flashdata('error_msg', 'Status Kebersihan Ruang Produksi gagal di Update');
				redirect('kebersihanruang/diketahui');
			}
		}

		$data = array(
			'kebersihanruang' => $this->kebersihanruang_model->get_by_uuid($uuid),
			'active_nav' => 'diketahui-kebersihanruang');

		$this->load->view('partials/head', $data);
		$this->load->view('form/kebersihanruang/kebersihanruang-statusprod', $data);
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

		$kebersihanruang_data = $this->kebersihanruang_model->get_by_date($tanggal, $plant); 
		$kebersihanruang_data_verif = $this->kebersihanruang_model->get_last_verif_by_date($tanggal, $plant); 

		if (!$kebersihanruang_data || !$kebersihanruang_data_verif) {
			$this->session->set_flashdata('error_msg', 'Data tidak ditemukan untuk tanggal yang dipilih.');
			redirect('kebersihanruang/verifikasi'); 
		}

		$data['kebersihanruang'] = $kebersihanruang_data_verif;

		$this->load->model('pegawai_model');
		$data['kebersihanruang']->nama_lengkap_qc = $this->pegawai_model->get_nama_lengkap($data['kebersihanruang']->username);
		$data['kebersihanruang']->nama_lengkap_spv = $this->pegawai_model->get_nama_lengkap($data['kebersihanruang']->nama_spv);
		$data['kebersihanruang']->nama_lengkap_produksi = $this->pegawai_model->get_nama_lengkap($data['kebersihanruang']->nama_produksi);

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

		$pdf->Write(7, "\n");
		$pdf->MultiCell(0, 5, 'KEBERSIHAN RUANG PRODUKSI', 0, 'C');
		$pdf->Ln(5);

		setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
		$tanggal = $data['kebersihanruang']->date;
		$date = new DateTime($tanggal);
		$formatted_date = strftime('%A, %d %B %Y', $date->getTimestamp());

		$formatted_date2 = strftime('%d %B %Y', $date->getTimestamp());

		$pdf->SetFont('times', '', 9);
		$pdf->SetX(10);
		$pdf->Write(0, 'Hari / Tanggal : ' . $formatted_date);
		$pdf->SetX($pdf->GetX() + 20);
		$pdf->Write(0, 'Shift: ' . $data['kebersihanruang']->shift);
		$pdf->Ln(5);

		$pdf->SetFont('times', '', 10);

		$pdf->Cell(55, 10, 'Lokasi', 1, 0, 'C');
		$pdf->Cell(30, 5, 'Kondisi', 1, 0, 'C');
		$pdf->Cell(55, 10, 'Problem', 1, 0, 'C');
		$pdf->Cell(55, 10, 'Tindakan Koreksi', 1, 0, 'C');
		$pdf->Cell(10, 5, '', 0, 1, 'C');
		// $pdf->Cell(30, 5, 'Paraf', 1, 1, 'C');

		$pdf->Cell(55, 10, '', 0, 0, 'L');
		$pdf->Cell(15, 5, 'Bersih', 1, 0, 'C');
		$pdf->Cell(15, 5, 'Kotor', 1, 0, 'C');
		$pdf->Cell(90, 5, '', 0, 1, 'C');
		// $pdf->Cell(15, 5, 'QC', 1, 0, 'C');
		// $pdf->Cell(15, 5, 'Prod', 1, 1, 'C');

		$no = 1;
		foreach ($kebersihanruang_data as $kebersihanruang) {
			$pdf->SetFont('times', '', 9);
			$pdf->Cell(5, 5, $no, 1, 0, 'L');
			$pdf->Cell(190, 5, $kebersihanruang->lokasi, 1, 1, 'L');

			$detail = json_decode($kebersihanruang->detail);

			if ($detail && is_array($detail)) {
				foreach ($detail as $detail) {
					$bagian = isset($detail->bagian) ? $detail->bagian : '-';
					$kondisi_raw = isset($detail->kondisi) ? strtolower(trim($detail->kondisi)) : '';
					$kondisi1 = '-';
					$kondisi2 = '-';

					if ($kondisi_raw === 'bersih' || $kondisi_raw === '0') {
						$kondisi1 = '✔';
					} elseif (in_array($kondisi_raw, ['1', '2', '3', '4', '5', '6'])) {
						$kondisi2 = $kondisi_raw;
					}
					$problem = isset($detail->problem) ? $detail->problem : '-';
					$tindakan = isset($detail->tindakan) ? $detail->tindakan : '-';

					$pdf->SetFont('times', '', 8);
					$pdf->Cell(55, 4, "$bagian", 1, 0, 'L');
					$pdf->SetFont('dejavusans', '', 8);
					$pdf->Cell(15, 4, "$kondisi1", 1, 0, 'C');
					$pdf->SetFont('times', '', 8);
					$pdf->Cell(15, 4, "$kondisi2", 1, 0, 'C');
					$pdf->Cell(55, 4, "$problem", 1, 0, 'L');
					$pdf->Cell(55, 4, "$tindakan", 1, 1, 'L');
				}
			}

			$no++;
		}


		$y_last = $pdf->GetY();
		$y_last += 5; 

		$pdf->SetFont('times', '', 7);
		$pdf->SetY($pdf->GetY() + 3); 
		$pdf->SetFont('dejavusans', '', 5);
		$kiri = "1 Berdebu\n2 Basah, ada genangan air\n3 Sisa produksi (remah-remah roti, tepung, sisa adonan)\n4 Noda (karat, cat, tinta)\n5 Pertumbuhan mikroorganisme (jamur, bau busuk, biofilm)\n6 Kontak / kontaminasi material non halal\n7 Higiene karyawan tidak sesuai GMP";
		$kanan = "✓ : Ok, sesuai SSOP, bersih, bebas najis / material non halal\n✗ : Tidak Ok, tidak sesuai SSOP\n-  : Tidak ada atau tidak digunakan";
		$posY = $pdf->GetY();
		$pdf->SetXY(10, $posY);
		$pdf->MultiCell(90, 4, $kiri, 0, 'L');
		$pdf->SetXY(105, $posY); 
		$pdf->MultiCell(90, 4, $kanan, 0, 'L'); 

		$y_after_keterangan = $pdf->GetY() + 5;
		$status_verifikasi = true;
		foreach ($kebersihanruang_data as $item) {
			if ($item->status_spv != '1') {
				$status_verifikasi = false;
				break;
			}
		}

		$pdf->SetFont('times', '', 8);
		$pdf->SetTextColor(0, 0, 0);

		if ($status_verifikasi) {
			$y_verifikasi = $y_after_keterangan;

			$pdf->SetXY(25, $y_verifikasi + 10);
			$pdf->Cell(35, 5, 'Dibuat Oleh,', 0, 0, 'C');
			$pdf->SetXY(25, $y_verifikasi + 15);
			$pdf->SetFont('times', 'U', 8); 
			$pdf->Cell(35, 5, $data['kebersihanruang']->nama_lengkap_qc, 0, 1, 'C');
			$pdf->SetFont('times', '', 8); 
			$pdf->Cell(65, 5, 'QC Inspector', 0, 0, 'C');

			$pdf->SetXY(90, $y_verifikasi + 10);
			$pdf->Cell(35, 5, 'Diketahui Oleh,', 0, 0, 'C');

			if ($data['kebersihanruang']->status_produksi == 1 && !empty($data['kebersihanruang']->nama_produksi)) {
				$update_tanggal_produksi = (new DateTime($data['kebersihanruang']->tgl_update_produksi))->format('d-m-Y | H:i');

				$pdf->SetFont('times', 'U', 8);
				$pdf->SetXY(90, $y_verifikasi + 15);
				$pdf->Cell(35, 5, $data['kebersihanruang']->nama_lengkap_produksi, 0, 0, 'C');

				$pdf->SetFont('times', '', 8);
				$pdf->SetXY(90, $y_verifikasi + 20);
				$pdf->Cell(35, 5, 'Foreman/Forelady Produksi', 0, 0, 'C');

			} else {
				$pdf->SetXY(90, $y_verifikasi + 15);
				$pdf->Cell(35, 5, 'Belum Diverifikasi', 0, 0, 'C');
			}

			$pdf->SetXY(150, $y_verifikasi + 10);
			$pdf->Cell(49, 5, 'Disetujui Oleh,', 0, 0, 'C');
			$update_tanggal = (new DateTime($data['kebersihanruang']->tgl_update_spv))->format('d-m-Y | H:i');
			$qr_text = "Diverifikasi secara digital oleh,\n" . $data['kebersihanruang']->nama_lengkap_spv . "\nSPV QC Bread Crumb\n" . $update_tanggal;
			$pdf->write2DBarcode($qr_text, 'QRCODE,L', 167, $y_verifikasi + 15, 15, 15, null, 'N');
			$pdf->SetXY(150, $y_verifikasi + 29);
			$pdf->Cell(49, 5, 'Supervisor QC', 0, 0, 'C');
		} else {
			$pdf->SetTextColor(255, 0, 0); 
			$pdf->SetFont('times', '', 8);
			$pdf->SetXY(100, $y_after_keterangan);
			$pdf->Cell(80, 5, 'Data Belum Diverifikasi', 0, 0, 'C');
		}

		$pdf->setPrintFooter(false);
		$filename = "Kebersihan Ruang_{$formatted_date2}.pdf";
		$pdf->Output($filename, 'I');
	}
}

