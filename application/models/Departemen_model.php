<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Departemen_model extends CI_Model {
	
	public function rules()
	{
		return[
			[
				'field' => 'departemen',
				'label' => 'Department',
				'rules' => 'required'
			]
		];
	}


	public function insert()
	{
		$uuid = Uuid::uuid4()->toString();

		$departemen = $this->input->post('departemen');
		$user_uuid = $this->session->userdata('username');

		$data = array(
			'uuid' => $uuid,
			'user_uuid' => $user_uuid,
			'departemen' => $departemen
		);

		$this->db->insert('departemen', $data);
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function update($uuid)
	{

		$departemen = $this->input->post('departemen');

		$data = array(
			'departemen' => $departemen,

			'modified_at' => date("Y-m-d H:i:s")
		);

		$this->db->update('departemen', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function get_all()
	{
		$data = $this->db->get('departemen')->result();
		return $data;
	}

	public function get_by_uuid($uuid)
	{
		$data = $this->db->get_where('departemen', array('uuid' => $uuid))->row();
		return $data;
	}

	public function delete_by_uuid($uuid)
	{
		$this->db->where('uuid', $uuid);
		return $this->db->delete('departemen');
	}

	public function getUuid($data)
	{
		$this->db->select('*');
		$this->db->from('departemen');
		$this->db->like('departemen', $data);

		$query = $this->db->get();  
		return $query->row();   
	}


}