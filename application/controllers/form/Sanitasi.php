<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Dompdf\Dompdf;
setlocale(LC_TIME, 'id_ID.UTF-8');

class Sanitasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model'); 
		$this->load->model('sanitasi_model');
		$this->load->library('upload');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'sanitasi' => $this->sanitasi_model->get_data_by_plant(),
			'active_nav' => 'sanitasi', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/sanitasi/sanitasi', $data);
		$this->load->view('partials/footer');
	}

	public function detail($uuid)
	{
		$data = array(
			'sanitasi' => $this->sanitasi_model->get_by_uuid($uuid),
			'active_nav' => 'sanitasi');

		$this->load->view('partials/head', $data);
		$this->load->view('form/sanitasi/sanitasi-detail', $data);
		$this->load->view('partials/footer');
	}

	public function file_check($str)
	{
		if (!empty($_FILES['hand_basin']['name'])) {
			$allowed_mime = ['image/jpeg', 'image/png', 'application/pdf'];
			$mime = mime_content_type($_FILES['hand_basin']['tmp_name']);

			if (!in_array($mime, $allowed_mime)) {
				$this->form_validation->set_message('file_check', 'File harus berformat JPEG, PNG, atau PDF');
				return false;
			}
		}

		return true; 
	}

	public function tambah()
	{
		$rules = $this->sanitasi_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$config = array(
				'upload_path'   => "./uploads/",
				'allowed_types' => "jpg|jpeg|png|pdf",
				'overwrite'     => TRUE,
				'max_size'      => 2048, 
				'encrypt_name'  => TRUE
			);

			$this->load->library('upload');
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('hand_basin')) {

				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error_msg', 'Upload gagal: ' . $error);
				redirect('sanitasi/tambah');

			} else {

				$data = $this->upload->data();
				$file_name = $data['file_name'];

            // 🔥 Kompres jika gambar
				if (in_array(strtolower($data['file_ext']), ['.jpg', '.jpeg', '.png'])) {

					$config_img = array(
						'image_library'  => 'gd2',
						'source_image'   => './uploads/' . $file_name,
						'maintain_ratio' => TRUE,
						'quality'        => '70%',
						'width'          => 800,
						'height'         => 800
					);

					$this->load->library('image_lib');
					$this->image_lib->initialize($config_img);

					if (!$this->image_lib->resize()) {
						echo $this->image_lib->display_errors();
					}

					$this->image_lib->clear();
				}

				$insert = $this->sanitasi_model->insert($file_name);

				if ($insert) {
					$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Sanitasi berhasil disimpan');
				} else {
					$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Sanitasi gagal disimpan');
				}

				redirect('sanitasi');
			}
		}

		$data = array(
			'sanitasi'   => $this->sanitasi_model->get_data_by_plant(),
			'active_nav' => 'sanitasi'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/sanitasi/sanitasi-tambah');
		$this->load->view('partials/footer');
	}

	public function edit($uuid)
	{
		$sanitasi = $this->sanitasi_model->get_by_uuid($uuid);
		$rules = $this->sanitasi_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$config = array(
				'upload_path'   => "./uploads/",
				'allowed_types' => "jpg|jpeg|png|pdf",
				'overwrite'     => FALSE,
				'max_size'      => 2048, 
				'encrypt_name'  => TRUE
			);

			$this->load->library('upload');
			$this->upload->initialize($config);

        // Default pakai file lama
			$file_name = $sanitasi->hand_basin;

        // Jika ada file baru diupload
			if (!empty($_FILES['hand_basin']['name'])) {

				if (!$this->upload->do_upload('hand_basin')) {

					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error_msg', 'Upload gagal: ' . $error);
					redirect('sanitasi/edit/' . $uuid);

				} else {

					$data = $this->upload->data();
					$file_name = $data['file_name'];

                // 🔥 Kompres jika gambar
					if (in_array(strtolower($data['file_ext']), ['.jpg', '.jpeg', '.png'])) {

						$config_img = array(
							'image_library'  => 'gd2',
							'source_image'   => './uploads/' . $file_name,
							'maintain_ratio' => TRUE,
							'quality'        => '70%',
							'width'          => 800,
							'height'         => 800
						);

						$this->load->library('image_lib');
						$this->image_lib->initialize($config_img);

						if (!$this->image_lib->resize()) {
							echo $this->image_lib->display_errors();
						}

						$this->image_lib->clear();
					}

                // 🔥 Hapus file lama
					if (!empty($sanitasi->hand_basin) && file_exists('./uploads/' . $sanitasi->hand_basin)) {
						unlink('./uploads/' . $sanitasi->hand_basin);
					}
				}
			}

			$update = $this->sanitasi_model->update($uuid, $file_name);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Sanitasi berhasil diupdate');
			} else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Sanitasi gagal diupdate');
			}

			redirect('sanitasi');
		}

		$data = array(
			'sanitasi'   => $sanitasi,
			'active_nav' => 'sanitasi'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/sanitasi/sanitasi-edit', $data);
		$this->load->view('partials/footer');
	}

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('sanitasi');
		}

		$deleted = $this->sanitasi_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('sanitasi');
	}
	
	
	public function verifikasi()
	{
		$data = array(
			'sanitasi' => $this->sanitasi_model->get_data_by_plant(),
			'active_nav' => 'verifikasi-sanitasi', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/sanitasi/sanitasi-verifikasi', $data);
		$this->load->view('partials/footer');
	}


	public function status($uuid)
	{
		$rules = $this->sanitasi_model->rules_verifikasi();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$update = $this->sanitasi_model->verifikasi_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pemeriksaan Sanitasi berhasil di Update');
				redirect('sanitasi/verifikasi');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pemeriksaan Sanitasi gagal di Update');
				redirect('sanitasi/verifikasi');
			}
		}

		$data = array(
			'sanitasi' => $this->sanitasi_model->get_by_uuid($uuid),
			'active_nav' => 'verifikasi-sanitasi');

		$this->load->view('partials/head', $data);
		$this->load->view('form/sanitasi/sanitasi-status', $data);
		$this->load->view('partials/footer');
	}

	public function diketahui()
	{
		$data = array(
			'sanitasi' => $this->sanitasi_model->get_data_by_plant(),
			'active_nav' => 'diketahui-sanitasi', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/sanitasi/sanitasi-diketahui', $data);
		$this->load->view('partials/footer');
	}


	public function statusprod($uuid)
	{
		$rules = $this->sanitasi_model->rules_diketahui();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->sanitasi_model->diketahui_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Status Pemeriksaan Sanitasi berhasil di Update');
				redirect('sanitasi/diketahui');
			}else {
				$this->session->set_flashdata('error_msg', 'Status Pemeriksaan Sanitasi gagal di Update');
				redirect('sanitasi/diketahui');
			}
		}

		$data = array(
			'sanitasi' => $this->sanitasi_model->get_by_uuid($uuid),
			'active_nav' => 'diketahui-sanitasi');

		$this->load->view('partials/head', $data);
		$this->load->view('form/sanitasi/sanitasi-statusprod', $data);
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

		$sanitasi_data = $this->sanitasi_model->get_by_date($tanggal, $plant); 
		$sanitasi_data_verif = $this->sanitasi_model->get_last_verif_by_date($tanggal, $plant); 

		if (!$sanitasi_data || !$sanitasi_data_verif) {
			$this->session->set_flashdata('error_msg', 'Data tidak ditemukan untuk tanggal yang dipilih.');
			redirect('sanitasi/verifikasi'); 
		}

		$data['sanitasi'] = $sanitasi_data_verif;

		$this->load->model('pegawai_model');
		$data['sanitasi']->nama_lengkap_qc = $this->pegawai_model->get_nama_lengkap($data['sanitasi']->username);
		$data['sanitasi']->nama_lengkap_spv = $this->pegawai_model->get_nama_lengkap($data['sanitasi']->nama_spv);
		$data['sanitasi']->nama_lengkap_produksi =  $this->pegawai_model->get_nama_lengkap($data['sanitasi']->nama_produksi);

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
		$pdf->MultiCell(0, 5, 'PEMERIKSAAN SANITASI', 0, 'C');
		$pdf->Ln(4);

		$tanggal = $data['sanitasi']->date;
		$datetime = new DateTime($tanggal);
		$formatted_date = strftime('%A, %d %B %Y', $datetime->getTimestamp());
		$formatted_date2 = strftime('%d %B %Y', $datetime->getTimestamp());

		$pdf->SetFont('times', '', 9);
		$pdf->SetX(10);
		$pdf->Write(0, 'Hari / Tanggal: ' . $formatted_date);
		$pdf->SetX($pdf->GetX() + 20);
		$pdf->Write(0, 'Shift: ' . $data['sanitasi']->shift);
		$pdf->Ln(5);

		$pdf->SetFont('times', '', 9);
		$pdf->Cell(15, 10, 'Pukul', 1, 0, 'C');
		$pdf->Cell(80, 5, 'AREA HAND BASIN', 1, 0, 'C');
		$pdf->Cell(60 ,10, 'Keterangan', 1, 0, 'C');
		$pdf->Cell(38, 5, 'Paraf', 1, 1, 'C');
		$pdf->Cell(15, 5, '', 0, 0, 'L');
		$pdf->Cell(40, 5, 'Standar (50 ppm)', 1, 0, 'C');
		$pdf->Cell(40, 5, 'Aktual', 1, 0, 'C');
		$pdf->Cell(60, 0, '', 0, 0, 'C');
		$pdf->Cell(19, 5, 'QC', 1, 0, 'C');
		$pdf->Cell(19, 5, 'Prod', 1, 1, 'C');

		foreach ($sanitasi_data as $sanitasi) {
			$time = $sanitasi->waktu;
			$created_time = (new DateTime($time))->format('H:i');
			$username = $sanitasi->username ?? '-';
			$nama_produksi = $sanitasi->nama_produksi ?? '-';

			$std_symbol = ($sanitasi->std_handbasin == 'Sesuai') ? '✔' : '✘';

			$pdf->Cell(15, 10, $created_time, 1, 0, 'C');
			$pdf->SetFont('dejavusans', '', 9);
			$pdf->Cell(40, 10, $std_symbol, 1, 0, 'C');
			$pdf->SetFont('times', '', 8);

    // Jika ada file gambar
			if (!empty($sanitasi->hand_basin) && file_exists(FCPATH . 'uploads/' . $sanitasi->hand_basin)) {
				$x = $pdf->GetX(); 
				$y = $pdf->GetY();

        // Buat cell kosong dulu
				$pdf->Cell(40, 10, '', 1, 0, 'C');

        // Hitung ukuran asli gambar
				list($img_width, $img_height) = getimagesize(FCPATH . 'uploads/' . $sanitasi->hand_basin);

        // Skala agar muat ke cell (max 36x8 biar ada margin)
				$max_w = 36;
				$max_h = 8;
				$scale = min($max_w / $img_width, $max_h / $img_height);

				$new_w = $img_width * $scale;
				$new_h = $img_height * $scale;

        // Posisi tengah di dalam cell
				$img_x = $x + (40 - $new_w) / 2;
				$img_y = $y + (10 - $new_h) / 2;

        // Masukkan gambar
				$pdf->Image(FCPATH . 'uploads/' . $sanitasi->hand_basin, $img_x, $img_y, $new_w, $new_h);
			} else {
				$pdf->Cell(40, 10, '-', 1, 0, 'C');
			}

			$pdf->Cell(60, 10, $sanitasi->keterangan, 1, 0, 'C');
			$pdf->Cell(19, 10, "$username", 1, 0, 'C');
			$pdf->Cell(19, 10, "$nama_produksi", 1, 1, 'C');
		}

		$pdf->SetFont('times', 'I', 7);
		$pdf->Cell(190, 5, 'QN 03/00', 0, 1, 'R'); 
		$pdf->SetY($pdf->GetY() + 2); 
		$pdf->SetFont('times', '', 8);
		$pdf->Cell(5, 3, 'Catatan : ', 0, 1, 'L');
		foreach ($sanitasi_data as $item) {
			if (!empty($item->catatan)) {
				$pdf->Cell(13, 0, '', 0, 0, 'L'); 
				$pdf->Cell(13, 0, ' - ' . $item->catatan, 0, 1, 'L');
			}
		}

		$y_after_keterangan = $pdf->GetY() + 2;
		$status_verifikasi = true;
		foreach ($sanitasi_data as $item) {
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
		// 	$pdf->SetFont('times', 'U', 8); // underline
		// 	$pdf->Cell(35, 5, $data['sanitasi']->nama_lengkap_qc, 0, 1, 'C');
		// 	$pdf->SetFont('times', '', 8); 
		// 	$pdf->Cell(65, 5, 'QC Inspector', 0, 0, 'C');

		// 	$pdf->SetXY(90, $y_verifikasi + 5);
		// 	$pdf->Cell(35, 5, 'Diketahui Oleh,', 0, 0, 'C');

		// 	if ($data['sanitasi']->status_produksi == 1 && !empty($data['sanitasi']->nama_produksi)) {
		// 		$update_tanggal_produksi = (new DateTime($data['sanitasi']->tgl_update_produksi))->format('d-m-Y | H:i');

		// 		$pdf->SetFont('times', 'U', 8);
		// 		$pdf->SetXY(90, $y_verifikasi + 10);
		// 		$pdf->Cell(35, 5, $data['sanitasi']->nama_lengkap_produksi, 0, 0, 'C');

		// 		$pdf->SetFont('times', '', 8);
		// 		$pdf->SetXY(90, $y_verifikasi + 15);
		// 		$pdf->Cell(35, 5, 'Foreman/Forelady Produksi', 0, 0, 'C');

		// 	} else {
		// 		$pdf->SetXY(90, $y_verifikasi + 10);
		// 		$pdf->Cell(35, 5, 'Belum Diverifikasi', 0, 0, 'C');
		// 	}

		// 	$pdf->SetXY(150, $y_verifikasi + 5);
		// 	$pdf->Cell(49, 5, 'Disetujui Oleh,', 0, 0, 'C');
		// 	$update_tanggal = (new DateTime($data['sanitasi']->tgl_update_spv))->format('d-m-Y | H:i');
		// 	$qr_text = "Diverifikasi secara digital oleh,\n" . $data['sanitasi']->nama_lengkap_spv . "\nSPV QC Bread Crumb\n" . $update_tanggal;
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

		foreach ($sanitasi_data as $item) {
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

		if (!empty($data['sanitasi']->nama_lengkap_produksi) && !empty($data['sanitasi']->tgl_update_produksi)) {
			$prod_tanggal = (new DateTime($data['sanitasi']->tgl_update_produksi ?? $data['sanitasi']->tgl_update_produksi))
			->format('d-m-Y | H:i');

			$qr_produksi_text = "Diketahui secara digital oleh,\n"
			. $data['sanitasi']->nama_lengkap_produksi . "\n"
			. "Foreman/Forelady Produksi\n"
			. $prod_tanggal;
		}

		$spv_tanggal = !empty($data['sanitasi']->tgl_update_spv)
		? (new DateTime($data['sanitasi']->tgl_update_spv))->format('d-m-Y | H:i')
		: '-';

		$qr_spv_text = "Disetujui secara digital oleh,\n"
		. $data['sanitasi']->nama_lengkap_spv . "\n"
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
		$filename = "Pemeriksaan Sanitasi_{$formatted_date2}.pdf";
		$pdf->Output($filename, 'I');
	}

}

