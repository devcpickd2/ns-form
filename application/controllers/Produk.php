<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('auth_model');
		$this->load->model('produk_model');
		if(!$this->auth_model->current_user()){
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'produk' => $this->produk_model->get_data_by_plant(),
			'active_nav' => 'produk', 
		);

		$this->load->view('partials/head', $data);
		$this->load->view('produk/produk', $data);
		$this->load->view('partials/footer');
	}

	public function tambah()
	{

		$rules = $this->produk_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			$insert = $this->produk_model->insert();
			if ($insert) {
				$this->session->set_flashdata('success_msg', 'Data List Produk berhasil di simpan');
				redirect('produk');
			}else {
				$this->session->set_flashdata('error_msg', 'Data List Produk gagal di simpan');
				redirect('produk');
			}
		}

		$data = array(
			'active_nav' => 'produk');

		$this->load->view('partials/head', $data);
		$this->load->view('produk/produk-tambah');
		$this->load->view('partials/footer');
	}


	public function edit($uuid)
	{
		$rules = $this->produk_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {
			
			$update = $this->produk_model->update($uuid);
			if ($update) {
				$this->session->set_flashdata('success_msg', 'Data List Produk berhasil di Update');
				redirect('produk');
			}else {
				$this->session->set_flashdata('error_msg', 'Data List Produk gagal di Update');
				redirect('produk');
			}
		}

		$data = array('produk' => $this->produk_model->get_by_uuid($uuid),
			'active_nav' => 'produk');

		$this->load->view('partials/head', $data);
		$this->load->view('produk/produk-edit', $data);
		$this->load->view('partials/footer');
	}

	public function delete($uuid)
	{
		if (!$uuid) {
			$this->session->set_flashdata('error_msg', 'ID tidak ditemukan.');
			redirect('produk');
		}

		$deleted = $this->produk_model->delete_by_uuid($uuid);

		if ($deleted) {
			$this->session->set_flashdata('success_msg', 'Data List Produk berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal List Produk menghapus data.');
		}

		redirect('produk');
	}
}
