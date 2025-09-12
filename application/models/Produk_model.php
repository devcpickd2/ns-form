<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Produk_model extends CI_Model {
	
	public function rules()
	{
		return[
			[
				'field' => 'nama_produk',
				'label' => 'Name of Product',
				'rules' => 'required'
			]
		];
	}

	public function insert()
	{
		$uuid = Uuid::uuid4()->toString();

		$nama_produk = $this->input->post('nama_produk');
		$plant = $this->session->userdata('plant');
		$username = $this->session->userdata('username');

		$data = array(
			'uuid' => $uuid,
			'username' => $username,
			'nama_produk' => $nama_produk,
			'plant' => $plant
		);

		$this->db->insert('produk', $data); 
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function update($uuid)
	{

		$nama_produk = $this->input->post('nama_produk');

		$data = array(
			'nama_produk' => $nama_produk,

			'modified_at' => date("Y-m-d H:i:s")
		);

		$this->db->update('produk', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function get_all()
	{
		$this->db->order_by('created_at', 'DESC'); 
		$data = $this->db->get('produk')->result();
		return $data;
	}

	public function get_data_by_plant()
	{
		$this->db->order_by('created_at', 'DESC');
		$plant = $this->session->userdata('plant');
		return $this->db->get_where('produk', ['plant' => $plant])->result();
	}

	public function get_by_uuid($uuid)
	{
		$data = $this->db->get_where('produk', array('uuid' => $uuid))->row();
		return $data;
	}

	public function delete_by_uuid($uuid)
	{
		$this->db->where('uuid', $uuid);
		return $this->db->delete('produk');
	}
}