<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Produksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model'); 
		$this->load->model('produksi_model');
		$this->load->model('produk_model');
		$this->load->library('upload');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}
	}

	public function index()
	{ 
		$data = array(
			'produksi' => $this->produksi_model->get_data_by_plant(),
			'active_nav' => 'produksi',  
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/produksi/produksi', $data);
		$this->load->view('partials/footer'); 
	}

	public function detail($uuid)
	{
		$data = array(
			'produksi' => $this->produksi_model->get_by_uuid($uuid),
			'active_nav' => 'produksi');

		$this->load->view('partials/head', $data);
		$this->load->view('form/produksi/produksi-detail', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{

		$rules = $this->produksi_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->produksi_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Verifikasi Produksi berhasil di simpan');
				redirect('produksi');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Verifikasi Produksi gagal di simpan');
				redirect('produksi');
			}
		}

		$today = date('Y-m-d');
		$last_kode = $this->produksi_model->get_last_kode_by_date($today);

		$data = array(
			'active_nav' => 'produksi',
			'produk' => $this->produk_model->get_all(),
			'last_kode'  => $last_kode ? $last_kode->kode_produksi : ''
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/produksi/produksi-tambah');
		$this->load->view('partials/footer');
	}


	public function edit($uuid)
	{
		$rules = $this->produksi_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->produksi_model->update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Verifikasi Produksi berhasil di Update');
				redirect('produksi');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Verifikasi Produksi gagal di Update');
				redirect('produksi');
			}
		}

		$data = array(
			'produksi' => $this->produksi_model->get_by_uuid($uuid),
			'active_nav' => 'produksi',
			'produk' => $this->produk_model->get_all(),
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/produksi/produksi-edit', $data);
		$this->load->view('partials/footer');
	}

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('produksi');
		}

		$deleted = $this->produksi_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('produksi');
	}


	public function file_check($str)
	{
		if (!empty($_FILES['labelisasi_karton']['name'])) {
			$allowed_mime = ['image/jpeg', 'image/png', 'application/pdf'];
			$mime = mime_content_type($_FILES['labelisasi_karton']['tmp_name']);

			if (!in_array($mime, $allowed_mime)) {
				$this->form_validation->set_message('file_check', 'File harus berformat JPEG, PNG, atau PDF');
				return false;
			}
		}

		return true; 
	}

	public function packing($uuid)
	{
		$produksi = $this->produksi_model->get_by_uuid($uuid);
		$rules = $this->produksi_model->rules_packing();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$config = array(
				'upload_path' => "./uploads/packing/",
				'allowed_types' => "jpg|png|jpeg|pdf",
				'overwrite' => FALSE,
				'max_size' => "2048000",
				'encrypt_name' => TRUE
			);

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$file_name = $produksi->labelisasi_karton;

			if (!empty($_FILES['labelisasi_karton']['name'])) {
				if (!$this->upload->do_upload('labelisasi_karton')) {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error_msg', 'Upload gagal: ' . $error);
					redirect('produksi/packing/' . $uuid);
				} else {
					$data = $this->upload->data();
					$file_name = $data['file_name'];

					if (!empty($produksi->labelisasi_karton) && file_exists('./uploads/packing/' . $produksi->labelisasi_karton)) {
						unlink('./uploads/packing/' . $produksi->labelisasi_karton);
					}
				}
			}

			$update = $this->produksi_model->pack($uuid, $file_name);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Verifikasi Pengemasan Produk berhasil diupdate');
				redirect('produksi');
			} else {
				$this->session->set_flashdata('error_msg', 'Data Verifikasi Pengemasan Produk gagal diupdate');
				redirect('produksi');
			}
		}

		$data = array(
			'produksi' => $produksi,
			'active_nav' => 'produksi'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/produksi/produksi-packing', $data);
		$this->load->view('partials/footer');
	}

	public function verifikasi()
	{
		$data = array(
			'produksi' => $this->produksi_model->get_data_by_plant(),
			'active_nav' => 'verifikasi-produksi', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/produksi/produksi-verifikasi', $data);
		$this->load->view('partials/footer');
	}


	public function status($uuid)
	{
		$rules = $this->produksi_model->rules_verifikasi();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->produksi_model->verifikasi_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Verifikasi Produksi berhasil di Update');
				redirect('produksi/verifikasi');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Verifikasi Produksi gagal di Update');
				redirect('produksi/verifikasi');
			}
		}

		$data = array(
			'produksi' => $this->produksi_model->get_by_uuid($uuid),
			'active_nav' => 'verifikasi-produksi');

		$this->load->view('partials/head', $data);
		$this->load->view('form/produksi/produksi-status', $data);
		$this->load->view('partials/footer');
	}

	public function diketahui()
	{
		$data = array(
			'produksi' => $this->produksi_model->get_data_by_plant(),
			'active_nav' => 'diketahui-produksi', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/produksi/produksi-diketahui', $data);
		$this->load->view('partials/footer');
	}


	public function statusprod($uuid)
	{
		$rules = $this->produksi_model->rules_diketahui();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->produksi_model->diketahui_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Status Verifikasi Produksi berhasil di Update');
				redirect('produksi/diketahui');
			}else {
				$this->session->set_flashdata('error_msg', 'Status Verifikasi Produksi gagal di Update');
				redirect('produksi/diketahui');
			}
		}

		$data = array(
			'produksi' => $this->produksi_model->get_by_uuid($uuid),
			'active_nav' => 'diketahui-produksi');

		$this->load->view('partials/head', $data);
		$this->load->view('form/produksi/produksi-statusprod', $data);
		$this->load->view('partials/footer');
	}

	public function get_nama_produk_by_tanggal()
	{
		$tanggal = $this->input->post('tanggal');
		$plant = $this->session->userdata('plant');

		if (!$tanggal) {
			echo json_encode([]);
			return;
		}

		$this->load->model('produksi_model');
		$result = $this->produksi_model->get_produk_by_date($tanggal, $plant);

		log_message('debug', 'Tanggal: ' . $tanggal . ', Plant: ' . $plant . ', Hasil: ' . json_encode($result));

		echo json_encode($result);
	}

	public function cetak()
	{
		$tanggal = $this->input->post('tanggal');  
		$produk_uuid = $this->input->post('produk_uuid'); 

		if (empty($tanggal) || empty($produk_uuid)) {
			show_error('Tanggal dan Produk harus dipilih', 404);
		}

		$plant = $this->session->userdata('plant');

		$produksi_data = $this->produksi_model->get_by_date_and_produk($tanggal, $produk_uuid, $plant); 
		$produksi_data_verif = $this->produksi_model->get_last_verif_by_date_and_produk($tanggal, $produk_uuid, $plant); 

		if (!$produksi_data || !$produksi_data_verif) {
			$this->session->set_flashdata('error_msg', 'Data tidak ditemukan untuk tanggal dan produk yang dipilih.');
			redirect('produksi/verifikasi'); 
		}


		$data['produksi_data'] = $produksi_data;
		$data['produksi'] = $produksi_data_verif;

		$this->load->model('pegawai_model');
		$data['produksi']->nama_lengkap_qc = $this->pegawai_model->get_nama_lengkap($data['produksi']->username);
		$data['produksi']->nama_lengkap_spv = $this->pegawai_model->get_nama_lengkap($data['produksi']->nama_spv);
		$data['produksi']->nama_lengkap_produksi = $this->pegawai_model->get_nama_lengkap($data['produksi']->nama_produksi);

		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
		$pdf->setPrintHeader(false); 
		$pdf->SetMargins(17, 10, 15); 
		$pdf->SetFont('times', '', 9);

		$maxColumnsPerRow = 8;
		$chunked_produksi = array_chunk($produksi_data, $maxColumnsPerRow);
		$pageIndex = 0;

		foreach ($chunked_produksi as $chunkIndex => $chunk) {
			$pdf->AddPage('L', 'LEGAL');
			$pdf->SetFont('times', 'B', 13);

			$logo_path = FCPATH . 'assets/img/logo.jpg';
			if (file_exists($logo_path)) {
				$pdf->Image($logo_path, 17, 14, 32);
			}

			$pdf->Write(9, "\n");
			$pdf->MultiCell(0, 5, 'VERIFIKASI PROSES PRODUKSI', 0, 'C');
			$pdf->Ln(3);

			setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
			$tanggal = $data['produksi']->date;
			$date = new DateTime($tanggal);
			$formatted_date = strftime('%A, %d %B %Y', $date->getTimestamp());
			$formatted_date2 = strftime('%d %B %Y', $date->getTimestamp());

			$pdf->SetFont('times', '', 9);
			$pdf->SetX(16);
			$pdf->Write(0, 'Hari / Tanggal : ' . $formatted_date);
			$pdf->SetX($pdf->GetX() + 20);
			$pdf->Write(0, 'Shift: ' . $data['produksi']->shift);
			$pdf->Ln(5);

        // === ISI TABEL (sama persis dengan kode Anda sebelumnya) ===
			$emptyColumns = $maxColumnsPerRow - count($chunk);

        // Sebelumnya masih $item->nama_produk (UUID)
			$pdf->Cell(40, 4, 'Nama Produk', 1, 0, 'L');
			foreach ($chunk as $item) {
				$pdf->Cell(35, 4, $item->nama_produk_asli, 1, 0, 'C'); 
			}
			for ($i = 0; $i < $emptyColumns; $i++) {
				$pdf->Cell(35, 4, '', 1, 0, 'C');
			}
			$pdf->Ln();

			$pdf->Cell(40, 4, 'Kode Produksi', 1, 0, 'L');
			foreach ($chunk as $item) {
				$pdf->Cell(35, 4, $item->kode_produksi, 1, 0, 'C');
			}
			for ($i = 0; $i < $emptyColumns; $i++) {
				$pdf->Cell(35, 4, '', 1, 0, 'C');
			}
			$pdf->Ln();

			$pdf->SetFont('times', 'B', 7);
			$pdf->Cell(40, 4, 'Parameter', 1, 0, 'L');
			foreach ($chunk as $item) {
				$pdf->Cell(19, 4, 'Kode', 1, 0, 'C');
				$pdf->Cell(8, 4, 'Kg', 1, 0, 'C');
				$pdf->Cell(8, 4, 'Sens', 1, 0, 'C');
			}
			for ($i = 0; $i < $emptyColumns; $i++) {
				$pdf->Cell(19, 4, '', 1, 0, 'C');
				$pdf->Cell(8, 4, '', 1, 0, 'C');
				$pdf->Cell(8, 4, '', 1, 0, 'C');
			}
			$pdf->Ln();

			$pdf->Cell(320, 4, 'Bahan Baku', 1, 0, 'L');
			$pdf->Ln();

			$premixColumns = [];
			foreach ($chunk as $item) {
				$premixData = json_decode($item->raw_mat, true);
				$premixColumns[] = is_array($premixData) ? $premixData : [];
			}

			$maxRows = max(array_map('count', $premixColumns));

			for ($row = 0; $row < $maxRows; $row++) {
				$namaBahan = '';
				foreach ($premixColumns as $col) {
					if (isset($col[$row]['nama'])) {
						$namaBahan = $col[$row]['nama'];
						break;
					}
				}

				$pdf->Cell(40, 4, $namaBahan, 1, 0, 'L');

				for ($col = 0; $col < count($chunk); $col++) {
					$kode  = $premixColumns[$col][$row]['kode']  ?? '';
					$berat = $premixColumns[$col][$row]['berat'] ?? '';
					$sens  = $premixColumns[$col][$row]['sens']  ?? '';

					$pdf->Cell(19, 4, $kode, 1, 0, 'C');
					$pdf->Cell(8, 4, $berat, 1, 0, 'C');
					$pdf->Cell(8, 4, $sens, 1, 0, 'C');
				}

				for ($i = 0; $i < $emptyColumns; $i++) {
					$pdf->Cell(19, 4, '', 1, 0, 'C');
					$pdf->Cell(8, 4, '', 1, 0, 'C');
					$pdf->Cell(8, 4, '', 1, 0, 'C');
				}

				$pdf->Ln();
			}

			$pdf->SetFont('times', 'B', 7);
			$pdf->Cell(40, 4, 'Premix', 1, 0, 'L');
			foreach ($chunk as $item) {
				$pdf->Cell(25, 4, 'Kode', 1, 0, 'C');
				$pdf->Cell(10, 4, 'Sens', 1, 0, 'C');
			}
			for ($i = 0; $i < $emptyColumns; $i++) {
				$pdf->Cell(25, 4, '', 1, 0, 'C');
				$pdf->Cell(10, 4, '', 1, 0, 'C');
			}
			$pdf->Ln();

			$premixDataColumns = [];
			foreach ($chunk as $item) {
				$premixData = json_decode($item->premix, true);
				$premixDataColumns[] = is_array($premixData) ? $premixData : [];
			}

			$maxPremixRows = max(array_map('count', $premixDataColumns));

			for ($row = 0; $row < $maxPremixRows; $row++) {
				$namaPremix = '';
				foreach ($premixDataColumns as $col) {
					if (isset($col[$row]['nama'])) {
						$namaPremix = $col[$row]['nama'];
						break;
					}
				}

				$pdf->Cell(40, 4, $namaPremix, 1, 0, 'L');

				for ($col = 0; $col < count($chunk); $col++) {
					$kode = $premixDataColumns[$col][$row]['kode'] ?? '';
					$sens = $premixDataColumns[$col][$row]['sens'] ?? '';
					$pdf->Cell(25, 4, $kode, 1, 0, 'C');
					$pdf->Cell(10, 4, $sens, 1, 0, 'C');
				}

				for ($i = 0; $i < $emptyColumns; $i++) {
					$pdf->Cell(25, 4, '', 1, 0, 'C');
					$pdf->Cell(10, 4, '', 1, 0, 'C');
				}

				$pdf->Ln();
			}

			$pdf->Cell(40, 4, 'Hasil Mixing', 1, 0, 'L');
			foreach ($chunk as $item) {
				$pdf->Cell(35, 4, $item->hasil_mixing, 1, 0, 'C');
			}
			for ($i = 0; $i < $emptyColumns; $i++) {
				$pdf->Cell(35, 4, '', 1, 0, 'C');
			}
			$pdf->Ln();

			$pdf->Cell(40, 4, 'Waktu Mixing Premix', 1, 0, 'L');
			foreach ($chunk as $item) {
				$pdf->Cell(35, 4, $item->waktu_mixing_premix . " menit", 1, 0, 'C');
			}
			for ($i = 0; $i < $emptyColumns; $i++) {
				$pdf->Cell(35, 4, '', 1, 0, 'C');
			}
			$pdf->Ln();

			$pdf->SetFont('times', 'B', 7);
			$pdf->Cell(320, 4, 'Sensori', 1, 0, 'L');
			$pdf->Ln();

			$pdf->SetFont('times', 'B', 7);
			$sensori_fields = [
				'rasa' => 'Rasa',
				'aroma' => 'Aroma',
				'tekstur' => 'Tekstur',
				'warna' => 'Warna'
			];

			foreach ($sensori_fields as $field => $label) {
				$pdf->SetFont('times', 'B', 7);
				$pdf->Cell(40, 4, $label, 1, 0, 'L');
				$pdf->SetFont('dejavusans', '', 7);
				foreach ($chunk as $item) {
					$pdf->Cell(35, 4, ($item->{'sens_' . $field} == 'oke') ? '✔' : '✘', 1, 0, 'C');
				}
				for ($i = 0; $i < $emptyColumns; $i++) {
					$pdf->Cell(35, 4, '', 1, 0, 'C');
				}
				$pdf->Ln();
			}
			$tanggal_packing = $data['produksi']->date_packing;
			$date_pack = new DateTime($tanggal_packing);
			$formatted_packing = strftime('%A, %d %B %Y', $date_pack->getTimestamp());
			$pdf->SetFont('times', '', 9);
			$pdf->SetX(16);
			$pdf->Write(0, 'Hari / Tanggal : ' . $formatted_packing);
			$pdf->SetX($pdf->GetX() + 20);
			$pdf->Write(0, 'Shift : ' . $data['produksi']->shift_packing);
			$pdf->SetX($pdf->GetX() + 20);
			$pdf->Write(0, 'Pukul : ' . date('H:i', strtotime($data['produksi']->pukul_packing)));
			$pdf->Ln(5);

			$pdf->SetFont('times', 'B', 7);
			$pdf->Cell(40, 4, 'Kondisi Produk', 1, 0, 'L');

			foreach ($chunk as $item) {
				$val = '';
				if (!empty($item->kondisi_produk)) {
					$pdf->SetFont('dejavusans', '', 7);
					$val = (strtolower(trim($item->kondisi_produk)) === 'oke') ? '✔' : '✘';
				}
				$pdf->Cell(35, 4, $val, 1, 0, 'C');
			}

			for ($i = 0; $i < $emptyColumns; $i++) {
				$pdf->Cell(35, 4, '', 1, 0, 'C');
			}
			$pdf->Ln();

			$pdf->SetFont('times', 'B', 7);
			$pdf->Cell(40, 4, 'Kondisi Seal', 1, 0, 'L');

			foreach ($chunk as $item) {
				$val = '';
				if (!empty($item->kondisi_seal)) {
					$pdf->SetFont('dejavusans', '', 7);
					$val = (strtolower(trim($item->kondisi_seal)) === 'oke') ? '✔' : '✘';
				}
				$pdf->Cell(35, 4, $val, 1, 0, 'C');
			}

			for ($i = 0; $i < $emptyColumns; $i++) {
				$pdf->Cell(35, 4, '', 1, 0, 'C');
			}
			$pdf->Ln();

			$pdf->SetFont('times', 'B', 7);

			$first = reset($chunk); 
			$jenis_packing = $first ? $first->jenis_packing : '';

			$pdf->Cell(40, 4, 'Berat Kotor ' . $jenis_packing . ' (gr)', 1, 0, 'L');

			foreach ($chunk as $item) {
				$pdf->Cell(35, 4, $item->berat, 1, 0, 'C');
			}
			for ($i = 0; $i < $emptyColumns; $i++) {
				$pdf->Cell(35, 4, '', 1, 0, 'C');
			}
			$pdf->Ln();

			$pdf->Cell(40, 4, 'Berat Kotor Karton (gr)', 1, 0, 'L');
			foreach ($chunk as $item) {
				$pdf->Cell(35, 4, $item->berat_kotor_karton, 1, 0, 'C');
			}
			for ($i = 0; $i < $emptyColumns; $i++) {
				$pdf->Cell(35, 4, '', 1, 0, 'C');
			}
			$pdf->Ln();
			$cellWidth = 35;
			$cellHeight = 8; 
			$totalHeight = $cellHeight * 3;

			$x = $pdf->GetX();
			$y = $pdf->GetY();
			$pdf->Cell(40, $cellHeight, 'Kode Produksi', 1, 2, 'L');
			$pdf->Cell(40, $cellHeight, 'Expired Date', 1, 2, 'L');
			$pdf->Cell(40, $cellHeight, 'Labelisasi Karton', 1, 0, 'L');

			$pdf->SetXY($x + 40, $y); 
			foreach ($chunk as $item) {
				$pdf->Cell($cellWidth, $totalHeight, '', 1, 0, 'C');
				if (!empty($item->labelisasi_karton) && file_exists(FCPATH . 'uploads/packing/' . $item->labelisasi_karton)) {
					$imgPath = FCPATH . 'uploads/packing/' . $item->labelisasi_karton;
					$padding = 2;
					$imgWidth = $cellWidth - 2 * $padding;
					$imgHeight = $totalHeight - 2 * $padding;

					$pdf->Image($imgPath, $pdf->GetX() - $cellWidth + $padding, $y + $padding, $imgWidth, $imgHeight);
				}
			}

			for ($i = 0; $i < $emptyColumns; $i++) {
				$pdf->Cell($cellWidth, $totalHeight, '', 1, 0, 'C');
			}

			$pdf->Ln($totalHeight);



			$pdf->SetFont('times', 'B', 7);
			$pdf->Cell(40, 4, 'Kondisi Seal Karton', 1, 0, 'L');

			foreach ($chunk as $item) {
				$val = '';
				if (!empty($item->kondisi_seal_karton)) {
					$pdf->SetFont('dejavusans', '', 7);
					$val = (strtolower(trim($item->kondisi_seal_karton)) === 'oke') ? '✔' : '✘';
				}
				$pdf->Cell(35, 4, $val, 1, 0, 'C');
			}

			for ($i = 0; $i < $emptyColumns; $i++) {
				$pdf->Cell(35, 4, '', 1, 0, 'C');
			}
			$pdf->Ln();

			$pageIndex++;
			$pdf->SetY($pdf->GetY() + 2); 
			$pdf->SetFont('times', '', 8);
			$pdf->Cell(5, 5, 'Catatan : ', 0, 1, 'L');
			foreach ($chunk as $item) {
				if (!empty($item->catatan)) {
					$pdf->Cell(13, 0, '', 0, 0, 'L'); 
					$pdf->Cell(200, 0, ' - ' . $item->catatan, 0, 1, 'L');
				}
			}

			$y_after_keterangan = $pdf->GetY();
			$status_verifikasi = true;
			foreach ($chunk as $item) {
				if ($item->status_spv != '1') {
					$status_verifikasi = false;
					break;
				}
			}

			$pdf->SetFont('times', '', 8);
			$pdf->SetTextColor(0, 0, 0);

			if ($status_verifikasi) {
				$y_verifikasi = $y_after_keterangan;
				$pdf->SetXY(40, $y_verifikasi + 3);
				$pdf->Cell(60, 5, 'Dibuat Oleh,', 0, 0, 'C');
				$pdf->SetXY(40, $y_verifikasi + 10);
				$pdf->SetFont('times', 'U', 8);
				$pdf->Cell(60, 5, $data['produksi']->nama_lengkap_qc, 0, 1, 'C');
				$pdf->SetFont('times', '', 8); 
				$pdf->SetXY(40, $y_verifikasi + 14);
				$pdf->Cell(60, 5, 'QC Inspector', 0, 0, 'C');

				$pdf->SetXY(100, $y_verifikasi + 3);
				$pdf->Cell(165, 5, 'Diketahui Oleh,', 0, 0, 'C');
				if ($data['produksi']->status_produksi == 1 && !empty($data['produksi']->nama_produksi)) {
					$pdf->SetXY(100, $y_verifikasi + 10);
					$pdf->SetFont('times', 'U', 8);
					$pdf->Cell(165, 5, $data['produksi']->nama_lengkap_produksi, 0, 0, 'C');
					$pdf->SetFont('times', '', 8);
					$pdf->SetXY(100, $y_verifikasi + 14);
					$pdf->Cell(165, 5, 'Foreman/Forelady Produksi', 0, 0, 'C');
				} else {
					$pdf->SetXY(100, $y_verifikasi + 12);
					$pdf->Cell(165, 5, 'Belum Diverifikasi', 0, 0, 'C');
				}

				$pdf->SetXY(260, $y_verifikasi + 1);
				$pdf->Cell(59, 5, 'Disetujui Oleh,', 0, 0, 'C');
				$update_tanggal = (new DateTime($data['produksi']->tgl_update))->format('d-m-Y | H:i');
				$qr_text = "Diverifikasi secara digital oleh,\n" . $data['produksi']->nama_lengkap_spv . "\nSPV QC Bread Crumb\n" . $update_tanggal;
				$pdf->write2DBarcode($qr_text, 'QRCODE,L', 283, $y_verifikasi + 5.5, 13, 13, null, 'N');
				$pdf->SetXY(260, $y_verifikasi + 17);
				$pdf->Cell(59, 5, 'Supervisor QC', 0, 0, 'C');
			} else {
				$pdf->SetTextColor(255, 0, 0); 
				$pdf->SetFont('times', '', 8);
				$pdf->SetXY(100, $y_after_keterangan);
				$pdf->Cell(250, 5, 'Data Belum Diverifikasi', 0, 0, 'C');
			}
			$pdf->setPrintFooter(false);
		}

		$filename = "Verifikasi Proses Produksi_{$formatted_date2}.pdf";
		$pdf->Output($filename, 'I');
	}

	public function export_excel()
	{
		require_once(FCPATH . 'vendor/autoload.php');

		$tanggal = $this->input->post('tanggal');
		$nama_produk = $this->input->post('nama_produk');

		if (empty($tanggal) || empty($nama_produk)) {
			show_error('Tanggal dan Nama Produk harus dipilih', 404);
		}

		$this->load->model('produksi_model');
		$this->load->model('pegawai_model');

		$plant = $this->session->userdata('plant');
		$produksi_data = $this->produksi_model->get_by_date_and_produk($tanggal, $nama_produk, $plant);
		$produksi_data_verif = $this->produksi_model->get_last_verif_by_date_and_produk($tanggal, $nama_produk, $plant);

		if (!$produksi_data || !$produksi_data_verif) {
			$this->session->set_flashdata('error_msg', 'Data tidak ditemukan untuk tanggal dan produk yang dipilih.');
			redirect('produksi/verifikasi');
		}

		$qc = $this->pegawai_model->get_nama_lengkap($produksi_data_verif->username);
		$spv = $this->pegawai_model->get_nama_lengkap($produksi_data_verif->nama_spv);
		$produksi = $produksi_data_verif->nama_produksi;

		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle('Verifikasi Produksi');

		$sheet->mergeCells('A1:J1');
		$sheet->setCellValue('A1', 'VERIFIKASI PROSES PRODUKSI');
		$sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
		$sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

		$sheet->setCellValue('A3', 'Tanggal');
		$sheet->setCellValue('B3', date('d-m-Y', strtotime($produksi_data_verif->date)));
		$sheet->setCellValue('A4', 'Shift');
		$sheet->setCellValue('B4', $produksi_data_verif->shift);

		$row = 6;

		foreach ($produksi_data as $item) {
			$sheet->setCellValue("A{$row}", 'Nama Produk');
			$sheet->setCellValue("B{$row}", $item->nama_produk);
			$row++;
			$sheet->setCellValue("A{$row}", 'Kode Produksi');
			$sheet->setCellValue("B{$row}", $item->kode_produksi);
			$row++;

			$sheet->setCellValue("A{$row}", '=== Bahan Baku ===');
			$row++;
			$sheet->setCellValue("A{$row}", 'Nama');
			$sheet->setCellValue("B{$row}", 'Kode');
			$sheet->setCellValue("C{$row}", 'Berat (Kg)');
			$sheet->setCellValue("D{$row}", 'Sens');
			$row++;

			$bahan_baku = json_decode($item->raw_mat, true);
			if (is_array($bahan_baku)) {
				foreach ($bahan_baku as $bahan) {
					$sheet->setCellValue("A{$row}", $bahan['nama'] ?? '');
					$sheet->setCellValue("B{$row}", $bahan['kode'] ?? '');
					$sheet->setCellValue("C{$row}", $bahan['berat'] ?? '');
					$sheet->setCellValue("D{$row}", $bahan['sens'] ?? '');
					$row++;
				}
			}

			$row++;
			$sheet->setCellValue("A{$row}", '=== Premix ===');
			$row++;
			$sheet->setCellValue("A{$row}", 'Nama');
			$sheet->setCellValue("B{$row}", 'Kode');
			$sheet->setCellValue("C{$row}", 'Sens');
			$row++;

			$premix = json_decode($item->premix, true);
			if (is_array($premix)) {
				foreach ($premix as $p) {
					$sheet->setCellValue("A{$row}", $p['nama'] ?? '');
					$sheet->setCellValue("B{$row}", $p['kode'] ?? '');
					$sheet->setCellValue("C{$row}", $p['sens'] ?? '');
					$row++;
				}
			}

			$row++;
			$sheet->setCellValue("A{$row}", 'Hasil Mixing');
			$sheet->setCellValue("B{$row}", $item->hasil_mixing);
			$row++;
			$sheet->setCellValue("A{$row}", 'Waktu Mixing Premix');
			$sheet->setCellValue("B{$row}", $item->waktu_mixing_premix . ' menit');
			$row++;

			$sheet->setCellValue("A{$row}", '=== Sensori ===');
			$row++;
			$sheet->setCellValue("A{$row}", 'Rasa');
			$sheet->setCellValueExplicit("B{$row}", $item->sens_rasa === 'oke' ? '✔' : '✘', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$row++;
			$sheet->setCellValue("A{$row}", 'Aroma');
			$sheet->setCellValueExplicit("B{$row}", $item->sens_aroma === 'oke' ? '✔' : '✘', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$row++;
			$sheet->setCellValue("A{$row}", 'Tekstur');
			$sheet->setCellValueExplicit("B{$row}", $item->sens_tekstur === 'oke' ? '✔' : '✘', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$row++;
			$sheet->setCellValue("A{$row}", 'Warna');
			$sheet->setCellValueExplicit("B{$row}", $item->sens_warna === 'oke' ? '✔' : '✘', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$row++;

			if (!empty($item->catatan)) {
				$sheet->setCellValue("A{$row}", 'Catatan');
				$sheet->setCellValue("B{$row}", $item->catatan);
				$row++;
			}

			$row += 2;
		}

    // Tanda Tangan
		$sheet->setCellValue("B{$row}", 'Dibuat Oleh');
		$sheet->setCellValue("E{$row}", 'Diketahui Oleh');
		$sheet->setCellValue("H{$row}", 'Disetujui Oleh');
		$row += 3;
		$sheet->setCellValue("B{$row}", $qc ?: '-');
		$sheet->setCellValue("E{$row}", $produksi ?: '-');
		$sheet->setCellValue("H{$row}", $spv ?: '-');
		$row++;
		$sheet->setCellValue("B{$row}", 'QC Inspector');
		$sheet->setCellValue("E{$row}", 'Foreman Produksi');
		$sheet->setCellValue("H{$row}", 'Supervisor QC');

    // Border dan Wrap
		$sheet->getStyle("A6:J{$row}")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$sheet->getStyle("A6:J{$row}")->getAlignment()->setWrapText(true);

    // Output Excel
		$filename = 'Verifikasi_Produksi_' . date('Ymd_His') . '.xlsx';

		if (ob_get_length()) ob_end_clean();
		ob_start();

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header('Cache-Control: max-age=0');

		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
		$writer->save('php://output');
		exit;
	}


}

