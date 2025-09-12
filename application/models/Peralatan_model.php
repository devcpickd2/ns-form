<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Peralatan_model extends CI_Model {
	
	public function rules()
	{
		return[
			[
				'field' => 'peralatan',
				'label' => 'Name of Things',
				'rules' => 'required'
			]
		];
	}

	public function insert()
	{
		$uuid = Uuid::uuid4()->toString();

		$peralatan = $this->input->post('peralatan');
		$plant = $this->session->userdata('plant');
		$username = $this->session->userdata('username');

		$data = array(
			'uuid' => $uuid,
			'username' => $username,
			'peralatan' => $peralatan,
			'plant' => $plant
		);

		$this->db->insert('peralatan', $data);
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function update($uuid)
	{

		$peralatan = $this->input->post('peralatan');

		$data = array(
			'peralatan' => $peralatan,

			'modified_at' => date("Y-m-d H:i:s")
		);

		$this->db->update('peralatan', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function get_all()
	{
		$this->db->order_by('created_at', 'DESC'); 
		$data = $this->db->get('peralatan')->result();
		return $data;
	}

	public function get_data_by_plant()
	{
		$this->db->order_by('created_at', 'DESC');
		$plant = $this->session->userdata('plant');
		return $this->db->get_where('peralatan', ['plant' => $plant])->result();
	}

	public function get_by_uuid($uuid)
	{
		$data = $this->db->get_where('peralatan', array('uuid' => $uuid))->row();
		return $data;
	}

	public function delete_by_uuid($uuid)
	{
		$this->db->where('uuid', $uuid);
		return $this->db->delete('peralatan');
	}
}