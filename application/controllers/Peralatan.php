<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peralatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model');
		$this->load->model('peralatan_model');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'peralatan' => $this->peralatan_model->get_data_by_plant(),
			'active_nav' => 'peralatan', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('peralatan/peralatan', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{

		$rules = $this->peralatan_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->peralatan_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Peralatan Kebersihan berhasil di simpan');
				redirect('peralatan');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Peralatan Kebersihan gagal di simpan');
				redirect('peralatan');
			}
		}

		$data = array(
			'active_nav' => 'peralatan');

		$this->load->view('partials/head', $data);
		$this->load->view('peralatan/peralatan-tambah');
		$this->load->view('partials/footer');
	}


	public function edit($uuid)
	{
		$rules = $this->peralatan_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->peralatan_model->update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Peralatan Kebersihan berhasil di Update');
				redirect('peralatan');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Peralatan Kebersihan gagal di Update');
				redirect('peralatan');
			}
		}

		$data = array('peralatan' => $this->peralatan_model->get_by_uuid($uuid),
			'active_nav' => 'peralatan');

		$this->load->view('partials/head', $data);
		$this->load->view('peralatan/peralatan-edit', $data);
		$this->load->view('partials/footer');
	}

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('peralatan');
		}

		$deleted = $this->peralatan_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('peralatan');
	}
}
