<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontaminasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model');  
		$this->load->model('kontaminasi_model');
		$this->load->library('upload');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}
	}

	public function index() 
	{
		$data = array(
			'kontaminasi' => $this->kontaminasi_model->get_data_by_plant(),
			'active_nav' => 'kontaminasi', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/kontaminasi/kontaminasi', $data);
		$this->load->view('partials/footer');
	}

	public function detail($uuid)
	{
		$data = array(
			'kontaminasi' => $this->kontaminasi_model->get_by_uuid($uuid),
			'active_nav' => 'kontaminasi');

		$this->load->view('partials/head', $data);
		$this->load->view('form/kontaminasi/kontaminasi-detail', $data);
		$this->load->view('partials/footer');
	}

	public function file_check($str)
	{
		if (!empty($_FILES['bukti']['name'])) {
			$allowed_mime = ['image/jpeg', 'image/png', 'application/pdf'];
			$mime = mime_content_type($_FILES['bukti']['tmp_name']);

			if (!in_array($mime, $allowed_mime)) {
				$this->form_validation->set_message('file_check', 'File harus berformat JPEG, PNG, atau PDF');
				return false;
			}
		}

		return true; 
	}

public function tambah()
	{
		$rules = $this->kontaminasi_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$config = array(
				'upload_path'   => "./uploads/",
				'allowed_types' => "jpg|png|jpeg|pdf",
				'overwrite'     => TRUE,
				'max_size'      => 2048, 
				'encrypt_name'  => TRUE
			);

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('bukti')) {

				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error_msg', 'Upload gagal: ' . $error);
				redirect('kontaminasi/tambah');

			} else {

				$data = $this->upload->data();
				$file_name = $data['file_name'];

            // 🔥 Kompres jika file gambar
				if (in_array($data['file_ext'], ['.jpg', '.jpeg', '.png'])) {

					$config['image_library']  = 'gd2';
					$config['source_image']   = './uploads/' . $file_name;
					$config['maintain_ratio'] = TRUE;
					$config['quality']        = '70%'; 
					$config['width']         = 800; 
					$config['height']        = 800; 

					$this->load->library('image_lib', $config);
					$this->image_lib->initialize($config);

					$this->image_lib->resize(); 
					$this->image_lib->clear();
				}

				$update = $this->kontaminasi_model->insert($file_name);

				if ($update) {
					$this->session->set_flashdata('success_msg', 'Data Kontaminasi berhasil disimpan');
				} else {
					$this->session->set_flashdata('error_msg', 'Data Kontaminasi gagal disimpan');
				}

				redirect('kontaminasi');
			}
		}

		$data = array(
			'kontaminasi' => $this->kontaminasi_model->get_data_by_plant(),
			'active_nav'  => 'kontaminasi'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/kontaminasi/kontaminasi-tambah');
		$this->load->view('partials/footer');
	}


	public function edit($uuid)
	{
		$kontaminasi = $this->kontaminasi_model->get_by_uuid($uuid);
		$rules = $this->kontaminasi_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$config = array(
				'upload_path'   => "./uploads/",
				'allowed_types' => "jpg|png|jpeg|pdf",
				'overwrite'     => FALSE,
				'max_size'      => 2048,
				'encrypt_name'  => TRUE
			);

			$this->load->library('upload');
			$this->upload->initialize($config);

        // Default pakai file lama
			$file_name = $kontaminasi->bukti; 

        // Jika ada file baru diupload
			if (!empty($_FILES['bukti']['name'])) {

				if (!$this->upload->do_upload('bukti')) {

					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error_msg', 'Upload gagal: ' . $error);
					redirect('kontaminasi/edit/' . $uuid);

				} else {

					$data = $this->upload->data();
					$file_name = $data['file_name'];

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

                // 🔥 Hapus file lama jika ada
					if (!empty($kontaminasi->bukti) && file_exists('./uploads/' . $kontaminasi->bukti)) {
						unlink('./uploads/' . $kontaminasi->bukti);
					}
				}
			}

        // Update database
			$update = $this->kontaminasi_model->update($uuid, $file_name);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Kontaminasi berhasil diupdate');
			} else {
				$this->session->set_flashdata('error_msg', 'Data Kontaminasi gagal diupdate');
			}

			redirect('kontaminasi');
		}

		$data = array(
			'kontaminasi' => $kontaminasi,
			'active_nav'  => 'kontaminasi'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/kontaminasi/kontaminasi-edit', $data);
		$this->load->view('partials/footer');
	}


	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('kontaminasi');
		}

		$deleted = $this->kontaminasi_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('kontaminasi');
	}

	public function verifikasi()
	{
		$data = array(
			'kontaminasi' => $this->kontaminasi_model->get_data_by_plant(),
			'active_nav' => 'verifikasi-kontaminasi', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/kontaminasi/kontaminasi-verifikasi', $data);
		$this->load->view('partials/footer');
	}

	public function status($uuid)
	{
		$rules = $this->kontaminasi_model->rules_verifikasi();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$update = $this->kontaminasi_model->verifikasi_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Status Kontaminasi Benda Asing berhasil di Update');
				redirect('kontaminasi/verifikasi');
			} else {
				$this->session->set_flashdata('error_msg', 'Status Kontaminasi Benda Asing gagal di Update');
				redirect('kontaminasi/verifikasi');
			}
		}

		$data = array(
			'kontaminasi' => $this->kontaminasi_model->get_by_uuid($uuid),
			'active_nav' => 'verifikasi-kontaminasi'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/kontaminasi/kontaminasi-status', $data);
		$this->load->view('partials/footer');
	}

	public function diketahui()
	{
		$data = array(
			'kontaminasi' => $this->kontaminasi_model->get_data_by_plant(),
			'active_nav' => 'diketahui-kontaminasi', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/kontaminasi/kontaminasi-diketahui', $data);
		$this->load->view('partials/footer');
	}

	public function statusprod($uuid)
	{
		$rules = $this->kontaminasi_model->rules_diketahui();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$update = $this->kontaminasi_model->diketahui_update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Status Kontaminasi Benda Asing berhasil di Update');
				redirect('kontaminasi/diketahui');
			} else {
				$this->session->set_flashdata('error_msg', 'Status Kontaminasi Benda Asing gagal di Update');
				redirect('kontaminasi/diketahui');
			}
		}

		$data = array(
			'kontaminasi' => $this->kontaminasi_model->get_by_uuid($uuid),
			'active_nav' => 'diketahui-kontaminasi'
		);

		$this->load->view('partials/head', $data);
		$this->load->view('form/kontaminasi/kontaminasi-statusprod', $data);
		$this->load->view('partials/footer');
	}

	public function cetak()
	{
		ob_start();
		$tanggal = $this->input->post('tanggal');  

		log_message('debug', 'Tanggal yang dipilih: ' . print_r($tanggal, true));

		if (empty($tanggal)) {
			show_error('Tidak ada tanggal yang dipilih', 404);
		}

		$plant = $this->session->userdata('plant');

		$kontaminasi_data = $this->kontaminasi_model->get_by_date($tanggal, $plant); 
		$kontaminasi_data_verif = $this->kontaminasi_model->get_last_verif_by_date($tanggal, $plant); 

		if (!$kontaminasi_data || !$kontaminasi_data_verif) {
			$this->session->set_flashdata('error_msg', 'Data tidak ditemukan untuk tanggal yang dipilih.');
			redirect('kontaminasi/verifikasi'); 
		}

		$data['kontaminasi'] = $kontaminasi_data_verif;

		$this->load->model('pegawai_model');
		$data['kontaminasi']->nama_lengkap_qc = $this->pegawai_model->get_nama_lengkap($data['kontaminasi']->username);
		$data['kontaminasi']->nama_lengkap_spv = $this->pegawai_model->get_nama_lengkap($data['kontaminasi']->nama_spv);
		$data['kontaminasi']->nama_lengkap_produksi =  $this->pegawai_model->get_nama_lengkap($data['kontaminasi']->nama_produksi);

		require_once APPPATH . 'third_party/tcpdf/tcpdf.php';
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
		$pdf->setPrintHeader(false); 
		$pdf->SetMargins(10, 9.5, 10);
		$pdf->AddPage();
		$pdf->SetFont('times', 'B', 12);

		$logo_path = FCPATH . 'assets/img/logo.jpg';
		if (file_exists($logo_path)) {
			$pdf->Image($logo_path, 10, 10, 35);
		}

		setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
		$tanggal = $data['kontaminasi']->date;
		$datetime = new DateTime($tanggal);
		$formatted_date = strftime('%A, %d %B %Y', $datetime->getTimestamp());
		$formatted_date2 = strftime('%d %B %Y', $datetime->getTimestamp());

		$pdf->Write(9, "\n");
		$pdf->MultiCell(0, 5, 'KONTAMINASI BENDA ASING', 0, 'C');
		$pdf->Ln(3);

		$pdf->SetFont('times', '', 9);
		$pdf->SetX(10);
		$pdf->Write(0, 'Tanggal: ' . $formatted_date);
		$pdf->SetX($pdf->GetX() + 20);
		$pdf->Write(0, 'Shift: ' . $data['kontaminasi']->shift);
		$pdf->Ln(5);

		$pdf->SetFont('times', '', 9); 
		$pdf->Cell(10, 10, 'Pukul', 1, 0, 'C');
		$pdf->Cell(30, 10, 'Jenis Kontaminasi', 1, 0, 'C');
		$pdf->Cell(30, 10, 'Bukti', 1, 0, 'C');
		$pdf->Cell(45, 10, 'Nama Produk / Kode Produksi', 1, 0, 'C');
		$pdf->Cell(30, 10, 'Tahapan', 1, 0, 'C');
		$pdf->Cell(26, 10, 'Keterangan', 1, 0, 'C');
		$pdf->Cell(24, 5, 'Paraf', 1, 1, 'C');

		$pdf->Cell(171, 5, '', 0, 0, 'L');
		$pdf->Cell(12, 5, 'QC', 1, 0, 'C');
		$pdf->Cell(12, 5, 'Prod', 1, 0, 'C');
		$pdf->Cell(10, 5, '', 0, 1, 'C');

		foreach ($kontaminasi_data as $kontaminasi) {
			$formattedTime = date('H:i', strtotime($kontaminasi->time));
			$pdf->Cell(10, 20, $formattedTime, 1, 0, 'C');
			$pdf->Cell(30, 20, $kontaminasi->jenis_kontaminasi, 1, 0, 'L');
			$colWidth = 30;
			$colHeight = 20;
			$maxWidthImage = 25;  
			$maxHeightImage = 15; 
			$image_path = FCPATH . 'uploads/' . $kontaminasi->bukti;
			$pdf->Rect($pdf->GetX(), $pdf->GetY(), $colWidth, $colHeight);

			if (file_exists($image_path)) {
				list($width, $height) = getimagesize($image_path);
				$aspectRatio = $width / $height;
				if ($width > $maxWidthImage || $height > $maxHeightImage) {
					if ($width > $height) {
						$newWidth = $maxWidthImage;
						$newHeight = $newWidth / $aspectRatio;
					} else {
						$newHeight = $maxHeightImage;
						$newWidth = $newHeight * $aspectRatio; 
					}
				} else {
					$newWidth = $width;
					$newHeight = $height;
				}
				$xPos = $pdf->GetX() + ($colWidth - $newWidth) / 2; 
				$yPos = $pdf->GetY() + ($colHeight - $newHeight) / 2; 
				$pdf->Image($image_path, $xPos, $yPos, $newWidth, $newHeight);
				$pdf->SetX($pdf->GetX() + $colWidth);
			} else {
				$pdf->Cell($colWidth, $colHeight, 'Gambar Tidak Ada', 1, 0, 'C');
				$pdf->SetX($pdf->GetX() + $colWidth);
			}
			$pdf->Cell(45, 20, $kontaminasi->nama_produk. ' / ' . $kontaminasi->kode_produksi, 1, 0, 'C');
			$pdf->Cell(30, 20, $kontaminasi->tahapan, 1, 0, 'C');
			$pdf->Cell(26, 20, !empty($kontaminasi->keterangan) ? $kontaminasi->keterangan : '-', 1, 0, 'C');
			$pdf->Cell(12, 20, $kontaminasi->username, 1, 0, 'C');
			$pdf->Cell(12, 20, $kontaminasi->nama_produksi, 1, 0, 'C');
			$pdf->Ln();
		}

		$pdf->SetFont('times', 'I', 7);
		$pdf->Cell(190, 5, 'QN 10/00', 0, 1, 'R'); 

		$pdf->SetY($pdf->GetY() + 2); 
		$pdf->SetFont('times', '', 8);
		$pdf->Cell(5, 3, 'Catatan : ', 0, 1, 'L');
		foreach ($kontaminasi_data as $item) {
			if (!empty($item->catatan)) {
				$pdf->Cell(13, 0, '', 0, 0, 'L'); 
				$pdf->Cell(13, 0, ' - ' . $item->catatan, 0, 1, 'L');
			}
		}

		$y_after_keterangan = $pdf->GetY() + 2;
		$status_verifikasi = true;
		foreach ($kontaminasi_data as $item) {
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
		// 	$pdf->Cell(35, 5, $data['kontaminasi']->nama_lengkap_qc, 0, 1, 'C');
		// 	$pdf->SetFont('times', '', 8); 
		// 	$pdf->Cell(65, 5, 'QC Inspector', 0, 0, 'C');

		// 	$pdf->SetXY(90, $y_verifikasi + 5);
		// 	$pdf->Cell(35, 5, 'Diketahui Oleh,', 0, 0, 'C');

		// 	if ($data['kontaminasi']->status_produksi == 1 && !empty($data['kontaminasi']->nama_produksi)) {
		// 		$update_tanggal_produksi = (new DateTime($data['kontaminasi']->tgl_update_produksi))->format('d-m-Y | H:i');

		// 		$pdf->SetFont('times', 'U', 8);
		// 		$pdf->SetXY(90, $y_verifikasi + 10);
		// 		$pdf->Cell(35, 5, $data['kontaminasi']->nama_lengkap_produksi, 0, 0, 'C');

		// 		$pdf->SetFont('times', '', 8);
		// 		$pdf->SetXY(90, $y_verifikasi + 15);
		// 		$pdf->Cell(35, 5, 'Foreman/Forelady Produksi', 0, 0, 'C');

		// 	} else {
		// 		$pdf->SetXY(90, $y_verifikasi + 10);
		// 		$pdf->Cell(35, 5, 'Belum Diverifikasi', 0, 0, 'C');
		// 	}

		// 	$pdf->SetXY(150, $y_verifikasi + 5);
		// 	$pdf->Cell(49, 5, 'Disetujui Oleh,', 0, 0, 'C');
		// 	$update_tanggal = (new DateTime($data['kontaminasi']->tgl_update_spv))->format('d-m-Y | H:i');
		// 	$qr_text = "Diverifikasi secara digital oleh,\n" . $data['kontaminasi']->nama_lengkap_spv . "\nSPV QC Bread Crumb\n" . $update_tanggal;
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

		foreach ($kontaminasi_data as $item) {
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

		if (!empty($data['kontaminasi']->nama_lengkap_produksi) && !empty($data['kontaminasi']->tgl_update_produksi)) {
			$prod_tanggal = (new DateTime($data['kontaminasi']->tgl_update_produksi ?? $data['kontaminasi']->tgl_update_produksi))
			->format('d-m-Y | H:i');

			$qr_produksi_text = "Diketahui secara digital oleh,\n"
			. $data['kontaminasi']->nama_lengkap_produksi . "\n"
			. "Foreman/Forelady Produksi\n"
			. $prod_tanggal;
		}

		$spv_tanggal = !empty($data['kontaminasi']->tgl_update_spv)
		? (new DateTime($data['kontaminasi']->tgl_update_spv))->format('d-m-Y | H:i')
		: '-';

		$qr_spv_text = "Disetujui secara digital oleh,\n"
		. $data['kontaminasi']->nama_lengkap_spv . "\n"
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
		$filename = "Kontaminasi Benda Asing_{$formatted_date2}.pdf";
		if (ob_get_length()) ob_end_clean();
		$pdf->Output($filename, 'I');
	}

}

