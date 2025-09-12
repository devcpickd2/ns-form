<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('departemen_model');
		$this->load->model('plant_model');
		$this->load->model('pegawai_model');
		$this->load->library('form_validation');

		if(!$this->auth_model->current_user()){
			redirect('login'); 
		}
	}

	public function index()
	{
		$data = array(
			'pegawai' => $this->pegawai_model->get_all(),
			'active_nav' => 'pegawai', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('pegawai/pegawai');
		$this->load->view('partials/footer');
	}

	public function tambah()
	{
		$rules = $this->pegawai_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->pegawai_model->insert();

			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Pegawai berhasil di simpan');
				redirect('pegawai');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pegawai gagal di simpan');
				redirect('pegawai');
			}
		}

		$data = array(
			'departemen' => $this->departemen_model->get_all(),
			'plant' => $this->plant_model->get_all(),
			'active_nav' => 'pegawai', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('pegawai/pegawai-tambah', $data);
		$this->load->view('partials/footer');
	}

	public function edit($uuid)
	{
		$rules = [
			[
				'field' => 'nama',
				'label' => 'Name',
				'rules' => 'required'
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'valid_email',
				'errors' => array('valid_email' => 'Masukkan alamat email yang valid.')
			], 
			[
				'field' => 'departemen',
				'label' => 'Department',
				'rules' => 'required'
			],
			[
				'field' => 'plant',
				'label' => 'Plant',
				'rules' => 'required'
			],
			[
				'field' => 'tipe_user',
				'label' => 'User Type',
				'rules' => 'required'
			]
		];

		$this->form_validation->set_rules($rules);

		$data = $this->pegawai_model->get_by_uuid($uuid);

		if ($this->form_validation->run() == TRUE) {
			$update = $this->pegawai_model->update($uuid);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pegawai berhasil di update');
				redirect('pegawai');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pegawai gagal di update');
				redirect('pegawai');
			}
		}

		$data = array(
			'pegawai' => $this->pegawai_model->get_by_uuid($uuid),
			'departemen' => $this->departemen_model->get_all(),
			'plant' => $this->plant_model->get_all(),
			'active_nav' => 'pegawai' 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('pegawai/pegawai-edit', $data);
		$this->load->view('partials/footer');
	}

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('pegawai');
		}

		$deleted = $this->pegawai_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('pegawai');
	}

	public function edituser($uuid)
	{
		$rules = [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|is_unique[pegawai.username]'
			]
		];

		$this->form_validation->set_rules($rules);

		$data = $this->pegawai_model->get_by_uuid($uuid);

		if ($this->form_validation->run() == TRUE) {
			$update = $this->pegawai_model->updateuser($uuid);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pegawai berhasil di update');
				redirect('pegawai');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pegawai gagal di update');
				redirect('pegawai');
			}
		}

		$data = array(
			'pegawai' => $this->pegawai_model->get_by_uuid($uuid),
			'departemen' => $this->departemen_model->get_all(),
			'plant' => $this->plant_model->get_all(),
			'active_nav' => 'pegawai' 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('pegawai/pegawai-edituser', $data);
		$this->load->view('partials/footer');
	}

	public function editpass($uuid)
	{
		$rules = [
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|min_length[8]'
			]
		];

		$this->form_validation->set_rules($rules);

		$data = $this->pegawai_model->get_by_uuid($uuid);

		if ($this->form_validation->run() == TRUE) {
			$update = $this->pegawai_model->updatepass($uuid);

			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Pegawai berhasil di update');
				redirect('pegawai');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Pegawai gagal di update');
				redirect('pegawai');
			}
		}

		$data = array(
			'pegawai' => $this->pegawai_model->get_by_uuid($uuid),
			'departemen' => $this->departemen_model->get_all(),
			'plant' => $this->plant_model->get_all(),
			'active_nav' => 'pegawai' 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('pegawai/pegawai-editpass', $data);
		$this->load->view('partials/footer');
	}

	// private function _map_role($roleName)
	// {
	// 	$mapping = [
	// 		'Admin' => 0,
	// 		'Manager' => 1,
	// 		'Supervisor'   => 2,
	// 		'Foreman Forelady Produksi'   => 3,
	// 		'Foreman Forelady QC'   => 8,
	// 	];

    //     return $mapping[$roleName] ?? null; // null if no match
    // }

    // public function syncApi()
    // {
    // 	header('Content-Type: application/json');


    //     // catch PHP warnings/notices into exceptions
    // 	set_error_handler(function ($severity, $message, $file, $line) {
    // 		throw new ErrorException($message, 0, $severity, $file, $line);
    // 	});


    // 	try {
    // 		$json = file_get_contents('php://input');
    // 		$data = json_decode($json, true);


    // 		if (empty($data['user'])) {
    // 			http_response_code(400);
    // 			echo json_encode([
    // 				'status'  => 'error',
    // 				'message' => 'Invalid payload'
    // 			]);
    // 			return;
    // 		}

    // 		$department = $this->departemen_model->getUuid($user['department']['department']);
    // 		$plant = $this->plant_model->getUuid($user['department']['plant']);

    // 		$user = $data['user'];
    // 		$userData = [
    // 			'uuid' => $user['uuid'],
    // 			'nama' => $user['name'],
    // 			'email' => $user['email'],
    // 			'username' => $user['username'],
    // 			'password' => $user['$password'],
    // 			'departemen' => $departemen->uuid,
    // 			'plant' => $plant->uuid,
    // 			'tipe_user'  => $this->_map_role($user['project_role']['role'])
    // 		];

    // 		$result = $this->pegawai_model->syncUser($userData);

    // 		if ($result) {
    // 			echo json_encode([
    // 				'status'  => 'success',
    // 				'message' => 'User synced successfully'
    // 			]);
    // 		} else {
    // 			$error = $this->db->error();
    // 			echo json_encode([
    // 				'status'  => 'error',
    // 				'message' => $error['message'] ?: 'Failed to sync user',
    // 				'details' => $error
    // 			]);
    // 		}
    // 	} catch (Throwable $e) {
    //         // ANY PHP warning/notice will be caught here
    // 		echo json_encode([
    // 			'status'  => 'error',
    // 			'message' => $e->getMessage()              ]);
    // 	} finally {
    // 		restore_error_handler();
    // 	}
    // }


}
