<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Plant_model extends CI_Model {
	
	public function rules()
	{
		return[
			[
				'field' => 'plant',
				'label' => 'Plant',
				'rules' => 'required'
			]
		];
	}


	public function insert()
	{
		$uuid = Uuid::uuid4()->toString();

		$plant = $this->input->post('plant');
		$user_uuid = $this->session->userdata('username');

		$data = array(
			'uuid' => $uuid,
			'user_uuid' => $user_uuid,
			'plant' => $plant
		);

		$this->db->insert('plant', $data);
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function update($uuid)
	{

		$plant = $this->input->post('plant');

		$data = array(
			'plant' => $plant,

			'modified_at' => date("Y-m-d H:i:s")
		);

		$this->db->update('plant', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function get_all()
	{
		$data = $this->db->get('plant')->result();
		return $data;
	}

	public function get_by_uuid($uuid)
	{
		$data = $this->db->get_where('plant', array('uuid' => $uuid))->row();
		return $data;
	}

	public function delete_by_uuid($uuid)
	{
		$this->db->where('uuid', $uuid);
		return $this->db->delete('plant');
	}

	public function getUuid($data)
	{
		$this->db->select('*');
		$this->db->from('plant');
		$this->db->like('plant', $data); 

		$query = $this->db->get();  
		return $query->row();     
	}
}