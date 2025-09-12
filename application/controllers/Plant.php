<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plant extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model');
		$this->load->model('plant_model');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'plant' => $this->plant_model->get_all(),
			'active_nav' => 'plant', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('plant/plant', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{

		$rules = $this->plant_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->plant_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data Plant berhasil di simpan');
				redirect('plant');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Plant gagal di simpan');
				redirect('plant');
			}
		}

		$data = array(
			'active_nav' => 'plant');

		$this->load->view('partials/head', $data);
		$this->load->view('plant/plant-tambah');
		$this->load->view('partials/footer');
	}


	public function edit($uuid)
	{
		$rules = $this->plant_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->plant_model->update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data Plant berhasil di Update');
				redirect('plant');
			}else {
				$this->session->set_flashdata('error_msg', 'Data Plant gagal di Update');
				redirect('plant');
			}
		}

		$data = array('plant' => $this->plant_model->get_by_uuid($uuid),
			'active_nav' => 'plant');

		$this->load->view('partials/head', $data);
		$this->load->view('plant/plant-edit', $data);
		$this->load->view('partials/footer');
	}

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('plant');
		}

		$deleted = $this->plant_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data.');
		}

		redirect('plant');
	}
}
